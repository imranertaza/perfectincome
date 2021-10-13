<?php print $sidebar_left; ?>

<div class="col-md-9">
  <div class="right_contant dashboard_right">
    <div class="top_right_content">
      <h1>Balance Request</h1>
      <hr />
      <div class="top_right_content">
        <form action="<?php print base_url(); ?>stockist/balance_request/" method="POST">
        <?php if (!empty($msg)) { print $msg; 
	  print '<meta http-equiv="refresh" content="1;URL='.base_url().'stockist/balance_request/">';
	  }?>
          <table class="table-bordered table-hover table">
            <tbody>
              <tr>
                <td>Amount</td>
                <td><input type="text" class="inp" name="amount" required="required" value=""></td>
              </tr>
              <tr>
                <td>Comment</td>
                <td><textarea name="comment" class="inp" required="required"></textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="con_btn" name="request" value="Submit Request"></td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
