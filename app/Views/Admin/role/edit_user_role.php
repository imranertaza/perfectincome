<?php
$sql = "SELECT * FROM `roles` WHERE `ID` = '$role_id'";
$details = $this->db->query($sql)->row();
$role_id = $details->ID;
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User Role</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <div id="success_report">
						<?php 
						print $msg = $this->role_add_list->edit_role($role_id);
						if (@$msg) {
						?>
                        <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>role/edit_role/<?php print $details['ID']; ?>.html" />
                        <?php } ?></div>
                            <div class="row">
                            	<form role="form" method="post">
                                <div class="col-lg-4">
                                    
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <input class="form-control" type="text" name="role_name" value="<?php print $details->roleName; ?>">
                                            <p class="help-block">Please keep the role name</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Role Description</label>
                                            <input class="form-control" type="text" name="role_des" value="<?php print @$details->role_description; ?>">
                                            <p class="help-block">Please put some description of the role</p>
                                        </div>
                                </div>
                                
                                <div class="col-lg-12">
                                <label>Permissions</label>
                                </div>
                                <div class="col-lg-12">
                                		<div class="col-lg-3"><?php $this->functions->permission_list_edited($role_id); ?></div>
                                </div>
                                <div class="col-lg-12">
                                        <input type="submit" class="btn btn-default btn btn-primary" name="edit_role" value="Update">
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                </form>
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