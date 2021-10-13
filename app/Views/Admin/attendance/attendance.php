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
                                            <th width="291">Date</th>
                                            <th width="291">Class Name</th>
                                            <th width="120">Group Name</th>
                                            <th width="120">Total Student</th>
                                            <th width="120">Attendance</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>attendance/add_attendance.html">
                                    	<tr>
                                            <td width="120">
											<input type="text" name="date" class="form-control" id="datepicker" value="<?php print date('d-m-Y'); ?>" />
                                            </td>
                                            <td width="291">
											<select name="class" id="class" class="form-control" onChange="getGroup(this.value);">
											<?php print class_list($class_id); ?>
                                            </select>
                                            </td>
                                            <td width="120">
											<select name="group" class="form-control" id="group_list" onChange="getTotalStudent(this.value);">
											<?php if(!empty($group_id)) { 
											print group_list($group_id, $class_id);
											}else { print '<option>No group selected</option>'; } ?>
                                            </select>
                                            </td>
                                            <td width="120">
											<input type="text" name="total_student" id="total_student" readonly="readonly" value="<?php print $total_student; ?>" class="form-control" />
                                            </td>
                                            <td width="120">
                                            <input type="text" name="attendance" class="form-control" />
                                            </td>
                                            <td width="120"><input type="submit" class="btn btn-default btn btn-primary" name="add_attendance" value="+ Add"></td>
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
										$attendance = $row->attendance;
										$absent = $total_student-$attendance;
										$persentage = (($total_student-$absent) / $total_student) * 100 . '%';
										?>
										<tr>
                                            <td width="150"><?php print $row->date; ?></td>
                                            <td width="200"><?php print $class_name; ?></td>
                                            <td width="120"><?php print $group_name; ?></td>
                                            <td width="120"><?php print $total_student; ?></td>
                                            <td width="120"><?php print $row->attendance; ?></td>
                                            <td width="120"><?php print $absent; ?></td>
                                            <td width="120"><?php print $persentage; ?></td>
                                            <td width="150">
                                            <?php if ($this->functions->hasPermission('edit_attendance') == true) { ?>
                                            <a href="<?php print base_url(); ?>attendance/edit_attendance/<?php print $row->att_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <a onclick="delete_product(31);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
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


function getTotalStudent(val){
	var class_id = $("#class option:selected").val();
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>ajax.html/?total_student=yes",
	data:{group_id: val, class_id: class_id},
	success: function(data){
		$("#total_student").val(data);
	}
	});
}

</script>
