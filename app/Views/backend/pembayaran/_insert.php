<div class="modal fade modal-insert" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?= route_to('pembayaran::create'); ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="single-select">Pilih Transaksi</label>
                            <div class="input-group flex-nowrap <?= validation_show_error('transaksi_id') ? 'is-invalid' : ''; ?>">
                                <select name="transaksi_id" id="single-select"
                                    class="form-control">
                                </select>
                                <button type="button" id="btnScanQR" class="btn btn-primary input-group-text">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>

                            <?php if (validation_show_error('transaksi_id')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('transaksi_id'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="total_bayar">Nominal</label>
                            <input type="text" id="total_bayar" name="total_bayar" class="form-control bg-body <?= validation_show_error('total_bayar') ? 'is-invalid' : ''; ?>" disabled>
                            <?php if (validation_show_error('total_bayar')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('total_bayar'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>