<div class="row">
    <span class="fw-bold fs-3">Data Transaksi</span>
    <div class="mb-3 col-md-12">
        <label class="form-label">Tujuan Transaksi <span class="text-danger">*</span></label>
        <select class="form-control <?= validation_show_error('tujuan') ? 'is-invalid' : ''; ?>" name="tujuan" id="">
            <option value="pendidikan" <?= old('tujuan') == 'pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
            <option value="modal-usaha" <?= old('tujuan') == 'modal-usaha' ? 'selected' : ''; ?>>Modal Usaha</option>
            <option value="konsumsi" <?= old('tujuan') == 'konsumsi' ? 'selected' : ''; ?>>Konsumsi</option>
            <option value="lain-lain" <?= old('tujuan') == 'lain-lain' ? 'selected' : ''; ?>>Lain-lain</option>
        </select>
        <?php if (validation_show_error('tujuan')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('tujuan'); ?>
            </div>
        <?php endif; ?>
        <input type="text" class="form-control mt-3 <?= validation_show_error('detail_tujuan') ? 'is-invalid' : ''; ?>" value="<?= old('detail_tujuan'); ?>" name="detail_tujuan" id="detail_tujuan" <?= old('tujuan') != 'lain-lain' ? 'style="display: none;" disabled' : ''; ?>>
        <?php if (validation_show_error('detail_tujuan')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('detail_tujuan'); ?>
            </div>
        <?php endif; ?>
    </div>
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
    <div class="mb-3 col-6">
        <label class="form-label">Lokasi <span class="text-danger">*</span></label>
        <select class="form-control <?= validation_show_error('tujuan') ? 'is-invalid' : ''; ?>" name="cabang_id" id="">
            <?php foreach ($cabangs as $index => $cabang): ?>
                <option value="<?= $cabang['id']; ?>"><?= $cabang['nama_cabang']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (validation_show_error('cabang_id')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('cabang_id'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3 col-6">
        <label class="form-label">Kode <span class="text-danger">*</span></label>
        <input type="text" name="kode_trans" value="<?= old('kode_trans'); ?>" class="form-control <?= validation_show_error('kode_trans') ? 'is-invalid' : ''; ?>">
        <?php if (validation_show_error('kode_trans')): ?>
            <div class="invalid-feedback">
                <?= validation_show_error('kode_trans'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>