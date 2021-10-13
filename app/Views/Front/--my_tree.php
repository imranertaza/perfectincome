<?php print $sidebar_left; ?>
<div class="col-md-8">
        <h1>My Tree</h1>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="tree">
                <?php $u_id = empty($user_id) ? $ID : $user_id; ?>

                  <table width="520" height="273">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="3" align="right" valign="bottom"><img class="tree_arrow_left" src="<?php print base_url(); ?>assets/images/tree_arrow_left.png" /></td>
                        <td colspan="2" align="center">
                        <a class="parent" href="<?php print base_url(); ?>member_form/my_tree/<?php print $u_id; ?>/">
                        <img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img"  />
						<?php print get_username_byID($u_id);
						$p_left = get_hand_byID($u_id, 'l_t');
						$p_right = get_hand_byID($u_id, 'r_t');
						?>
                        </a></td>
                        <td colspan="3" valign="bottom"><img class="tree_arrow_right" src="<?php print base_url(); ?>assets/images/tree_arrow.png" /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td colspan="2" align="center" valign="top">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level"  />
						<?php 
						print get_username_byID($p_left);
						$p_l_left = get_hand_byID($p_left, 'l_t');
						$p_l_right = get_hand_byID($p_left, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td colspan="2" width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level"  />
						<?php 
						print get_username_byID($p_right);
						$p_r_left = get_hand_byID($p_right, 'l_t');
						$p_r_right = get_hand_byID($p_right, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve2"  />
						<?php 
						print get_username_byID($p_l_left);
						$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve2"  />
						<?php 
						print get_username_byID($p_l_right);
						$p_l_r_left = get_hand_byID($p_l_right, 'l_t');
						$p_l_r_right = get_hand_byID($p_l_right, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve2"  />
						<?php 
						print get_username_byID($p_r_left);
						$p_r_l_left = get_hand_byID($p_r_left, 'l_t');
						$p_r_l_right = get_hand_byID($p_r_left, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_right; ?>/">
                        <img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve2"  />
						<?php 
						print get_username_byID($p_r_right);
						$p_r_r_left = get_hand_byID($p_r_right, 'l_t');
						$p_r_r_right = get_hand_byID($p_r_right, 'r_t');
						?>
                        </a></td>
                        <td valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                      </tr>
                      <tr>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_l_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_l_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_l_l_right);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_r_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_l_r_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_r_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_l_r_right);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_r_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_l_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_r_l_right);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_r_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_r_r_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_r_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img leve3"  />
						<?php 
						print get_username_byID($p_r_r_right);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                      </tr>
                   </table>

                  
                  
                  
              </div>
            </div>
        </div>
</div>

                                    
                                    
