<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Result</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo base_url(); ?>admin_area/exam/add_result/<?php print $exm_id; ?>.html">Make result</a></li>
              <li><a href="<?php echo base_url(); ?>admin_area/exam/view_result/<?php print $exm_id; ?>.html">View Result</a></li>
            </ul>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<?php print $msg; ?>
                                
                                <form name="codexworld_frm" action="<?php print base_url(); ?>admin_area/exam/add_result/<?php print $exm_id; ?>.html" method="post">
                                <div class="col-lg-6">
                                <div id="dataTables-example">
									<select name="roll" class="form-control" onchange="get_tech_subject(this.value);">
                                    <option>Please select a roll</option>
									<?php
									print roll_list_using_exam_id($exm_id); ?>
                                    </select>
                                </div><br />
                                </div>    
                                    
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
									</div>
									<input type="submit" name="submit_result" value="SUBMIT" class="btn btn-default btn btn-primary"/>
                                    
                                 </div> 
                                </form>
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


function get_tech_subject(val){
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>ajax.html/?get_tech_subject=yes",
	data:{roll_no: val},
	success: function(data){
		$("#tech_sub input").val(data);
	}
	});
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
