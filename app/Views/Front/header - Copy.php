<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if (!empty($page_title)) {
	//$page_details = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE `slug` = '$page_title'"));
	$page_details = $this->db->query("SELECT * FROM `pages` WHERE `slug` = '$page_title'")->row();
	$page_title = $page_details['page_title'];
	$page_description = $page_details['short_des'];
}

if (!empty($cat_id)) {
	$page_details = mysql_fetch_array(mysql_query("SELECT * FROM `Category` WHERE `cat_id` = '$cat_id'"));
	$page_details = $this->db->query("SELECT * FROM `Category` WHERE `cat_id` = '$cat_id'")->row();
	$page_title = $page_details['cat_name'];
	$page_description = $page_details['cat_name'];
}

?>

<title><?php if (!empty($page_title)) { print $page_title . ' | '; } print $this->global_settings->get_each_setting_value($key = 'site_title'); ?></title>

<meta name="description" content="<?php if (empty($page_description)) { print 'Dnationsoft CMS'; }else { print $page_description; } ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
<link href="<?php echo base_url(); ?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front/slick/slick.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery-1.11.0.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cycle.all.js" type="text/javascript"></script>
</head>


<!--start the header--->

<body>
 <div class="main_body">
 	<div class="header">
      <div class="header_left">
        <div class="logo">
            <!--<img src="<?php //echo base_url(); ?>assets/images/logo.png" />-->
            <h1 style="font-size:36px; color:#09C;"><a href="<?php echo base_url(); ?>">Dnation School (V1)</a></h1>
        </div><!--end of logo-->
     </div><!--end of header_left-->   
     <div class="header_right">
     	<div class="header_right_1st">
            <div class="scarch_box">
            <input name="search" type="text" class="search" placeholder="Search" />
            <input type="submit" name="search" class="secrch_icone" value="" />
            <br clear="all" />
            </div><!--end of scarch_box-->
         </div><!--end of header_right_1st--> 
       <div class="header_right_2st">
             <div class="login"><a href="#">login</a> | <a href="<?php print base_url(); ?>details/page/contact-us.html">Contact Us</a></div><!--end of login-->
        </div><!--end of   header_right_2st-->   
      </div><!--end of header_right-->
     </div><!--end of header-->  
 <!--finish of the header-->  
 
      <br clear="all" />
      
 <!--start of the menu-->     
      <div class="menul">
      	<div class="menu">
        	<ul>
            	<li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">About School</a>
               		 <ul>
                    	<li><a href="<?php print base_url(); ?>details/page/history.html">History</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/land-history.html">Land history</a></li>
                    </ul>
                </li>
                <li><a href="#">Informations</a>
                	<ul>
                    	<li><a href="<?php print base_url(); ?>details/page/buildings.html">Buildings</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/rooms.html">Rooms</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/classes.html">Classes</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/sits.html">Sits</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/decoration.html">Decoration</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/land.html">Fysical Fitness</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/senetary.html">Senetary</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/cultural-activity.html">Cultural Activity</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/role-information.html">Role Information</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/law.html">Law</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/rules.html">Rules</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/sports.html">Sports</a></li>
                        <li><a href="<?php print base_url(); ?>details/page/managing-commitee.html">Managing Commitee</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url(); ?>details/products_cat/7.html">Students</a></li>
                <li><a href="<?php echo base_url(); ?>details/products_cat/8.html">Teachers</a></li>
                <li><a href="#">Downloads</a>
                	<ul>
                    	<li><a href="#">Notice</a></li>
                        <li><a href="#">Circular</a></li>
                        <li><a href="#">Class Routine</a></li>
                        <li><a href="#">Holidays</a></li>
                    </ul>
                </li>
                <li><a href="<?php print base_url(); ?>details/page/about-us.html">Present</a></li>
                <li><a href="#">Result</a>
                	<ul class="submenu">
                    	<li><a href="#">Public Exam Result</a></li>
                        <li><a href="#">Internal Exam Result</a></li>
                    </ul>
                </li>
                <br clear="all" />
            </ul>
        </div><!--end of menu-->
      </div><!--end of menul--> 
 <!--finish of the menu-->  
 
     
  <?php include('slider.php'); ?>