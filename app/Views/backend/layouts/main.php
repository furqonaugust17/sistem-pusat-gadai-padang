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
    <title><?= $titlePage ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/chartist/css/chartist.min.css') ?>">
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
    
    <script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chart.js/Chart.bundle.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/peity/jquery.peity.min.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/apexchart/apexchart.js') ?>"></script>

    <script src="<?= base_url('assets/js/dashboard/dashboard-1.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/owl-carousel/owl.carousel.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script src="<?= base_url('assets/js/deznav-init.js') ?>"></script>
</body>

</html>