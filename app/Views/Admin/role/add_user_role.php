<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Role</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <div id="success_report"><?php $this->role_add_list->add_role(); ?></div>
                            <div class="row">
                            	<form role="form" method="post">
                                <div class="col-lg-4">
                                    
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <input class="form-control" type="text" name="role_name">
                                            <p class="help-block">Please keep the role name</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Role Description</label>
                                            <input class="form-control" type="text" name="role_des">
                                            <p class="help-block">Please put some description of the role</p>
                                        </div>
                                </div>
                                
                                <div class="col-lg-12">
                                <label>Permissions</label>
                                </div>
                                <div class="col-lg-12">
                                		<div class="col-lg-3"><?php $this->functions->permission_list(); ?></div>
                                </div>
                                <div class="col-lg-12">
                                        <input type="submit" class="btn btn-default btn btn-primary" name="add_role" value="Add New Role">
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