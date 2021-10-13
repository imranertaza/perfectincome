<?php print $sidebar_left; ?>

<div class="col-md-9">
  <div class="right_contant dashboard_right">
    <div class="top_right_content">
      <h1>Commission</h1>
      <hr />
      <div class="top_right_content">
        <table class="table-bordered table-hover table">
          <tbody>
            <tr>
              <td>#</td>
              <td>Amount</td>
              <td>Comment</td>
              <td>Time</td>
            </tr>
             <?php
			foreach ($query->result() as $row)
			{
			 ?>
            <tr>
              <td><?php echo $row->gen_id;?></td>
              <td><?php echo $row->amount;?></td>
              <td><?php echo $row->purpose;?></td>
              <td><?php echo $row->date;?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
