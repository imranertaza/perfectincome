<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Result</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<?php print $msg; ?>
                                <div class="col-lg-6">
                                <form action="<?php print base_url(); ?>admin_area/exam/add_result/<?php print $exm_id; ?>.html" method="post">
                                <table width="100%" border="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <tr>
                                    <th scope="row">Roll</th>
                                    <td>&nbsp;</td>
                                    <td>
									<select name="roll" class="form-control" onchange="get_tech_subject(this.value);">
                                    <option>Please select a roll</option>
									<?php
									print roll_list_using_exam_id($exm_id); ?>
                                    </select>
                                    </td>
                                  </tr>
                                  
                                  <?php foreach($common  as $rows) { ?>
                                  <tr>
                                    <th width="33%" scope="row"><input type="text" name="subject_name[]" value="<?php print $rows->sub_name; ?>" readonly="readonly" /></th>
                                    <td width="1%">:</td>
                                    <td width="66%"><input type="text" class="form-control" name="subject[]" /></td>
                                  </tr>
                                  <?php } ?>
                                  <?php foreach($subject_ord  as $rows) { ?>
                                  <tr>
                                    <th width="33%" scope="row"><input type="text" name="subject_name[]" value="<?php print $rows->sub_name; ?>" readonly="readonly" /></th>
                                    <td width="1%">:</td>
                                    <td width="66%"><input type="text" class="form-control" name="subject[]" /></td>
                                  </tr>
                                  <?php } ?>
                                  <tr>
                                    <th width="33%" scope="row" id="tech_sub"><input type="text" name="subject_name[]" value="Select roll for technical subject" readonly="readonly" /></th>
                                    <td width="1%">:</td>
                                    <td width="66%"><input type="text" class="form-control" name="subject[]" /></td>
                                  </tr>
                                  <tr>
                                    <th width="33%" scope="row" id="tech_sub"></th>
                                    <td width="1%"></td>
                                    <td width="66%"><input type="submit" name="submit_result" value="Submit" class="btn btn-default btn btn-primary" /></td>
                                  </tr>
                                </table>
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
