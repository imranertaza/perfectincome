<?php print $sidebar_left; ?>
	
    <?php if ($check_user) { ?>
    
    <div class="col-md-9">
            <h1>Confirmation Report</h1>
            <hr />
            <div class="row store">
            	<div class="col-md-12">
                	<?php print $msg; 
					if ($this->cart->total_items()>0) {
					?>
                	<form method="post" action="">
                	<table width="100%">
                      <tr>
                        <td width="123"><strong>Customer ID</strong></td>
                        <td width="17" align="center"><strong>:</strong></td>
                        <td width="802"><?php print $u_name; ?>
                    	<input class="form-control" name="stockist_id" type="hidden" value="<?php print $ID; ?>" required></td>
                      </tr>
                      <tr>
                        <td valign="top"><strong>Products</strong></td>
                        <td align="center" valign="top"><strong>:</strong></td>
                        <td>
                        	<table cellpadding="1" cellspacing="1" style="width:100%" border="0">
            
                            <tr>
                              <th>QTY</th>
                              <th>Item</th>
                              <th style="text-align:right">Price</th>
                              <th style="text-align:right">Pnt</th>
                              <th style="text-align:right">Total</th>
                            </tr>
                            <?php $i = 1; 
							foreach ($this->cart->contents() as $items): ?>
                                <tr>
                                  <td><?php echo $items['qty']; ?></td>
                                  <td>
                                    <?php echo $items['name']; ?>
                                  </td>
                                  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                                  
                                  <td style="text-align:right">
                                  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                        
                                                <strong><?php //echo $option_name; ?></strong> <?php echo $option_value*$items['qty']; ?><br />
                        
                                            <?php endforeach; ?>
                                    <?php endif; ?>
                                  </td>
                                  
                                  <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                </tr>
                            
                            <?php $i++;
							endforeach; ?>
                            <tr>
                              <td colspan="3"></td>
                              <td align="right"><strong>Total</strong></td>
                              <td align="right"><?php echo $this->cart->format_number($this->cart->total()); ?></td>
                            </tr>
                            
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="confirm" value="Confirm" /></td>
                      </tr>
                    </table>
                    </form>
                    <?php } 
					else { ?>
                    <p>You cart is empty.</p>
                	<a href="<?php print base_url(); ?>stockist/store/">Continue to Shoping</a>
                    <?php } ?>
              </div>
            </div>
    </div>
    
    <?php } ?>