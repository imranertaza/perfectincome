<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Admin/Agent/create')?>" class="btn btn-primary" style="float: right;margin-top: 40px;">Add Agent</a>
            <h1 class="page-header">Agent List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
        </div>
        <div class="col-lg-12">
            <div class="panel-body no_padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($agent as $rows) { ; ?>
                            <tr class="odd gradeX">
                                <td><?php print $rows->ID; ?></td>
                                <td><?php print $rows->username; ?></td>
                                <td><?php print $rows->email; ?></td>
                                <td class="text-center">

                                   <a href="<?php print base_url(); ?>/Admin/Agent/withdraw_request_list/<?php print $rows->ID; ?>" class="btn btn-primary take_margin" title="Edit">Member withdraw request</a>
                                   <a href="<?php print base_url(); ?>/Admin/Agent/edit/<?php print $rows->ID; ?>" class="btn btn-primary take_margin" title="Edit">Edit</a>

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




