
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Download</h1>
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
                                    <form method="post" action="<?php echo base_url('Download/update_action')?>" enctype="multipart/form-data">
                                	<div class="col-lg-8">
                                        <label>Post Title</label>
                                        <input class="form-control" name="title" value="<?php print $row->title; ?>">
                                        <input type="hidden" name="dwn_id" value="<?php print $row->dwn_id; ?>">
                                        <p class="help-block help_text">Please put the title here</p>
                                        <label>Description</label>
                                        <textarea name="description" id="ckeditor" class="ckeditor"><?php print $row->description; ?></textarea>
                                        <p class="help-block help_text">Please put some description of this file.</p>
                                        <button type="submit" name="edit_download" class="btn btn-default btn btn-primary">Update Download</button>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <input type="file" name="userfile" />
                                        <p class="help-block help_text">Set the file in PDF format</p><br />
                                        <label>Category</label>
                                        <div class="cat_show"><?php print $functionModel->category_checkbox(0, $row->cat_id); ?></div>
                                     </div>
                                    </form>
                                  </div>
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