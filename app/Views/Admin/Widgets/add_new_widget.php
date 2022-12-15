<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Block</h1>
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
                                    <form method="post" action="<?php echo base_url('Admin/Widgets/action')?>" enctype="multipart/form-data">
                                	<div class="col-lg-8">
                                        <label>Title</label>
                                        <input class="form-control" name="title">
                                        <p class="help-block help_text">Please keep the title here</p>
                                        <label>Description</label>
                                        <textarea name="description" id="ckeditor" class="ckeditor"></textarea>
                                        <p class="help-block help_text">The description you want to show into the page</p>
                                        
                                        <button type="submit" name="add_widget" class="btn btn-default btn btn-primary">Add Widget</button>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Featured Image</label>
                                        <input type="file" name="f_img" />
                                        <p class="help-block help_text">Please set the main image of your product</p><br />
                                        
                                        <label>Block Code</label>
                                        <textarea class="form-control" name="b_code" rows="10"></textarea>
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