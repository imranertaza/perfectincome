<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php print $title; ?> List | (Total <?php print $title; ?><em>(s)</em> : <?php print $total_rows; ?>)</h1>
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
                                            <th width="291">Phone</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<form method="post" action="<?php print base_url(); ?>admin_area/member/<?php print $search; ?>/">
                                    	<tr>
                                            <td width="120">
											                         <input type="text" name="username" class="form-control" />
                                            </td>
                                            <td width="120">
											                         <input type="text" name="phone" class="form-control" />
                                            </td>
                                            <td width="120"><input type="submit" class="btn btn-default btn btn-primary" name="add_attendance" value="Search"></td>
                                        </tr>
                                        </form>
                                    </tbody>
                                </table>
                            
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="100">Image</th>
                                            <th width="248">Title</th>
                                            <th width="386">Email</th>
                                            <th width="187">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										                          if ($records) {
										                          foreach($records as $rows) {
										                      ?>
                                        
                                        <tr class="odd gradeX" id="std_<?php print $rows->ID; ?>">
                                            <td>
                                             <?php if($rows->photo){ ?>
                                             <img src="<?php print base_url(); ?>assets/timthumb.php?src=<?php print base_url(); ?>/uploads/user_image/<?php echo $rows->photo; ?>&w=100px&h=100px&zc=1" />
                                             <?php }else { ?>
                                             <img src="<?php print base_url(); ?>assets/timthumb.php?src=<?php print base_url(); ?>/uploads/user_image/no_thumb.jpg&w=100px&h=100px&zc=1" />
                                             <?php } ?>
                                             </td>
                                            <td><?php print $rows->username; ?></td>
                                            <td><?php print $rows->email; ?></td>
                                            <td class="center">
                                            <a href="<?php print base_url(); ?>admin_area/agent/view/<?php print $rows->ID; ?>.html" class="btn btn-primary take_margin" title="View"><i class="fa fa-fw"></i></a>
                                            <?php if ($this->functions->hasPermission('edit_std') == true) { ?>
                                            <a href="<?php print base_url(); ?>admin_area/agent/edit/<?php print $rows->ID; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <?php } ?>
                                            <!--<?php //if ($this->functions->hasPermission('delete_std') == true) { ?>
                                            <a onclick="delete_product(<?php //print $rows->ID; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php //} ?>-->
                                            </td>
                                        </tr>
                                        
                                        <?php }}else { ?>
                                        <tr class="odd gradeX"><td colspan="5">No <?php print $title; ?> Found</td></tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                                <p class="paginate"><?php print $pagination; ?></p>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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
