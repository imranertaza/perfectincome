<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Class</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            <?php print $msg = $this->class_mod->add_new_class();
							if ($msg) {
							?>
                            <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>classes/add_class.html" />
                            <?php } ?>
                            	<form method="post" action="">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class Name</label>
                                            <input class="form-control" name="class_name">
                                            <p class="help-block">Name of the Class</p>
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="add_class">Add</button>
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