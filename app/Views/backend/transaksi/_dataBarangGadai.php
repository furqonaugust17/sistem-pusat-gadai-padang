<div class="row">
    <span class="fw-bold fs-3">Data Barang Gadai</span>
    <div class="mb-3 col-12">
        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
        <input type="text" name="nama_barang" value="<?= old('nama_barang'); ?>" class="form-control <?= validation_show_error('nama_barang') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('nama_barang')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('nama_barang'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-12">
        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
        <textarea name="deskripsi" class="form-control h-auto <?= validation_show_error('deskripsi') ? 'is-invalid' : ''; ?>" id="" rows="5"><?= old('deskripsi'); ?></textarea>
        <?php if (validation_show_error('deskripsi')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('deskripsi'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-12">
        <label class="form-label">Nilai Taksiran <span class="text-danger">*</span></label>
        <input type="text" name="nilai_taksiran" value="<?= old('nilai_taksiran'); ?>" class="form-control money <?= validation_show_error('nilai_taksiran') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('nilai_taksiran')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('nilai_taksiran'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-12">
        <label class="form-label">Jenis Barang <span class="text-danger">*</span></label>
        <select name="jenis" class="form-control <?= validation_show_error('jenis') ? 'is-invalid' : ''; ?>" id="tipe_barang">
            <option value="Kendaraan">Kendaraan</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <?php if (validation_show_error('jenis')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('jenis'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>