<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

          <?php print $sidebar_left; ?>

          <div class="col-md-9">
            <div class="right_contant dashboard_right">
              <div class="top_right_content">
                <h1>Agent Sales Report</h1>
                <hr />
                <table class="table-bordered table-hover table">
                
                <thead>
                	<tr class="strong">
                      <th>#</th>
                      <th>Bill To</th>
                      <th>Referral</th>
                      <th>Invoice No</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Points</th>
                      <th>Print</th>
                    </tr>
                </thead>
                  <tbody>
                  
                  <?php
          		foreach ($query->result() as $row)
          		{
          		?>
                    <tr class="strong">
                      <td><?php echo $row->sale_id;?></td>
                      <td><?php echo get_username_by_id($row->u_id);?></td>
                      <td><?php echo get_username_by_id($row->spon_id);?></td>
                      <td><?php echo $row->inv_id;?></td>
                      <td><?php echo $row->time;?></td>
                      <td><?php echo get_total_price_of_a_sale($row->sale_id);?></td>
                      <td><?php echo get_total_point_of_a_sale($row->sale_id);?></td>
                      <td>Print</td>
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
