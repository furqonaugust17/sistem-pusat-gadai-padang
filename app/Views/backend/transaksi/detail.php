<?php

use CodeIgniter\I18n\Time;
?>
<?= $this->extend('backend/layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12 mb-4">
        <form action="<?= route_to('TransaksiController::generateQRCode', $data['id']); ?>" method="post" target="_blank">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-primary float-end">Generate QR Code</button>
        </form>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="table-transaksi" class="display nowrap" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <th>Kode</th>
                                    <th>:</th>
                                    <td><?= $data['kode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nominal</th>
                                    <th>:</th>
                                    <td><?= number_format($data['nominal'], 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th>Jatuh Tempo</th>
                                    <th>:</th>
                                    <td><?= Time::parse($data['jatuh_tempo'])
                                            ->toLocalizedString('dd MMMM yyyy'); ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Darurat</th>
                                    <th>:</th>
                                    <td><?= $data['nama_kontak_darurat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nomor Darurat</th>
                                    <th>:</th>
                                    <td><?= $data['no_kontak_darurat']; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>:</th>
                                    <td><?= $data['status']; ?></td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <th>:</th>
                                    <td><?= $data['nama_cabang']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Nasabah</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="table-nasabah" class="display nowrap" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <th>:</th>
                                    <td><?= $data['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <th>:</th>
                                    <td><?= $data['no_telp1']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Whatsapp</th>
                                    <th>:</th>
                                    <td><?= $data['no_wa']; ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th>:</th>
                                    <td><?= $data['alamat_domisili']; ?></td>
                                </tr>
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
                    <?php if (count($data['files']) == 0): ?>
                        <span class="fs-4 text-center">Tidak Ada Gambar Barang</span>
                    <?php else: ?>
                        <?php foreach ($data['files'] as $gambar): ?>
                            <div class="col-lg-3 col-md-4 col-6 mb-3 text-center">
                                <img class="img-thumbnail w-100" src="<?= base_url($gambar['file_path']); ?>" alt="Gambar Lama">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>