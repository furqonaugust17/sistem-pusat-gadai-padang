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
    <title>Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="<?= base_url('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css'); ?>?version=<?= time(); ?>" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h2 class="text-center mb-4">Login</h2>
                                    <?php if (session('error') !== null) : ?>
                                        <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
                                    <?php elseif (session('errors') !== null) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php if (is_array(session('errors'))) : ?>
                                                <?php foreach (session('errors') as $error) : ?>
                                                    <?= esc($error) ?>
                                                    <br>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <?= esc(session('errors')) ?>
                                            <?php endif ?>
                                        </div>
                                    <?php endif ?>

                                    <?php if (session('message') !== null) : ?>
                                        <div class="alert alert-success" role="alert"><?= esc(session('message')) ?></div>
                                    <?php endif ?>
                                    <form action="<?= url_to('login') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label class="mb-1" for="floatingEmailInput"><strong><?= lang('Auth.email') ?></strong></label>
                                            <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>

                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1" for="floatingPasswordInput"><strong><?= lang('Auth.password') ?></strong></label>
                                            <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="form-check-input" id="basic_checkbox_1" name="remember">
                                                        <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                                    <a href="<?= url_to('magic-link') ?>">Forgot Password?</a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <?php if (setting('Auth.allowRegistration')) : ?>
                                        <div class="new-account mt-3">
                                            <p>Don't have an account? <a class="text-primary" href="<?= url_to('register'); ?>">Sign up</a></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('assets/vendor/global/global.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/custom.js'); ?>"></script>
    <script src="<?= base_url('assets/js/deznav-init.js'); ?>"></script>
</body>

</html>