<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url('Admin/Video/add')?>" class="btn btn-primary " style="float: right; margin-top: 50px;" >Add</a>
            <h1 class="page-header">Video List</h1>

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
                            <th width="50">#</th>
                            <th>Title</th>
                            <th style="width: 300px !important;">Url</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($video as $key => $rows) {  ?>
                            <tr>
                                <td><?php print $key + 1; ?></td>
                                <td><?php print $rows->title; ?></td>
                                <td s><?php print $rows->vi_url; ?></td>
                                <td><?php
                                    if ($rows->status == 1){
                                        echo 'Active';
                                    }else{
                                        echo 'Inactive';
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <a href="<?php print base_url(); ?>/Admin/Video/edit/<?php print $rows->video_id; ?>" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="<?php print base_url(); ?>/Admin/Video/delete/<?php print $rows->video_id; ?>" class="btn btn-danger take_margin" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
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
</script>
