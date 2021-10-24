<?php

use App\Models\FunctionModel;

$this->session = \Config\Services::session();
$user_id = $this->session->user_id;
$this->functionModel = new \App\Models\FunctionModel();
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="active" href="<?php echo base_url(); ?>/dashboard"><i class="fa fa-dashboard fa-fw"></i>
                    Mainboard</a>
            </li>
            <?php if ($this->functionModel->hasPermission('page_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Page<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('page_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Pages/page_list"><i class="fa fa-list fa-fw"></i> All
                                    Pages</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_page') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Pages/add_new_page"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Page</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php }
            /*
            if ($this->functionModel->hasPermission('std_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-list-ol" aria-hidden="true"></i> Products <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('std_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_area/product/list/"><i
                                            class="fa fa-list fa-fw"></i> All Products</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_std') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_area/product/add/"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Product</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($this->functionModel->hasPermission('std_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-list-ol" aria-hidden="true"></i> Menufacture <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('std_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Menufacture"><i class="fa fa-list fa-fw"></i>
                                    All Menufacture</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_std') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Menufacture/add/"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Menufacture</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($this->functionModel->hasPermission('std_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-list-ol" aria-hidden="true"></i> Product Catagory <span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('std_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Product_cat"><i class="fa fa-list fa-fw"></i>
                                    All Product Catagory</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_std') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Product_cat/add"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Prodcut Catagory</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } */
            if ($this->functionModel->hasPermission('std_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-fw"></i> Member <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('std_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_area/member/list"><i
                                            class="fa fa-list fa-fw"></i> All Member</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_std') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_area/member/add"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Member</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($this->functionModel->hasPermission('category_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Catagory<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('category_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Category/category_list"><i
                                            class="fa fa-list fa-fw"></i> All Categories</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_category') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Category/add_category"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Catagory</a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }
            if ($this->functionModel->hasPermission('post_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-puzzle-piece fa-fw"></i> Blocks<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('post_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Widgets/widgets_list"><i
                                            class="fa fa-list fa-fw"></i> Block List</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_post') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Widgets/add"><i class="fa fa-plus-square fa-fw"></i>
                                    Add Block</a>
                            </li>


                        <?php } ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>


                <li>
                    <a href="#"><i class="fa fa-puzzle-piece fa-fw"></i> Location<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/add_division"><i
                                        class="fa fa-plus-square fa-fw"></i> Add Division</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/list_division"><i class="fa fa-list fa-fw"></i>
                                List Division </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/add_district"><i
                                        class="fa fa-plus-square fa-fw"></i> Add District</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/district_list"><i class="fa fa-list fa-fw"></i>
                                List District</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/add_thana"><i
                                        class="fa fa-plus-square fa-fw"></i> Add Thana/Upazila</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/thana_list"><i class="fa fa-list fa-fw"></i>
                                List Thana/Upazila</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/add_word"><i
                                        class="fa fa-plus-square fa-fw"></i> Add Union/Ward</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Location/word_list"><i class="fa fa-list fa-fw"></i> List
                                Union/Ward</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <?php if ($this->functionModel->hasPermission('post_list') == true) { ?>
                        <a href="<?php echo base_url(); ?>/Admin_area/tree"><i class="fa fa-puzzle-piece fa-fw"></i>
                            Tree</a>
                    <?php } ?>
                </li>
            <?php }
            if ($this->functionModel->hasPermission('download_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-fw"></i> Notice<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('download_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Download"><i
                                            class="fa fa-list fa-fw"></i> Notice List</a>
                            </li>
                        <?php }
                        if ($this->functionModel->hasPermission('add_download') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Download/add"><i
                                            class="fa fa-plus-square fa-fw"></i> Add Notice</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>/Package"><i class="fa fa-fw"></i> Package</a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-fw"></i> Pin Gnerate<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a href="<?php echo base_url(); ?>/Pin_generat"><i
                                        class="fa fa-list fa-fw"></i> Pin Generat List</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>/Pin_generat/add"><i
                                        class="fa fa-plus-square fa-fw"></i> Pin Generat</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>


            <?php }
            if ($this->functionModel->hasPermission('download_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-fw"></i> Deposit/Withdraw<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php
                        if ($this->functionModel->hasPermission('add_download') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_ut/Balance_history/"><i
                                            class="fa fa-plus-square fa-fw"></i> User Load Balance</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            <?php }
            if ($this->functionModel->hasPermission('download_list') == true) { ?>
                <li>
                    <a href="#"><i class="fa fa-fw"></i> Point History<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->functionModel->hasPermission('download_list') == true) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>/Admin_ut/Point_history"><i
                                            class="fa fa-list fa-fw"></i> Point History</a>
                            </li>
                        <?php }  ?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php } ?>
            <li>
                <a href="#"><i class="fa fa-cogs fa-fw"></i> Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($this->functionModel->hasPermission('general_settings') == true) { ?>
                        <li>
                            <a href="<?php echo base_url(); ?>/General_settings">General Settings</a>
                        </li>
                    <?php }
                    if ($this->functionModel->hasPermission('slider') == true) { ?>
                        <li>
                            <a href="<?php echo base_url(); ?>/General_settings/slider">Slider</a>
                        </li>
                    <?php }
                    if ($this->functionModel->hasPermission('gallery') == true) { ?>
                        <li>
                            <a href="<?php echo base_url(); ?>/General_settings/gallery">Gallery</a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php /* if ($this->functionModel->hasPermission('user_list') == true) { ?>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            	<?php if ($this->functionModel->hasPermission('user_list') == true) { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>user/users_list.html">All Users</a>
                                </li>
                                <?php } if ($this->functionModel->hasPermission('add_user') == true) { ?>
                                <li>
                                    <a href="<?php echo base_url(); ?>user/add_user.html">Add User</a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="#">User Role management <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                    	<?php if ($this->functionModel->hasPermission('user_role_list') == true) { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>role/users_role_list.html">All User Roles</a>
                                        </li>
                                        <?php } if ($this->functionModel->hasPermission('add_role') == true) { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>role/add_role.html">Add Roles</a>
                                        </li>
                                        <?php } if ($this->functionModel->hasPermission('permission_list') == true) { ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>role/access_permission.html">Permissions List</a>
                                        </li>
                                        <?php } ?>
                                     
                                    </ul>
                                    <!-- /.nav-third-level -->
                                    
                                    
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } */ ?>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
