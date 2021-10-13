<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Result List <a href="<?php print base_url(); ?>admin_area/exam/view_result_print/<?php print $exm_id; ?>/<?php print $segment; ?>.html" class="btn btn-primary take_margin right" title="Print Page">Print Result List</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url(); ?>admin_area/exam/add_result/<?php print $exm_id; ?>.html">Make result</a></li>
              <li class="active"><a href="<?php echo base_url(); ?>admin_area/exam/view_result/<?php print $exm_id; ?>.html">View Result</a></li>
            </ul>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="158">Roll</th>
                                            <th width="245">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
										if (is_array($list_result)) {
										foreach($list_result as $row) {
										?>
										<tr id="res_<?php print $row->res_id; ?>">
                                            <td width="86"><?php print $row->roll_no; ?></td>
                                            <td width="245">
                                            <a href="<?php print base_url(); ?>admin_area/exam/view_result_details/<?php print $row->res_id; ?>.html" class="btn btn-primary take_margin" title="Result">View</a>
											<?php if ($this->functions->hasPermission('edit_exam') == true) { ?>
                                            <a href="<?php print base_url(); ?>admin_area/exam/edit_result/<?php print $exm_id; ?>/<?php print $row->res_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <?php if ($this->functions->hasPermission('delete_exam') == true) { ?>
                                            <a onclick="delete_result(<?php print $row->res_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } }else { print '<tr><td colspan="7">'.$list_result.'</td></tr>'; } ?>
                                    </tbody>
                                </table>
                                <?php print $pagination; ?>
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


function delete_result(res_id){
	  var yes = confirm('Do you want to delete permanently?');
	  if(yes){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?delete_res=yes',
			 type: "POST",
			 dataType: "text",
			 data: {res_id: res_id},
			 beforeSend: function(){
				   $('#res_'+res_id).css( 'background','#F00');
			 },
			 success: function(msg){
				  $('#res_'+res_id).fadeOut('slow');
			 }
	  });
	  }
 }
</script>
