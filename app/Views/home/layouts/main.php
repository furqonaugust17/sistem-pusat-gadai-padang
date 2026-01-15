<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= csrf_meta(); ?>
    <title>Pusat Gadai Padang — PT Usaha Gadai Mandiri</title>

    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('home/logo.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,300&amp;display=swap" rel="stylesheet">
    <?= $this->renderSection('css'); ?>
    <link href="<?= base_url('home/assets/css/theme.min.css'); ?>?v=<?php echo time(); ?>" rel="stylesheet" />
    <link href="<?= base_url('home/assets/css/user.min.css'); ?>" rel="stylesheet" />

</head>

<body>
    <main class="main" id="top">
        <?= $this->include('home/layouts/navbar'); ?>
        <div class="min-vh-100">
            <?= $this->renderSection('content'); ?>
        </div>
        <?= $this->include('home/layouts/footer'); ?>
    </main>

    <script src="<?= base_url('home/vendors/popper/popper.min.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/bootstrap/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/anchorjs/anchor.min.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/is/is.min.js'); ?>"></script>
    <script src="<?= base_url('assets/icons/font-awesome/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/lodash/lodash.min.js'); ?>"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.0/gsap.min.js"></script>
    <script src="<?= base_url('home/vendors/imagesloaded/imagesloaded.pkgd.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/gsap/customEase.js'); ?>"></script>
    <script src="<?= base_url('home/vendors/gsap/scrollToPlugin.js'); ?>"></script>
    <script src="<?= base_url('home/assets/js/theme.min.js'); ?>"></script>
    <?= $this->renderSection('script'); ?>

</body>

</html>