<?php $get_category = $this->db->query("SELECT * FROM `Category` WHERE `cat_id` = '$cat_id'")->row(); ?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Catagory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            <?php print $msg = $this->category_mod->edit_category($cat_id);
							if ($msg) {
							?>
                            <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>category/edit_category/<?php print $cat_id; ?>.html" />
                            <?php } ?>
                            	<form method="post" action="">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Catagory Name</label>
                                            <input class="form-control" name="cat_name" value="<?php print $get_category['cat_name']; ?>">
                                            <p class="help-block">Name of the catagory</p>
                                        </div>
                                        <div class="form-group">
                                        	<select class="form-control" name="perent">
                                            	<option value="0">No Category</option>
                                            	<?php print $this->category_mod->category_option_list($get_category['perent_id']); ?>
                                            </select>
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