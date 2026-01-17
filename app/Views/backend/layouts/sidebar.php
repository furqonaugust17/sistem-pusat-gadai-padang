<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="<?= base_url('assets/images/avatar.jpg'); ?>" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Halo,</span> <?= session('karyawan_nama'); ?></h5>
            <p class="email"><?= auth()->user()->email; ?></p>
        </div>
        <ul class="metismenu" id="menu">
            <?php if (auth()->user()->inGroup('admin')): ?>
                <li><a href="<?= route_to('NasabahController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-users fw-bold"></i>
                        <span class="nav-text">Nasabah</span>
                    </a>
                </li>
                <li><a href="<?= route_to('BarangGadaiController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-warehouse fw-bold"></i>
                        <span class="nav-text">Barang Gadai</span>
                    </a>
                </li>
                <li><a href="<?= route_to('TransaksiController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-book-open fw-bold"></i>
                        <span class="nav-text">Transaksi</span>
                    </a>
                </li>
                <li><a href="<?= route_to('PembayaranController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-money-bill fw-bold"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
                <li><a href="<?= route_to('WhatsappController::logPesan'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-comments fw-bold"></i>
                        <span class="nav-text">Riwayat Pesan</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (auth()->user()->inGroup('pemilik')): ?>
                <li><a href="<?= route_to('DashboardController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-chart-area fw-bold"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a href="<?= route_to('KaryawanController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-users fw-bold"></i>
                        <span class="nav-text">Karyawan</span>
                    </a>
                </li>
                <li><a href="<?= route_to('CabangController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-warehouse fw-bold"></i>
                        <span class="nav-text">Cabang</span>
                    </a>
                </li>
                <li><a href="<?= route_to('LaporanController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-file-alt fw-bold"></i>
                        <span class="nav-text">Laporan</span>
                    </a>
                </li>
                <li><a href="<?= route_to('BackupController::index'); ?>" class="ai-icon" aria-expanded="false">
                        <i class="fas fa-cloud-upload-alt fw-bold"></i>
                        <span class="nav-text">Backup Data</span>
                    </a>
                </li>
            <?php endif; ?>
            <li><a href="<?= route_to('WhatsappController::index'); ?>" class="ai-icon" aria-expanded="false">
                    <i class="fab fa-whatsapp fw-bold"></i>
                    <span class="nav-text">WhatsApp</span>
                </a>
            </li>
        </ul>
    </div>
</div>