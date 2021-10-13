<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product Catagory List</h1>
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
                            <th width="135">ID</th>
                            <th width="291">Catagory Name</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($proCat as $rows){
                            $pro_cat_id = $rows->cat_id;
                            ?>
                            <tr class="odd gradeX" id="cat_<?php print $pro_cat_id; ?>">
                                <td><?php print $pro_cat_id ?></td>
                                <td><?php print $rows->cat_name; ?></td>
                                <td class="center">
                                    <?php if ($functionModel->hasPermission('edit_category') == true) { ?>
                                        <a href="<?php print base_url(); ?>/Product_cat/edit/<?php print $pro_cat_id; ?>"
                                           class="btn btn-primary take_margin" title="Edit"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    <?php } ?>
                                    <?php if ($functionModel->hasPermission('delete_category') == true) { ?>
                                        <a href="<?php print base_url(); ?>/Product_cat/delete/<?php print $pro_cat_id; ?>"
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
    function delete_pro_cat(pro_cat_id) {
        var yes = confirm('Do you want to delete permanently? ');
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>ajax.html/?delete_pro_cat=yes',
                type: "POST",
                dataType: "text",
                data: {pro_cat_id: pro_cat_id},
                beforeSend: function () {
                    $('#cat_' + pro_cat_id).css('background', '#F00');
                },
                success: function (msg) {
                    $('#cat_' + pro_cat_id).fadeOut('slow');
                }
            });
        }
    }
</script>
