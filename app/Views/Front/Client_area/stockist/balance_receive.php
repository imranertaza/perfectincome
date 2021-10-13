<?php print $sidebar_left; ?>

<div class="col-md-9">
  <div class="right_contant dashboard_right">
    <div class="top_right_content">
      <h1>Stockist Balance Received</h1>
      <hr />
      <table class="table-bordered table-hover table">
        <tbody>
            <tr>
                <th width="181">ID</th>
                <th width="181">Title</th>
                <th width="417">Amount</th>
                <th width="400">Date</th>
                <th width="400">Status</th>
                <th width="400">Type</th>            
            </tr>
         <?php
			foreach ($query->result() as $row)
			{
			 ?>
            <tr>
                <td width="181"><?php echo get_username_by_id($row->agent_id);?></td>
                <td width="181"><?php echo $row->comment;?></td>
                <td width="417"><?php echo $row->amount;?></td>
                <td width="400"><?php echo $row->date;?></td>
                <td width="400"><?php echo $row->status;?></td>
                <td width="400"><?php echo($row->type == 1) ? "Agent":"Stockis";?></td>
            </tr>
           <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
