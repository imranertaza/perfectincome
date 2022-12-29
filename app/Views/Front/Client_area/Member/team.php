<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9 pt-4">
                    <h5 class="main-title">My Team</h5>

                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="tree border-con">
                                <?php $u_id = empty($user_id) ? $ID : $user_id; ?>

                                <table class=" table-hover table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><h6 style="font-weight: bold;"><?php print $u_name;?></h6></td>
                                    </tr>
                                    <tr>
                                        <td>Left Point</td>
                                        <td><?php print $lpoint; ?> Pt.</td>
                                    </tr>
                                    <tr>
                                        <td>Right Point</td>
                                        <td><?php print $rpoint; ?> Pt.</td>
                                    </tr>
                                    <tr>
                                        <td>Member Search</td>
                                        <td>
                                            <form method="post" action="">
                                                <input type="text" id="user_tree_search" name="member_user">
                                                <input type="submit" name="search_member" value="Search" />
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table >
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td colspan="2" align="center"> <a class="parent" href="<?php print base_url(); ?>/member/general/team/<?php print $u_id; ?>"> <?php print view_user_image($u_id, 90, 90); ?><br>
                                                <?php print get_username_byID($u_id);
                                                $p_left = get_hand_byID($u_id, 'l_t');
                                                $p_right = get_hand_byID($u_id, 'r_t');
                                                ?> </a></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td colspan="12" style="text-align: center;"> <img  src="<?php echo base_url()?>/uploads/treeimage/level1.png" width="420" ></td>
                                    </tr>

                                    <tr>

                                        <td colspan="6" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_left; ?>"> <?php print view_user_image($p_left, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_left);
                                                $p_l_left = get_hand_byID($p_left, 'l_t');
                                                $p_l_right = get_hand_byID($p_left, 'r_t');
                                                ?>
                                            </a></td>


                                        <td colspan="6" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_right; ?>"> <?php print view_user_image($p_right, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_right);
                                                $p_r_left = get_hand_byID($p_right, 'l_t');
                                                $p_r_right = get_hand_byID($p_right, 'r_t');
                                                ?>
                                            </a></td>


                                    </tr>

                                    <tr>
                                        <td colspan="6" style="text-align: center;"><img src="<?php echo base_url()?>/uploads/treeimage/Level2.png" width="210"  ></td>
                                        <td colspan="6" style="text-align: center;"><img src="<?php echo base_url()?>/uploads/treeimage/Level2.png" width="210" ></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_left; ?>"> <?php print view_user_image_leve2($p_l_left, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_l_left);
                                                $p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                $p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a></td>

                                        <td colspan="3" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_right; ?>"> <?php print view_user_image_leve2($p_l_right, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_l_right);
                                                $p_l_r_left = get_hand_byID($p_l_right, 'l_t');
                                                $p_l_r_right = get_hand_byID($p_l_right, 'r_t');
                                                ?>
                                            </a></td>

                                        <td colspan="3" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_left; ?>"> <?php print view_user_image_leve2($p_r_left, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_r_left);
                                                $p_r_l_left = get_hand_byID($p_r_left, 'l_t');
                                                $p_r_l_right = get_hand_byID($p_r_left, 'r_t');
                                                ?>
                                            </a></td>

                                        <td colspan="3" style="text-align: center;"><a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_right; ?>"> <?php print view_user_image_leve2($p_r_right, 90, 90); ?><br>
                                                <?php
                                                print get_username_byID($p_r_right);
                                                $p_r_r_left = get_hand_byID($p_r_right, 'l_t');
                                                $p_r_r_right = get_hand_byID($p_r_right, 'r_t');
                                                ?>
                                            </a></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url()?>/uploads/treeimage/level3.png" width="120" >
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url()?>/uploads/treeimage/level3.png" width="120" >
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url()?>/uploads/treeimage/level3.png" width="120" >
                                        </td>

                                        <td colspan="3" style="text-align: center;">
                                            <img src="<?php echo base_url()?>/uploads/treeimage/level3.png" width="120" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_l_left; ?>/"> <?php print view_user_image_leve3($p_l_l_left, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_l_l_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_l_right; ?>/"> <?php print view_user_image_leve3($p_l_l_right, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_l_l_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_r_left; ?>/"> <?php print view_user_image_leve3($p_l_r_left, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_l_r_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_l_r_right; ?>/"> <?php print view_user_image_leve3($p_l_r_right, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_l_r_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_l_left; ?>/"> <?php print view_user_image_leve3($p_r_l_left, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_r_l_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_l_right; ?>/"> <?php print view_user_image_leve3($p_r_l_right, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_r_l_right);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_r_left; ?>/"> <?php print view_user_image_leve3($p_r_r_left, 90, 90); ?>
                                                <?php
                                                print get_username_byID($p_r_r_left);
                                                //$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
                                                //$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
                                                ?>
                                            </a>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center;">
                                            <a href="<?php print base_url(); ?>/member/general/team/<?php print $p_r_r_right; ?>/"> <?php print view_user_image_leve3($p_r_r_right, 90, 90); ?>
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

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

