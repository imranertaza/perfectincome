<div class="container-fluid dash_body">
  <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

                <?php print $sidebar_left; ?>

                <div class="col-md-9">
                  <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                      <h1>Withdraw</h1>
                      <hr />
                        <?php //print $this->session->flashdata('msg'); ?>



                  <!--  <div class="panel with-nav-tabs panel-default"> -->
                            <!-- <ul class="nav nav-tabs">
                                <li class=""><a href="#tab1default" data-toggle="tab">Perfect Money</a></li>
                                <li class="active"><a href="#tab2default" data-toggle="tab">Postal Nagad</a></li>
                            </ul> -->
                            <!-- <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="tab1default">

                                        <div class='alert alert-warning' role='alert'>Withdraw using Perfect Money. Minimum $<?php //print $min_amount_load_PM; ?> to withdraw.</div>
                                        <div id="er_msg"></div>

                                        <div class="row">
                                            <div class="col-md-12"><img class="float-right" width="200" src="<?php //print base_url(); ?>assets/images/pm.png" /></div>
                                        </div>
                                        <br>
                                        <br> -->

                                        <!-- <form action="<?php //print base_url(); ?>member/general/withdraw_perfectmoney/" method="post">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="pm_number" name="pm_number" placeholder="Enter Your PM Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Withdraw Amount">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>

                                        </form> -->


                                            <!-- <div class="row">



                                            <br>
                                            <br>
                                            <div class="col-md-12"> -->
                                                <!-- <hr>
                                                <h4>Perfect Money withdraw list</h4>
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Payer Account(From)</th>
                                                        <th>Payee Account(To)</th> -->
                <!--                                        <th>Transection Batch Number</th>-->
                                                        <!-- <th>Amount</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php //foreach($PM_trans as $trans) { ?>
                                                        <tr>
                                                            <td><?php //print $trans->payer_account; ?></td>
                                                            <td><?php //print $trans->payee_account; ?></td> -->
                <!--                                            <td>--><?php //print $trans->payment_batch_num; ?><!--</td>-->
                                                            <!-- <td><?php //print $trans->amount; ?></td>
                                                            <td><?php //print $trans->date; ?></td>
                                                        </tr>
                                                    <?php //} ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div> -->


                                    <!-- <div class="tab-pane fade active in" id="tab2default">

                                        <div class='alert alert-warning' role='alert'>Minimum <?php //print "$".$min_withdraw_amount_nagad; ?> TK to withdraw.</div>

                                        <div class="row">
                                            <div class="col-md-12"><img class="float-right" width="200" src="<?php //print base_url(); ?>assets/images/nagad.jpg" /></div>
                                        </div>
                                        <br><br>

                                        <form action="<?php //print base_url(); ?>member/general/withdraw_money_nagad_success/" method="post">

                                        <div class="row">
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="nagad_number" name="nagad_number" placeholder="Enter Your Nagad Number">
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                         <div class="form-group">
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Withdraw Amount">
                                        </div>
                                            </div>
                                            <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                        </form> -->

                                        <!-- <hr>
                                        <br>
                                        <br>
                                        <h4>Nagad withdraw amount list</h4>
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
                                            <?php //foreach($nagad_trans as $trans) { ?>
                                            <tr>
                                                <td><?php //print $trans->sender_phone; ?></td>
                                                <td><?php //print $trans->nagad_number; ?></td>
                                                <td><?php //print $trans->transection_num; ?></td>
                                                <td><?php //print "$".$trans->amount; ?></td>
                                                <td><?php //print $trans->status; ?></td>
                                            </tr>
                                            <?php //} ?>
                                            </tbody>
                                        </table>


                                    </div>


                                </div>
                            </div>
                        </div> -->

                        <h2>Under Development </h2>
                    </div>
                  </div>
                </div>

        </div>
    </div>
</div>

<script>
//    function check_amount() {
//        var amount = document.getElementById("payment_amount").value;
//        if (amount >= <?php //print $min_amount_load_PM; ?>//) {
//            $("#PM_load_method").submit();
//        }else{
//            $('#er_msg').html("Minimum $<?php //print $min_amount_load_PM; ?>// amount to load.");
//        }
//    }
</script>
