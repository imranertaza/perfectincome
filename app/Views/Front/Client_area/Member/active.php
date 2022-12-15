<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content">
                            <h1><b>User Active</b></h1>
                            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                            if ($message) {
                                echo $message;
                            } ?>
                            <div id="message"></div>
                            <hr/>
                            <div class="dashboard_left_area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="border: 1px solid;padding: 20px;">
                                            <center><h4>Pin Active</h4></center>
                                            <form action="<?php echo base_url('member/dashboard/pin_active')?>" method="post" >
                                                <div class="input">
                                                    <label>Pin</label>
                                                    <input type="text" id="myInput" class="form-control" name="pin" placeholder="pin" onchange="pin_check(this.value)" required >
                                                    <b id="pin_bar"></b>
                                                </div>
                                                <div class="input" style="padding-top: 20px;">
                                                    <button type="submit" class="btn btn-primary">Active</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div style="border: 1px solid;padding: 20px;">
                                            <h4>Active with Nagad</h4>
<!--                                            <form action="https://perfectmoney.com/api/step1.asp" method="POST">-->
                                                <?php foreach($package_list as $row) { ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="PACKAGEID" onchange="setPackagePrice('<?php print $row->price; ?>','<?php print $row->package_id; ?>');" id="<?php print $row->package_id; ?>" value="<?php print $row->package_id; ?>">
                                                    <label class="form-check-label" for="<?php print $row->package_id; ?>">
                                                        <?php print $row->package_name. '( '.Tk_view(number_format($row->price)).' )'; ?>
                                                    </label>
                                                </div>
                                                <?php } ?>
<!--                                                <input type="hidden" name="PAYEE_ACCOUNT" value="--><?php //print $payee_account; ?><!--">-->
<!--                                                <input type="hidden" name="PAYEE_NAME" value="FriendsWorld LTD">-->
<!--                                                <input type="hidden" name="PAYMENT_AMOUNT" id="payment_amount">-->
<!--                                                <input type="hidden" name="PAYMENT_ID" value="--><?php //print encrypt_decrypt($user_id, "encrypt"); ?><!--">-->
<!--                                                <input type="hidden" name="PAYMENT_UNITS" value="USD">-->
<!--                                                <input type="hidden" name="STATUS_URL" value="--><?php //print base_url(); ?><!--/index.php/member/deposit/deposit_status">-->
<!--                                                <input type="hidden" name="PAYMENT_URL" value="--><?php //print base_url(); ?><!--/index.php/member/deposit/payment">-->
<!--                                                <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">-->
<!--                                                <input type="hidden" name="NOPAYMENT_URL" value="--><?php //print base_url(); ?><!--/index.php/member/deposit/no_payment">-->
<!--                                                <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">-->
<!--                                                <input type="hidden" name="SUGGESTED_MEMO" value="--><?php //print $memo_number; ?><!--">-->
<!--                                                <input type="hidden" name="BAGGAGE_FIELDS" value="USER_ID PAYEE_NAME PACKAGEID">-->
<!--                                                <input type="hidden" name="USER_ID" value="--><?php //print encrypt_decrypt($user_id, "encrypt"); ?><!--">-->

<!--                                                <div class="input" style="padding-top: 20px;">-->
<!--                                                    <button type="submit" name="PAYMENT_METHOD" class="btn btn-primary">Active</button>-->
<!--                                                </div>-->
<!--                                                <input type="submit" class="btn btn-sm btn-warning" style="margin-top:10px;" name="PAYMENT_METHOD" value="Deposit Now!">-->
<!--                                            </form>-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<div class="modal fade" id="hourModal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Active with Nagad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">  </button>
            </div>
            <form id="userActive" >
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" >Payee Nagad Account *</label>
                        <input type="text" name="payee_account" class="form-control" placeholder="Please input" value="<?php echo get_global_settings_value('PM_ID');?>" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" >Amount *</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Please input" readonly>
                        <input type="hidden" name="packId" id="packId" class="form-control" placeholder="Please input" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" >Payer Nagad Account *</label>
                        <input type="text" name="payer_account" class="form-control" placeholder="" required>
                    </div>

<!--                    <div class="col-md-6">-->
<!--                        <label class="form-label" >Batch Number</label>-->
<!--                        <input type="text" name="payment_batch_num" class="form-control" placeholder="U_ _ _ _ _" >-->
<!--                    </div>-->


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="pay" class="btn btn-primary" id="acBtnAc">Active</button>
            </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function setPackagePrice(setprice,packId){

        // alert(packId);
        $('#hourModal').modal('show');
        $("#amount").val(setprice);
        $("#packId").val(packId);

        $("#userActive").submit(function(e) {
            e.preventDefault();
            $("#acBtnAc").attr("disabled", true);
            var dataString = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php  echo base_url('Member/Dashboard/deposit')?>",
                data: dataString,
                success: function (data) {
                    $('#message').html(data);
                    $('#hourModal').modal('hide');
                    $("#acBtnAc").attr("disabled", false);
                }
            });
        });
    }
</script>