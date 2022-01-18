<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-md-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-5">
                            <h5 class="main-title">Withdraw</h5>
                            <hr />
                            <?php print $session->getFlashdata('withdraw_msg'); ?>
                            <div class="alert alert-warning">Inactive member can not withdraw. Only active member can withdraw.</div>
                            <div class="col-lg-5">
                                <form action="<?php print base_url(); ?>/Member/general/withdraw_action" method="post">
                                    <?php
                                        $minWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'minWithdrawPerTime');
                                        $maxWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerTime');
                                    ?>
                                    <div class="form-group">
                                        <label>Withdraw Amount(Min:<?php echo Tk_view($minWithdrawPerTime);?>, Max:<?php echo Tk_view($maxWithdrawPerTime);?>) <sup class="required">*</sup></label>
                                        <input class="form-control" name="withdraw_amount" type="number" min="<?php echo $minWithdrawPerTime;?>" max="<?php echo $maxWithdrawPerTime;?>" required placeholder="<?php echo $minWithdrawPerTime;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Your Nagad Account <sup class="required">*</sup></label>
                                        <input type="number" min="11" max="11" class="form-control" name="payee_account" type="text" required value="" >
                                    </div>
                                    <input type="submit" class="btn btn-submit" value="Withdraw">
                                </form>
                            </div>











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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->




