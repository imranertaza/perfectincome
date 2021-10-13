<?php print $sidebar_left; ?>
<div class="col-md-8">
        <h1>My Tree</h1>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <?php function my_tree($pid=1,$sub=0, $limit=0) {
                                    $limit++;
                                    $sql = $this->db->query("SELECT * FROM `Tree` WHERE `u_id` = '$pid'");
                                    $tree = '';
                                    while($row = $this->db->query($sql)->row()){
										
                                        if((empty($row['l_t']) || empty($row['r_t'])) && $sub==1) { 
                                            $tree .= '';
                                        }else {
                                            $tree .=  '<ul><li><a href="#">'.get_username_byID($pid).'</a>'; 
                                        }
                                        $tree .=  '<ul>
                                                        <li>
                                                        <a href="#">'.get_username_byID($row['l_t']).'</a>
                                                            '.my_tree($row['l_t'], $sub=1, $limit).'
                                                        </li>
                                                        <li>
                                                            <a href="#">'.get_username_byID($row['r_t']).'</a>
                                                            '.my_tree($row['r_t'], $sub=1, $limit).'
                                                        </li>
                                                    </ul>';
                                        if((empty($row['l_t']) || empty($row['r_t'])) && $sub==1) { 
                                            $tree .= '';
                                        }else {
                                            $tree .=  '</li></ul>'; 
                                        }
                                    }
                                    if ($limit < 4) { return $tree; }
                                    
                                } ?>

                <div class="tree">
                   <?php //print my_tree($ID); ?>
                   <table width="454">
                      <tr>
                        <td height="49" align="right" valign="bottom" colspan="5"><img class="tree_arrow_left" src="<?php print base_url(); ?>assets/images/tree_arrow_left.png" /></td>
                        <?php $u_id = empty($user_id) ? $ID : $user_id; ?>
                        <td colspan="4" align="center">
                        <a class="parent" href="<?php print base_url(); ?>member_form/my_tree/<?php print $u_id; ?>/">
                        <img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img"  />
						<?php print get_username_byID($u_id);
						$p_left = get_hand_byID($u_id, 'l_t');
						$p_right = get_hand_byID($u_id, 'r_t');
						?>
                        </a></td>
                        <td colspan="5" valign="bottom"><img class="tree_arrow_right" src="<?php print base_url(); ?>assets/images/tree_arrow.png" /></td>
                      </tr>
                      <tr>
                        <td height="62" align="right" valign="bottom" colspan="1"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td colspan="1" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level2l"  />
						<?php 
						print get_username_byID($p_left);
						$p_l_left = get_hand_byID($p_left, 'l_t');
						$p_l_right = get_hand_byID($p_left, 'r_t');
						?>
                        </a></td>
                        <td colspan="2" valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                        <td colspan="7">&nbsp;</td>
                        <td width="62" colspan="1" align="right" valign="bottom"><img class="tree_arrow_sort_l" src="<?php print base_url(); ?>assets/images/tree_arrow_left_short.png" /></td>
                        <td width="36" colspan="1" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level2r"  />
						<?php 
						print get_username_byID($p_right);
						$p_r_left = get_hand_byID($p_right, 'l_t');
						$p_r_right = get_hand_byID($p_right, 'r_t');
						?>
                        </a></td>
                        <td width="32" colspan="2" valign="bottom"><img class="tree_arrow_sort_r" src="<?php print base_url(); ?>assets/images/tree_arrow_right_short.png" /></td>
                      </tr>
                      <tr>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="53">&nbsp;</td>
                        <td colspan="2" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_right; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3r"  />
						<?php 
						print get_username_byID($p_l_right);
						//$p_l_r_left = get_hand_byID($p_l_right, 'l_t');
						//$p_l_r_right = get_hand_byID($p_l_right, 'r_t');
						?>
                        </a></td>
                        <td colspan="4">&nbsp;</td>
                        <td width="99" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_r_left);
						//$p_r_l_left = get_hand_byID($p_r_left, 'l_t');
						//$p_r_l_right = get_hand_byID($p_r_left, 'r_t');
						?>
                        </a></td>
                        <td width="6">&nbsp;</td>
                        <td colspan="2" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_r_right; ?>/">
                        <img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3r"  />
						<?php 
						print get_username_byID($p_r_right);
						//$p_r_r_left = get_hand_byID($p_r_right, 'l_t');
						//$p_r_r_right = get_hand_byID($p_r_right, 'r_t');
						?>
                        </a></td>
                      </tr>
                      <tr>
                      	<td height="70" align="center">&nbsp;</td>
                        <td height="70" align="center">&nbsp;</td>
                        <td width="35">&nbsp;</td>
                        <td colspan="2" align="center">&nbsp;</td>
                        <td colspan="4">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td width="25">&nbsp;</td>
                        <td colspan="2" align="center">&nbsp;</td>
                        <td height="70" align="center">&nbsp;</td>
                      </tr>
   
                  </table>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  <table width="720" height="307">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
						//$p_l_l_left = get_hand_byID($p_l_left, 'l_t');
						//$p_l_l_right = get_hand_byID($p_l_left, 'r_t');
						?>
                        </a></td>
                        <td>&nbsp;</td>
                        <td width="54" height="70" align="center">
                        <a href="<?php print base_url(); ?>member_form/my_tree/<?php print $p_l_left; ?>/">
						<img src="<?php print base_url(); ?>uploads/widget_image/no_thumb.jpg" class="profile_img level3l"  />
						<?php 
						print get_username_byID($p_l_left);
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

                                    
                                    
