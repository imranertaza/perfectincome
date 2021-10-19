<div class="container-fluid wraper">
    <div class="row">
        <div class="container" id="area_pad">
            <?php print $sidebar_left; ?>

            <?php if ($check_user) { ?>
                <div class="col-md-9">
                    <h1>Confirmation Report</h1>
                    <hr/>
                    <div class="row store">
                        <div class="col-md-12">
                            <?php print $msg;
                            if ($cart->totalItems() > 0) {
                                ?>
                                <form method="post" action="">
                                    <table width="100%" class="table">
                                        <tr>
                                            <td width="123"><strong>Customer ID</strong></td>
                                            <td width="17" align="center"><strong>:</strong></td>
                                            <td width="802"><?php print $u_name; ?>
                                                <input class="form-control" name="stockist_id" type="hidden"
                                                       value="<?php print $ID; ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td valign="top"><strong>Products</strong></td>
                                            <td align="center" valign="top"><strong>:</strong></td>
                                            <td>
                                                <table class="table-bordered table con_table"
                                                       style="text-align: center;">

                                                    <tr>
                                                        <th style="text-align: center;">QTY</th>
                                                        <th style="text-align: center;">Item</th>
                                                        <th style="text-align:right">Price</th>
                                                        <th style="text-align:right">Pnt</th>
                                                        <th style="text-align:right">Total</th>
                                                    </tr>
                                                    <?php $i = 1;
                                                    foreach ($cart->contents() as $items): ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $items['qty']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $items['name']; ?>
                                                            </td>
                                                            <td style="text-align:right"><?php echo $items['price']; ?></td>

                                                            <td style="text-align:right">
                                                                <?php if ($items['options']): ?>
                                                                    <?php foreach ($items['options'] as $option_name => $option_value): ?>

                                                                        <strong><?php echo $option_name; ?></strong> <?php echo $option_value * $items['qty']; ?>
                                                                        <br/>

                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td style="text-align:right"><?php echo $items['subtotal']; ?> </td>
                                                        </tr>

                                                        <?php $i++;
                                                    endforeach; ?>
                                                    <tr>
                                                        <td>
                                                            <label>User Name</label>
                                                        </td>
                                                        <td colspan="2">

                                                            <input id="myInput" type="text" name="username"
                                                                   class="form-control"
                                                                   onchange="check_spon(this.value)" required>

                                                            <b id="spon_bar"></b>
                                                        </td>
                                                        <td align="right"><strong>Total</strong></td>
                                                        <td align="right">
                                                            <?php echo $cart->total(); ?>
                                                            <input type="hidden" name="totalamount"
                                                                   value="<?php echo $cart->total(); ?>">
                                                        </td>
                                                    </tr>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" class="btn btn-success" name="confirm"
                                                       value="Confirm"/></td>
                                        </tr>
                                    </table>
                                </form>
                            <?php } else { ?>
                                <p>You cart is empty.</p>
                                <a href="<?php print base_url(); ?>agent/store/">Continue to Shoping</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function check_spon(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/check_username',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#spon_bar').css('color', '#238A09');
                $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');

            },
            success: function (message) {
                if (message == 0) {
                    $('#spon_bar').html('<span style="color:red">Invalid Username</span>');
                    document.getElementById('myInput').value = ''
                }else{
                    $('#spon_bar').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }
</script>