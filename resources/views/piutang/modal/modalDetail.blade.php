<div class="modal fade" id="modalDetailPiutang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Detail Piutang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-10">
                        <table>
                            <tr>
                                <td>Tanggal Jatuh Tempo</td>
                                <td class="fw-bold" id="tanggal_jatuh_tempo"></td>
                            </tr>
                            <tr>
                                <td>Nama Customer</td>
                                <td class="fw-bold" id="nama_customer"></td>
                            </tr>
                            <tr>
                                <td>Alamat Customer</td>
                                <td class="fw-bold" id="alamat_customer"></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td class="fw-bold" id="catatan"></td>
                            </tr>
                            <tr>
                                <td>Uang Muka</td>
                                <td class="fw-bold" id="uangMuka"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-2">
                        @if ($loggedInUser->role->role == 'manager' || $loggedInUser->role->role == 'admin' || $loggedInUser->role->role == 'kasir')
                        <button class="btn btn-primary ms-4 mb-3 mt-0 ps-5 pe-5" onclick="bayar()">Bayar</button>
                        @endif
                    </div>
                </div>
                <div class="modal-xl-scroll">
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="table-detail">
                            <thead>
                                <tr>
                                    <th><strong>Tanggal</strong></th>
                                    <th><strong>Bayar</strong></th>
                                    <th><strong>Sisa</strong></th>
                                    <th><strong>Di bayar oleh</strong></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
