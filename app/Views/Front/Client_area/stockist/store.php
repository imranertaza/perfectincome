<?php print $sidebar_left; ?>
    
    <div class="col-md-6">
            <h1>Store</h1>
            <hr />
            <div class="row store">
            	<div class="col-md-12">
                	<?php @print $msg; ?>
                	<table width="100%">
                    	<tr>
                        	<th>Image</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Point</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Cart</th>
                        </tr>
            	<?php foreach($pro_query as $each_product) { ?>
                        <tr>
                        	<td><?php if (!empty($each_product->main_image)) {?>
                            <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path.$each_product->main_image; ?>&amp;w=100&amp;h=100&amp;zc=1">
                            <?php }else { ?>
                            <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path."no_thumb.jpg"; ?>&amp;w=100&amp;h=100&amp;zc=1">
                            <?php } ?></td>
                            <td>
							<form method="post" action="">
							<?php print $each_product->model; ?></td>
                            <td><?php print $each_product->name; ?>
                            <input type="hidden" value="<?php print $each_product->name; ?>" name="name" />
                            </td>
                            <td><?php print $each_product->point; ?>
                            <input type="hidden" value="<?php print $each_product->point; ?>" name="point" />
                            </td>
                            <td>
                            <input type="text" value="1" size="1" name="qty" /></td>
                            <td><?php print $each_product->price; ?>
                            <input type="hidden" value="<?php print $each_product->price; ?>" name="price" />
                            </td>
                            <td>
                            <input type="submit" name="add_to_cart" value="Add to Cart" />
                            <input type="hidden" name="product_id" value="<?php print $each_product->pro_id; ?>" />
                            </form>
                            </td>
                        </tr>
                <?php } ?>
                	</table>
                </div>
            </div>
    </div>

<?php print $sidebar_right; ?>