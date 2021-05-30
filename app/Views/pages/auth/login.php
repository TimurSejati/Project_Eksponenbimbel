<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title; ?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico">

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <h3 class="text-center mt-0 m-b-15 text-dark">
                    <!-- <a href="index.html" class="logo logo-admin"><img src="<?= base_url() ?>/assets/images/logo.png" height="24" alt="logo"></a> -->
                    EKSPONEN BIMBEL
                </h3>

                <div class="p-3">

                    <?php if (session()->get('msg')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?= session()->get('msg'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- <?php var_dump(session('nama')) ?> -->
                    <form class="form-horizontal m-t-20" action="<?= site_url('auth/process_login'); ?>" method="POST">
                        <?php csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" type="text" name="username" placeholder="Username" id="username" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" type="password" name="password" placeholder="Password" id="password">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center row m-t-20">
                            <div class="col-12">
                                <button class="btn btn-danger btn-block waves-effect waves-light btnLogin" type="submit">Log In</button>
                            </div>
                        </div>

                        <!-- <div class="form-group m-t-10 mb-0 row">
                            <div class="col-sm-7 m-t-20">
                                <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> <small>Forgot your password ?</small></a>
                            </div>
                            <div class="col-sm-5 m-t-20">
                                <a href="<?= site_url('auth/register'); ?>" class="text-muted"><i class="mdi mdi-account-circle"></i> <small>Create an account ?</small></a>
                            </div>
                        </div> -->
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- jQuery  -->
    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/modernizr.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/detect.js"></script>
    <script src="<?= base_url() ?>/assets/js/fastclick.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>



</body>

</html>