<?php

namespace App\Http\Controllers;

use App\Models\DetailPiutangModel;
use App\Models\NotifPiutangModel;
use App\Models\PemasukkanModel;
use App\Models\PengeluaranModel;
use App\Models\PenjualanModel;
use App\Models\PiutangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PiutangController extends Controller
{
    public function showData(Request $request)
    {
        $nama_customer = $request->nama_customer;
        $tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $status_pembayaran = $request->status_pembayaran;

        $query = PiutangModel::query()
            ->select('A.*', 'B.nota', 'B.total_harga')
            ->from('piutang AS A')
            ->join('penjualan AS B', 'A.penjualan_id', '=', 'B.penjualan_id')
            ->when($nama_customer, function($query, $nama_customer) {
                return $query->where('A.nama_customer', 'like', '%' . $nama_customer . '%' );
            })
            ->when($tanggal_jatuh_tempo, function($query, $tanggal_jatuh_tempo) {
                return $query->where('A.tanggal_jatuh_tempo', $tanggal_jatuh_tempo);
            })
            ->when($status_pembayaran, function($query, $status_pembayaran) {
                return $query->where('A.status_pembayaran', $status_pembayaran);
            })
            ->orderBy('A.status_pembayaran', 'desc')
            ->orderBy('A.tanggal_jatuh_tempo', 'asc')
        ;

        $piutang = $query->paginate(20);

        $queryCount = "
            SELECT COUNT(1) AS totalData
            FROM piutang    
        ";

        $total = DB::select($queryCount);

        $queryNotifPiutang = "
            SELECT A.*, B.nama_customer, B.alamat_customer, B.jumlah_piutang, B.uang_muka, C.nota
            FROM notif_piutang A 
            INNER JOIN piutang B ON A.piutang_id = B.piutang_id
            INNER JOIN penjualan C ON B.penjualan_id = C.penjualan_id
            ORDER BY A.tanggal_tenggat ASC
        ";

        $notifPiutang = DB::select($queryNotifPiutang);

        $this->notifPiutang();
        return view("piutang.index", compact('piutang', 'total', 'notifPiutang'));
    }

    public function detailPiutang($id)
    {
        $query = "
            SELECT A.*, B.name
            FROM detail_piutang A
            INNER JOIN users B ON A.record_id = B.id
            WHERE piutang_id = ?
            ORDER BY detail_tanggal ASC
        ";

        $piutang = DB::select($query, [$id]);

        $piutang_base = PiutangModel::find($id);

        return response()->json(["piutang" => $piutang, 'piutang_base' => $piutang_base]);
    }

    public function bayarPiutang(Request $request)
    {
        $val = $request->validate([
            'bayar' => 'required',
            'piutang_id'  => 'required',
        ]);

        $piutang = PiutangModel::find($val['piutang_id']);

        $request->validate([
            'bayar' => 'required|numeric|min:0.01|max:' . $piutang->sisa_piutang,
            'piutang_id' => 'required',
        ], [
            'bayar.max' => 'Nilai pembayaran tidak boleh lebih besar dari sisa pembayaran piutang.',
        ]);

        $piutang_sisa = $piutang->sisa_piutang - $val['bayar'];

        $data = [
            'piutang_id'  => $val['piutang_id'],
            'detail_tanggal'    => Carbon::now()->toDateString(),
            'bayar' => $val['bayar'],
            'sisa'  => $piutang_sisa,
            'record_id' => Auth::user()->id,
        ];

        $detailPiutang = DetailPiutangModel::create($data);

        $piutang->update([
            'sisa_piutang' => $piutang_sisa
        ]);

        if ($piutang_sisa == 0) {
            $piutang->update([
                'status_pembayaran' => 'L'
            ]);

            $penjualan = PenjualanModel::find($piutang->penjualan_id);
            $penjualan->update([
                'status_pembayaran' => 'L'
            ]);
        }

        $dataPemasukkan = [
            'jenis_pemasukkan'     => 'P',
            'tanggal_pemasukkan'   => Carbon::now()->toDateString(),
            'total_nominal'         => $val['bayar'],
            'keterangan'            => 'Pemasukkan pembayaran Credit'
        ]; 

        PemasukkanModel::create($dataPemasukkan);


        return redirect()->route('index.piutang')->with('toast_success', 'Pembayaran Piutang telah sukses!');
    }
    
    private function notifPiutang() {
        $now = Carbon::now()->subDays(1)->toDateString();

        $piutang = PiutangModel::where('tanggal_jatuh_tempo', $now)->get();

        if($piutang) {
            foreach($piutang as $i) {
                $detail = DetailPiutangModel::find($i->piutang_id)->latest()->first();
                $existingNotification = NotifPiutangModel::where('piutang_id', $i->piutang_id)->exists();

                if(!$existingNotification && $detail) {
                    $data = [
                        "piutang_id"        => $i->piutang_id,
                        "tanggal_tenggat"   => $i->tanggal_jatuh_tempo,
                        "terakhir_dibayar"  => $detail->detail_tanggal,
                        "sisa_pembayaran"   => $detail->sisa
                    ];

                    NotifPiutangModel::create($data);
                }
            }
        }
    }
}
