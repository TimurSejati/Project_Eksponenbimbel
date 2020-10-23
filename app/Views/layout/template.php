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
  <!-- Sweetalert2 -->
  <link href="<?= base_url() ?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">

  <script src="<?= base_url() ?>/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>

</head>


<body class="fixed-left">

  <!-- Loader -->
  <div id="preloader">
    <div id="status">
      <div class="spinner"></div>
    </div>
  </div>

  <!-- Begin page -->
  <div id="wrapper">
    <!-- ========== Left Sidebar Start ========== -->

    <?= $this->include('layout/sidebar'); ?>
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->
    <div class="content-page">
      <!-- Start content -->
      <div class="content">

        <!-- Top Bar Start -->
        <div class="topbar">

          <nav class="navbar-custom">
            <ul class="list-inline float-right mb-0">
              <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <img src="<?= base_url() ?>/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!-- item-->
                  <div class="dropdown-item noti-title">
                    <h5>Welcome</h5>
                  </div>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5 text-muted"></i> My Wallet</a>
                  <a class="dropdown-item" href="#"><span class="badge badge-success float-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
              </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
              <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                  <i class="mdi mdi-menu"></i>
                </button>
              </li>
              <li class="hide-phone app-search">
                <form role="search" class="">
                  <input type="text" placeholder="Search..." class="form-control">
                  <a href=""><i class="fa fa-search"></i></a>
                </form>
              </li>
            </ul>

            <div class="clearfix"></div>

          </nav>

        </div>
        <!-- Top Bar End -->

        <?= $this->renderSection('content') ?>

      </div> <!-- content -->

      <footer class="footer">
        © 2018 Annex by Mannatthemes.
      </footer>

    </div>
    <!-- End Right content here -->

  </div>
  <!-- END wrapper -->


  <!-- jQuery  -->

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