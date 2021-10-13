<div class="container-fluid dash_body">
  <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

                        <?php print $sidebar_left; ?>
                            
                            <div class="col-md-9 "  >
                              <div class="right_contant dashboard_right">
                                <div class="top_right_content">
                                  <h1> Agent Dashboard </h1>
                                  <hr />
                                  <div class="dashboard_aera">
                                    <div class="dashboard_right_area">
                                      <div class="user_information">
                                        <h3>Agent Information</h3>
                                        <table class="table-bordered table-hover table">
                                          <tbody>
                                            <tr>
                                              <td><strong>Name</strong></td>
                                              <td><?php echo $profile->username;?></td>
                                            </tr>
                                            <tr>
                                              <td><strong>Profile Picture</strong></td>
                                                <?php $img = (!empty($profile->photo))?$profile->photo:'images.png'; ?>
                                              <td><img src="<?php print base_url(); ?>/uploads/user_image/<?php echo $img ;?>" width="30%"></td>
                                            </tr>
                                            <tr>
                                              <td><strong>Available Balance</strong></td>
                                              <td><?php echo Tk_view($profile->balance)?></td>
                                            </tr>
                                            <tr>
                                              <td><strong>Mobile Number</strong></td>
                                              <td><?php echo $profile->phn_no;?></td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                    <div class="dashboard_left_area">
                                      <h3>Recent Added Members</h3>
                                      <table class="table-bordered table-hover table">
                                        <tbody>
                                          <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Date Added</th>
                                          </tr>
                                           <?php
                              			foreach ($query as $row)
                              			{
                              			 ?>
                                          <tr>
                                            <td><?php echo $row->ID;?></td>
                                            <td><?php echo $row->username;?></td>
                                            <td><?php echo $row->time;?></td>
                                          </tr>
                                          <?php
                              			}
                              			?>
                                        </tbody>
                                      </table>
                                      <br>
                                      <h3>Recent Sales</h3>
                                      <table class="table-bordered table-hover table">
                                        <tbody>
                                         
                                          <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Sale Amount</th>
                                            <th>Date Time</th>
                                          </tr>
                                          <?php
                              			foreach ($querya as $item)
                              			{
                              			 ?>
                                          <tr>
                                            <td><?php echo $item->sale_id;?></td>
                                            <td><?php print get_username_by_id($item->u_id); ?></td>
                                            <td><?php print Tk_view(get_total_price_of_a_sale($item->sale_id)); ?></td>
                                            <td><?php echo $item->time;?></td>
                                          </tr>
                                          <?php } ?>
                                          
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
      </div>
    </div>
  </div>