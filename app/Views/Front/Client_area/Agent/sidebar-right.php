<div class="col-md-3 sidebar" style="margin-top: 100px;" >
    <div class="row">
      <div class="col-md-12">
        <div class="head_teacher_comment">
          <h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> Cart</h4>
            <div class="cart table-responsive" >
            
<!--      --><?php //if ($cart->totalItems()<=0) { print "<p style='padding:10px;'><b>The cart is empty..</b></p>"; }else { ?>
<!--            <form method="post" action="--><?php //print base_url(); ?><!--agent/store/">-->
<!--            <table class="table-bordered table">-->
<!---->
<!--            <tr>-->
<!--              <th>QTY</th>-->
<!--              <th>Item</th>-->
<!--              <th style="text-align:right">Price</th>-->
<!--              <th style="text-align:right">Pnt</th>-->
<!--              <th style="text-align:right">Total</th>-->
<!--            </tr>-->
<!---->
<!--            --><?php //$i = 1; ?>
<!--            --><?php //foreach ($cart->contents() as $items): ?>
<!---->
<!--                <tr>-->
<!--                  <td width="10">-->
<!--          --><?php //echo form_hidden($i.'[rowid]', $items['rowid']); ?>
<!--          --><?php //echo $items['qty'] ; ?><!--</td>-->
<!--                  <td width="60">-->
<!--                    --><?php //echo $items['name']; ?>
<!--                  </td>-->
<!--                  <td width="10" style="text-align:right">--><?php ////echo $this->cart->format_number($items['price']); ?><!--</td>-->
<!---->
<!--                  <td width="20" style="text-align:right">-->
<!--          --><?php //if ($this->cart->has_options($items['rowid']) == TRUE): ?>
<!--                            --><?php //foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
<!---->
<!--                                <strong>--><?php ////echo $option_name; ?><!--</strong> --><?php //echo $option_value*$items['qty']; ?><!--<br />-->
<!---->
<!--                            --><?php //endforeach; ?>
<!--                    --><?php //endif; ?>
<!--                  </td>-->
<!---->
<!--                  <td width="20" style="text-align:right">--><?php ////echo $this->cart->format_number($items['subtotal']); ?><!--</td>-->
<!--                </tr>-->
<!---->
<!--            --><?php //$i++; ?>
<!---->
<!--            --><?php //endforeach; ?>
<!---->
<!--            <tr>-->
<!--              <td colspan="3"></td>-->
<!--              <td align="right"><strong>Total </strong></td>-->
<!--              <td align="right"><strong>--><?php ////echo $this->cart->format_number($this->cart->total()); ?><!--</strong></td>-->
<!--            </tr>-->
<!--            </table>-->
<!--            </form>-->
<!--            <div style="padding: 10px;">-->
<!--              <form method="post" action="">-->
<!--                <input type="submit" class="btn btn-warning" name="empty" value="Empty Cart" style="float:right;" />-->
<!--              </form>-->
<!--              <form method="post" action="--><?php //print base_url(); ?><!--/agent/product_sale/buy">-->
<!--                    <input type="submit" class="btn btn-success" name="complete" value="Complete" />-->
<!--              </form>-->
<!--            </div>-->
<!--            --><?php //} ?>
             <br class="clear" />
            </div>
        </div>
      </div>
    </div>
  </div>