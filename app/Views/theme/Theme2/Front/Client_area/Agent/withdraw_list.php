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
                            <h5 class="main-title">Withdraw request list</h5>
                            <span id="message"></span>
                            <div class="mt-5 border-con">
                                <table class=" table-hover table mt-2" id="reload">
                                    <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Date</td>
                                            <td>Sender</td>
                                            <td>Nagad number</td>
                                            <td>Amount</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i=1; foreach ($withdrawData as $row){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row->date;?></td>
                                            <td><?php echo get_field_by_id_from_table('users', 'username', 'ID', $row->sender_id);;?></td>
                                            <td><?php echo $row->nagad_number;?></td>
                                            <td><?php echo Tk_view($row->amount);?></td>
                                            <td>
                                                <?php if (($row->status == 'pending')){?>
                                                <select class="text-capitalize p-2" name="status" id="status" style="border: 1px solid #dfdede;" onchange="statusChangeWithdraw(this.value,'<?php echo $row->history_agent_tran_id;?>')" >
                                                    <option value="confirm" <?php echo ($row->status == 'confirm')?'selected':''; ?> >conform</option>
                                                    <option value="pending" <?php echo ($row->status == 'pending')?'selected':''; ?>>pending</option>
                                                    <option value="cancel" <?php echo ($row->status == 'cancel')?'selected':''; ?>>cancel</option>
                                                </select>
                                                <?php } ?>

                                                <?php if (($row->status == 'confirm')){?>
                                                    <span class="badge bg-success text-capitalize">Success</span>
                                                <?php } ?>

                                                <?php if (($row->status == 'cancel')){?>
                                                    <span class="badge bg-danger text-capitalize">cancel</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<script>
    function statusChangeWithdraw(status,id){
        if(confirm("Are you sure?")){
            $.ajax({
                url: '<?php print base_url(); ?>/Ajax/agent_change_with_status',
                type: "POST",
                dataType: "text",
                data: {status: status,id:id},
                beforeSend: function(){
                    $('#message').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
                },
                success: function(msg){
                    $('#message').html(msg);
                    $( "#reload" ).load(window.location.href + " #reload" );
                    $( "#balance" ).load(window.location.href + " #balance" );
                }
            });
        }

    }
</script>