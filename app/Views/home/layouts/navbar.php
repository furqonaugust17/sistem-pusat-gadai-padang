<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="light">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('home/logo.png'); ?>" height="35" alt="Pusat Gadai Padang Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-between w-100 ms-lg-5 ms-auto pt-2 pt-lg-0 font-base align-items-center">

                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#services">Layanan</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#process">Cara Kerja</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#about">Tentang</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?= route_to('Home::index'); ?>#contact">Kontak</a></li>

                <li class="nav-item">
                    <a class="nav-link px-3" href="<?= route_to('Home::barangLelang'); ?>">Barang Lelang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="<?= base_url('cek-transaksi'); ?>">Cek Transaksi</a>
                </li>

            </ul>
        </div>
    </div>
</nav>