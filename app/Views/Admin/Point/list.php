<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Point History List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                            <div class="table-responsive">
                            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                	<thead>
                                        <tr>
                                            <th width="291">Username</th>
                                            <th width="291">Select Type</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="POST" action="<?php print base_url(); ?>/Admin/Point_history">
                                    	<tr>
                                            <td width="120">
											<input type="text" name="username" class="form-control" value="<?php echo $username;?>" />
                                            </td>
                                            <td width="120">
											<select name="type" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="Add" <?php if($type == 'Add'){echo 'selected';} ?>  >Add</option>
                                                <option value="Deduct" <?php if($type == 'Deduct'){echo 'selected';} ?>>Deduct</option>
                                                <option value="Flush" <?php if($type == 'Flush'){echo 'selected';} ?>>Flush</option>
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
                                            <th width="120">Username</th>
                                            <th width="100">L_P</th>
                                            <th width="100">R_P</th>
                                            <th width="120">Total L_P</th>
                                            <th width="120">Total R_P</th>
                                            <th width="120">Commission</th>
                                            <th width="120">Balance</th>
                                            <th width="100">Type</th>
                                            <th width="200">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										if ($records) {
										foreach($records as $rows) {
										?>
                                        
                                        <tr class="odd gradeX">
                                            <td><?php print get_username_by_id($rows->u_id)?></td>
                                            <td><?php print $rows->lpoint; ?></td>
                                            <td><?php print $rows->rpoint; ?></td>
                                            <td><?php print $rows->current_left_point; ?></td>
                                            <td><?php print $rows->current_right_point; ?></td>
                                            <td><?php print $rows->current_commission; ?></td>
                                            <td><?php print $rows->current_balance; ?></td>
                                            <td><?php print $rows->type; ?></td>
                                            <td><?php print $rows->date; ?></td>
                                        </tr>
                                        
                                        <?php }}else { ?>
                                        <tr class="odd gradeX"><td colspan="9">No Result Found</td></tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                                <p class="paginate"><?php //print $pagination; ?></p>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-lg-4">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th width="180">Current Commission</th>
                            <th width="20">:</th>
                            <td><?php print "$". $commission; ?></td>
                        </tr>
                        <tr>
                            <th>Current Balance</th>
                            <th>:</th>
                            <td><?php print "$". $balance; ?></td>
                        </tr>
                    </table>
                </div>



                <div class="col-lg-3 right">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th width="110">Left Added</th>
                            <th width="20">:</th>
                            <td><?php print $totalLeftAdd; ?></td>
                        </tr>
                        <tr>
                            <th width="110">Right Added</th>
                            <th width="20">:</th>
                            <td><?php print $totalRightAdd; ?></td>
                        </tr>
                        <tr>
                            <th>Total Deduct</th>
                            <th>:</th>
                            <td><?php print $totalDeduct; ?></td>
                        </tr>
                        <tr>
                            <th>Left Flush</th>
                            <th>:</th>
                            <td><?php print $totalLeftFlush; ?></td>
                        </tr>
                        <tr>
                            <th>Right Flush</th>
                            <th>:</th>
                            <td><?php print $totalRightFlush; ?></td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.row -->
            
        </div>
        

<script>
function delete_product(std_id){
          var yes = confirm('Do you want to delete permanently? ');
          if(yes){
          $.ajax({
                 url: '<?php print base_url(); ?>ajax.html/?delete_student=yes',
                 type: "POST",
                 dataType: "text",
                 data: {std_id: std_id},
                 beforeSend: function(){
                       $('#std_'+std_id).css( 'background','#F00');
                 },
                 success: function(msg){
                      $('#std_'+std_id).fadeOut('slow');
                 }
          });
          }
     }

/*function getGroup(val) {
	$.ajax({
	type: "POST",
	url: "<?php //print base_url(); ?>/ajax.html/?group_list=yes",
	data:'class='+val,
	success: function(data){
		$("#group_list").html(data);
	}
	});
}*/
</script>
