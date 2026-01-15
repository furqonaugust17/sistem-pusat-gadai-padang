<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="card">
        <div class="card-body">
            <form action="<?= route_to('ProfileController::create'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="<?= validation_show_error('nama') ? old('nama') : $data->nama; ?>" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : ''; ?>">
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
                        <input type="text" name="no_telp" value="<?= validation_show_error('no_telp') ? old('no_telp') : $data->no_telp; ?>" class="form-control telp <?= validation_show_error('no_telp') ? 'is-invalid' : ''; ?>">
                        <?php if (validation_show_error('no_telp')): ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('no_telp'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" value="<?= validation_show_error('username') ? old('username') : $data->username; ?>" class="form-control <?= validation_show_error('username') ? 'is-invalid' : ''; ?>">
                        <?php if (validation_show_error('username')): ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('username'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3 col-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?= validation_show_error('email') ? old('email') : $data->email_user; ?>" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>">
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
                        <textarea name="alamat" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : ''; ?>" id="" cols="30" rows="10"><?= validation_show_error('alamat') ? old('alamat') : $data->alamat; ?></textarea>
                        <?php if (validation_show_error('alamat')): ?>
                            <div class="invalid-feedback">
                                <?= validation_show_error('alamat'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <button class="btn btn-primary float-end">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const optionPhoneMask = {
            placeholder: '628123456789'
        };
        $('.telp').mask('6280000000000', optionPhoneMask)
    })
</script>
<?= $this->endSection(); ?>