<?php $get_category = $this->db->query("SELECT * FROM `classes` WHERE `class_id` = '$class_id'")->row(); ?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Class</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            <?php print $msg = $this->class_mod->edit_class($class_id);
							if ($msg) {
							?>
                            <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>classes/edit_class/<?php print $class_id; ?>.html" />
                            <?php } ?>
                            	<form method="post" action="">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Class Name</label>
                                            <input class="form-control" name="class_name" value="<?php print $get_category['class_name']; ?>">
                                            <p class="help-block">Name of the Class</p>
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="edit_class">Edit</button>
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