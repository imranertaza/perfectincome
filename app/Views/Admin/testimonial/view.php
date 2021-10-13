

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ACADEMY TESTIMONIAL <a href="<?php print base_url(); ?>testimonial/view_testimonial_print/<?php print $test_id; ?>.html" class="btn btn-primary take_margin right" title="Print Page">Print page</a><a onclick="history.go(-1);" class="btn btn-primary take_margin right" title="Result"><< Back</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row tc_detail">
						<?php
                        if ($result->num_rows() > 0)
                        {
                        foreach ($result->result() as $rows)
                        {
                        ?>
                        <div class="main_body bg_img">
                        <div class="border_2nd">
                        <div class="border_3rd">
                        <div class="header">
                            <img src="<?php print base_url(); ?>assets/images/logo.png" class="logo" />
                            <div class="college_name">Darul Quran Siddikia Kamil Madrasa
                                <div class="seriol_number"><?php print $rows->test_id; ?></div><!--end of seriol_number-->
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
                        <div class="contain"><p>I,with much pleasure, certify that <?php print $rows->name; ?> was a student of this college.Hes/she duly has passed the HSC Examination under the board of Intermediate and Secondary Education,Jessore/National University held in the year of <?php print $rows->seassion; ?> While he/she was in this college,his/her conduct was found to be satisfactory.So far as I know he/she never took part in any activities subversive to law and discipline of the college</p></div><!--end of contain-->
                        <div class="PARTICULARS">PARTICULARS</div><!--end of PARTICULARS-->
                        <div class="PARTICULARS_main_box">
                        <div class="PARTICULARS_box">
                            <table width="285" border="0">
                        <tr>
                        <td width="102" align="left">Name of Student</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->name; ?></td>
                        </tr>
                        <tr>
                        <td width="102" align="left">Father's Namet</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->father; ?></td>
                        
					
                        </tr>
                        <tr>
                        <td width="102" align="left">Mother's Name</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->mother; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Date of Barth</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->dob; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Village</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->village; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Post Office</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->post; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Upazilla</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->upazilla; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="102" align="left">Ditrict</td>
                        <td width="10" align="left">:</td>
                        <td width="159" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->district; ?></td>
                        
                        </tr>
                        </table>
                        
                         </div><!--end of PARTICULARS_box-->
                         <div class="PARTICULARS_box">
                            <table width="301" border="0">
                        <tr>
                        <td width="138" align="left">Name of Examination</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->exam_name; ?></td>
                        </tr>
                      								  
                        
                        <tr>
                        <td width="138" align="left">Resgistration No</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->reg_no; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Seassion</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->seassion; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Roll No</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->roll_no; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Exam.Centre</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->ex_center; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Group</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->group; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">G.P.A</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->gpa; ?></td>
                        
                        </tr>
                        <tr>
                        <td width="138" align="left">Date of result publication</td>
                        <td width="10" align="left">:</td>
                        <td width="139" align="left" style="border-bottom:1px solid #a6ad8c;"><?php print $rows->publish_date; ?></td>
                        
                        </tr>
                        </table>
                        
                         </div>
                         <br clear="all" />
                        </div><!--end of PARTICULARS_main_box-->
                        <div class="footer">
                            <div class="Written_by">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Written by</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                        
                          </div><!--end of Written by-->
                          <div class="another">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Another</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                        
                          </div><!--end of another -->
                          <div class="another">
                                <table width="171" border="0">
                                      <tr>
                                        <td width="70" align="left">Another</td>
                                        <td width="120" align="left" style="border-bottom:1px dotted #a6ad8c;">&nbsp;</td>
                                      </tr>
                                    </table>
                        
                          </div>
                        </div><!--end of footer-->
                        </div>
                        </div>
                        </div>
                        
                        
                        
                        
						
						<?php } } else {
						print 'There is no records like this.';	
						}?>
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
