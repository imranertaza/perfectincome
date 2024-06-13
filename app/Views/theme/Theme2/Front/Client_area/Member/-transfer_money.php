<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

                <?php print $sidebar_left; ?>

                <div class="col-md-9">
                  <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                      <h1>Transfer Money</h1>
                      <hr />

                        <?php print $this->session->flashdata('msg'); ?>
                        <div class="row">
                            <div class="col-sm-4">
                        <form action="<?php print base_url(); ?>member/general/transfer_money_action" method="post">
                            <div class="form-group">
                                <label>Transfer ID</label>
                                <?php echo form_error('transfer_id', '<p class="error">', '</p>'); ?>
                                <input class="form-control" name="transfer_id" type="text"  onchange="check_user(this.value)" required>
                                <p class="help-block" id="check_user">Please put your transfer user ID</p>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <?php echo form_error('amount', '<p class="error">', '</p>'); ?>
                                <input class="form-control" name="amount" type="text" required>
                                <p class="help-block">Please put the amount to transfer.</p>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Transfer</button>
                            </div>
                        </form>
                            </div>
                        </div>

                    </div>
                  </div>
                </div>

        </div>
    </div>
</div>


<script>
    function check_user(uname){
        $.ajax({
            url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function(){
                $('#check_user').css( 'color','#238A09');
                $('#check_user').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function(message){
                //$('#progress_bar').html(msg);
                if (message==0) {
                    $('#check_user').html('<span style="color:red">Invalid Username</span>');
                }else {
                    $('#check_user').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }
</script>