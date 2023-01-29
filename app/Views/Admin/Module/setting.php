<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Module Setting</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    // print_r( $setting);
                    // exit();
                    $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                </div>
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                        <form method="post" action="<?php echo base_url('Admin/Module/update_setting')?>">
                            <div class="form-group col-lg-8">
                                <label>Title</label>
                                <input class="form-control" name="title" value="<?php print $setting->title; ?>">
                                <p class="help-block">Please keep the title here</p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Value</label>
                                <input class="form-control" name="value" value="<?php print $setting->value; ?>">
                                <p class="help-block">The description you want to show into the page</p>
                            </div>
                            
                            <div class="form-group col-lg-8">
                                <input type="hidden" name="module_id" value="<?php print $setting->module_id; ?>">
                            <button type="submit" name="update" class="btn btn-default btn btn-primary">Update</button>
                            </div>
                        </form>
                            
                        </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
