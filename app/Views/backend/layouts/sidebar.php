<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="images/Untitled-1.jpg" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> Marquez</h5>
            <p class="email">marquezzzz@mail.com</p>
        </div>
        <ul class="metismenu" id="menu">
            <li><a href="<?= route_to('KaryawanController::index'); ?>" class="ai-icon" aria-expanded="false">
                    <i class="fas fa-users fw-bold"></i>
                    <span class="nav-text">Karyawan</span>
                </a>
            </li>
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
        </ul>
    </div>
</div>