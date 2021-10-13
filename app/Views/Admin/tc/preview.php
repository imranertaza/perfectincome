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

<div class="print_page" style="margin-top:20px;">
    <div class="row tc_detail">
                        
                        <h1 style="text-align:center;">Darul Quran Siddikia Kamil Madrasa</h1><hr>
                        <p style="text-align:center;"><strong>Haji Ismail Road, Shonadanga, Khulna-9100</strong></p>
                        
                        
                        <p style="text-align:center;"><strong>TRANSFER CERTIFICATE</strong></p><br><br>
                        
                        
                        <p>This is to consenting that <?php print $name; ?>, Father– <?php print $father; ?>, Mother- <?php print $mother; ?> of Post Office- <?php print $post; ?>, P.S-Kachua, District-<?php print $district; ?>, he had been studying in this college up to the dated: <?php print $admitted; ?>. As per description of admission book his date of birth is: <?php print $dob; ?>. He used to read in class <?php print $admitted_class; ?> and the last annual examination promoted in the class <?php print $promoted_class; ?> have passed. His was age <?php print $age; ?> period of college transfer. All the dues from him was received with understanding.</p>
                        <strong>His moral character :</strong><br><?php print $character; ?><br>
                        <strong>Board Registration No:</strong><br><?php print $reg_no; ?><br>
                        <strong>Board Roll No:</strong><br><?php print $roll_no; ?><br>
                        <strong>Cause of leaving the college:</strong><br><?php print $cause_of_leaving; ?><br><br><br>

                        
                        
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                        <tr>
                          <td align="center">
                        (Round Seal)<br>
                        Seal of college
                        </td>
                          <td align="center">
                        	Written by:<br>
                          </td>
                          <td align="center">
                            Sd/Illegible<br>
                            Head Master<br>
                            
                        </td>
                         </tr>
                        </tbody></table>
                        
                        
                        
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
