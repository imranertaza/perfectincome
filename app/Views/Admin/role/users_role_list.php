<?php
@$do = $_GET['do'];
@$id = $_GET['id'];
$msg = '';
if ($do == 'del') {
	$delete_role = $this->db->query("DELETE FROM `roles` WHERE `roles`.`ID` = '$id'");
	if ($delete_role) {
		$delete_role_permission = $this->db->query("DELETE FROM `role_perms` WHERE `role_perms`.`roleID` = '$id'");
		if ($delete_role_permission) {
		$msg = '<p class="success">Role successfully deleted!</p>';
		}
	}
}
?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All User Role List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           	
            
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                            <div class="table-responsive">
                            <div><?php print $msg;
								if ($msg) { ?>
									<meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>role/users_role_list.html" />
							<?php } ?></div>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="135">SL</th>
                                            <th width="291">Role name</th>
                                            <th width="427">Role Permissions</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php $this->role_add_list->role_list(); ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>