<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
        	<h1>Students List</h1>
            
            <div class="shorting_std row">
            <form method="post" action="">
            	<div class="col-md-3">
            	<label>Student Name : </label>
            	<input type="text" name="name" class="form-control" />
                </div>
                <div class="col-md-3">
                <label>Class : </label>
                <select name="class" class="form-control" onChange="getState(this.value);">
                	<option value="0">Select Class</option>
                	<?php print class_list(); ?>
                </select>
                </div>
                <div class="col-md-3">
                <label>Group : </label>
                <select name="group" class="form-control" id="group_list">
					<?php if(!empty($row['group_id'])) { 
                    print group_list($row['group_id'], $row['class_id']);
                    }else { print '<option>No group selected</option>'; } ?>
                </select>
                </div>
                <div class="col-md-3">
                <br />
                <input type="submit" name="filter_std" value="Filter" class="btn btn-default btn-primary filter" />
                </div>
             </form>
            </div>
            
            <hr />
            
            <?php 
			if (is_array($list_student)) {
			foreach($list_student as $row) {
			$image = $row->main_image;
			?>
            <div class="row student_list">
            	<div class="col-md-2 std_photo">
                <?php if (!empty($image)) {?>
                <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$std_path.$image; ?>&amp;w=120&amp;h=110&amp;zc=1">
                <?php }else { ?>
                <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$std_path."no_thumb.jpg"; ?>&amp;w=120&amp;h=110&amp;zc=1">
                <?php } ?>
                </div>
                <div class="col-md-10">
                <h4><?php print $row->name; ?></h4>
				<p><?php print substr(strip_tags($row->description), 0, 150); ?></p>
                <a href="<?php print base_url(); ?>student/view/<?php print $row->std_id; ?>">View Detail</a>
                </div>
            </div>
            <?php }}else { print $list_student; } ?>
            <div class="pagination"><?php print $pagination; ?></div>
        </div>
    </div>
</div>



<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "<?php print base_url(); ?>/ajax.html/?group_list=yes",
	data:'class='+val,
	success: function(data){
		$("#group_list").html(data);
	}
	});
}
</script>