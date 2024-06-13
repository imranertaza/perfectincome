<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>Load Balance</h1>
                  <hr />
                    <?php print $this->session->flashdata('msg'); ?>



                    <div class="panel with-nav-tabs panel-default">
                        <ul class="nav nav-tabs">
                            <li class=""><a href="#tab1default" data-toggle="tab">Perfect Money</a></li>
                            <li class="active"><a href="#tab2default" data-toggle="tab">Postal Nagad</a></li>
                        </ul>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade" id="tab1default">

                                    <div class='alert alert-warning' role='alert'>Load your balance using Perfect Money. Minimum $<?php print $min_amount_load_PM; ?> to load.</div>
                                    <div id="er_msg"></div>

                                    <div class="row">
                                        <div class="col-md-12"><img class="float-right" width="200" src="<?php print base_url(); ?>assets/images/pm.png" /></div>
                                    </div>
                                        <div class="row">
                                        <form id="PM_load_method" action="https://perfectmoney.is/api/step1.asp" method="POST">
                                            <p>
                                                <input type="hidden" name="PAYEE_ACCOUNT" value="<?php print $PM_ID; ?>">
                                                <input type="hidden" name="PAYEE_NAME" value="UTURN2LIFE">
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="PAYMENT_AMOUNT" id="payment_amount" placeholder="Enter Amount">
                                            </div>
                                            </div>
                                            <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                            <input type="hidden" name="STATUS_URL"
                                                   value="<?php print base_url(); ?>payment_exe.php">
                                            <input type="hidden" name="PAYMENT_URL"
                                                   value="<?php print base_url(); ?>member/general/load_money_success/">
                                            <input type="hidden" name="NOPAYMENT_URL"
                                                   value="<?php print base_url(); ?>member/general/load_money_canceled/">
                                            <input type="hidden" name="BAGGAGE_FIELDS"
                                                   value="ORDER_NUM CUST_NUM">
                                            <!--<input type="hidden" name="ORDER_NUM" value="ut00">-->
                                            <input type="hidden" name="CUST_NUM" value="<?php print $ID; ?>">
                                            <div class="col-md-4">
                                            <input type="button" onclick="check_amount()" name="PAYMENT_METHOD" value="Load" class="btn btn-primary">
                                            </div>
                                            </p>
                                        </form>


                                        <br>
                                        <br>
                                        <div class="col-md-12">
                                            <hr>
                                            <h4>Perfect Money load amount list</h4>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Payer Account(From)</th>
                                                    <th>Payee Account(To)</th>
                                                    <th>Transection Batch Number</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach($PM_trans as $trans) { ?>
                                                    <tr>
                                                        <td><?php print $trans->payer_account; ?></td>
                                                        <td><?php print $trans->payee_account; ?></td>
                                                        <td><?php print $trans->payment_batch_num; ?></td>
                                                        <td><?php print $trans->amount; ?></td>
                                                        <td><?php print $trans->date; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>


                                <div class="tab-pane fade active in" id="tab2default">

                                    <div class='alert alert-warning' role='alert'>Minimum <?php print "$".$min_amount_load_nagad/$doller_rate." / ".$min_amount_load_nagad; ?> TK to send. ($1 = <?php print $doller_rate; ?> TK)</div>

                                    <div class="row">
                                        <div class="col-md-12"><img class="float-right" width="200" src="<?php print base_url(); ?>assets/images/nagad.jpg" /></div>
                                    </div>
                                    <br><br>

                                    <form action="<?php print base_url(); ?>member/general/load_money_nagad_success/" method="post">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="nagad_phone" id="nagad_phone1" value="01647067830" checked>
                                        <label class="form-check-label" for="nagad_phone1">
                                            01647067830
                                        </label>
                                    </div>
                                    <br>

                                    <div class="row">
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="sender_phone" name="sender_phone" placeholder="Enter Sender Phone">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                     <div class="form-group">
                                        <input type="text" class="form-control" id="transection" name="transection" placeholder="Enter Transection Number">
                                    </div>
                                    </div>
                                        <div class="col-md-3">
                                     <div class="form-group">
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                                    </div>
                                        </div>
                                        <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                                    </form>

                                    <hr>
                                    <br>
                                    <br>
                                    <h4>Nagad load amount list</h4>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sender Number(From)</th>
                                            <th>Nagad Number(To)</th>
                                            <th>Transection Number</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($nagad_trans as $trans) { ?>
                                        <tr>
                                            <td><?php print $trans->sender_phone; ?></td>
                                            <td><?php print $trans->nagad_number; ?></td>
                                            <td><?php print $trans->transection_num; ?></td>
                                            <td><?php print $trans->amount; ?></td>
                                            <td><?php print $trans->status; ?></td>
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
            </div>
        </div>
    </div>
</div>

            <script>
                function check_amount() {
                    var amount = document.getElementById("payment_amount").value;
                    if (amount >= <?php print $min_amount_load_PM; ?>) {
                        $("#PM_load_method").submit();
                    }else{
                        $('#er_msg').html("Minimum $<?php print $min_amount_load_PM; ?> amount to load.");
                    }
                }
            </script>
