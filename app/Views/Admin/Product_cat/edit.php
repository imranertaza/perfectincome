
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Product Catagory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<form method="post" action="<?php echo base_url('Product_cat/update_action')?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Catagory Name</label>
                                            <input class="form-control" name="cat_name" value="<?php print $get_category->cat_name; ?>" required>
                                            <input type="hidden" name="id" value="<?php print $get_category->cat_id ; ?>" required>
                                            <p class="help-block">Name of the catagory</p>
                                        </div>
                                        <div class="form-group">
                                        	<select class="form-control" name="perent">
                                            	<option value="0">No Category</option>
                                            	<?php print $functionModel->category_option_list($get_category->perent_id); ?>
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