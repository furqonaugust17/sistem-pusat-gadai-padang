<div class="modal fade modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Cabang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= route_to('cabang::create'); ?>" method="post">
                <?= csrf_field() ?>

                <div class="modal-body">
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Cabang</label>
                            <input
                                type="text"
                                name="nama_cabang"
                                value="<?= old('nama_cabang'); ?>"
                                class="form-control <?= validation_show_error('nama_cabang') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('nama_cabang')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama_cabang'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Link Google Maps</label>
                            <input
                                type="text"
                                name="link_google_maps"
                                value="<?= old('link_google_maps'); ?>"
                                class="form-control <?= validation_show_error('link_google_maps') ? 'is-invalid' : ''; ?>"
                                placeholder="https://maps.google.com/...">
                            <?php if (validation_show_error('link_google_maps')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('link_google_maps'); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Alamat Cabang</label>
                            <textarea
                                name="alamat_cabang"
                                class="form-control <?= validation_show_error('alamat_cabang') ? 'is-invalid' : ''; ?>"
                                cols="30"
                                rows="5"><?= old('alamat_cabang'); ?></textarea>

                            <?php if (validation_show_error('alamat_cabang')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('alamat_cabang'); ?>
                                </div>
                            <?php endif; ?>
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