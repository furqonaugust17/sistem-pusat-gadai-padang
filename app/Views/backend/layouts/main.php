<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="PT. Usaha Gadai Mandiri Pusat Gadai Padang" />
    <meta property="og:title" content="PT. Usaha Gadai Mandiri Pusat Gadai Padang" />
    <meta property="og:description" content="PT. Usaha Gadai Mandiri Pusat Gadai Padang" />
    <meta name="format-detection" content="telephone=no">
    <?= csrf_meta(); ?>
    <title><?= $titlePage ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('home/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/chartist/css/chartist.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/toastr/css/toastr.min.css'); ?>">
    <?= $this->renderSection('css'); ?>
    <link href="<?= base_url('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/owl-carousel/owl.carousel.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <?= $this->include('backend/layouts/nav'); ?>

        <?= $this->include('backend/layouts/header'); ?>

        <?= $this->include('backend/layouts/sidebar'); ?>

        <div class="content-body">
            <div class="container-fluid">
                <?= $this->renderSection('content'); ?>
            </div>
        </div>

        <?= $this->include('backend/layouts/footer'); ?>
    </div>

    <?= $this->renderSection('modal'); ?>

    <script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/peity/jquery.peity.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/owl-carousel/owl.carousel.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script src="<?= base_url('assets/js/deznav-init.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/toastr/js/toastr.min.js'); ?>"></script>

    <?php if (session()->getFlashdata('success')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.success("<?= session()->getFlashdata('success'); ?>", {
                    closeButton: false,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: 300,
                    hideDuration: 1000,
                    timeOut: 500,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                })
            })
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('errors')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                toastr.error("<?= session()->getFlashdata('errors'); ?>", {
                    closeButton: false,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: 300,
                    hideDuration: 1000,
                    timeOut: 500,
                    extendedTimeOut: 1000,
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut"
                })
            })
        </script>
    <?php endif; ?>
    <?= $this->renderSection('javascript'); ?>
</body>

</html>