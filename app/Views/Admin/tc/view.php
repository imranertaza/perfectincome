

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ACADEMY TRANSFER CERTIFICATE <a href="<?php print base_url(); ?>tc/view_tc_print/<?php print $tc_id; ?>.html" class="btn btn-primary take_margin right" title="Print Page">Print page</a><a onclick="history.go(-1);" class="btn btn-primary take_margin right" title="Result"><< Back</a></h1>
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
                        
                        
                        
                        
                        
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row tc_detail">
                                    
                                    <h1 style="text-align:center;">Darul Quran Siddikia Kamil Madrasa</h1><hr>
                                    <p style="text-align:center;"><strong>Haji Ismail Road, Shonadanga, Khulna-9100</strong></p>
                                    
                                    
                                    <p style="text-align:center;"><strong>TRANSFER CERTIFICATE</strong></p><br><br>
                                    
                                    
                                    <p>This is to consenting that <?php print $rows->name; ?>, Father– <?php print $rows->father; ?>, Mother- <?php print $rows->mother; ?> of Post Office- <?php print $rows->post; ?>, P.S-Kachua, District-<?php print $rows->district; ?>, he had been studying in this college up to the dated: <?php print $rows->admitted; ?>. As per description of admission book his date of birth is: <?php print $rows->dob; ?>. He used to read in class <?php print $rows->admitted_class; ?> and the last annual examination promoted in the class <?php print $rows->promoted_class; ?> have passed. His was age <?php print $rows->age; ?> period of college transfer. All the dues from him was received with understanding.</p>
                                    <strong>His moral character :</strong><br><?php print $rows->character; ?><br>
                                    <strong>Board Registration No:</strong><br><?php print $rows->reg_no; ?><br>
                                    <strong>Board Roll No:</strong><br><?php print $rows->roll_no; ?><br>
                                    <strong>Cause of leaving the college:</strong><br><?php print $rows->cause_of_leaving; ?><br><br><br>
            
                                    
                                    
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
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
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
