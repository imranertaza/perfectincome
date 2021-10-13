<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Subject</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row" style="padding:20px;">
                            	<?php print $msg; ?>
                                
                                <form method="post" action="<?php print base_url(); ?>classes/edit_subject/<?php print $sub_id; ?>.html">
                                <table width="300" border="0" class="" id="dataTables-example">
                                 <!-- <tr>
                                    <td>
                                    <label>Type</label><br />
                                    <select name="s_type" class="form-control">
                                        <option value="0">Please select a type</option>
                                        <?php print subject_type_list($records->type); ?>
                                    </select><br />
                                    </td>
                                  </tr>
                                  <tr id="class" <?php //if($records->type == 'common') { print 'style="display:none;"'; } ?>>
                                    <td width="181">
                                    <label>Class Name</label><br />
                                    <select name="class" id="class_list" class="form-control" onChange="getGroup(this.value);">
                                    <option>Please select a class</option>
                                    <?php //print class_list($records->class_id); ?>
                                    </select><br />
                                    </td>
                                  </tr>
                                  <tr id="group">
                                    <td width="190">
                                    <label>Group Name</label>
                                    <select name="group" class="form-control" id="group_list" onChange="getTotalStudent(this.value);">
                                    <?php print group_list($records->grp_id); ?>
                                    </select><br />
                                    </td>
                                  </tr>-->
                                  <tr>
                                    <td><label>Subject Name</label><br />
                                    <input type="text" name="subject_name" class="form-control" value="<?php print $records->sub_name; ?>" /><br />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><input type="submit" class="btn btn-default btn btn-primary" name="edit_subject" value="Update"></td>
                                  </tr>
                                </table>
								</form>
                                
                                
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
	var class_id = $("#class_list option:selected").val();
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>ajax.html/?total_student=yes",
	data:{group_id: val, class_id: class_id},
	success: function(data){
		$("#total_student").val(data);
	}
	});
}


function viewclass(val) {
	var type_id = val;
	if (type_id != "Common") {
		$("#class").css("display", "block");
		$("#group").css("display", "block");
	}else {
		$("#class").css("display", "none");
		$("#group").css("display", "none");
	}
}

</script>
