<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Exam List</h1>
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
                                            <th width="291">Year</th>
                                            <th width="291">Class Name</th>
                                            <th width="291">Group Name</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>admin_area/exam/exam_list.html">
                                    	<tr>
                                            <td width="120">
											<select name="year" class="form-control">
                                            	<?php print get_year_list(2015, 2050); ?>
                                            </select>
                                            </td>
                                            <td width="291">
											<select name="class" id="class" class="form-control">
                                            <option>Please select a class</option>
											<?php print class_list($class_id); ?>
                                            </select>
                                            </td>
                                            <td width="120">
											<select name="group" class="form-control">
                                            <option>Please select a group</option>
											<?php print group_list($group_id, $class_id); ?>
                                            </select>
                                            </td>
                                            <td width="120"><input type="submit" class="btn btn-default btn btn-primary" name="add_attendance" value="Search"></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="86">Year</th>
                                            <th width="121">Class Name</th>
                                            <th width="123">Group Name</th>
                                            <th width="127">Exam Name</th>
                                            <th width="158">Activity</th>
                                            <th width="245">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										if (is_array($list_exam)) {
										foreach($list_exam as $row) {
										?>
										<tr id="exm_<?php print $row->exm_id; ?>">
                                            <td width="86"><?php print $row->year; ?></td>
                                            <td width="121"><?php print class_name_by_id($row->class_id); ?></td>
                                            <td width="123"><?php print group_name_by_id($row->grp_id); ?></td>
                                            <td width="127"><?php print $row->exam_name; ?></td>
                                            <td width="158">Publish</td>
                                            <td width="245">
                                            <a href="<?php print base_url(); ?>admin_area/exam/add_result/<?php print $row->exm_id; ?>.html" class="btn btn-primary take_margin" title="Result">Make Result</a>
											<?php if ($this->functions->hasPermission('edit_exam') == true) { ?>
                                            <a href="<?php print base_url(); ?>admin_area/exam/edit_exam/<?php print $row->exm_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_exam') == true) { ?>
                                            <a onclick="delete_exam(<?php print $row->exm_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } }else { print '<tr><td colspan="7">'.$list_exam.'</td></tr>'; } ?>
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
/*function getGroup(val) {
	$.ajax({
	type: "POST",
	url: "<?php //print base_url(); ?>/ajax.html/?group_list=yes",
	data:'class='+val,
	success: function(data){
		$("#group_list").html(data);
	}
	});
}*/


function delete_exam(exm_id){
	  var yes = confirm('Do you want to delete permanently?');
	  if(yes){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?delete_exam=yes',
			 type: "POST",
			 dataType: "text",
			 data: {exm_id: exm_id},
			 beforeSend: function(){
				   $('#exm_'+exm_id).css( 'background','#F00');
			 },
			 success: function(msg){
				  $('#exm_'+exm_id).fadeOut('slow');
			 }
	  });
	  }
 }
</script>
