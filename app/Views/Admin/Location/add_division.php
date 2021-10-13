<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Division</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            
                            	<form method="post" action="<?php echo base_url('Location/action_division')?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Add Division </label>
                                            <input class="form-control" name="div_name">
                                            <p class="help-block">Name of the Division</p>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default btn btn-primary" name="add_division">Add</button>
                                </div>
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