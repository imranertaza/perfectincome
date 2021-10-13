<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menufacture List</h1>
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
                            <th width="10">ID</th>
                            <th width="291">Menufacture Name</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($menufacture as $rows) {
                            $men_id = $rows->men_id;
                            ?>
                            <tr class="odd gradeX" id="cat_<?php print $men_id; ?>">
                                <td><?php print $men_id ?></td>
                                <td><?php print $rows->brand_name; ?></td>
                                <td class="center">
                                    <?php if ($functionModel->hasPermission('edit_category') == true) { ?>
                                        <a href="<?php print base_url(); ?>/Menufacture/edit/<?php print $men_id; ?>"
                                           class="btn btn-primary take_margin" title="Edit"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    <?php } ?>
                                    <?php if ($functionModel->hasPermission('delete_category') == true) { ?>
                                        <a href="<?php print base_url(); ?>/Menufacture/delete/<?php print $men_id; ?>"
                                           class="btn btn-danger take_margin" title="Delete"><i
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
    function delete_mnu(mnu_id) {
        var yes = confirm('Do you want to delete permanently? ');
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>ajax.html/?delete_menu=yes',
                type: "POST",
                dataType: "text",
                data: {mnu_id: mnu_id},
                beforeSend: function () {
                    $('#cat_' + mnu_id).css('background', '#F00');
                },
                success: function (msg) {
                    $('#cat_' + mnu_id).fadeOut('slow');
                }
            });
        }
    }
</script>
