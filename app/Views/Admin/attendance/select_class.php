<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Please select a class</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<form method="post" action="<?php print base_url()."attendance/report.html"; ?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                        	<label>Class</label>
                                            <select name="class" id="class" class="form-control" onChange="getState(this.value);">
                                            <option>Please select a class</option>
                                            <?php print class_list(); ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="select_class">Go <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></button>
                                </div>
                                <div class="col-lg-6">
                                	<div class="form-group">
                                        <label>Group</label>
                                        <select name="group" class="form-control" id="group_list">
                                            <option>Please select a class first</option>
                                        </select>
                                    </div>
                                </div>
                                </form>
                                <!-- /.col-lg-6 (nested) -->
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
function getState(val) {
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>ajax.html/?group_list=yes",
	data:'class='+val,
	success: function(data){
		$("#group_list").html(data);
	}
	});
}
</script>
