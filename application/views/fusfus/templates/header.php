<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="<?= base_url('assets/eiser/') ?>img/favicon.png" type="image/png" />
  <title><?= $title ?></title>
    <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/'); ?>css/fontawesome.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/bootstrap.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/linericon/style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/themify-icons.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/flaticon.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/lightbox/simpleLightbox.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/animate-css/animate.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>vendors/jquery-ui/jquery-ui.css" />
  <!-- main css -->
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/style.css" />
  <link rel="stylesheet" href="<?= base_url('assets/eiser/') ?>css/responsive.css" />
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="banner_content">
          <h2 class="sub text-uppercase" href="index.html">
            <span style="color: green;"><i class=" fas fa-leaf"><?= $title ?></i></span>
          </h2>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('fusfus'); ?>">Home</a>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Profile</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('user'); ?>">My Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">Logout</a>
                      </li>
                    </ul>
                  </li>
                                   
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                    <li class="nav-item">
                      <a href="<?= base_url('user'); ?>" class="icons">
                        <i class="ti-user" aria-hidden="true"> <?= $user['name'] ?></i>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="#" class="icons">
                        <i aria-hidden="true">Poin Saat ini : <?= $user['saldo_user']; ?></i>                        
                      </a>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->