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

    <div id="wrapper">
<!--<h1>নওয়াপাড়া মহিলা কলেজ</h1>
<h1>ডাকঃ নওয়াপাড়া, উপজেলাঃ অভয়নগর, জেলাঃ যশোর।</h1>
<h1>স্তাপিতঃ ১৯৯৪খ্রিঃ</h1>
-->

<div id="print_page_wrapper">
    <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                            <div class="table-responsive">
                            	<div class="p_heading">
                                <h1>নওয়াপাড়া মহিলা কলেজ<br>
                                ডাকঃ নওয়াপাড়া, উপজেলাঃ অভয়নগর, জেলাঃ যশোর।<br>
                                স্তাপিতঃ ১৯৯৪খ্রিঃ</h1>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example main">
                                    <thead>
                                        <tr>
                                            <th width="19">ক্রমিক নং</th>
                                            <th width="95">শিক্ষক কর্মচারীর নাম ও পদবীইনডেক্স নং</th>
                                            <th width="114">ইনডেক্স নং</th>
                                            <th width="83">জান্ম তারিখ ও বয়স</th>
                                            <th width="216">শিক্ষাগত যোগ্যতার বিস্তারিত বিবরন বিভাগ ও সন সহ</th>
                                            <th width="76">আত্র প্রতিস্থানের যোগদানের তারিখ</th>
                                            <th width="87">শিক্ষক হিসেবে মোট অভিজ্ঞতা</th>
                                            <th width="147">গৃহীত এক বা একাধিক বেতন ক্রম তারিখ সহ উল্লেখ করতে হবে</th>
                                            <th width="55">ছবি</th>
                                            <th width="75">স্বাক্ষর</th>
                                            <th width="81">মন্তব্য</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //$this->teacher_function->teacher_list();
										$i=$page_no+1;
										foreach($records as $rows) {
										?>
                                        
                                        <tr class="odd gradeX" id="tec_<?php print $rows->tec_id; ?>">
                                            <td><?php print $i; ?></td>
                                            <td><?php print $rows->name; ?><br><?php print $rows->designation; ?></td>
                                            <td><?php print $rows->index; ?></td>
                                            <td><?php print $rows->dob; ?></td>
                                            <td><?php print $rows->e_qualification; ?></td>
                                            <td><?php print $rows->joining_date; ?></td>
                                            <td><?php print $rows->experience; ?></td>
                                            <td><?php print $rows->salary_details; ?></td>
                                            <td><?php print $this->teacher_function->view_teacher_image($rows->tec_id, 90, 90); ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                    <tfoot>
                                    	<tr><td colspan="11">
                                    	Principal Noapara Model College.
                                        </td></tr>
                                    </tfoot>
                                </table>
                                <p class="paginate"><?php //print $pagination; ?></p>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>


<style>
.p_heading h1{
    text-align: center;
    font-size: 15px !important;
    font-weight: bold;
}
</style> 

<script>
function delete_teacher(tec_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>ajax.html/?delete_teacher=yes',
                 type: "POST",
                 dataType: "text",
                 data: {tec_id: tec_id},
                 beforeSend: function(){
                       $('#tec_'+tec_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#tec_'+tec_id).fadeOut( 'slow' );
                 }
          });
          }
     }
</script>
