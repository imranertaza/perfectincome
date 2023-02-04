<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Module List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                </div>
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="135">ID</th>
                                            <th>Moduel Name</th>
<!--                                            <th width="427">Moduel Key</th>-->
                                            <th width="120">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $moduleModel->module_list() as $rows) {$module_id = $rows->module_id;  ?>
                                            <tr class="odd gradeX" id="page_<?php print $module_id; ?>">
                                                <td><?php print $rows->module_id; ?></td>
                                                <td><?php print $rows->module_name; ?></td>
<!--                                                <td>--><?php //print $rows->module_key; ?><!--</td>-->
                                                <td class="center">
                                                    <?php if ($rows->status == 1) { if(check_module_by_id($rows->module_id) == true){ ?>

                                                        <a class="btn btn-xs btn-success" href="Module/setting/<?= $rows->module_id; ?>">Setting</a>

                                                    <?php } } ?>
                                                   
                                                    <div class="material-switch pull-right">
                                                        <input id="label-<?= $rows->module_id; ?>" onclick="changeStatus(<?= $rows->module_id; ?>);" name="status" id="<?= $rows->module_id; ?>" type="checkbox" <?php echo ($rows->status == 1) ? 'checked' : '' ?>/>
                                                        <label for="label-<?= $rows->module_id; ?>" class="label-default"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>

<script>
    function changeStatus(id){
    
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/module_status',
			 type: "POST",
			 dataType: "text",
			 data: {id:id},
			 beforeSend: function(){
				   $('#pin_bar').css( 'color','#238A09');
				   $('#pin_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				if (message == 'OK') {
					location.reload();
				}
			 }
	  });
}
</script>        
<style>
    .material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
</style>