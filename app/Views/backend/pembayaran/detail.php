<?= $this->extend('backend/layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID Pembayaran</th>
                                <th>:</th>
                                <td><?= $data['pembayaran']['id']; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Bayar</th>
                                <th>:</th>
                                <td><?= date('d F Y', strtotime($data['pembayaran']['tanggal'])); ?></td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <th>:</th>
                                <td><?= number_format($data['pembayaran']['total_bayar'], 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>:</th>
                                <td><?= $data['transaksi']['kode']; ?></td>
                            </tr>
                            <tr>
                                <th>Nominal</th>
                                <th>:</th>
                                <td><?= number_format($data['transaksi']['nominal'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Jatuh Tempo</th>
                                <th>:</th>
                                <td><?= date('d F Y', strtotime($data['transaksi']['jatuh_tempo'])); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>:</th>
                                <td><?= $data['transaksi']['status']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Darurat</th>
                                <th>:</th>
                                <td><?= $data['transaksi']['nama_kontak_darurat']; ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Darurat</th>
                                <th>:</th>
                                <td><?= $data['transaksi']['no_kontak_darurat']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Nasabah</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <td><?= $data['nasabah']['nama_lengkap']; ?></td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <th>:</th>
                            <td><?= $data['nasabah']['nasabah_telp1']; ?></td>
                        </tr>
                        <tr>
                            <th>No Whatsapp</th>
                            <th>:</th>
                            <td><?= $data['nasabah']['nasabah_wa']; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td><?= $data['nasabah']['nasabah_alamat']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title">Foto Barang Gadai</h4>
            </div>
            <div class="card-body">
                <div class="row mt-2">

                    <?php if (empty($data['files'])): ?>
                        <p class="text-center fs-5">Tidak Ada Gambar Barang</p>

                    <?php else: ?>
                        <?php foreach ($data['files'] as $gambar): ?>
                            <div class="col-lg-4 col-md-6 col-6 mb-3 text-center">
                                <img src="<?= base_url($gambar['file_path']); ?>" class="img-thumbnail w-100">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>