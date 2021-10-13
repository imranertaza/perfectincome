<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Load Balance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            
                            	<form method="post" action="">
                                <div class="col-lg-6">
                                		<?php print $msg; ?>
                                        <div class="form-group">
                                            <label>Amount </label>
                                            <?php echo form_error('balance', '<p class="error">', '</p>'); ?>
                                            <input class="form-control" name="balance" required>
                                            <p class="help-block">Enter Amount</p>
                                        </div>
                                       
                                       <div class="form-group">
                                       		<label>Agent ID / Stockis ID</label>
                                            <?php echo form_error('agent_id', '<p class="error">', '</p>'); ?>
                                            <input class="form-control" name="agent_id" type="text" list="ref_id" onchange="check_username(this.value)" required>
                                            <datalist id="ref_id">
                                                <?php print get_agentname_as_list(); ?>
                                              </datalist>
                                              <p class="help-block" id="progress_bar">Please put your Agent ID</p>
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="add_balance">Load Balance</button>
                                </div>
                                </form>

                            </div>
                            <!-- /.row (nested) -->
                            
                             <div class="row">
                             	<div class="col-lg-12">
                                <br />
                             		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="181">ID</th>
                                            <th width="181">Title</th>
                                            <th width="417">Amount</th>
                                            <th width="400">Date</th>
                                            <th width="400">Status</th>
                                            <th width="400">Type</th>
                                            
                                        </tr>
                                    </thead>
                                	<tbody>
                                    <?php
									foreach ($query->result() as $row)
										{
									 ?>
                                    	<tr>
                                        	<td width="181"><?php echo get_username_by_id($row->agent_id);?></td>
                                            <td width="181"><?php echo $row->comment;?></td>
                                            <td width="417"><?php echo $row->amount;?></td>
                                            <td width="400"><?php echo $row->date;?></td>
                                            <td width="400"><?php echo $row->status;?></td>
                                            <td width="400"><?php echo($row->type == 1) ? "Agent":"Stockis";?></td>
                                        </tr>
                                     <?php } ?>
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
function check_username(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#progress_bar').css( 'color','#238A09');
				   $('#progress_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				  //$('#progress_bar').html(msg);
				if (message==0) {
					$('#progress_bar').html('<span style="color:red">Invalid Username</span>');
				}else {
					$('#progress_bar').html('<span style="color:green">Valid Username</span>');
				 }
			 }
	  });
}
</script>