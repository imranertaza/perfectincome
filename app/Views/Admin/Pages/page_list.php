<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pages List</h1>
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
                                            <th width="291">Title</th>
                                            <th width="427">Short Description</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $pageModel->page_list() as $rows) { $page_id = $rows->page_id; ?>
                                            <tr class="odd gradeX" id="page_<?php print $page_id; ?>">
                                                <td><?php print $rows->page_id; ?></td>
                                                <td><?php print $rows->page_title; ?></td>
                                                <td><?php print $rows->short_des; ?></td>
                                                <td class="center">
                                                    <?php if ($functionModel->hasPermission('edit_page') == true) { ?>
                                                        <a href="<?php print base_url(); ?>/Pages/edit_page/<?php print $page_id; ?>" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                    <?php } ?>
                                                    <?php if ($functionModel->hasPermission('delete_page') == true) { ?>
                                                        <a href="<?php print base_url('Pages/delete/'.$page_id) ?>" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php }?>
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
function delete_page(page_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>/ajax.html/?delete_page=yes',
                 type: "POST",
                 dataType: "text",
                 data: {page_id: page_id},
                 beforeSend: function(){
                       $('#page_'+page_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#page_'+page_id).fadeOut( 'slow' );
                     //$('#page_'+page_id).html(msg);
                 }
          });
          }
     }
</script>

