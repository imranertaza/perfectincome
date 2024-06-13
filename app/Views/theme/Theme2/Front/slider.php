<!--start of the slider--> 

<div class="row">
<div id="banner-fade">
    <ul class="bjqs">
    	<?php foreach ($list_slider as $slide) {?>
    	<li><img src="<?php echo base_url(); ?>/assets/timthumb.php?src=<?php echo base_url(); ?>/uploads/gallery/<?php print $slide->image; ?>&amp;w=1200&amp;h=400&amp;zc=1" /></li>
        <?php } ?>
    </ul>
    <br class="clear" />
</div><!--end of slider-->
</div>
<!--finish of the slider-->


<script type="text/javascript">
jQuery(document).ready(function($) {

  $('#banner-fade').bjqs({
	height      : 400,
	width       : 1170,
	responsive  : true
  });

});
</script>
