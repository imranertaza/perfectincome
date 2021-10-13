<?php
date_default_timezone_set('Asia/Dhaka');
$do = isset($_GET['do']) ? $_GET['do'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Noapara Mohila College Admin Panel</title>

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
    
    
    <!-- Datepicker Start -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
		$( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
	});
	</script>
    <!-- Datepicker Start -->

</head>
<body>

<div id="print_page_wrapper">
            
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-default">
                <div class="panel-body">
                    <div class="row">
                        	<div class="col-lg-12 indivisual_result">
                				<table width="100%" border="0" >
                                  <tr>
                                    <th width="16%" align="left" scope="row">Studnet Name</th>
                                    <td width="1%">:</td>
                                    <td width="83%"><?php print $student_name; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" scope="row">Roll Number</th>
                                    <td>:</td>
                                    <td><?php print $student_roll; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" scope="row">Registration Number</th>
                                    <td>:</td>
                                    <td><?php print $student_reg; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" valign="top" scope="row">Picture</th>
                                    <td valign="top">:</td>
                                    <td><?php print $this->student_function->view_student_image($std_id, 90, 90); ?></td>
                                  </tr>
                                </table>
							  </div>
                        
                        <div class="col-lg-12">  
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th width="158">Subject</th>
                                    <th width="245">Written/CQ</th>
                                    <th width="245">MCQ</th>
                                    <th width="245">Practical</th>
                                    <th width="245">Total Marks</th>
                                    <th width="245">Point</th>
                                    <th width="245">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php print $subject_result; ?>
                                <tr>
                                    <th width="158"></th>
                                    <th width="158"></th>
                                    <th width="158"></th>
                                    <th width="158"></th>
                                    <th width="245">Result</th>
                                    <th width="245"><?php print sprintf ("%.2f", $point_result); ?></th>
                                    <th width="245"><?php print $grade_result; ?></th>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
</div>
        
</body>