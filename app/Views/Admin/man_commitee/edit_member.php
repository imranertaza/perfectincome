<?php
/*$selete_page = $this->db->get_where('products', array('pro_id' => $pro_id));
$row = $selete_page->row_array();*/
?>
<script type="text/javascript" src="<?php print base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Member</h1>
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
                                <?php
								if ($report) {
								?>
                                <div class="success"><?php print $report; ?></div>
                                <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>admin_area/commitee/edit_member/<?php print $tec_id; ?>.html" />
                                </div>
                                <div class="col-lg-12">
                                <?php } ?>
                                <form method="post" action="" enctype="multipart/form-data">
                                	<div class="col-lg-6">
                                        <label>Name</label>
                                        <div class="error_text"><?php echo form_error('name'); ?></div>
                                        <input class="form-control" name="name" value="<?php print $row['name']; ?>">
                                        <p class="help-block help_text">Member's full name</p>
                                        <label>Father Name</label>
                                        <input class="form-control" name="father" value="<?php print $row['f_name']; ?>">
                                        <p class="help-block help_text">Member's father name</p>
                                        <label>Mother Name</label>
                                        <input class="form-control" name="mother" value="<?php print $row['m_name']; ?>">
                                        <p class="help-block help_text">Member's mother name</p>
                                        <label>Date of birth</label><br />
                                        <input type="text" name="dob" class="form-control" value="<?php print $row['dob']; ?>" id="datepicker" />
                                        <p class="help-block help_text">format day-month-year(01-02-1999)</p>
                                        <label>Mobile</label><br />
                                        <div class="error_text"><?php echo form_error('mobile'); ?></div>
                                        <input type="text" name="mobile" class="form-control" value="<?php print $row['mobile']; ?>" />
                                        <p class="help-block help_text">Member's mobile</p>
                                        <label>Password</label><br />
                                        <div class="error_text"><?php echo form_error('password'); ?></div>
                                        <input type="text" name="password" class="form-control" value="<?php print $row['pass']; ?>" />
                                        <p class="help-block help_text">Member's Password</p>
                                        <label>Married status</label><br />
                                        <label><input type="radio" name="m_status" value="1" <?php if ($row['merried'] == 1) { print 'checked="checked"'; } ?> /> Single</label><br />
                                        <label><input type="radio" name="m_status" value="2" <?php if ($row['merried'] == 2) { print 'checked="checked"'; } ?> /> Marreid</label>
                                        <p class="help-block help_text">Member's married status</p>
                                        <label>Gendar</label><br />
                                        <label><input type="radio" name="gender" value="1" <?php if ($row['sex'] == 1) { print 'checked="checked"'; } ?> /> Male</label><br />
                                        <label><input type="radio" name="gender" value="2" <?php if ($row['sex'] == 2) { print 'checked="checked"'; } ?> /> Female</label>
                                        <p class="help-block help_text">Gender of the Member</p>
                                        <label>Religion</label><br />
                                        <?php print religion_list($row['religion']); ?>
                                        <p class="help-block help_text">Please choose the religion</p><br />
                                        <button type="submit" name="edit_Member" class="btn btn-default btn btn-primary">Update</button>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    	<?php print $pro_image; ?>
                                        <label>Member Image</label>
                                        <input type="file" name="main_img" />
                                        <p class="help-block help_text">Photo of the Member</p>
                                        <label>Local Address</label><br />
                                        <textarea name="laddress" class="form-control" rows="5"><?php print $row['l_address']; ?></textarea>
                                        <p class="help-block help_text">Member's local address</p>
                                        <label>Permanent Address</label><br />
                                        <textarea name="paddress" class="form-control" rows="5"><?php print $row['p_address']; ?></textarea>
                                        <p class="help-block help_text">Member's permanent address</p>
                                        <label>Description</label>
                                        <textarea name="description" id="ckeditor" class="ckeditor"><?php print $row['description']; ?></textarea>
                                        <p class="help-block help_text">Some details about the Member</p>
                                    </div>
                                    </form>
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