<?= $this->extend('home/layouts/main'); ?>

<?= $this->section('css'); ?>
<link href="<?= base_url('home/vendors/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #444;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        height: 80%;
        width: 100%;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="py-7 py-lg-8">
    <div class="container">
        <div class="row">
            <h1 class="text-center mb-4">Detail Barang Gadai</h1>
            <div class="col-12">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="rouded">
                                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                        class="swiper mySwiper2">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($data['gambar'] as $index => $gambar): ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= base_url($gambar['file_path']) ?>"
                                                        class="card-img-top" alt="...">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <div class="btn-prev">
                                            <i class="fas fa-chevron-left text-black fs-2"></i>
                                        </div>
                                        <div thumbsSlider="" class="swiper mySwiper">
                                            <div class="swiper-wrapper">
                                                <?php if (count($data['gambar']) > 1): ?>
                                                    <?php foreach ($data['gambar'] as $index => $gambar): ?>
                                                        <div class="swiper-slide">
                                                            <img src="<?= base_url($gambar['file_path']) ?>"
                                                                class="card-img-top" alt="...">
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="btn-next">
                                            <i class="fas fa-chevron-right text-black fs-2"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h1 class="mb-0"><?= $data['barang']['nama_barang']; ?></h1>
                                <p class="fs-2 fw-semi-bold"><?= "Rp " . number_format($data['barang']['nilai_taksiran'], 0, ',', '.'); ?></p>
                                <p><?= $data['barang']['deskripsi']; ?></p>

                                <?php if ($data['barang']['tipe_barang'] !== 'Lainnya'): ?>
                                    <p class="mb-0"><strong>Merk:</strong> <?= $data['barang']['merk']; ?></p>
                                    <p class="mb-0"><strong>Tipe:</strong> <?= $data['barang']['tipe']; ?></p>
                                    <p class="mb-0"><strong>Tahun Pembuatan:</strong> <?= $data['barang']['tahun_pembuatan']; ?></p>

                                    <?php if ($data['barang']['tipe_barang'] === 'Kendaraan'): ?>
                                        <p class="mb-0"><strong>Plat Nomor:</strong> <?= $data['barang']['plat_nomor']; ?></p>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
<script src="<?= base_url('home/vendors/swiper/swiper-bundle.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: <?= count($data['gambar']); ?>,
            freeMode: true,
            watchSlidesProgress: true,
        });
        const swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".btn-next",
                prevEl: ".btn-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    })
</script>
<?= $this->endSection(); ?>