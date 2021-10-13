<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
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

    <meta name="description" content="<?php if (empty($page_description)) {
        print 'Dnationsoft CMS';
    } else {
        print $page_description;
    } ?>"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/bootstrap.css"/>
    <link href="<?php echo base_url(); ?>/assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/front/slick/slick.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/front/js/jquery-1.11.0.js"></script>
    <script src="<?php echo base_url(); ?>/assets/front/js/jquery.cycle.all.js" type="text/javascript"></script>

    <!-- For slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/bjqs.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/tree.css"/>
    <script src="<?php echo base_url(); ?>/assets/js/bjqs-1.3.js" type="text/javascript"></script>

    <!-- end of slider -->
</head>

<body>
<section class="header-section">
    <div class="main_body">
        <div class="container">
            <div class="col-md-3">
                <strong style="margin-top:5px;"><a href="<?php echo base_url(); ?>">Stars Fair BD</a></strong>
            </div>
            <div class="col-md-1 col-md-offset-8 text-right">
                <?php $clientLogin = new_session()->isLoggedInClient;
                if (isset($clientLogin) || $clientLogin == TRUE) { ?>
                    <a href="<?php print base_url('Member_form/logout'); ?>"> Logout</a>
                <?php } else { ?>
                    <a href="<?php print base_url($log_url); ?>"><?php print $log_title; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--finish of the header-->

    <div class="container-fluid wraper">
        <div class="row">
            <div class="container" style="padding: 10px;">
                <div class="col-md-4">
                    <a href="<?php echo base_url(); ?>"><img src="<?php print base_url(); ?>/assets/images/logos.png"
                                                             width="250"/></a>
                </div>
                <div class="col-md-8 " id="navigation">
                    <div class="topnav">
                        <a href="<?php echo base_url(); ?>">Home</a>
                        <a href="<?php print base_url(); ?>/details/page/notice">Notice</a>
                        <a href="<?php print base_url(); ?>/gallery">Event Gallery</a>
                        <a href="<?php print base_url(); ?>/details/page/about-us">About Us</a>
                        <a href="<?php print base_url(); ?>/details/page/contact-us">Contact Us</a>
                        <?php $clientLogin = new_session()->isLoggedInClient;
                        if (isset($clientLogin) || $clientLogin == TRUE) { ?>
                            <a href="<?php print base_url($log_url); ?>"> Dashboard</a>
                        <?php } else { ?>
                            <a href="<?php print base_url(); ?>/member_form/register">Register</a>
                            <a href="<?php print base_url($log_url); ?>"><?php print $log_title; ?></a>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
