<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

          <?php print $sidebar_left; ?>

          <div class="col-md-9">
            <div class="right_contant dashboard_right">
              <div class="top_right_content">
                <h1>Agent Account Status</h1>
                <hr />
                    <table class="table-bordered table-hover table">
                      <tbody>
                        <tr>
                          <th>Name: </th>
                          <td><?php echo $row->username;?></td>
                        </tr>
                        <tr>
                          <th>Mobile: </th>
                          <td><?php echo $row->phn_no;?></td>
                        </tr>
                        <tr>
                          <th>Available Balance:</th>
                          <td><?php echo $row->balance;?></td>
                        </tr>
                        <tr>
                          <th>Commission:</th>
                          <td><?php echo $row->commission;?> <a href="<?php print base_url(); ?>agent/withdraw/">Withdraw</a></td>
                        </tr>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
