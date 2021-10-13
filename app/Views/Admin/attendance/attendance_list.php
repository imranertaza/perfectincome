<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Attendance Report</h1>
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
                                            <th width="291">Date (From)</th>
                                            <th width="291">Date (To)</th>
                                            <th width="291">Class Name</th>
                                            <th width="291">Group Name</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>attendance/attendance_list.html">
                                    	<tr>
                                            <td width="120">
											<input type="text" name="date_from" class="form-control" id="datepicker" />
                                            </td>
                                            <td width="120">
											<input type="text" name="date_to" class="form-control" id="datepicker2" />
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
											<?php print group_list(); ?>
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
                                            <th width="150">Date</th>
                                            <th width="200">Class Name</th>
                                            <th width="120">Group Name</th>
                                            <th width="120">Total Student</th>
                                            <th width="120">Attendance</th>
                                            <th width="120">Absent</th>
                                            <th width="120">Percentage</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										if (is_array($list_attendance)) {
										foreach($list_attendance as $row) { 
										$total_student = count_student($row->class_id, $row->group_id);
										$attendance = $row->attendance;
										$absent = $total_student-$attendance;
										$persentage = (($total_student-$absent) / $total_student) * 100 . '%';
										?>
										<tr id="att_<?php print $row->att_id; ?>">
                                            <td width="150"><?php print $row->date; ?></td>
                                            <td width="200"><?php print class_name_by_id($row->class_id); ?></td>
                                            <td width="120"><?php print group_name_by_id($row->group_id); ?></td>
                                            <td width="120"><?php print $total_student; ?></td>
                                            <td width="120"><?php print $row->attendance; ?></td>
                                            <td width="120"><?php print $absent; ?></td>
                                            <td width="120"><?php print $persentage; ?></td>
                                            <td width="150">
                                            <?php if ($this->functions->hasPermission('edit_attendance') == true) { ?>
                                            <a href="<?php print base_url(); ?>attendance/edit_attendance/<?php print $row->att_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_attendance') == true) { ?>
                                            <a onclick="delete_attendance(<?php print $row->att_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } }else { print '<tr><td colspan="7">'.$list_attendance.'</td></tr>'; } ?>
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


function delete_attendance(att_id){
	  var yes = confirm('Do you want to delete permanently?');
	  if(yes){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?delete_attendance=yes',
			 type: "POST",
			 dataType: "text",
			 data: {att_id: att_id},
			 beforeSend: function(){
				   $('#att_'+att_id).css( 'background','#F00');
			 },
			 success: function(msg){
				  $('#att_'+att_id).fadeOut('slow');
			 }
	  });
	  }
 }
</script>
