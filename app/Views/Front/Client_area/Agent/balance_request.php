<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>Balance Requests</h1>
                  <hr />
                  <form action="<?php print base_url(); ?>agent/balance_request/" method="POST">
                  <?php if (!empty($msg)) { print $msg; 
            	  print '<meta http-equiv="refresh" content="1;URL='.base_url().'agent/balance_request/">';
            	  }?>
                    <table class="table-bordered table-hover table">
                      <tbody>
                        <tr>
                          <th>Amount</th>
                          <td><input type="text" name="amount" required="required" value=""></td>
                        </tr>
                        <tr>
                          <th>Comment</th>
                          <td><textarea name="comment" style="width: 100%;" required="required"></textarea></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><input type="submit" name="request" value="Request Submit"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
  