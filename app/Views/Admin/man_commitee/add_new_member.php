<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Member</h1>
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
									print $report;
								?>
                                <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>admin_area/commitee/add_new_member.html" />
                                </div>
                                <div class="col-lg-12">
                                <?php } ?>
                                 <form method="post" action="" enctype="multipart/form-data">
                                	<div class="col-lg-6">
                                        <label>Name</label><sup>*</sup>
                                        <input class="form-control" name="name">
                                        <p class="help-block help_text">Member's full name</p>
                                        <input type="hidden" class="form-control" name="type" value="m_member">
                                        <label>Father Name</label>
                                        <input class="form-control" name="father">
                                        <p class="help-block help_text">Member's father name</p>
                                        <label>Mother Name</label>
                                        <input class="form-control" name="mother">
                                        <p class="help-block help_text">Member's mother name</p>
                                        <label>Date of birth</label><br />
                                        <input type="text" name="dob" class="form-control" id="datepicker" />
                                        <p class="help-block help_text">format day-month-year(dd-mm-yyyy)</p>
                                        <label>Mobile</label><sup>*</sup><br />
                                        <input type="text" name="mobile" class="form-control" />
                                        <p class="help-block help_text">Member mobile number</p>
                                        <label>Password</label><sup>*</sup><br />
                                        <input type="text" name="password" class="form-control" />
                                        <p class="help-block help_text">Member's Password (Must be between 5-20 character)</p>
                                        <label>Married status</label><br />
                                        <label><input type="radio" name="m_status" value="1"/> Single</label><br />
                                        <label><input type="radio" name="m_status" value="2" /> Married</label>
                                        <p class="help-block help_text">Member's married status</p>
                                        <label>Gendar</label><br />
                                        <label><input type="radio" name="gender" value="1"/> Male</label><br />
                                        <label><input type="radio" name="gender" value="2" /> Female</label>
                                        <p class="help-block help_text">Gender of the Member</p>
                                        <label>Religion</label><br />
                                        <?php print religion_list(); ?>
                                        <p class="help-block help_text">Please choose the religion</p>
                                        <button type="submit" name="add_pro" class="btn btn-default btn btn-primary">Add Member</button>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <label>Product Image</label>
                                        <input type="file" name="main_img" />
                                        <p class="help-block help_text">Photo of the Member</p>
                                        <label>Local Address</label><br />
                                        <textarea name="laddress" class="form-control" rows="5"></textarea>
                                        <p class="help-block help_text">Member's local address</p>
                                        <label>Permanent Address</label><br />
                                        <textarea name="paddress" class="form-control" rows="5"></textarea>
                                        <p class="help-block help_text">Member's permanent address</p>
                                        <label>Description</label>
                                        <textarea name="description" id="ckeditor" class="ckeditor"></textarea>
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