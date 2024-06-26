<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>komobox | transaksi-penjualan</title>

    <meta name="description" content="" />

    @include('link-asset.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        .table-penjualan tbody tr:last-child {
            display: none;
        }

        .tampil-kembalian {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }

        .has-error .form-control {
            border-color: #a94442;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }


        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }

            .tampil-kembalian {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">


            {{-- contentdisini --}}
            <div class="layout-page">
                <!-- Navbar -->

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card p-3">
                            <div class="">
                                <a href="{{ route('backTransaction.penjualan', ['id' => $penjualan_id]) }}"
                                    class="btn btn-primary pt-1 pb-1 mb-3"
                                    onclick="return confirm('Apakah Anda yakin ingin keluar dari transaksi?')">
                                    <span class="tf-icons bx bx-left-arrow-alt fw-bold"></span> Kembali
                                </a>
                            </div>

                            <div class="row">
                                <div class="col-md-5">

                                </div>
                            </div>

                            <div class="row justify-content-end mb-5">
                                <div class="col-sm-3 text-end">
                                    <form class="form-produk">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id">
                                        <input type="hidden" name="product_code" id="product_code">
                                        <input type="hidden" name="penjualan_id" id="penjualan_id"
                                            value="{{ $penjualan_id }}">
                                    </form>
                                    <button class="btn-lg btn-success ps-5 pe-5 fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#pilihProduk">Pilih Produk</button>
                                </div>
                            </div>
                            @include('penjualan.modal.pilihProdukModal')

                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="3%"><strong>No</strong></th>
                                            <th><strong>Kode Produk</strong></th>
                                            <th><strong>Nama Produk</strong></th>
                                            <th width=15%><strong>Harga Jual</strong></th>
                                            <th width=10%><strong>Diskon</strong></th>
                                            <th width="12%"><strong>Jumlah</strong></th>
                                            <th width="18%"><strong>Sub Total</strong></th>
                                            <th><strong>Aksi</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="detailTableBody">

                                    </tbody>
                                </table>

                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-8">
                                    <span class="fw-bold">Bayar :</span>
                                    <div class="tampil-bayar bg-primary text-white"></div>
                                    <div class="tampil-terbilang"></div>
                                    <br>
                                    <span class="fw-bold">kembalian :</span>
                                    <div class="tampil-kembalian bg-primary text-white"></div>
                                    <div class="tampil-terbilang"></div>
                                </div>
                                <div class="col-lg-4">
                                    <form action="{{ route('saveTransaction.penjualan') }}" class="form-penjualan"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="penjualan_id" value="{{ $penjualan_id }}">
                                        <input type="hidden" name="total_harga" id="totalInputan">
                                        <input type="hidden" name="total_item" id="total_item">
                                        <input type="hidden" name="bayar" id="bayar">
                                        <input type="hidden" name="kembalian" id="kembalianInputan">


                                        <div class="form-group row mb-2">
                                            <label for="totalrp" class="col-lg-4 control-label">Total</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="totalrp" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2">
                                            <label for="ppn" class="col-lg-4 control-label">PPN 11%</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="ppn" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="
                                            "
                                                class="col-lg-4 control-label">Bayar + PPN</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="bayarrp" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="" class="col-lg-4 control-label">Jenis
                                                Pembelian</label>
                                            <div class="col-lg-8">
                                                <select name="jenis_transaksi" class="form-select"
                                                    id="jenis_transaksi" aria-label="Default select example">
                                                    <option value="cash">Cash</option>
                                                    <option value="credit">Credit</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2" id="diterima_input">
                                            <label for="diterima" class="col-lg-4 control-label">Diterima</label>
                                            <div class="col-lg-8">
                                                <input type="number" name="diterima" id="diterima"
                                                    oninput="updateBayar()" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="kembalian_input">
                                            <label for="kembalian" class="col-lg-4 control-label">Kembalian</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="kembalian" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-2" id="nama_customer_input"
                                            style="display: none;">
                                            <label for="uang_muka" class="col-lg-4 control-label">Nama
                                                Customer</label>
                                            <div class="col-lg-8">
                                                <input type="text" name="nama_customer" id="nama_customer"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="alamat_customer_input"
                                            style="display: none;">
                                            <label for="uang_muka" class="col-lg-4 control-label">Alamat
                                                Customer</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" name="alamat_customer" id="alamat_customer" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="dp_zero_input" style="display: none;">
                                            <label for="" class="col-lg-4 control-label">DP 0%</label>
                                            <div class="col-lg-8">
                                                <select name="dp_zero" class="form-select" id="dp_zero"
                                                    aria-label="Default select example">
                                                    <option value="N">Tidak</option>
                                                    <option value="Y">Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="uang_muka_input" style="display: none;">
                                            <label for="uang_muka" class="col-lg-4 control-label">Uang Muka</label>
                                            <div class="col-lg-8">
                                                <input type="number" name="uang_muka" id="uang_muka"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2" id="tanggal_jatuh_tempo_input"
                                            style="display: none;">
                                            <label for="tanggal_jatuh_tempo" class="col-lg-4 control-label">Tanggal
                                                Jatuh Tempo</label>
                                            <div class="col-lg-8">
                                                <input type="date" name="tanggal_jatuh_tempo"
                                                    id="tanggal_jatuh_tempo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="" class="col-lg-4 control-label">Catatan</label>
                                            <div class="col-lg-8">
                                                <textarea class="form-control" name="catatan" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="text-end">
                                <button class="btn-lg btn-primary" onclick="saveTransaksi()" type="submit"><span
                                        class="tf-icons bx bxs-save"></span> Simpan
                                    Transaksi</button>
                            </div>
                          
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('partials.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>

        </div>
    </div>

    @include('link-asset.script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchDataAndUpdateTable() {
            let penjualanId = $('#penjualan_id').val();
            // Fetch data from the server
            $.get("{{ route('productDetail.pembelian', ['id' => $penjualan_id]) }}")
                .done(response => {
                    updateTable(response.detail);
                })
                .fail(errors => {
                    alert('Tidak Dapat Mengambil Data');
                });
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetchDataAndUpdateTable();
        });


        function updateTable(detailData) {
            let tableBody = $('#detailTableBody');
            tableBody.empty();
            let total = 0;

            // console.log(detailData);
            // Loop through the data and append rows to the table
            $.each(detailData, function(index, detail) {
                let sub_total_number = parseFloat(detail.sub_total);
                let harga_jual_number = parseFloat(detail.harga_jual);
                console.log(detail);
                harga_jual_formatted = harga_jual_number.toLocaleString('id-ID');

                // Check if sub_total is a valid number
                let sub_total_formatted;
                if (!isNaN(sub_total_number)) {
                    // Format sub_total as currency if it's a valid number
                    sub_total_formatted = sub_total_number.toLocaleString('id-ID');
                    total += sub_total_number;
                } else {
                    // If sub_total is not a valid number, display it as is
                    sub_total_formatted = detail.sub_total;
                }
                let rowHtml =

                    `<tr>
                    <td>${index + 1}</td>
                    <td>${detail.produk.product_code}</td>
                    <td>${detail.produk.product_name}</td>
                    <td>Rp ${harga_jual_formatted}</td>
                    <td>${detail.produk.diskon}%</td>
                    <td><input type="number" class="form-control quantity" data-id="${detail.detail_penjualan_id}" value="${detail.jumlah}"></td>
                    <td class="fw-bold">Rp ${sub_total_formatted}</td>
                    <td><a href="#" class="btn btn-danger delete-item" data-id="${detail.detail_penjualan_id}"><i class="bx bx-trash me-1"></i></a></td>
                </tr>`;

                tableBody.append(rowHtml);

                $(document).on('input', '.quantity', function() {

                    let id = $(this).data('id');
                    let jumlah = $(this).val();

                    let stok = parseInt(detail.produk.stok.total_stok);
                    console.log(stok);

                    if (jumlah < 1) {
                        $(this).val(1);
                        alert('Jumlah tidak boleh kurang dari 1');
                        return;
                    }
                    if (jumlah > 100000) {
                        $(this).val(100000);
                        alert('Jumlah tidak boleh lebih dari 100000');
                        return;
                    }

                    if (jumlah > stok) {
                        $(this).val(stok);
                        alert('Jumlah tidak boleh melebihi stok');
                        return;
                    }

                    $.post(`{{ url('/penjualan_quantity') }}/${id}`, {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'POST',
                            jumlah: jumlah
                        })
                        .done(response => {
                            fetchDataAndUpdateTable();
                        })
                        .fail(errors => {
                            // alert('Tidak Dapat Menyimpan Data');
                            return;
                        })

                });
            });

            $('#totalrp').val('Rp ' + total.toLocaleString('id-ID'));
            updateBayar();
        }

        function updateBayar() {
            let diterima = parseFloat($('#diterima').val());
            let totalString = $('#totalrp').val().replace(/\./g, '');
            let totalReplace = totalString.replace(/[^\d.-]/g, '');
            let bayar = parseFloat(totalReplace);

            console.log(diterima);

            let ppn = (11 / 100) * bayar;
            let resultBayar = bayar + ppn;

            let kembalianResult = diterima - resultBayar;

            if (isNaN(kembalianResult)) {
                kembalian = 0;
            } else {
                kembalian = kembalianResult;
            }


            console.log(kembalian)

            isiForm(diterima, resultBayar, kembalian)

            $('#bayarrp').val('Rp ' + resultBayar.toLocaleString('id-ID'));
            $('#kembalian').val('Rp ' + kembalian.toLocaleString('id-ID'));
            $('#ppn').val('Rp ' + ppn.toLocaleString('id-ID'));
            $('.tampil-bayar').text('Rp ' + resultBayar.toLocaleString('id-ID'));
            $('.tampil-kembalian').text('Rp ' + kembalian.toLocaleString('id-ID'));

        }

        function isiForm(diterima, resultBayar, kembalian) {
            let totalHarga = resultBayar;
            console.log(totalHarga);
            $('#totalInputan').val(totalHarga);

            let totalItem = $('#detailTableBody tr').length;

            $('#total_item').val(totalItem);

            let bayar = diterima;
            $('#bayar').val(bayar);
            $('#kembalianInputan').val(kembalian);
        }


        function saveTransaksi() {
            // $('.form-penjualan').submit();
            if (validateTransaksi()) {
                let diterima = parseFloat($('#diterima').val());
                let totalString = $('#totalrp').val().replace(/\./g, '');
                let totalReplace = totalString.replace(/[^\d.-]/g, '');
                let bayar = parseFloat(totalReplace);

                if (diterima <= bayar) {
                    alert('Jumlah yang diterima harus lebih besar dari jumlah yang harus dibayar.');
                    return; // Hentikan proses simpan transaksi jika validasi gagal
                }
                $('.form-penjualan').submit();
            }
        }

        function validateTransaksi() {
            let totalHarga = parseFloat($('#totalInputan').val());
            let totalItem = parseInt($('#total_item').val());
            let diterima = parseFloat($('#diterima').val());

            if (totalHarga === 0 || totalItem === 0 || diterima === '') {
                alert('Transaksi belum bisa tersimpan, pastikan untuk mengisi semuanya.');
                return false; 
            }

            return true; 
        }

        $(document).ready(function() {
            $('#jenis_transaksi').change(function() {
                if ($(this).val() === 'credit') {
                    $('#uang_muka_input').show();
                    $('#tanggal_jatuh_tempo_input').show();
                    $('#nama_customer_input').show();
                    $('#alamat_customer_input').show();
                    $('#dp_zero_input').show();
                    $('#diterima_input').hide();
                    $('#kembalian_input').hide();
                    $('#diterima').val(null);
                    updateBayar();
                    $('#buttonNota').hide();
                } else {
                    $('#uang_muka_input').hide();
                    $('#tanggal_jatuh_tempo_input').hide();
                    $('#diterima_input').show();
                    $('#kembalian_input').show();
                    $('#nama_customer_input').hide();
                    $('#alamat_customer_input').hide();
                    $('#dp_zero_input').hide();
                    $('#buttonNota').show();
                }
            });
        });

        $(document).on('click', '.delete-item', function(e) {
            e.preventDefault();
            let id_detail = $(this).data('id');

            $.ajax({
                url: '/delete-penjualan-detail/' + id_detail, // Anda mungkin perlu menyesuaikan URL ini
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hapus baris dari tabel setelah berhasil menghapus data dari server
                    $(this).closest('tr').remove();
                    fetchDataAndUpdateTable();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Gagal menghapus data. Silakan coba lagi.');
                }
            });
        });

        function hideModalProduct() {
            $('#pilihProduk').modal('hide');
        }

        function pilihProduct(id, code, penjualan_id) {
            $('#product_id').val(id);
            $('#product_code').val(code);
            $('#penjualan_id').val(penjualan_id);
            console.log(id);
            console.log(code);
            console.log(penjualan_id);
            hideModalProduct();
            addProduct();
        }

        function addProduct() {
            $.post('{{ route('storeTransactionDetail.penjualan') }}', $('.form-produk').serialize())
                .done(response => {
                    fetchDataAndUpdateTable();
                })
                .fail(errors => {
                    alert('Tidak Dapat Menyimpan Data');
                })
        }
        $(document).ready(function() {
            $('.form-produk').on('submit', function(event) {
                event.preventDefault();
            });
        });
    </script>
</body>

</html>
