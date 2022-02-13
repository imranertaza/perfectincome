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
                            <h5 class="main-title">Withdraw By Agent</h5>
                            <hr />
                            <?php print $session->getFlashdata('withdraw_msg'); ?>
                            <div class="alert alert-warning">Inactive member can not withdraw. Only active member can withdraw.</div>
                            <div class="col-lg-5">
                                <form action="<?php print base_url(); ?>/Member/WithdrawbyAgent/withdraw_action" method="post">
                                    <?php
                                        $minWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'minWithdrawPerTime');
                                        $maxWithdrawPerTime = get_field_by_id_from_table('global_settings', 'value', 'title', 'maxWithdrawPerTime');
                                    ?>
                                    <div class="form-group">
                                        <label>Withdraw Amount(Min:<?php echo Tk_view($minWithdrawPerTime);?>, Max:<?php echo Tk_view($maxWithdrawPerTime);?>) <sup class="required">*</sup></label>
                                        <input class="form-control" name="withdraw_amount" type="number" min="<?php echo $minWithdrawPerTime;?>" max="<?php echo $maxWithdrawPerTime;?>" required placeholder="<?php echo $minWithdrawPerTime;?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Agent Username <sup class="required">*</sup></label>
                                        <input type="text"  class="form-control" name="username" id="username"  required onchange="check_valid_agent(this.value)" >
                                        <b id="user_valid"></b>
                                    </div>

                                    <div class="form-group">
                                        <label>Your Nagad Account <sup class="required">*</sup></label>
                                        <input type="number" min="10" class="form-control" name="nagad_number" required >
                                    </div>
                                    <input type="submit" class="btn btn-submit" id="btn-withdraw" value="Withdraw" >
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



<script>
    function check_valid_agent(uname){

        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/check_valid_agent',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function(){
                $('#user_valid').css( 'color','#238A09');
                $('#user_valid').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');

                $("#btn-withdraw").prop('disabled', true);

            },
            success: function(msg){
                if (msg == 1) {
                    $('#user_valid').html('<span style="color:red">Invalid Agent Username</span>');
                    document.getElementById('username').value = '';
                }else {
                    $('#user_valid').html('<span style="color:green">Valid Agent Username</span>');
                }
                $("#btn-withdraw").prop('disabled', false);
            }
        });
    }
</script>




