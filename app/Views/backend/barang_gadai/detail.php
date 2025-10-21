<?= $this->extend('backend/layouts/main'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
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
                                    <th>Id</th>
                                    <th>:</th>
                                    <td><?= $data['id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>:</th>
                                    <td><?= $data['nama_barang']; ?></td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th>:</th>
                                    <td><?= $data['deskripsi']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nilai Taksiran</th>
                                    <th>:</th>
                                    <td><?= 'Rp ' . number_format($data['nilai_taksiran'], 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>:</th>
                                    <td><?= $data['status']; ?></td>
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
                                        <th>Merek</th>
                                        <th>:</th>
                                        <td><?= $data['merk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tipe</th>
                                        <th>:</th>
                                        <td><?= $data['tipe']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Pembuatan</th>
                                        <th>:</th>
                                        <td><?= $data['tahun_pembuatan']; ?></td>
                                    </tr>
                                    <?php if ($data['tipe_barang'] == 'Kendaraan'): ?>
                                        <tr>
                                            <th>Plat Nomor</th>
                                            <th>:</th>
                                            <td><?= $data['plat_nomor']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>STNK</th>
                                            <th>:</th>
                                            <td class="py-2">
                                                <?php if ($data['stnk'] != null): ?>
                                                    <a target="_blank" class="w-100 btn btn-sm btn-primary" href="<?= route_to('file.barang', $data['id'], 'stnk'); ?>">lihat</a>
                                                <?php else: ?>
                                                    <span>tidak ada STNK</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>BPKB</th>
                                            <th>:</th>
                                            <td class="py-2">
                                                <?php if ($data['bpkb'] != null): ?>
                                                    <a target="_blank" class="w-100 btn btn-sm btn-primary" href="<?= route_to('file.barang', $data['id'], 'bpkb'); ?>">lihat</a>
                                                <?php else: ?>
                                                    <span>tidak ada BPKB</span>
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

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Foto Barang Gadai</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center mt-3" id="oldImages">
                        <?php foreach ($gambars as $gambar): ?>
                            <div class="col-lg-3 col-md-4 col-6 mb-3 text-center">
                                <img class="img-thumbnail w-100" src="<?= base_url($gambar['file_path']); ?>" alt="Gambar Lama">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>