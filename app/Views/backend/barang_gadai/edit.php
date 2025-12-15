<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<form action="<?= route_to('BarangGadaiController::update', $data['id']); ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Barang Gadai</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="table-barang-gadai" class="display nowrap" style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <th>Id<span class="text-danger">*</span></th>
                                                <th>:</th>
                                                <td class="p-2"><input class="bg-body form-control" type="text" value="<?= $data['id']; ?>" disabled></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Barang<span class="text-danger">*</span></th>
                                                <th>:</th>
                                                <td class="p-2">
                                                    <input class="form-control <?= validation_show_error('nama_barang') ? 'is-invalid' : ''; ?>" type="text" name="nama_barang" value="<?= validation_show_error('nama_barang') ? old('nama_barang') : $data['nama_barang']; ?>">
                                                    <?php if (validation_show_error('nama_barang')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= validation_show_error('nama_barang'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi<span class="text-danger">*</span></th>
                                                <th>:</th>
                                                <td class="p-2">
                                                    <textarea class="form-control h-auto <?= validation_show_error('deskripsi') ? 'is-invalid' : ''; ?>" rows="8" name="deskripsi" id=""><?= validation_show_error('deskripsi') ? old('deskripsi') : $data['deskripsi']; ?></textarea>
                                                    <?php if (validation_show_error('deskripsi')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= validation_show_error('deskripsi'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nilai Taksiran<span class="text-danger">*</span></th>
                                                <th>:</th>
                                                <td class="p-2">
                                                    <input class="form-control money <?= validation_show_error('nilai_taksiran') ? 'is-invalid' : ''; ?>" type="text" name="nilai_taksiran" value="<?= validation_show_error('nilai_taksiran') ? old('nilai_taksiran') : number_format($data['nilai_taksiran'], 0, ',', '.'); ?>">
                                                    <?php if (validation_show_error('nilai_taksiran')): ?>
                                                        <div class="invalid-feedback">
                                                            <?= validation_show_error('nilai_taksiran'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <th>:</th>
                                                <td class="p-2">
                                                    <?php if ($data['status'] != 'Lelang'): ?>
                                                        <input class="bg-body form-control" type="text" value="<?= $data['status']; ?>" disabled>
                                                    <?php else: ?>
                                                        <select name="status" id="" class="form-control <?= validation_show_error('status') ? 'is-invalid' : ''; ?>">
                                                            <option value="Lelang" selected>Lelang</option>
                                                            <option value="Terlelang">Terlelang</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            <?= validation_show_error('status'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($data['tipe_barang'] != 'Lainnya'): ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Barang Gadai</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="table-barang-gadai" class="display nowrap" style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <th>Merek<span class="text-danger">*</span></th>
                                                    <th>:</th>
                                                    <td class="p-2">
                                                        <input class="form-control  <?= validation_show_error('merk') ? 'is-invalid' : ''; ?>" type="text" name="merk" value="<?= validation_show_error('merk') ? old('merk') : $data['merk']; ?>">
                                                        <?php if (validation_show_error('merk')): ?>
                                                            <div class="invalid-feedback">
                                                                <?= validation_show_error('merk'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tipe<span class="text-danger">*</span></th>
                                                    <th>:</th>
                                                    <td class="p-2">
                                                        <input class="form-control  <?= validation_show_error('tipe') ? 'is-invalid' : ''; ?>" type="text" name="tipe" value="<?= validation_show_error('tipe') ? old('tipe') : $data['tipe']; ?>">
                                                        <?php if (validation_show_error('tipe')): ?>
                                                            <div class="invalid-feedback">
                                                                <?= validation_show_error('tipe'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tahun Pembuatan<span class="text-danger">*</span></th>
                                                    <th>:</th>
                                                    <td class="p-2">
                                                        <input class="form-control  <?= validation_show_error('tahun_pembuatan') ? 'is-invalid' : ''; ?>" type="text" name="tahun_pembuatan" value="<?= validation_show_error('tahun_pembuatan') ? old('tahun_pembuatan') : $data['tahun_pembuatan']; ?>">
                                                        <?php if (validation_show_error('tahun_pembuatan')): ?>
                                                            <div class="invalid-feedback">
                                                                <?= validation_show_error('tahun_pembuatan'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php if ($data['tipe_barang'] == 'Kendaraan'): ?>
                                                    <tr>
                                                        <th>Plat Nomor<span class="text-danger">*</span></th>
                                                        <th>:</th>
                                                        <td class="p-2">
                                                            <input class="form-control  <?= validation_show_error('plat_nomor') ? 'is-invalid' : ''; ?>" type="text" name="plat_nomor" value="<?= validation_show_error('plat_nomor') ? old('plat_nomor') : $data['plat_nomor']; ?>">
                                                            <?php if (validation_show_error('plat_nomor')): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= validation_show_error('plat_nomor'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>STNK<span class="text-danger">*</span></th>
                                                        <th>:</th>
                                                        <td class="p-2">
                                                            <div class="row align-items-center <?= validation_show_error('stnk') ? 'is-invalid' : ''; ?>">
                                                                <div class="py-lg-0 py-2 col-lg-8">
                                                                    <input type="file" name="stnk">
                                                                </div>
                                                                <div class="py-lg-0 py-2 col-lg-4">
                                                                    <?php if ($data['stnk'] != null): ?>
                                                                        <a target="_blank" class="w-100 btn btn-sm btn-primary" href="<?= route_to('file.barang', $data['id'], 'stnk'); ?>">lihat</a>
                                                                    <?php else: ?>
                                                                        <span>tidak ada STNK</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <?php if (validation_show_error('stnk')): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= validation_show_error('stnk'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>BPKB<span class="text-danger">*</span></th>
                                                        <th>:</th>
                                                        <td class="p-2">
                                                            <div class="row align-items-center <?= validation_show_error('bpkb') ? 'is-invalid' : ''; ?>">
                                                                <div class="py-lg-0 py-2 col-lg-8">
                                                                    <input type="file" name="bpkb">
                                                                </div>
                                                                <div class="py-lg-0 py-2 col-lg-4">
                                                                    <?php if ($data['bpkb'] != null): ?>
                                                                        <a target="_blank" class="w-100 btn btn-sm btn-primary" href="<?= route_to('file.barang', $data['id'], 'bpkb'); ?>">lihat</a>
                                                                    <?php else: ?>
                                                                        <span>tidak ada BPKB</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <?php if (validation_show_error('bpkb')): ?>
                                                                <div class="invalid-feedback">
                                                                    <?= validation_show_error('bpkb'); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Foto Barang Gadai</h4>
                        </div>
                        <div class="card-body">
                            <input class="<?= validation_show_error('file_gambar') ? 'is-invalid' : ''; ?>" type="file" name="file_gambar[]" id="file_gambar" multiple accept="image/*">
                            <?php if (validation_show_error('file_gambar')): ?>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('file_gambar'); ?>
                                </div>
                            <?php endif; ?>
                            <p class="text-danger mt-2" id="errorMsg"></p>

                            <div class="row justify-content-center mt-3" id="oldImages">
                                <?php foreach ($gambars as $gambar): ?>
                                    <div class="col-lg-3 col-md-4 col-6 mb-3 text-center">
                                        <img class="img-thumbnail w-100" src="<?= base_url($gambar['file_path']); ?>" alt="Gambar Lama">
                                        <p class="small text-muted mt-1">Gambar Lama</p>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="row justify-content-center mt-4" id="previewContainer"></div>
                        </div>
                    </div>
                </div>

            </div>
            <button class="btn btn-primary float-end">Simpan</button>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>


<?= $this->section('javascript'); ?>
<script src="<?= base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.money').mask("#.##0", {
            reverse: true
        });

        $('#file_gambar').on('change', function() {
            const maxFiles = 5;
            const files = this.files;
            const previewContainer = $('#previewContainer');
            const errorMsg = $('#errorMsg');

            previewContainer.empty();
            errorMsg.text('');

            if (files.length > maxFiles) {
                errorMsg.text(`Maksimal upload ${maxFiles} gambar.`);
                $(this).val('');
                return;
            }

            $.each(files, function(i, file) {
                if (!file.type.startsWith('image/')) {
                    errorMsg.text('Hanya file gambar yang diizinkan.');
                    return false;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = $('<div>', {
                        class: 'col-lg-3 col-md-4 col-6 mb-3 text-center'
                    });

                    const img = $('<img>', {
                        src: e.target.result,
                        class: 'img-thumbnail w-100',
                        alt: `Preview ${i + 1}`,
                        css: {
                            height: '180px',
                            objectFit: 'cover'
                        }
                    });

                    const label = $('<p>', {
                        text: 'Gambar Baru',
                        class: 'small text-muted mt-1'
                    });

                    col.append(img).append(label);
                    previewContainer.append(col);
                };

                reader.readAsDataURL(file);
            });
        });


        // $('#file_gambar').on('change', function() {
        //     const file = $(this)[0].files[0];
        //     const gambarContainer = $('#gambar_container');
        //     const gambarOld = $('#gambar_old');

        //     console.log(gambarContainer.children().length)

        //     if (gambarContainer.children().length == 1) {
        //         gambarContainer.append(`
        //         <div class="col-lg-6 d-flex align-items-center flex-column" id="gambar_old_container">
        //             <p class="fs-3 fw-bold text-center">Gambar Lama</p>
        //         </div>
        //         <div class="col-lg-6 d-flex align-items-center flex-column" id="gambar_preview_container">
        //             <p class="fs-3 fw-bold text-center">Gambar Baru</p>
        //             <img class="w-50" id="gambar_preview" />
        //         </div>
        //         `)
        //         $('#gambar_old_container').append(gambarOld);
        //     }

        //     const reader = new FileReader();

        //     if (file) {
        //         reader.onload = function(event) {
        //             $("#gambar_preview")
        //                 .attr("src", event.target.result);
        //         };
        //         reader.readAsDataURL(file);
        //     }

        // })
    });
</script>
<?= $this->endSection(); ?>