<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pin Generate List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
            if ($message) {
                echo $message;
            } ?>
        </div>
        <div class="col-lg-12">
            <div class="panel-body no_padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th width="10">Serial</th>
                            <th width="200">User Name</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        foreach ($pins as $rows) {
                            ?>

                            <tr class="odd gradeX">
                                <td><?php echo ++$i; ?></td>

                                <td><?php print get_username_by_id($rows->user_id); ?></td>
                                <td class="center">

                                    <a href="<?php print base_url(); ?>/pin_generat/view_agent_pin/<?php print $rows->user_id; ?>.html"
                                       class="btn btn-primary take_margin" title="Edit"><i class="fa fa-fw"></i></a>

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
        


