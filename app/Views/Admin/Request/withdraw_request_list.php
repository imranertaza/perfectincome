<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Nagad Withdraw Request List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body no_padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th width="150">Sender</th>
                            <th width="120">Sender No.</th>
                            <th width="120">Receiver No.</th>
                            <th width="100">Transection No.</th>
                            <th width="100">Amount</th>
                            <th width="200">Date</th>
                            <th width="100">Status</th>
                            <th width="250">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php //$this->downloads->download_list(); ?>
                        <?php //$this->portfolio_function->portfolio_list();
                        foreach ($records as $rows)
                        {
                            ?>
                            <form method="post" action="<?php print base_url(); ?>admin_ut/withdraw_request/change_status/1/<?php print $rows->history_withdraw_nagad_id; ?>">
                                <tr class="odd gradeX" id="nagad_request_<?php print $rows->history_withdraw_nagad_id; ?>">
                                    <td><?php print get_field_by_id_from_table('users', 'username', 'ID', $rows->receiver_id); ?></td>
                                    <td><input type="text" class="form-control" name="sender_phone" value="<?php print $rows->sender_phone; ?>" name="trans_num"></td>
                                    <td><?php print $rows->nagad_number; ?></td>
                                    <td><input type="text" class="form-control" name="trans_num" value="<?php print $rows->transection_num; ?>" name="trans_num"></td>
                                    <td><?php print $rows->amount; ?></td>
                                    <td><?php print $rows->date; ?></td>
                                    <td><a href="#" class="btn btn-info take_margin" title="Status"><?php print $rows->status; ?></i></a></td>
                                    <td class="center">
                                        <?php if ($rows->status != "Approved") { ?>
<!--                                            <a href="--><?php //print base_url(); ?><!--admin_ut/withdraw_request/change_status/1/--><?php //print $rows->history_withdraw_nagad_id; ?><!--" class="btn btn-primary take_margin" title="Edit">Approve</i></a>-->
                                            <button type="submit" class="btn btn-default btn btn-primary" name="Approve">Approve</button>
                                            <a href="<?php print base_url(); ?>admin_ut/withdraw_request/change_status/2/<?php print $rows->history_withdraw_nagad_id; ?>" class="btn btn-danger take_margin" title="Edit">Cancel</i></a>
                                        <?php }else { ?>
                                            <a href="#" class="btn btn-default take_margin" title="Sorry You can not change it.">Action Taken</i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </form>
                        <?php } ?>
                        </tbody>
                    </table>
                    <p class="paginate"><?php //print $pagination; ?></p>
                </div>
                <!-- /.table-responsive -->

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>


