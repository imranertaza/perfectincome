<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php

    if (!empty($page_title)) {
        $pages = DB()->table('pages');
        $sql = $pages->where('slug', $page_title)->get();

        $page_details = $sql->getRow();
        $page_title = $page_details->page_title;
        $page_description = $page_details->short_des;
    }

    if (!empty($cat_id)) {
        $category = DB()->table('category');
        $sqlCat = $category->where('cat_id', $cat_id)->get();
        $page_details = $sqlCat->getResult();
        $page_title = $page_details['cat_name'];
        $page_description = $page_details['cat_name'];
    }

    ?>

  <title><?php
        if (!empty($page_title)) {
            print $page_title . ' | ';
        }
        if (!empty($web_page_title)) {
            print $web_page_title . " | ";
        }
        print $globalSettingsModel->get_each_setting_value($key = 'site_title'); ?></title>
  <meta content="<?php if (empty($page_description)) {
        print 'DNS CMS';
    } else {
        print $page_description;
    } ?>" name="description">
  <meta content="<?php if (empty($page_description)) {
        print 'DNS CMS';
    } else {
        print $page_description;
    } ?>" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>/assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>/assets/plugins/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/plugins/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-lg-between">

       <a href="<?php echo base_url(); ?>" class="logo me-auto me-lg-0"><img src="<?php echo base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="<?php echo base_url(); ?>">Home</a></li>
          <li><a class="nav-link scrollto" href="<?php print base_url(); ?>/details/page/package">Packages</a></li>
          <li><a class="nav-link scrollto" href="<?php print base_url(); ?>/details/page/incentives">Incentives</a></li>
          <li><a class="nav-link scrollto" href="<?php print base_url(); ?>/details/page/notice">Notice</a></li>
          <li><a class="nav-link scrollto" href="<?php print base_url(); ?>/details/page/about-us">About Us</a></li>
          <li><a class="nav-link scrollto" href="<?php print base_url(); ?>/details/page/contact-us">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-right">

          <?php $agentLogin = new_session()->isLoggedInAgent;
          if (isset($agentLogin) || $agentLogin == TRUE) { ?>
              <a href="<?php print base_url('Agent/dashboard'); ?>"> Dashboard</a>
              <a href="<?php print base_url('Agent/Login/logout'); ?>"> Logout</a>
          <?php }
          $clientLogin = new_session()->isLoggedInClient;
          if (isset($clientLogin) || $clientLogin == TRUE) { ?>
              <a href="<?php print base_url('Member/dashboard'); ?>"> Dashboard</a>
              <a href="<?php print base_url('Member_form/logout'); ?>"> Logout</a>
          <?php } ?>
        <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#search">
          <i class="bi bi-search"></i>
        </button>
        <div class="collapse" id="search">
          <div class="search-box">
            <div class="input-group">
              <div class="form-outline">
                <input type="search" id="form1" class="form-control" placeholder="Search here!" />
              </div>
              <button type="button" class="btn btn-search">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      

    </div>
  </header><!-- End Header -->