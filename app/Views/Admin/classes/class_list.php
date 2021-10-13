<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Class List</h1>
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
                                            <th width="291">Class Name</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php //print $this->class_mod->class_list(); 
										
										foreach($records as $rows) {
										?>
                                        
                                        <tr class="odd gradeX" id="class_<?php print $rows->class_id; ?>">
                                            <td><?php print $rows->class_id ?></td>
                                            <td><?php print $rows->class_name; ?></td>
                                            <td class="center">
                                            <?php if ($this->functions->hasPermission('edit_class') == true) { ?>
                                            <a href="<?php print base_url(); ?>classes/edit_class/<?php print $rows->class_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_class') == true) { ?>
                                            <a onclick="delete_class(<?php print $rows->class_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <p class="paginate"><?php print $pagination; ?></p>
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
function delete_class(class_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>ajax.html/?delete_class=yes',
                 type: "POST",
                 dataType: "text",
                 data: {class_id: class_id},
                 beforeSend: function(){
                       $('#class_'+class_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#class_'+class_id).fadeOut( 'slow' );
                 }
          });
          }
     }
</script>
