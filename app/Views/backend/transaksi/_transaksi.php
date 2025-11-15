<div class="row">
    <span class="fw-bold fs-3">Data Transaksi</span>
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
        <label class="form-label">Nomor Kontak Darurat <span class="text-danger">*</span></label>
        <input type="text" name="no_kontak_darurat" value="<?= old('no_kontak_darurat'); ?>" class="form-control telp <?= validation_show_error('no_kontak_darurat') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('no_kontak_darurat')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('no_kontak_darurat'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-12">
        <label class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
        <input type="date" onclick="this.showPicker()" name="jatuh_tempo" value="<?= old('jatuh_tempo'); ?>" class="form-control <?= validation_show_error('jatuh_tempo') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('jatuh_tempo')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('jatuh_tempo'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-12">
        <label class="form-label">Nominal <span class="text-danger">*</span></label>
        <input type="text" name="nominal" value="<?= old('nominal'); ?>" class="form-control money <?= validation_show_error('nominal') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('nominal')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('nominal'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>