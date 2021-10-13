<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thana List</h1>
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
                            <th width="291">Thana Name</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($location as $row) {
                            ?>
                            <tr>
                                <td width="291"><?php print $row->name; ?></td>
                                <td width="120">
                                    <?php if ($functionModel->hasPermission('edit_std') == true) { ?>
                                        <a href="<?php echo base_url('Location/edit_thana/'.$row->lo_id)?>" class="btn btn-primary take_margin" title="Edit"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    <?php } ?>
                                    <?php if ($functionModel->hasPermission('delete_std') == true) { ?>
                                        <a href="<?php echo base_url('Location/delete/'.$row->lo_id)?>" class="btn btn-danger take_margin" title="Delete"><i
                                                    class="fa fa-trash-o"></i></a>
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

</div>


<script>
    function delete_cat(cat_id) {
        var yes = confirm('Do you want to delete permanently? ');
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>ajax.html/?delete_cat=yes',
                type: "POST",
                dataType: "text",
                data: {cat_id: cat_id},
                beforeSend: function () {
                    $('#cat_' + cat_id).css('background', '#F00');
                },
                success: function (msg) {
                    $('#cat_' + cat_id).fadeOut('slow');
                }
            });
        }
    }
</script>
