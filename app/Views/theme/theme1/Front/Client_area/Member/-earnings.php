<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">
        <?php print $sidebar_left; ?>

        <div class="col-md-9">
          <div class="right_contant dashboard_right">
            <div class="top_right_content">
              <h1>Member Earnings</h1>
              <hr />
              
              <div class="top_right_content">
                <table class="table-bordered table-hover table">
                  <tbody>
                    <tr>
                      <td>Total Matching</td>
                      <td> <?php echo $com_taken_matching; ?></td>
                    </tr>
                               
                    <tr>
                      <td>Waiting Matching</td>
                      <td>0</td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <br>
                <table class="table-bordered table-hover table">
                  <tbody>
                    <tr>
                      <th>Sponsor</th>
                      <th>Matching</th>
                    </tr>
                    <tr>
                      <td><?php print empty($cspot_commis[0]["SUM(amount)"]) ? "0" : $cspot_commis[0]["SUM(amount)"]; ?></td>
                      <td><?php print empty($total_matching_amount[0]["SUM(amount)"]) ? "0" : $total_matching_amount[0]["SUM(amount)"]; ?></td>
                    </tr>
                    <tr>
                      <td>1.60<br>
                        (For product buy)</td>
                      <td>0.00<br>
                        (For product buy)</td>
                      <!-- <td>0.00</td> --> 
                    </tr>
                    <tr>
                      <td><a class="withdraw_btn" href="<?php print base_url(); ?>member/withdraw/spon/">Withdraw</a></td>
                      <td><a class="withdraw_btn" href="<?php print base_url(); ?>member/withdraw/mat/">Withdraw</a></td>
                    </tr>
                    <tr>
                      <td colspan="1"><b>Wait for product buy</b></td>
                      <td colspan="4"><b>21.60</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
