<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">General Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                </div>
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Settings
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>
                            <form method="post" action="<?php echo base_url('Admin/General_settings/action')?>">
                            	<label>Website title</label>
                                <input type="text" name="site_title" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'site_title'); ?>" />
                                
                                <label>Set general email</label>
                                <input type="text" name="gen_email" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'gen_email'); ?>" />
                                
                                <label>Contact form email</label>
                                <input type="text" name="form_email" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'form_email'); ?>" />
                                
                                <label>Contact page email</label>
                                <input type="text" name="contact_email" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'contact_email'); ?>" /><br />
                                
                                <input type="submit" name="save_settings" class="btn btn-default btn btn-primary" value="Save Settings" />
                             </form>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <div class="col-lg-4">
<!--                <a href="--><?php //print base_url(); ?><!--/General_settings/download_backup">Downlaod SQL backup</a>-->
                </div>
            </div>
            <!-- /.row -->
        </div>