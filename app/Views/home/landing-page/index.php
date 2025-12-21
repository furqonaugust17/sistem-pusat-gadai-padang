<?= $this->extend('home/layouts/main'); ?>
<?= $this->section('css'); ?>
<style>
    .hero-cta .btn-primary {
        min-width: 160px;
    }

    .service-card {
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        object-fit: contain;
    }

    .trust-badge {
        border-radius: 6px;
        background: rgba(255, 255, 255, .06);
        padding: 8px 12px;
        display: inline-block;
    }

    .faq .card {
        border: none;
        border-radius: 10px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="py-7 py-lg-8" id="home">
    <div class="bg-holder bg-size" style="background-image:url(<?= base_url('home/assets/img/illustration/2.png'); ?>);background-position:left top;background-size:contain; z-index:-2;"></div>

    <div class="container">
        <div class="row align-items-center h-100 justify-content-center justify-content-lg-start">
            <div class="col-md-9 col-xxl-6 text-md-start text-center py-6 pt-8">
                <h1 class="fs-4 fs-md-5 fs-xxl-4" data-zanim-xs='{"delay":0.3}' data-zanim-trigger="scroll">Memberikan Solusi Tanpa Masalah</h1>
                <p class="lead mt-3 mb-4" data-zanim-xs='{"delay":0.5}' data-zanim-trigger="scroll">Pusat Gadai Padang — layanan gadai resmi dari <strong class="text-black">PT Usaha Gadai Mandiri</strong>. Cair cepat, aman, dan transparan untuk kebutuhan finansial Anda.</p>

                <div class="d-flex flex-column flex-sm-row hero-cta justify-content-center justify-content-md-start mt-4" data-zanim-xs='{"delay":0.6}' data-zanim-trigger="scroll">
                    <a class="btn btn-primary me-2" href="#services" role="button">Layanan Kami</a>
                    <a class="btn btn-light" href="#contact" role="button">Hubungi Kami</a>
                </div>

                <div class="mt-4">
                    <span class="trust-badge me-2">Terdaftar: PT Usaha Gadai Mandiri</span>
                    <span class="trust-badge">Jam Operasional: Sen–Sab 09:30–21:00</span>
                </div>
            </div>
            <!-- <div class="d-none d-xxl-block py-6" style="position: absolute; right: 0; top: 0; width: 70%; z-index: -1;">
                <img src="<?= base_url('home/assets/img/illustration/hero-section.png'); ?>" alt="Hero Illustration" class="img-fluid">
            </div> -->
            <div class="bg-holder d-none d-xxl-block py-6" style="background-image:url(<?= base_url('home/assets/img/illustration/hero-section.png'); ?>);background-position:right center;background-size:70%; z-index:-1;"></div>
        </div>
    </div>
</section>

<!-- Services -->
<section id="services" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col text-center">
                <h2 class="fw-semi-bold">Layanan Kami</h2>
                <p class="text-muted">Kami melayani berbagai jenis barang jaminan dengan proses profesional dan aman.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded-4 service-card">
                    <img src="<?= base_url('home/assets/img/icons/1.png'); ?>" class="feature-icon mb-3" alt="Gadai Emas">
                    <h5 class="mb-2">Gadai Emas & Perhiasan</h5>
                    <p class="mb-0">Penaksiran profesional, suku bunga kompetitif, dan penyimpanan aman untuk perhiasan Anda.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded-4 service-card">
                    <img src="<?= base_url('home/assets/img/icons/2.png'); ?>" class="feature-icon mb-3" alt="Gadai Kendaraan">
                    <h5 class="mb-2">Gadai Kendaraan</h5>
                    <p class="mb-0">Gadai sepeda motor dan mobil — proses cepat dengan dokumen jelas dan aman.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded-4 service-card">
                    <img src="<?= base_url('home/assets/img/icons/3.png'); ?>" class="feature-icon mb-3" alt="Gadai Elektronik">
                    <h5 class="mb-2">Gadai Elektronik & Gadget</h5>
                    <p class="mb-0">HP, laptop, dan perangkat elektronik lainnya menerima penaksiran cepat dan dana cair.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded-4 service-card">
                    <img src="<?= base_url('home/assets/img/icons/5.png'); ?>" class="feature-icon mb-3" alt="Pembayaran Digital">
                    <h5 class="mb-2">Pembayaran Digital</h5>
                    <p class="mb-0">Terima pembayaran melalui transfer bank dan QRIS untuk kemudahan pelanggan.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-4 bg-white rounded-4 service-card">
                    <img src="<?= base_url('home/assets/img/icons/6.png'); ?>" class="feature-icon mb-3" alt="Keamanan">
                    <h5 class="mb-2">Keamanan</h5>
                    <p class="mb-0">Barang kami pastikan disimpan dengan aman dan dirawat</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why choose us -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="fw-semi-bold">Kenapa Memilih Pusat Gadai Padang?</h3>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><strong>Proses Cepat:</strong> Penaksiran dan pencairan dana dalam waktu singkat.</li>
                    <li class="mb-2"><strong>Transparan:</strong> Biaya dan syarat dijelaskan di depan — tidak ada biaya tersembunyi.</li>
                    <li class="mb-2"><strong>Aman:</strong> Penyimpanan profesional dan dokumentasi lengkap.</li>
                    <li class="mb-2"><strong>Resmi & Terdaftar:</strong> Beroperasi di bawah PT Usaha Gadai Mandiri dengan standar operasional yang jelas.</li>
                </ul>
                <div class="mt-4">
                    <a class="btn btn-primary me-2" href="#contact">Ajukan Sekarang</a>
                    <a class="btn btn-outline-secondary" href="#faq">Lihat FAQ</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="<?= base_url('home/assets/img/illustration/4.png'); ?>" class="img-fluid" alt="Keunggulan" style="max-height:320px;">
            </div>
        </div>
    </div>
</section>

<!-- Process -->
<section id="process" class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col">
                <h2 class="fw-semi-bold">Cara Kerja</h2>
                <p class="text-muted">Empat langkah sederhana untuk mendapatkan dana cepat.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-3 text-center">
                <div class="p-4 rounded-4 bg-white">
                    <div class="mb-3"><img src="<?= base_url('home/assets/img/icons/7.png'); ?>" alt="Ajukan" style="width:64px;"></div>
                    <h5>1. Ajukan Gadai</h5>
                    <p class="mb-0">Datang ke kantor dan urusan administrasi akan dilakukan oleh petugas.</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-4 rounded-4 bg-white">
                    <div class="mb-3"><img src="<?= base_url('home/assets/img/icons/8.png'); ?>" alt="Taksir" style="width:64px;"></div>
                    <h5>2. Penaksiran</h5>
                    <p class="mb-0">Petugas menaksir kondisi dan nilai barang secara transparan.</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="p-4 rounded-4 bg-white">
                    <div class="mb-3"><img src="<?= base_url('home/assets/img/icons/9.png'); ?>" alt="Cair" style="width:64px;"></div>
                    <h5>3. Dana Cair</h5>
                    <p class="mb-0">Dana disalurkan segera setelah dokumen lengkap dan barang diterima.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="fw-semi-bold">Testimoni Pelanggan</h2>
                <p class="text-muted">Pengalaman nyata dari pelanggan kami</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light">
                    <p class="mb-2">"Prosesnya cepat dan petugas sangat profesional. Barang disimpan dengan aman sampai saya tebus."</p>
                    <strong>- Siti, Padang</strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light">
                    <p class="mb-2">"Harga transparan dan saya mendapat dana secara langsung. Rekomen!"</p>
                    <strong>- Agus, Bukittinggi</strong>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light">
                    <p class="mb-2">"Pelayanan ramah dan proses administrasinya mudah. Aman dan cepat."</p>
                    <strong>- Rina, Padang</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="fw-semi-bold">Pertanyaan Umum (FAQ)</h2>
                <p class="text-muted">Pertanyaan yang sering diajukan pelanggan</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="faqOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Barang apa saja yang bisa digadai?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Kami menerima emas, perhiasan, kendaraan, elektronik (HP/laptop), dan barang berharga lainnya. Untuk barang bernilai tinggi, penaksiran lebih detail dilakukan.</div>
                        </div>
                    </div>

                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="faqTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Berapa lama proses pencairan?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Setelah dokumen lengkap, proses penaksiran dan administrasi biasanya selesai dalam 30–60 menit, dan dana dapat dicairkan segera.</div>
                        </div>
                    </div>

                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="faqThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Bagaimana cara menebus barang?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Datang ke kantor dengan bukti gadai dan lakukan pelunasan sesuai tagihan. Kami juga menerima pembayaran transfer/VA/QRIS.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="p-4 bg-white rounded-4">
                    <h4 class="mb-3">Butuh bantuan lebih cepat?</h4>
                    <p class="mb-2">Hubungi kami via WhatsApp atau telepon — tim customer service siap membantu proses pengajuan dan menjawab pertanyaan.</p>
                    <a href="https://wa.me/6281275341600" class="btn btn-primary">Chat WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About & Legal -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6">
                <h3 class="fw-semi-bold">Tentang PT Usaha Gadai Mandiri</h3>
                <p class="text-muted">PT Usaha Gadai Mandiri mengoperasikan brand <strong>Pusat Gadai Padang</strong>. Komitmen kami adalah membantu masyarakat mendapatkan akses dana dengan proses yang mudah, transparan, dan aman.</p>
                <ul>
                    <li>Terdaftar dan mematuhi peraturan setempat</li>
                    <li>Standard operasional untuk keamanan barang</li>
                    <li>Layanan pelanggan yang cepat dan profesional</li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h3 class="mb-2">Legalitas & Keamanan</h3>
                <p class="text-muted mb-1">Nomor izin: <strong>— AHU-063392.AH.01.30 Tahun 2024</strong></p>
                <p class="text-muted">Kami menyimpan barang di fasilitas aman dan menyediakan bukti gadai resmi untuk setiap transaksi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Lokasi -->
<section id="contact" class="py-6">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Lokasi Cabang Kami</h2>
            <p class="text-muted">PT Usaha Gadai Mandiri / Pusat Gadai Padang memiliki dua cabang untuk melayani Anda.</p>
        </div>

        <div class="row g-4">

            <!-- CABANG 1 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h4 class="fw-bold">Cabang 1 (Kantor Pusat)</h4>
                        <p class="text-muted mb-2">
                            Pusat Gadai Padang — Cabang Utama
                        </p>

                        <a href="https://maps.app.goo.gl/rVqv4Ewz8eaazY7ZA"
                            target="_blank"
                            class="btn btn-primary btn-sm mb-3">
                            Lihat di Google Maps
                        </a>

                        <div class="ratio ratio-4x3 rounded overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7978.658920163804!2d100.35836918916908!3d-0.8969285999999977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b9856c4220cf%3A0xd392de5f1f154785!2sPusat%20gadai%20Padang!5e0!3m2!1sid!2sid!4v1763986697526!5m2!1sid!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CABANG 2 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h4 class="fw-bold">Cabang 2</h4>
                        <p class="text-muted mb-2">
                            Pusat Gadai Padang — Cabang 2
                        </p>

                        <a href="https://www.google.com/maps?q=-0.9402516,100.3516488"
                            target="_blank"
                            class="btn btn-primary btn-sm mb-3">
                            Lihat di Google Maps
                        </a>

                        <div class="ratio ratio-4x3 rounded overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3989.2810952688615!2d100.34907387496513!3d-0.94025159905066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMMKwNTYnMjQuOSJTIDEwMMKwMjEnMDUuOSJF!5e0!3m2!1sid!2sid!4v1763986740029!5m2!1sid!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>