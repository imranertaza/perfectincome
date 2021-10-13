<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mainboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php print total_members(); ?></div>
                                    <div>Members</div>
                                </div>
                            </div>
                        </div>
                        <?php if ($functionModel->hasPermission('tec_list') == true) { ?>
                        <a href="<?php echo base_url(); ?>admin_area/teacher/teacher_list.html">
                            <div class="panel-footer">
                                <span class="pull-left">Member List</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php print total_stockis(); ?></div>
                                    <div>Stockis</div>
                                </div>
                            </div>
                        </div>
                        <?php if ($functionModel->hasPermission('std_list') == true) { ?>
                        <a href="<?php echo base_url(); ?>admin_area/student/student_list">
                            <div class="panel-footer">
                                <span class="pull-left">Stockis List</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php print total_agents(); ?></div>
                                    <div>Agents</div>
                                </div>
                            </div>
                        </div>
                        <?php if ($functionModel->hasPermission('download_list') == true) { ?>
                        <a href="<?php echo base_url(); ?>/download/download_list.html">
                            <div class="panel-footer">
                                <span class="pull-left">Agents List</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php print total_pages(); ?></div>
                                    <div>Pages</div>
                                </div>
                            </div>
                        </div>
                        <?php if ($functionModel->hasPermission('page_list') == true) { ?>
                        <a href="<?php echo base_url(); ?>/pages/page_list.html">
                            <div class="panel-footer">
                                <span class="pull-left">Pages List</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php print total_users(); ?></div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <?php if ($functionModel->hasPermission('user_list') == true) { ?>
                        <a href="<?php //echo base_url(); ?>user/users_list.html">
                            <div class="panel-footer">
                                <span class="pull-left">Users List</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        
        
    