<?php
date_default_timezone_set('Asia/Dhaka');
$do = isset($_GET['do']) ? $_GET['do'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transfer Certificate</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
        <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <script type="text/javascript" src="<?php print base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    
    <script>
	function CkEditorURLTransfer(url) 
	{
		window.parent.CKEDITOR.tools.callFunction(1, url, '');
		$('#cke_111_textInput').val(url);
	}
	</script>

</head>

<body>

<div class="print_page">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ACADEMY TRANSFER CERTIFICATE</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row tc_detail">
                        This is to consenting that <?php print $std_name; ?>, son of Edan Miah, Mothers-Soleman Khatun, Address: Village-Battali Khamar, Post Office-Battali Khamar, Upazilla-Raipura, Dist-Narsingdi, he had been studying in this school up to the dated 30/12/2002 in class eight. As per description of admission book his date of birth is: 01/06/1987. His present age 19 years 03 months 17 days. He was promoted in to class IX (Nine) in the last annual examination. All the dues from him was received with understanding up to the dated December month 2002.
                        
                        His moral character :   Good                             Lesson Progress : Satisfactory 
                        Board Registration No. ------                           Year -----------------------------
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>        
</div>
    <!-- /#wrapper -->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>
    
<script>
CKEDITOR.replace( 'ckeditor', { 
	filebrowserBrowseUrl: '<?php print base_url(); ?>assets/ckeditor/plugins/w3bdeveloper_uimages/index.php',
	filebrowserWindowWidth: '860',
	filebrowserWindowHeight: '660'
});
</script>

</body>

</html>
