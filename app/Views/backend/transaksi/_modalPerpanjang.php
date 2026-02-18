<div class="modal fade modal-perpanjang" id="modal-perpanjang" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perpanjang Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-12">
                            <label class="form-label">Kode Transaksi</label>
                            <input type="text" name="kode_transaksi" id="kode_transaksi" class="bg-body form-control" disabled>
                        </div>
                        <div class="mb-3 col-lg-6 col-12">
                            <label class="form-label">Nama Nasabah</label>
                            <input type="text" name="nama_nasabah" id="nama_nasabah" class="bg-body form-control" disabled>
                        </div>
                        <div class="mb-3 col-lg-6 col-12">
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" class="bg-body form-control" disabled>
                        </div>
                        <div class="mb-3 col-lg-6 col-12">
                            <label class="form-label">Berapa Hari? <span class="text-danger">*</span></label>
                            <input type="number" name="interval_days" id="interval_days" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3 col-lg-6 col-12">
                            <label class="form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="text" name="nominal" id="nominal" class="form-control money" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>