<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">	
                    <h1 class="page-header">View Result List <a href="<?php print base_url(); ?>admin_area/exam/view_result_details_print/<?php print $res_id; ?>.html" class="btn btn-primary take_margin right" title="Print Page">Print page</a><a onclick="history.go(-1);" class="btn btn-primary take_margin right" title="Result"><< Back</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 indivisual_result">
                				<table width="100%" border="0" >
                                  <tr>
                                    <th width="16%" align="left" scope="row">Studnet Name</th>
                                    <td width="1%">:</td>
                                    <td width="83%"><?php print $student_name; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" scope="row">Roll Number</th>
                                    <td>:</td>
                                    <td><?php print $student_roll; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" scope="row">Registration Number</th>
                                    <td>:</td>
                                    <td><?php print $student_reg; ?></td>
                                  </tr>
                                  <tr>
                                    <th align="left" valign="top" scope="row">Picture</th>
                                    <td valign="top">:</td>
                                    <td><?php print $this->student_function->view_student_image($std_id, 90, 90); ?></td>
                                  </tr>
                                </table>
							  </div>

                                <div class="col-lg-12">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                        <tr>
                                            <th width="158">Subject</th>
                                            <th width="245">Written/CQ</th>
                                            <th width="245">MCQ</th>
                                            <th width="245">Practical</th>
                                            <th width="245">Total Marks</th>
                                            <th width="245">Point</th>
                                            <th width="245">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php print $subject_result; ?>
                                        <tr>
                                            <th width="158"></th>
                                            <th width="158"></th>
                                            <th width="158"></th>
                                            <th width="158"></th>
                                            <th width="245">Result</th>
                                            <th width="245"><?php print sprintf ("%.2f", $point_result); ?></th>
                                            <th width="245"><?php print $grade_result; ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
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
