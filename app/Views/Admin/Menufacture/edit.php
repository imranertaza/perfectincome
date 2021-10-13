
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Menufacture</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<form method="post" action="<?php echo base_url('Menufacture/update_action')?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Menufacture Name</label>
                                            <input class="form-control" name="menu_name" value="<?php print $menufacture->brand_name; ?>" required>
                                            <input type="hidden" name="id" value="<?php print $menufacture->men_id; ?>">
                                            <p class="help-block">Name of the catagory</p>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-default btn btn-primary" name="edit_category">Edit</button>
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