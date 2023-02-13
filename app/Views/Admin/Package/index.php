<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12" style="padding-top: 10px;">
            <a href="<?php echo base_url('Admin/package/add')?>" class="btn btn-primary" style="float: right;">Add Package</a>
            <h1 class="page-header">Package List</h1>
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
                            <th>Package Name</th>
                            <th>Price</th>
                            <th>Sponsor Commission</th>
<!--                            <th>Matching Commission</th>-->
                            <th>Point</th>
                            <th>Total Pin Generated Number</th>
                            <th>Video Commission</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <?php foreach ($package as $key => $item) { ?>
                            <tr>
                                <td><?php echo $key + 1;?></td>
                                <td><?php echo $item->package_name;?></td>
                                <td><?php echo $item->price;?></td>
                                <td><?php echo $item->sponsor_commission;?></td>
<!--                                <td>--><?php //echo $item->matching_commission;?><!--</td>-->
                                <td><?php echo $item->point;?></td>
                                <td><?php echo $item->total_pin_generated_number;?></td>
                                <td><?php echo $item->video_watch_earning;?></td>
                                <td>
                                    <a href="<?php echo base_url('Admin/Package/update/'.$item->package_id)?>" class="btn btn-primary take_margin"  title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php echo base_url('Admin/Package/delete/'.$item->package_id)?>" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tbody>
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



