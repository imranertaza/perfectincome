<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Theme Settings</h1>
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
                        <div class="panel-heading"> Theme select </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>
                            <form method="post" action="<?php echo base_url('Admin/Theme_settings/action')?>">
                                <label>Theme </label>
                                <select class="form-control" name="theme" required>
                                    <?php echo available_theme($globalSettings->get_each_setting_value('theme'));?>
                                </select><br />

                                <input type="submit" name="save_settings" class="btn btn-default btn btn-primary" value="Update" />
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