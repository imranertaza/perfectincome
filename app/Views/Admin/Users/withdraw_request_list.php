<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1>Agent: <?php print get_field_by_id_from_table('users', 'username', 'ID', $agentId); ?></h1>
            <h3 class="page-header">Member withdraw list</h3>
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
                            <th width="135">ID</th>
                            <th>Date</th>
                            <th>User Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($agentWith as $rows) { ; ?>
                            <tr class="odd gradeX">
                                <td><?php print $i++; ?></td>
                                <td><?php print $rows->date; ?></td>
                                <td><?php print get_field_by_id_from_table('users', 'username', 'ID', $rows->sender_id); ?></td>
                                <td><?php print Tk_view($rows->amount); ?></td>
                                <td>
                                    <?php echo $rows->status ?>

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

</div>



<script>
    function statusChangeWithdrawAdmin(status,id){
        if(confirm("Are you sure?")){
            $.ajax({
                url: '<?php print base_url(); ?>/Ajax/admin_change_with_status',
                type: "POST",
                dataType: "text",
                data: {status: status,id:id},
                beforeSend: function(){
                    $('#message').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
                },
                success: function(msg){
                    $('#message').html(msg);
                    $( "#dataTables-example" ).load(window.location.href + " #dataTables-example" );
                    $( "#balance" ).load(window.location.href + " #balance" );
                }
            });
        }
    }

</script>
