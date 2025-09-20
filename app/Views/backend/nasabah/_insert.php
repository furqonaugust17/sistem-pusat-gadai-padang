<div class="modal fade modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Nasabah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?= route_to('Nasabah::create'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <span class="fw-bold fs-3">Data Nasabah</span>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>" class="form-control <?= validation_show_error('nama_lengkap') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('nama_lengkap')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama_lengkap'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Panggilan <span class="text-danger">*</span></label>
                            <input type="text" name="panggilan" value="<?= old('panggilan'); ?>" class="form-control <?= validation_show_error('panggilan') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('panggilan')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('panggilan'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" value="<?= old('tempat_lahir'); ?>" class="form-control <?= validation_show_error('tempat_lahir') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('tempat_lahir')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tempat_lahir'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>" class="form-control <?= validation_show_error('tanggal_lahir') ? 'is-invalid' : ''; ?>" onclick="this.showPicker()">
                            <?php if (validation_show_error('tanggal_lahir')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggal_lahir'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Alamat KTP <span class="text-danger">*</span></label>
                            <textarea name="alamat_ktp" class="form-control <?= validation_show_error('alamat_ktp') ? 'is-invalid' : ''; ?>" id=""><?= old('alamat_ktp'); ?></textarea>
                            <?php if (validation_show_error('alamat_ktp')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('alamat_ktp'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Alamat Domisili <span class="text-danger">*</span></label>
                            <textarea name="alamat_domisili" class="form-control <?= validation_show_error('alamat_domisili') ? 'is-invalid' : ''; ?>" id=""><?= old('alamat_domisili'); ?></textarea>
                            <?php if (validation_show_error('alamat_domisili')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('alamat_domisili'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control <?= validation_show_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" id="">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?php if (validation_show_error('jenis_kelamin')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jenis_kelamin'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">No Telepon 1 <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp1" value="<?= old('no_telp1'); ?>" class="form-control telp <?= validation_show_error('no_telp1') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('no_telp1')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('no_telp1'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">No Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" name="no_wa" value="<?= old('no_wa'); ?>" class="form-control telp <?= validation_show_error('no_wa') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('no_wa')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('no_wa'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">No Telepon 2</label>
                            <input type="text" name="no_telp2" value="<?= old('no_telp2'); ?>" class="form-control telp <?= validation_show_error('no_telp2') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('no_telp2')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('no_telp2'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="<?= old('email'); ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('email')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <span class="fw-bold fs-3">Kontak Darurat</span>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Kontak Darurat <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kontak_darurat" value="<?= old('nama_kontak_darurat'); ?>" class="form-control <?= validation_show_error('nama_kontak_darurat') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('nama_kontak_darurat')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama_kontak_darurat'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">No Kontak Darurat <span class="text-danger">*</span></label>
                            <input type="text" name="no_kontak_darurat" value="<?= old('no_kontak_darurat'); ?>" class="form-control telp <?= validation_show_error('no_kontak_darurat') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('no_kontak_darurat')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('no_kontak_darurat'); ?>
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