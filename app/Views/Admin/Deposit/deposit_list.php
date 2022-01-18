<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Deposit List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12" id="message">
            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
        </div>
        <div class="col-lg-12">
            <div class="panel-body no_padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Payee Account</th>
                            <th>Package</th>
                            <th>Payer Account</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($deposit as $rows) {  ?>
                            <tr class="odd gradeX" >
                                <td><?php print $i++ ?></td>
                                <td><?php print get_data_by_id('username','users','ID',$rows->user_id) ; ?></td>
                                <td><?php print $rows->payee_account; ?></td>
                                <td><?php print $rows->package_id; ?></td>
                                <td><?php print $rows->payer_account; ?></td>
                                <td><?php print Tk_view($rows->amount); ?></td>
                                <td>
                                    <?php if ($rows->status != 'confirm'){ if ($rows->status != 'cancel'){ ?>
<!--                                        <a href="--><?php //print base_url(); ?><!--/Admin/Deposit/active/--><?php //print $rows->hist_manual_with_pm_id; ?><!--" class="btn btn-primary " title="Active" onclick="return confirm('Are you sure？')">Active</a>-->
                                        <a href="" class="btn btn-primary " title="Active" onclick="activeUser(<?php print $rows->hist_manual_with_pm_id; ?>)" id="activeBtn" >Active</a>
                                        <a href="<?php print base_url(); ?>/Admin/Deposit/cancel/<?php print $rows->hist_manual_with_pm_id; ?>" class="btn btn-danger " title="cancel" onclick="return confirm('Are you sure？')">Cancel</a>
                                        <?php } else{ ?>

                                        <button class="btn btn-secondary" style="background-color: gray; color: white;" title="cancel">Canceled</button>
                                        <a href="" class="btn btn-primary " title="Active" onclick="activeUser(<?php print $rows->hist_manual_with_pm_id; ?>)" id="activeBtn" >Active</a>
                                    <?php } }else{ ?>
                                        <button class="btn btn-success " title="success">Activated</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="statusChange" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Payer Account</label>
                                <input type="text" name="Payer_Account" class="form-control" placeholder="Please input" >
                            </div>

                            <div class="col-md-6">
                                <label>Batch Number</label>
                                <input type="text" name="batch_number" class="form-control" placeholder="Please input" >
                                <input type="hidden" name="sta" id="statusval" class="form-control" placeholder="Please input" >
                                <input type="hidden" name="withdraw_id" id="withdraw_id" class="form-control" placeholder="Please input" >
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Save</button>
                </form>
                <button class="btn btn-primary " type="button" class="close" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>
    </div>
</div>

</div>



<script>
    function delete_cat(cat_id){
        var yes = confirm('Do you want to delete permanently? ');
        if(yes){
            $.ajax({
                url: '<?php print base_url(); ?>ajax.html/?delete_cat=yes',
                type: "POST",
                dataType: "text",
                data: {cat_id: cat_id},
                beforeSend: function(){
                    $('#cat_'+cat_id).css( 'background','#F00');
                },
                success: function(msg){
                    $('#cat_'+cat_id).fadeOut( 'slow' );
                }
            });
        }
    }

    function withdraStatus(status,id){
        $('#myModal').modal('show');
        $('#statusval').val(status);
        $('#withdraw_id').val(id);

        $("#statusChange").submit(function(e) {
            e.preventDefault();
            var dataString = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?php  echo base_url('Admin/Withdraw/withdraw_action')?>",
                data: dataString,
                success: function (data) {
                    $('#message').html(data);
                    $("#dataTables-example").load(window.location + " #dataTables-example");
                    $('#myModal').modal('hide');
                }
            });
        });

    }
</script>
