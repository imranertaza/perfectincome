<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Group List</h1>
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
                                    	<?php foreach($records as $row) {?>
										<tr class="odd gradeX" id="group_<?php print $row->grp_id; ?>">
                                            <td><?php print $row->grp_id; ?></td>
                                            <td><?php print $row->group_name; ?></td>
                                            <td class="center">
                                            <?php if ($this->functions->hasPermission('edit_group') == true) { ?>
                                            <a href="<?php print base_url(); ?>classes/edit_group/<?php print $row->grp_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_group') == true) { ?>
                                            <a onclick="delete_group(<?php print $row->grp_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
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
function delete_group(group_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>ajax.html/?delete_group=yes',
                 type: "POST",
                 dataType: "text",
                 data: {grp_id: group_id},
                 beforeSend: function(){
                       $('#group_'+group_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#group_'+group_id).fadeOut( 'slow' );
                 }
          });
          }
     }
</script>
