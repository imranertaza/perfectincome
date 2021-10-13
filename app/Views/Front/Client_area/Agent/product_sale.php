<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

            <?php print $sidebar_left; ?>

            <div class="col-md-6">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1>My Profile</h1>
                        <hr/>
                        <div class="row store2">
                            <div class="col-md-12 table-responsive">
                                <div class="message">
                                    <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                                </div>
                                <table class="table-bordered table ">
                                    <tr>
                                        <th>Image</th>
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Point</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Cart</th>
                                    </tr>
                                    <?php foreach ($pro_query as $each_product) { ?>
                                        <tr>
                                            <td><?php if (!empty($each_product->main_image)) { ?>
                                                    <img style="border:2px solid;"
                                                         src="<?php print base_url() . $timthumb; ?>?src=<?php echo base_url() . $pro_path . $each_product->main_image; ?>&amp;w=100&amp;h=100&amp;zc=1">
                                                <?php } else { ?>
                                                    <img src="<?php print base_url() . $timthumb; ?>?src=<?php echo base_url() . $pro_path . "no_thumb.jpg"; ?>&amp;w=100&amp;h=100&amp;zc=1">
                                                <?php } ?></td>
                                            <form method="post" action="">
                                                <td>
                                                    <?php print $each_product->model; ?></td>
                                                <td><?php print $each_product->name; ?>
                                                    <input type="hidden" value="<?php print $each_product->name; ?>"
                                                           name="name"/>
                                                </td>
                                                <td><?php print $each_product->point; ?>
                                                    <input type="hidden" value="<?php print $each_product->point; ?>"
                                                           name="point"/>
                                                </td>
                                                <td>
                                                    <input type="text" value="1" size="1" name="qty"/></td>
                                                <td><?php print $each_product->price; ?>
                                                    <input type="hidden" value="<?php print $each_product->price; ?>"
                                                           name="price"/>
                                                </td>
                                                <td>
                                                    <input type="submit" class="btn btn-info btn-sm" name="add_to_cart"
                                                           value="Add to Cart"/>
                                                    <input type="hidden" name="product_id"
                                                           value="<?php print $each_product->pro_id; ?>"/>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php print $sidebar_right; ?>
        </div>
    </div>
</div>