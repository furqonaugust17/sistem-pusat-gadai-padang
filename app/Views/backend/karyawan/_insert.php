<div class="modal fade modal-insert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?= route_to('karyawan::create'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" value="<?= old('nama'); ?>" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('nama')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
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
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="no_telp" value="<?= old('no_telp'); ?>" class="form-control telp <?= validation_show_error('no_telp') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('no_telp')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('no_telp'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-control <?= validation_show_error('jabatan') ? 'is-invalid' : ''; ?>" id="">
                                <?php foreach ($groups as $index => $group): ?>
                                    <option value="<?= $group['title']; ?>"><?= $group['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (validation_show_error('jabatan')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jabatan'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="<?= old('username'); ?>" class="form-control <?= validation_show_error('username') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('username')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('username'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= old('email'); ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('email')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('email'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control <?= validation_show_error('password') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('password')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('password'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control <?= validation_show_error('confirm_password') ? 'is-invalid' : ''; ?>">
                            <?php if (validation_show_error('confirm_password')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('confirm_password'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : ''; ?>" id="" cols="30" rows="10"><?= old('alamat'); ?></textarea>
                            <?php if (validation_show_error('alamat')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('alamat'); ?>
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