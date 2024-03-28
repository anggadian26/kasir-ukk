<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasEndLabel" class="offcanvas-title">Piutang telah melewati batas tenggat</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        @if (count($notifPiutang) < 1)
            Data Not Found
        @else
            @foreach ($notifPiutang as $item)
                <div class="card accordion-item active mb-3">
                    <h2 class="accordion-header" id="headingTwo">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne{{ $item->notif_piutang_id }}" aria-expanded="true" aria-controls="accordionTwo">
                            <span class="badge bg-primary">{{ $item->nota }}</span>  | {{ $item->tanggal_tenggat }} | [{{ $item->nama_customer }}]  
                        </button>
                    </h2>

                    <div id="accordionOne{{ $item->notif_piutang_id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table>
                                <tr>
                                    <td class="text-primary">Nota</td>
                                    <td>: <span class="badge bg-primary">{{ $item->nota }}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Nama Customer</td>
                                    <td>: {{ $item->nama_customer }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Alamat Customer</td>
                                    <td>: {{ $item->alamat_customer }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Jumlah Piutang</td>
                                    <td>: Rp. {{ number_format($item->jumlah_piutang, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Tanggal Tenggat</td>
                                    <td>: {{ $item->tanggal_tenggat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Terakhir Pembayaran</td>
                                    <td>: {{ $item->terakhir_dibayar }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary">Sisa Pembayaran</td>
                                    <td>: Rp. {{ number_format($item->sisa_pembayaran, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach 
        @endif
    </div>
</div>
