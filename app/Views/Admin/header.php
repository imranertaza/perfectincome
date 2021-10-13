<?php
date_default_timezone_set('Asia/Dhaka');
$do = isset($_GET['do']) ? $_GET['do'] : 0;
$this->session = \Config\Services::session();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stars Fair - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/tree.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>/assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
        <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <script type="text/javascript" src="<?php print base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
    
    <script>
	function CkEditorURLTransfer(url) 
	{
		window.parent.CKEDITOR.tools.callFunction(1, url, '');
		$('#cke_111_textInput').val(url);
	}
	</script>
    
    
    <!-- Datepicker Start -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/jquery-ui.css">
	<script src="<?php echo base_url(); ?>/assets/js/jquery-ui.js"></script>
    <script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
		$( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
	});
	</script>
    <!-- Datepicker Start -->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php print base_url(); ?>/dashboard">Stars Fair - Admin Panel<sup>(v1)</sup></a>
            </div>
            <!-- /.navbar-header -->
            
            <ul class="nav navbar-top-links navbar-right">
                <li class="username" style="margin-right: 50px;" ><b>Balance :</b> <?php print Tk_view(get_balance_by_id($this->session->user_id));?></li>

            	<li class="username"><?php print 'Hi! '. $this->session->username;?></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php print base_url(); ?>user/edit_user/<?php print $this->session->user_id; ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php print base_url(); ?>general_settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>/Admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
