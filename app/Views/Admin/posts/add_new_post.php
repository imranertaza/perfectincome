<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Post</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<?php print $report = $this->post->add_new_post();
								if ($report) {
								?>
                                <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>posts/add_new_post.html" />
                                </div>
                                <div class="col-lg-12">
                                <?php } ?>
                                    
                                    <form method="post" action="" enctype="multipart/form-data">
                                	<div class="col-lg-8">
                                        <label>Post Title</label>
                                        <input class="form-control" name="post_tilte">
                                        <p class="help-block help_text">Please keep the title here</p>
                                        <label>Description</label>
                                        <textarea name="description" id="ckeditor" class="ckeditor"></textarea>
                                        <p class="help-block help_text">The description you want to show into the page</p>
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_description" rows="3"></textarea><br />
                                        <button type="submit" name="add_post" class="btn btn-default btn btn-primary">Add Post</button>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Featured Image</label>
                                        <input type="file" name="f_img" />
                                        <p class="help-block help_text">Please set the main image of your product</p><br />
                                        <label>Category</label>
                                        <div class="cat_show"><?php print $this->functions->category_checkbox(); ?></div>
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