<?php print $sidebar_left; ?>
	<div class="col-md-8">
    	<?php if(empty($not_found)) {?>
        <h1><?php print $title; ?></h1><hr />
        <a href="<?php if ($file) { print $dwn_path.$file; }else { print '#'; } ?>" target="_blank">Download PDF</a>
        <p><?php print $description; ?></p>
        <?php } ?>
    </div>
<?php //print $sidebar_right; ?>