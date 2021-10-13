<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Subjects List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                	<thead>
                                        <tr>
                                            <th width="291">Subject Name</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>classes/subject_list.html">
                                    	<tr>
                                            <td width="120">
											<input type="text" name="subject" class="form-control" />
                                            </td>
                                            <td width="120"><input type="submit" class="btn btn-default btn btn-primary" name="add_attendance" value="Search"></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="201">Subject Name</th>
                                            <th width="69">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										if (is_array($list_subject)) {
										foreach($list_subject as $row) { 
										$class_name = empty($row->class_id) ? "Null" : class_name_by_id($row->class_id);
										$grp_name = empty($row->grp_id) ? "Null" : group_name_by_id($row->grp_id);
										?>
										<tr id="sub_<?php print $row->sub_id; ?>">
                                            <td width="201"><?php print $row->sub_name; ?></td>
                                            <td width="69">
                                            <?php if ($this->functions->hasPermission('edit_attendance') == true) { ?>
                                            <a href="<?php print base_url(); ?>classes/edit_subject/<?php print $row->sub_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_attendance') == true) { ?>
                                            <a onclick="delete_subject(<?php print $row->sub_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } }else { print '<tr><td colspan="7">'.$list_subject.'</td></tr>'; } ?>
                                    </tbody>
                                </table>
                                <p class="paginate"><?php print $pagination; ?></p>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        
        
<script>
function getGroup(val) {
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>ajax.html/?group_list=yes",
	data:'class='+val,
	success: function(data){
		$("#group_list").html(data);
	}
	});
}


function delete_subject(sub_id){
	  var yes = confirm('Do you want to delete permanently?');
	  if(yes){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?delete_subject=yes',
			 type: "POST",
			 dataType: "text",
			 data: {sub_id: sub_id},
			 beforeSend: function(){
				   $('#sub_'+sub_id).css( 'background','#F00');
			 },
			 success: function(msg){
				  $('#sub_'+sub_id).fadeOut('slow');
			 }
	  });
	  }
 }
</script>
