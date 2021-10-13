<?php
@$do = $_GET['do'];
@$id = $_GET['id'];
$msg = '';
if ($do == 'del') {
	$delete_users = $this->db->query("DELETE FROM `users` WHERE `users`.`ID` = '$id'");
	if ($delete_users) {
		$delete_users_role = $this->db->query("DELETE FROM `user_roles` WHERE `user_roles`.`userID` = '$id'");
		if ($delete_users_role) {
		$msg = '<p class="success">User successfully deleted!</p>';
		}
	}
}
?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Users List</h1>
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
									<meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>user/users_list.html" />
							<?php } ?></div>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="20">SL</th>
                                            <th width="181">User Name</th>
                                            <th width="417">Email</th>
                                            <th width="400">User Role</th>
                                            <th width="130">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    	<?php $this->user_model->user_list(); ?>
                                        
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