<div class="row">
    <span class="fw-bold fs-3">Detail Barang Gadai</span>
    <div class="mb-3 col-md-12">
        <label class="form-label">Merek <span class="text-danger">*</span></label>
        <input type="text" name="merek" value="<?= old('merek'); ?>" class="form-control <?= validation_show_error('merek') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('merek')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('merek'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Tipe <span class="text-danger">*</span></label>
        <input type="text" name="tipe" value="<?= old('tipe'); ?>" class="form-control <?= validation_show_error('tipe') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('tipe')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('tipe'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Tahun Pembuatan <span class="text-danger">*</span></label>
        <input type="text" name="tahun_pembuatan" value="<?= old('tahun_pembuatan'); ?>" class="form-control tahun <?= validation_show_error('tahun_pembuatan') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('tahun_pembuatan')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('tahun_pembuatan'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="kendaraan-section">
        <div class="mb-3 col-md-6">
            <label class="form-label">Plat Nomor <span class="text-danger">*</span></label>
            <input type="text" name="plat_nomor" value="<?= old('plat_nomor'); ?>" class="form-control plat <?= validation_show_error('plat_nomor') ? 'is-invalid' : ''; ?>">
            <?php if (validation_show_error('plat_nomor')): ?>
                <div class="invalid-feedback">
                    <?= validation_show_error('plat_nomor'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">STNK <span class="text-danger">*</span></label>
            <input type="file" name="stnk">
            <!-- <input type="text" name="stnk" value="<?= old('stnk'); ?>" class="form-control <?= validation_show_error('stnk') ? 'is-invalid' : ''; ?>"> -->
            <?php if (validation_show_error('stnk')): ?>
                <div class="invalid-feedback">
                    <?= validation_show_error('stnk'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3 col-md-6">
            <label class="form-label">BPKB <span class="text-danger">*</span></label>
            <input type="file" name="bpkb">
            <!-- <input type="text" name="bpkb" value="<?= old('bpkb'); ?>" class="form-control <?= validation_show_error('bpkb') ? 'is-invalid' : ''; ?>"> -->
            <?php if (validation_show_error('bpkb')): ?>
                <div class="invalid-feedback">
                    <?= validation_show_error('bpkb'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>