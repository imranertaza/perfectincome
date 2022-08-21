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
                                        <input type="number"  class="form-control" name="payee_account" type="text" required value="" >
                                    </div>
                                    <input type="submit" class="btn btn-submit" value="Withdraw">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->




