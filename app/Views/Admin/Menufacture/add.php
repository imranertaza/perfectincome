<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Menufacture</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<form method="post" action="<?php echo base_url('Menufacture/action')?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Menufacture Name</label>
                                            <input class="form-control" name="menu_name" required>
                                            <p class="help-block">Name of the menufacture</p>
                                        </div>
                                        <div class="form-group">
                                        	
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="add_menufacture">Add</button>
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