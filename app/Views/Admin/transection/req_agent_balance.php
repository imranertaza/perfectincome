<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Requested Agent Balance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            
                            	

                            </div>
                            <!-- /.row (nested) -->
                            
                             <div class="row">
                             	<div class="col-lg-12">
                                <br />
                                
                                <?php print $msg; ?>
                             		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="181">Agent ID</th>
                                            <th width="181">Title</th>
                                            <th width="417">Amount</th>
                                            <th width="400">Status</th>
                                            <th width="400">Date</th>
                                            <th width="400">Action</th>
                                        </tr>
											

                                    </thead>
                                	<tbody>
                                    <?php
                                            foreach ($query->result() as $row)
                                            {
                                            ?>
                                            <tr>
                                            <td><?php echo get_username_by_id($row->agent_id);?></td>
                                            <td><?php echo $row->comment;?></td>
                                            <td><?php echo $row->amount;?></td>
                                            <td><?php echo $row->status;?></td>
                                            <td><?php echo $row->date;?></td> 
                                            <td><form action="" method="post">
                                            <input type="hidden" name="re_id" value="<?php echo $row->req_id;?>" />
                                            <input type="submit" class="btn btn-default btn btn-primary" name="confirm" value="Comfirm" />
                                            </form>
                                            </td>             
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