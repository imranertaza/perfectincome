<script type="text/javascript" src="<?php print base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">My Tree</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

                        <div class="col-lg-12" style="margin-left: 80px;padding: 10px;">

                            <div class="Tree">
                                <?php $u_id = empty($user_id) ? $ID : $user_id; ?>

                                <table width="70%">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="2" align="center"><a class="parent"
                                                                          href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $u_id; ?>/">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img"/><br>
                                                <?php print get_username_byID($u_id);
                                                $p_left = get_hand_byID($u_id, 'l_t');
                                                $p_right = get_hand_byID($u_id, 'r_t');
                                                ?></a></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="12" style="text-align: center;"><img
                                                    src="<?php echo base_url() ?>/uploads/treeimage/level1.png"
                                                    width="420"></td>
                                    </tr>

                                    <tr>

                                        <td colspan="6" style="text-align: center;"><a
                                                    href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img level"/><br>
                                                <?php
                                                print get_username_byID($p_left);
                                                $p_l_left = get_hand_byID($p_left, 'l_t');
                                                $p_l_right = get_hand_byID($p_left, 'r_t');
                                                ?>
                                            </a></td>


                                        <td colspan="6" style="text-align: center;"><a
                                                    href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img level"/><br>
                                                <?php
                                                print get_username_byID($p_right);
                                                $p_r_left = get_hand_byID($p_right, 'l_t');
                                                $p_r_right = get_hand_byID($p_right, 'r_t');
                                                ?>
                                            </a></td>


                                    </tr>

                                    <tr>
                                        <td colspan="6" style="text-align: center;"><img
                                                    src="<?php echo base_url() ?>/uploads/Treeimage/Level2.png"
                                                    width="210"></td>
                                        <td colspan="6" style="text-align: center;"><img
                                                    src="<?php echo base_url() ?>/uploads/Treeimage/Level2.png"
                                                    width="210"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve2"/><br>
                                                <?php
                                                print get_username_byID($p_l_left);
                                                $p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                $p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>

                                        <td colspan="3" style="text-align: center;"><a
                                                    href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve2"/><br>
                                                <?php
                                                print get_username_byID($p_l_right);
                                                $p_l_r_left = get_hand_byID($p_l_right, 'l_t');
                                                $p_l_r_right = get_hand_byID($p_l_right, 'r_t');
                                                ?>
                                            </a></td>

                                        <td colspan="3" style="text-align: center;"><a
                                                    href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve2"/><br>
                                                <?php
                                                print get_username_byID($p_r_left);
                                                $p_r_l_left = get_hand_byID($p_r_left, 'l_t');
                                                $p_r_l_right = get_hand_byID($p_r_left, 'r_t');
                                                ?>
                                            </a></td>

                                        <td colspan="3" style="text-align: center;"><a
                                                    href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve2"/><br>
                                                <?php
                                                print get_username_byID($p_r_right);
                                                $p_r_r_left = get_hand_byID($p_r_right, 'l_t');
                                                $p_r_r_right = get_hand_byID($p_r_right, 'r_t');
                                                ?>
                                            </a></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url() ?>/uploads/Treeimage/level3.png"
                                                 width="120">
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url() ?>/uploads/Treeimage/level3.png"
                                                 width="120">
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url() ?>/uploads/Treeimage/level3.png"
                                                 width="120">
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url() ?>/uploads/Treeimage/level3.png"
                                                 width="120">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_l_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_l_l_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_l_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_l_l_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_r_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_l_r_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_l_r_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_l_r_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_l_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_r_l_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_l_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_r_l_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_r_left; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_r_r_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/Admin/Tree/index/<?php print $p_r_r_right; ?>">
                                                <img src="<?php print base_url(); ?>/uploads/widget_image/no_thumb.jpg"
                                                     class="profile_img leve3"/>
                                                <?php
                                                print get_username_byID($p_r_r_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                    </tr>

                                </table>
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