
<section class="content-section">
    <div class="container-fluid" style="background-image: url('<?php print base_url(); ?>uploads/gallery/gallery.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
        <div class="row" style="background-color: rgba(36, 29, 29, 0.48);">
            <div class="container" id="area_pad">
                <link rel="stylesheet" href="<?php print base_url(); ?>/assets/css/lightbox.css">
                    <div class="col-md-12"  >
                        <div class="col-md-12 text-center" >
                            <h1><b><?php print $title; ?></b></h1>
                            <center><p class="front-border"></p></center>
                        </div>
                        <div class="col-md-12  results" id="cont-padding">
                            
                            
                            <?php if (is_array($list_gallery)) { ?>                        
                            
                    			<?php foreach ($list_gallery as $gallery) {?>
                                <div class="each_gallery_image" style="float:left; padding:3px; border:1px solid #ccc; margin:5px;">
                                  <a class="example-image-link" href="<?php echo base_url(); ?>/uploads/gallery/<?php print $gallery->image; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img src="<?php echo base_url(); ?>/assets/timthumb.php?src=<?php echo base_url(); ?>/uploads/gallery/<?php print $gallery->image; ?>&amp;w=300&amp;h=300&amp;zc=1" /></a>
                                </div>
                                <?php } ?>
                                
                            <?php } ?>
                            
                            <p><?php //print $pagination; ?></p>
                        </div>
                 	</div>

                <script src="<?php print base_url(); ?>/assets/js/lightbox-plus-jquery.js"></script>
            </div>
        </div>
    </div>
</section>

