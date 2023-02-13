<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-4">
                            <h5 class="main-title">Withdraw </h5>
                            <?php print new_session()->getFlashdata('withdraw_msg'); ?>
                            <div class="col-lg-6">
                                <form action="<?php print base_url(); ?>/Agent/Withdraw/withdraw_action" method="post">
                                    <?php
                                    $minWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'minWithdrawPerTimeAgent');
                                    $maxWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerTimeAgent');
                                    ?>
                                    <div class="form-group">
                                        <label>Withdraw Amount(Min:<?php echo Tk_view($minWithdrawPerTime);?>, Max:<?php echo Tk_view($maxWithdrawPerTime);?>) <sup class="required">*</sup></label>
                                        <input class="form-control" name="withdraw_amount" type="number" min="<?php echo $minWithdrawPerTime;?>" max="<?php echo $maxWithdrawPerTime;?>" required placeholder="<?php echo $minWithdrawPerTime;?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Your Nagad Account <sup class="required">*</sup></label>
                                        <input type="number" min="10" class="form-control" name="nagad_number" required >
                                    </div>

                                    <input type="submit" class="btn btn-submit" onclick="return confirm('Are you sure?');" value="Withdraw">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->


