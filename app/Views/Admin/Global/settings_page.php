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

                                <label>Matching Commission</label>
                                <input type="text" name="matching_commission" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'matching_commission'); ?>" /><br />

                                <label>Perday matching</label>
                                <input type="text" name="per_day_matching" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'per_day_matching'); ?>" /><br />

                                <label>Min matching point</label>
                                <input type="text" name="min_matching_point" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'min_matching_point'); ?>" /><br />

                                <label>PM ID</label>
                                <input type="text" name="PM_ID" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'PM_ID'); ?>" /><br />

                                <label>Perday video watch</label>
                                <input type="text" name="per_day_video_watch" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'per_day_video_watch'); ?>" /><br />

                                <label>Perday video watch earning</label>
                                <input type="text" name="per_day_video_watch_earning" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'per_day_video_watch_earning'); ?>" /><br />

                                <label>Max Withdraw PerDay (Member)</label>
                                <input type="text" name="maxWithdrawPerDay" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'maxWithdrawPerDay'); ?>" /><br />

                                <label>Min Withdraw PerTime (Member)</label>
                                <input type="text" name="minWithdrawPerTime" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'minWithdrawPerTime'); ?>" /><br />



                                <label>Max Withdraw PerTime (Member)</label>
                                <input type="text" name="maxWithdrawPerTime" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'maxWithdrawPerTime'); ?>" /><br />

                                <label>User expiry day</label>
                                <input type="text" name="user_expiry_day" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'user_expiry_day'); ?>" /><br />


                                <label>Max Withdraw PerDay (Agent)</label>
                                <input type="text" name="maxWithdrawPerDayAgent" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'maxWithdrawPerDayAgent'); ?>" /><br />

                                <label>Min Withdraw PerTime (Agent)</label>
                                <input type="text" name="minWithdrawPerTimeAgent" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'minWithdrawPerTimeAgent'); ?>" /><br />



                                <label>Max Withdraw PerTime (Agent)</label>
                                <input type="text" name="maxWithdrawPerTimeAgent" class="form-control" value="<?php print $globalSettings->get_each_setting_value($key = 'maxWithdrawPerTimeAgent'); ?>" /><br />

                                
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