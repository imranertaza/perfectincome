<?php print $sidebar_left;?>
<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
        	<h1>Products List</h1>
            
            <div class="shorting_std row">
            <form method="post" action="">
            	<div class="col-md-6">
            	<label>Product Name : </label>
            	<input type="text" name="name" class="form-control" />
                </div>
                <div class="col-md-6"><br />
                <input type="submit" name="filter_tec" value="Filter" class="btn btn-default btn-primary filter" />
                </div>
             </form>
            </div>
            <hr />
            <?php 
			if (is_array($list_teacher)) {
			foreach($list_teacher as $row) {
			$image = $row->main_image;	
			?>
            <div class="row student_list">
            	<div class="col-md-2 std_photo">
                <?php if (!empty($image)) {?>
                <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path.$image; ?>&amp;w=120&amp;h=110&amp;zc=1">
                <?php }else { ?>
                <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path."no_thumb.jpg"; ?>&amp;w=120&amp;h=110&amp;zc=1">
                <?php } ?>
                </div>
                <div class="col-md-10">
                <h4><?php print $row->name; ?></h4>
				<p><?php print substr(strip_tags($row->description), 0, 150); ?></p>
                <a href="<?php print base_url(); ?>product/view/<?php print $row->pro_id; ?>">View Detail</a>
                </div>
            </div>
            <?php }}else { print $list_teacher; } ?>
            <?php print $pagination; ?>
        </div>
    </div>
</div>