<?php print $sidebar_left; ?>

<div class="col-md-9">
  <h1>Supplier Stock</h1>
  <hr />
  <div class="row store">
    <div class="col-md-12">
      <div class="top_right_content">
        <div id="message_show_box"></div>
        <table class="reports store_img" width="100%">
          <tbody>
            <tr>
              <th width="3%">#</th>
              <th width="20%">Image</th>
              <th width="22%">Name</th>
              <th width="18%">LP</th>
              <th width="18%">Price</th>
              <th width="19%">Qty</th>
            </tr>
            <?php
			foreach ($list_product->result() as $row)
			{
			 ?>
            <tr>
              <td><?php print $row->pro_id; ?></td>
              <td><?php print $this->product_function->view_product_image($row->pro_id, $w=200, $h=200); ?></td>
              <td><?php print $row->name; ?></td>
              <td><?php print $row->point; ?></td>
              <td><?php print $row->price; ?></td>
              <td><?php print $row->quantity; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>