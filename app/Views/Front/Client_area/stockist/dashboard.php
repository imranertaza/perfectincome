<?php print $sidebar_left; ?>

<div class="col-md-9">
  <div class="right_contant dashboard_right">
    <div class="top_right_content">
      <h1>Stockist Dashboard Statement</h1>
      <hr />
      <div class="dashboard_aera"> 
        <div class="dashboard_left_area">
          <h3>Latest Delivery Reports</h3>
          <table class="table-bordered table-hover table">
            <tbody>
              <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Date</th>
              </tr>
              <tr>
                <td>1</td>
                <td>sohelchy</td>
                <td>95.00</td>
                <td>10 Jan 2017</td>
              </tr>
              <tr>
                <td>2</td>
                <td>sohelchy</td>
                <td>645.00</td>
                <td>10 Jan 2017</td>
              </tr>
              <tr>
                <td>3</td>
                <td>ab-chy2</td>
                <td>57.00</td>
                <td>13 Dec 2016</td>
              </tr>
              <tr>
                <td>4</td>
                <td>hussain5958</td>
                <td>57.00</td>
                <td>05 Dec 2016</td>
              </tr>
              <tr>
                <td>5</td>
                <td>jahid5103</td>
                <td>485.00</td>
                <td>05 Dec 2016</td>
              </tr>
              <tr>
                <td>6</td>
                <td>foysol90</td>
                <td>435.00</td>
                <td>04 Dec 2016</td>
              </tr>
              <tr>
                <td>7</td>
                <td>abchy</td>
                <td>95.00</td>
                <td>28 Nov 2016</td>
              </tr>
              <tr>
                <td>8</td>
                <td>sohelchy</td>
                <td>160.00</td>
                <td>22 Nov 2016</td>
              </tr>
              <tr>
                <td>9</td>
                <td>sohelchy</td>
                <td>167.00</td>
                <td>22 Nov 2016</td>
              </tr>
              <tr>
                <td>10</td>
                <td>pyar</td>
                <td>435.00</td>
                <td>21 Nov 2016</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="dashboard_right_area">
          <div class="user_information">
            <h3>Stockist Information</h3>
            <table class="table-bordered table-hover table">
              <tbody>
                <tr>
                  <td><strong>Name</strong></td>
                  <td><?php echo $profile->username;?></td>
                </tr>
                <tr>
                  <td><strong>Profile Picture</strong></td>
                  <td><img src="http://aponjonint.com/images/logo22.png"></td>
                </tr>
                <tr>
                  <td><strong>Mobile Number</strong></td>
                  <td><?php echo $profile->phn_no;?></td>
                </tr>
                <tr>
                  <td><strong>Available Balance</strong></td>
                  <td><?php echo $profile->balance;?></b></td>
                </tr>
                <tr>
                  <td><strong>Stock Value</strong></td>
                  <td><?php echo $profile->phn_no;?></b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
