<?php
//$selete_page = $this->db->get_where('pages', array('page_id' => $page_id));
//$row = $selete_page->row_array();
?>
<script type="text/javascript" src="<?php print base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Page</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-lg-12">

                                    <form method="post" action="<?php echo base_url('Admin/Pages/update')?>">
                                        <div class="form-group col-lg-8">
                                            <label>Page Title</label>
                                            <input class="form-control" name="page_tilte" value="<?php print $pageData->page_title; ?>">
                                            <p class="help-block">Please keep the title here</p>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Description</label>
                                            <textarea name="description" id="ckeditor" class="ckeditor"><?php print $pageData->page_description; ?></textarea>
                                            <p class="help-block">The description you want to show into the page</p>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <label>Short Description</label>
                                            <textarea class="form-control" name="short_description" rows="3"><?php print $pageData->short_des; ?></textarea>
                                            <p class="help-block">The page short description will be here but it will not show into the main description.</p>
                                        </div>
                                        
                                        <div class="form-group col-lg-4">
                                        <label>Page Template</label>
                                            <select class="form-control" name="page_template">
                                            	<option value="0">Difault Template</option>
                                                <?php print $pageModel->find_template($page_id); ?>
                                            </select>
                                            <p class="help-block">Select a page template.</p>
                                        </div>
                                        <div class="form-group col-lg-8">
                                            <input type="hidden" name="page_id" value="<?php print $pageData->page_id; ?>">
                                        <button type="submit" name="edit_page" class="btn btn-default btn btn-primary">Update</button>
                                        </div>
									</form>
                                    
                                </div>
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