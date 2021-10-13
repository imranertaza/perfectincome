<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">	
                    <h1 class="page-header">Edit Result <a onclick="history.go(-1);" class="btn btn-primary take_margin right" title="Result"><< Back</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php print $msg; ?>
                        	<form name="codexworld_frm" action="<?php print base_url(); ?>admin_area/exam/edit_result/<?php print $exm_id; ?>/<?php print $res_id; ?>.html" method="post">
                                <div class="col-lg-6">
                                <div id="dataTables-example">
									<select name="roll" class="form-control" onchange="get_tech_subject(this.value);">
                                    <option>Please select a roll</option>
									<?php
									print roll_list_using_exam_id($exm_id, $roll); ?>
                                    </select>
                                </div><br />
                               	</div>  
                                
                            <div class="row">
                                <div class="col-lg-12">
                                    
									<strong>General Subjects : </strong>
									<a href="javascript:void(0);" class="add_sub_c_p" title="Add field">Creative + Practical</a> | 
									<a href="javascript:void(0);" class="add_sub_c_wt_p" title="Add field">Creative</a> | 
									<a href="javascript:void(0);" class="add_sub_n_c_p" title="Add field">Non-creative + Practical</a> | 
									<a href="javascript:void(0);" class="add_sub_n_c_wt_p" title="Add field">Non-creative</a>
									<br><br>
									
									<strong>4 Subjects : </strong>
									<a href="javascript:void(0);" class="add_4sub_c_p" title="Add field">Creative + Practical</a> | 
									<a href="javascript:void(0);" class="add_4sub_c_wt_p" title="Add field">Creative</a> | 
									<a href="javascript:void(0);" class="add_4sub_n_c_p" title="Add field">Non-creative + Practical</a> | 
									<a href="javascript:void(0);" class="add_4sub_n_c_wt_p" title="Add field">Non-creative</a>
									
									
									<div class="field_wrapper">
									<?php print $subject_result; ?>
                                    </div>
                                    
                                 </div>
                            </div>
                            <input type="submit" class="btn btn-default btn btn-primary" name="update_result" value="Update" />
                            </form>
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


<script type="text/javascript">
									$(document).ready(function(){
										var maxField = 8; //Input fields increment limitation
										var addCreativePra = $('.add_sub_c_p'); //Add button selector
										var addCreativeWTPra = $('.add_sub_c_wt_p');
										var addNCreativePra = $('.add_sub_n_c_p');
										var addNCreativeWTPra = $('.add_sub_n_c_wt_p');
										
										var add4CreativePra = $('.add_4sub_c_p'); //Add button selector
										var add4CreativeWTPra = $('.add_4sub_c_wt_p');
										var add4NCreativePra = $('.add_4sub_n_c_p');
										var add4NCreativeWTPra = $('.add_4sub_n_c_wt_p');
										
										var wrapper = $('.field_wrapper'); //Input field wrapper
										var remButton = $('.remove_button'); //Add button selector
										
										
										
										var x = 1; //Initial field counter is 1
										$(addCreativePra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(CP_fields); // Add field html
											}
										});
										$(addCreativeWTPra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(CWTP_fields); // Add field html
											}
										});
										$(addNCreativePra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(NCP_fields); // Add field html
											}
										});
										$(addNCreativeWTPra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(NCWTP_fields); // Add field html
											}
										});
										
									
										
										var CP_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="cwp"><input type="text" name="subject[sub_name][]" />\
														 <span>CQ</span> <input type="text" name="subject[marks][cq][]" />\
														 <span>MCQ</span> <input type="text" name="subject[marks][mcq][]" />\
														 <span>Practical</span> <input type="text" name="subject[marks][practical][]" />\
														 <a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>'; //New input field html 
														 
										var CWTP_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="cwtp"><input type="text" name="subject[sub_name][]" />\
															<span>CQ</span> <input type="text" name="subject[marks][cq][]" />\
															<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" />\
															<input type="hidden" name="subject[marks][practical][]" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
															
										var NCP_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="ncwp"><input type="text" name="subject[sub_name][]" />\
															<span>Written</span> <input type="text" name="subject[marks][cq][]" />\
															<input type="hidden" name="subject[marks][mcq][]" />\
															<span>Practical</span> <input type="text" name="subject[marks][practical][]" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
															
										var NCWTP_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="ncwtp"><input type="text" name="subject[sub_name][]" />\
															<span>Written</span> <input type="text" name="subject[marks][cq][]" />\
															<input type="hidden" name="subject[marks][mcq][]" />\
															<input type="hidden" name="subject[marks][practical][]" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
															
										
										
										
										$(add4CreativePra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(CP4_fields); // Add field html
											}
										});
										$(add4CreativeWTPra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(CWTP4_fields); // Add field html
											}
										});
										$(add4NCreativePra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(NCP4_fields); // Add field html
											}
										});
										$(add4NCreativeWTPra).click(function(){ //Once add button is clicked
											if(x < maxField){ //Check maximum number of input fields
												x++; //Increment field counter
												$(wrapper).append(NCWTP4_fields); // Add field html
											}
										});
													
															
										var CP4_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="cwp4"><input type="text" name="subject[sub_name][]" />\
														 <span>CQ</span> <input type="text" name="subject[marks][cq][]" value="" />\
														 <span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="" />\
														 <span>Practical</span> <input type="text" name="subject[marks][practical][]" value="" />\
														 <a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>'; //New input field html 
														 
										var CWTP4_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="cwtp4"><input type="text" name="subject[sub_name][]" />\
															<span>CQ</span> <input type="text" name="subject[marks][cq][]" value="" />\
															<span>MCQ</span> <input type="text" name="subject[marks][mcq][]" value="" />\
															<input type="hidden" name="subject[marks][practical][]" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
															
										var NCP4_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="ncwp4"><input type="text" name="subject[sub_name][]" />\
															<span>Written</span> <input type="text" name="subject[marks][cq][]" value="" />\
															<input type="hidden" name="subject[marks][mcq][]" />\
															<span>Practical</span> <input type="text" name="subject[marks][practical][]" value="" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
															
										var NCWTP4_fields = '<div><span>Subject</span> <input type="hidden" name="subject[sub_type][]" value="ncwtp4"><input type="text" name="subject[sub_name][]" />\
															<span>Written</span> <input type="text" name="subject[marks][cq][]" value="" />\
															<input type="hidden" name="subject[marks][mcq][]" />\
															<input type="hidden" name="subject[marks][practical][]" />\
															<a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times"></i></a></div>';
										
										
										
										
										$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
											e.preventDefault();
											$(this).parent('div').remove(); //Remove field html
											x--; //Decrement field counter
										});
										
										
									});
									</script>
