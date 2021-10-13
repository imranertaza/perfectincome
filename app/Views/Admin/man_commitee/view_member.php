<?php
/*$selete_page = $this->db->get_where('products', array('pro_id' => $pro_id));
$row = $selete_page->row_array();*/
?>
<script type="text/javascript" src="<?php print base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Member</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	
                                <div class="col-lg-12">
                                
                                	<div class="col-lg-6">
                                        <b>Name</b><br />
                                        <?php if ($row['name']) { print 'Not Set'; } else { print $row['name']; } ?><br />                                    
                                        <b>Father Name</b><br />
                                        <?php print empty($row['f_name']) ? "Not Set" : $row['f_name']; ?><br />
                                        <b>Mother Name</b><br />
                                       	<?php print empty($row['m_name']) ? "Not Set" : $row['m_name']; ?><br />                                      
                                        <b>Date of birth</b><br />
                                        <?php print empty($row['dob']) ? "Not Set" : $row['dob']; ?><br />
                                        <b>Mobile</b><br />
                                        <?php print empty($row['mobile']) ? "Not Set" : $row['mobile']; ?><br />
                                        <b>Password</b><br />
                                        <?php print empty($row['pass']) ? "Not Set" : $row['pass']; ?><br />                                     
                                        <b>Married status</b><br /> 
                                        <?php print get_married_status_teacher($row['tec_id']); ?><br />                                 
                                        <b>Gendar</b><br />
                                        <?php print get_gender_teacher($row['tec_id']); ?>  <br />                                   
                                        <b>Religion</b><br />
                                        <?php print get_religion_teacher($row['tec_id']); ?><br /> 
                                       
                                        
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    	<?php print $pro_image; ?><br /> 
                                        
                                        
                                        
                                        <b>Local Address</b><br />
                                        <?php print empty($row['l_address']) ? "Not Set" : $row['l_address']; ?><br /> 
                                        
                                        <b>Permanent Address</b><br />
                                        <?php print empty($row['p_address']) ? "Not Set" : $row['p_address']; ?><br /> 
                                        
                                        <b>Description</b><br />
                                        <?php print empty($row['description']) ? "Not Set" : $row['description']; ?><br /> 
                                      
                                    </div>
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
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