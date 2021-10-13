<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Members List</h1>
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
                                            <th width="291">Name</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>admin_area/commitee/member_list.html">
                                    	<tr>
                                            <td width="120">
											<input type="text" name="name" class="form-control" />
                                            </td>
                                            <td width="120"><input type="submit" class="btn btn-default btn btn-primary" name="add_attendance" value="Search"></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                            
                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="20">ID</th>
                                            <th width="100">Image</th>
                                            <th width="249">Title</th>
                                            <th width="390">Short Description</th>
                                            <th width="182">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //$this->teacher_function->teacher_list(); 
										foreach($records as $rows) {
										?>
                                        
                                        <tr class="odd gradeX" id="tec_<?php print $rows->tec_id; ?>">
                                            <td><?php print $rows->tec_id; ?></td>
                                            <td><?php print $this->commitee_function->view_commitee_image($rows->tec_id, 90, 90); ?></td>
                                            <td><?php print $rows->name; ?></td>
                                            <td><?php print substr(strip_tags($rows->description), 0, 150); ?></td>
                                            <td class="center">
                                            <a href="<?php print base_url(); ?>admin_area/commitee/view/<?php print $rows->tec_id; ?>.html" class="btn btn-primary take_margin" title="View"><i class="fa fa-fw"></i></a>
                                            <?php if ($this->functions->hasPermission('edit_com_member') == true) { ?>
                                            <a href="<?php print base_url(); ?>admin_area/commitee/edit_member/<?php print $rows->tec_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_com_member') == true) { ?>
                                            <a onclick="delete_member(<?php print $rows->tec_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
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
function delete_member(tec_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>ajax.html/?delete_member=yes',
                 type: "POST",
                 dataType: "text",
                 data: {tec_id: tec_id},
                 beforeSend: function(){
                       $('#tec_'+tec_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#tec_'+tec_id).fadeOut( 'slow' );
                 }
          });
          }
     }
</script>

