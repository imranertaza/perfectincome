<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Page</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">

                            	<form method="post" action="<?php echo base_url('Pages/action')?>">
                                        <div class="form-group col-lg-8">
                                            <label>Page Title</label>
                                            <input class="form-control" name="page_tilte" value="" required>
                                            <p class="help-block">Please keep the title here</p>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Description</label>
                                           <textarea name="description" id="ckeditor" class="ckeditor"></textarea>
                                            <p class="help-block">The description you want to show into the page</p>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <label>Short Description</label>
                                            <textarea class="form-control" name="short_description" rows="3" required></textarea>
                                            <p class="help-block">The page short description will be here but it will not show into the main description.</p>
                                        </div>
                                        
                                        <div class="form-group col-lg-4">
                                        <label>Page Template</label>
                                            <select class="form-control" name="page_template">
                                            	<option value="0">Difault Template</option>
                                                <?php print $pageModel->find_template(); ?>
                                            </select>
                                            <p class="help-block">Select a page template.</p>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <button type="submit" name="add_page" class="btn btn-default btn btn-primary">Add New</button>
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