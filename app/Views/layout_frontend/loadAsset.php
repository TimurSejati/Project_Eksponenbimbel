<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?=$title;?></title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="<?=base_url()?>/assets/images/favicon.ico">
    <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>/assets/css/custom.css" rel="stylesheet" type="text/css">
    <!-- Sweetalert2 -->
    <link href="<?=base_url()?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="<?=base_url()?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
</head>
<body class="fixed-left">

<div id="wrapper">
    <!-- Loader -->
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div> -->

    <nav class="navbar navbar-light bg-info">
        <div>
            <a class="ml-5 text-white navbar-brand font-weight-bold" href="/">Eksponen Bimbel</a>
        </div>
        <?php
            $request = \Config\Services::request();
            $uri = $request->uri->getSegment(1);
        ?>
        <div class="flex-row mr-5 navbar-nav d-flex">
            <li class="nav-item">
                <a class="mr-3 text-white nav-link linkHead" style="<?=$uri == 'home' ? 'font-weight:500' : ''?>" href="/" >Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link linkHead" style="<?=$uri == 'kontent' ? 'font-weight:500' : ''?>" href="/kontent">Kontent Materi</a>
            </li>
        </div>
    </nav>


    <?=$this->renderSection('contentHome')?>



