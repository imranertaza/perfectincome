
<div class="container-fluid dash_body">
  <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>My Profile</h1>
                  <hr />
                      <table class="table-bordered table-hover table">
                      
                        <tbody>
                         
                          <tr>
                            <td>Name</td>
                            <td><?php echo $row->username;?></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><?php echo $row->email;?></td>
                          </tr>
                          <tr>
                            <td>Mobile</td>
                            <td><?php echo $row->phn_no;?></td>
                          </tr>
                          <tr>
                            <td>National ID</td>
                            <td><?php echo $row->nid;?></td>
                          </tr>
                          <tr>
                            <td>Father Name</td>
                            <td><?php echo $row->father;?></td>
                          </tr>
                          <tr>
                            <td>Mother Name</td>
                            <td><?php echo $row->mother;?></td>
                          </tr>
                          <tr>
                            <td>Address1</td>
                            <td><?php echo $row->address1;?></td>
                          </tr>
                          <tr>
                            <td>Address2</td>
                            <td><?php echo $row->address2;?></td>
                          </tr>
                          <tr>
                            <td>Religion</td>
                            <td><?php echo get_globle($row->religion, 'religion');?></td>
                          </tr>
                          <tr>
                            <td>Nominee</td>
                            <td><?php echo $row->nominee;?></td>
                          </tr>

                          <tr>
                            <td colspan="2" style="text-align: right;">
                              <a type="button" class="btn btn-sm btn-warning" href="<?php print base_url(); ?>/member/profile/profile_update">Edit Profile</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                      
                      
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
