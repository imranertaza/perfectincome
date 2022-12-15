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

                                <h5 class="main-title">Member Withdraw Report By Agent</h5>
                                <hr />
                                <table class=" table-hover table">
                                    <tbody>
                                    <tr class="strong">
                                        <td>Sl</td>
                                        <td>Amount</td>
                                        <td>Status</td>
                                        <td>Date</td>
                                    </tr>
                                    <?php $i=1; foreach($query as $row) { ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo Tk_view($row->amount);?></td>
                                            <td><?php echo $row->status;?></td>
                                            <td><?php echo $row->createdDtm;?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>


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
            },
            success: function(msg){
                //$('#user_valid').html(msg);
                if (msg == 1) {
                    $('#user_valid').html('<span style="color:red">Invalid Agent Username</span>');
                    document.getElementById('username').value = '';
                }else {
                    $('#user_valid').html('<span style="color:green">Valid Agent Username</span>');
                }
            }
        });
    }
</script>




