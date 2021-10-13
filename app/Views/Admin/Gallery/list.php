<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Slides</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo base_url(); ?>/General_settings/gallery">Image List</a></li>
              <li><a href="<?php echo base_url(); ?>/General_settings/upload_image_gallery">Upload</a></li>
            </ul>
            
            <div class="row">
                <div class="col-lg-12">
                    <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="20">No</th>
                                            <th width="206">Image</th>
                                            <th width="521">Title</th>
                                            <th width="72">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i='';
										if (is_array($records)) {
										foreach($records as $rows) {
										?>
                                        
                                        <tr class="odd gradeX" id="sl_<?php print $rows->sl_id; ?>">
                                            <td><?php print ++$i; ?></td>
                                            <td><img src="<?php echo base_url(); ?>/uploads/gallery/<?php print $rows->image; ?>" width="50%" ></td>
                                            <td><?php print $rows->name; ?></td>
                                            <td class="center">
                                            <?php if ($functionModel->hasPermission('delete_slider') == true) { ?>
                                            <a href="<?php echo base_url('General_settings/delete/'.$rows->sl_id)?>" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        
                                        <?php }}else {print '<tr><td colspan="4">'.$records.'</td></tr>'; } ?>
                                        
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            

        </div>
        
        
<script>
function delete_slider(sl_id){
  var yes = confirm('Do you want to delete permanently? ');
  if(yes){
  $.ajax({
		 url: '<?php print base_url(); ?>ajax.html/?delete_slider=yes',
		 type: "POST",
		 dataType: "text",
		 data: {sl_id: sl_id},
		 beforeSend: function(){
			   $('#sl_'+sl_id).css( 'background','#F00');
		 },
		 success: function(msg){
			  $('#sl_'+sl_id).fadeOut('slow');
		 }
  });
  }
}
</script>
