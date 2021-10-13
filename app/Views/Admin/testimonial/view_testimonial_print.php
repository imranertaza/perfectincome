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

    <title>Testimonial</title>

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
     <div class="row tc_detail">

                       <div class="main_body bg_img">
                        <div class="border_2nd">
                        <div class="border_3rd">
                        <div class="header">
                            <img src="<?php print base_url(); ?>assets/images/logo.png" class="logo" />
                            <div class="college_name">Darul Quran Siddikia Kamil Madrasa
                                <div class="seriol_number"><?php print $result->test_id; ?></div><!--end of seriol_number-->
                            </div><!--end of college_name-->
                            <br clear="all" />
                        </div><!--end of header-->
                        <div class="seccond_header">
                            <div class="address">
                                <table width="200" border="0">
                                  <tr>
                                    <td width="59" align="left">Post</td>
                                    <td width="8" align="left">:</td>
                                    <td width="111" align="left">Khulna-9100</td>
                                  </tr>
                                  <tr>
                                    <td align="left">Road</td>
                                    <td align="left">:</td>
                                    <td align="left">Haji Ismail Road</td>
                                  </tr>
                                  <tr>
                                    <td align="left">Dist</td>
                                    <td align="left">:</td>
                                    <td align="left">Khulna</td>
                                  </tr>
                                </table>
                        
                            </div><!---end of address-->
                            <div class="testimonila_box">TESTIMONIAL</div><!--end of testimonila_box-->
                            <div class="contuct">
                            <table width="200" border="0">
                                  <tr>
                                    <td align="left">Telephone</td>
                                    <td align="left">:</td>
                                    <td align="left">041-722956</td>
                                  </tr>
                                  <tr>
                                    <td align="left">Center Code</td>
                                    <td align="left">:</td>
                                    <td align="left">438/Khulna-3</td>
                                  </tr>
                                  <tr>
                                    <td align="left">Madrasa Code</td>
                                    <td align="left">:</td>
                                    <td align="left">19394</td>
                                  </tr>
                                  <tr>
                                    <td align="left">EIN</td>
                                    <td>:</td>
                                    <td align="left">117421</td>
                                  </tr>
                              </table>
                        
                            </div><!--end of contuct-->
                          <br clear="all" />
                        </div><!---end of seccond_header-->
                        <div class="contain"><p>I,with much pleasure, certify that <?php print $result->name; ?> was a student of this college.Hes/she duly has passed the HSC Examination under the board of Intermediate and Secondary Education,Jessore/National University held in the year of <?php print $result->seassion; ?> While he/she was in this college,his/her conduct was found to be satisfactory.So far as I know he/she never took part in any activities subversive to law and discipline of the college</p></div><!--end of contain-->
                        <div class="PARTICULARS">PARTICULARS</div><!--end of PARTICULARS-->
                        <div class="PARTICULARS_main_box">
                        <div class="PARTICULARS_box">
                            <table width="285" border="0">
                        <tr>
                        <td width="102" align="left">Name of Student</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->name; ?></td>
                        </tr>
                        <tr>
                        <td width="102" align="left">Father's Namet</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->father; ?></td>
                        
					
                        </tr>
                        <tr>
                        <td width="102" align="left">Mother's Name</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->mother; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Date of Barth</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->dob; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Village</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->village; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Post Office</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->post; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Upazilla</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->upazilla; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Ditrict</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->district; ?></td>
                        
                        </tr>
                        </table>
                        
                         </div><!--end of PARTICULARS_box-->
                         <div class="PARTICULARS_box">
                            <table width="301" border="0">
                        <tr>
                        <td width="138" align="left">Name of Examination</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->exam_name; ?></td>
                        </tr>
                      								  
                        
                        <tr>
                        <td width="138" align="left">Resgistration No</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->reg_no; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Seassion</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->seassion; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Roll No</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->roll_no; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Exam.Centre</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->ex_center; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Group</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->group; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">G.P.A</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->gpa; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Date of result publication</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $result->publish_date; ?></td>
                        
                        </tr>
                        </table>
                        
                         </div>
                         <br clear="all" />
                        </div>
                        <div class="footer">
                            <div class="Written_by">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Written by</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                        
                          </div>
                          <div class="another">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Another</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                          </div>
                          <div class="another">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Another</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                        
                          </div>
                        </div>
                        </div>
                       </div>
                       </div>
                       
                       
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
