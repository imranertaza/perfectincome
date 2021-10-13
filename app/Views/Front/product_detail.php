<?php print $sidebar_left; ?>
<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
        	<h1><?php print $list_teacher->name; ?></h1>
            <hr />
            <div class="row">
            
            <div class="col-md-12">
            <h4>Product Information</h4>
            </div>
            <div class="col-md-8">
            
            <table width="100%" border="0" class="table table-hover">
              <tr>
                <td width="37%">Name</td>
                <td width="1%" align="center"><strong>:</strong></td>
                <td width="62%"><?php $list_teacher->name ? print $list_teacher->name : print "Not Set"; ?></td>
              </tr>
              <tr>
                <td>Product Price</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->price; ?></td>
              </tr>
              <tr>
                <td>Model</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->model; ?></td>
              </tr>
              <!--<tr>
                <td>Menufacture</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print get_menufacture_by_id($list_teacher->men_id); ?></td>
              </tr>-->
              <!--<tr>
                <td>Catagories</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print get_cat_name_by_id($list_teacher->cat_id); ?></td>
              </tr>-->
            </table>

            
            </div>
            <div class="col-md-4">
            <?php if (!empty($list_teacher->main_image)) {?>
            <img class="std_big_image" src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path.$list_teacher->main_image; ?>&amp;w=200&amp;h=200&amp;zc=3">
            <?php }else { ?>
            <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$pro_path."no_thumb.jpg"; ?>&amp;w=200&amp;h=200&amp;zc=0">
            <?php } ?>
            </div>
            <table width="100%" border="0" class="table table-hover">
              <!--<tr>
                <td width="37%">Color</td>
                <td width="1%" align="center"><strong>:</strong></td>
                <td width="62%"><*?php print color_by_id($list_teacher->colors); ?></td>
              </tr>-->
              <tr>
                <td>Size</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->size; ?></td>
              </tr>
              <tr>
                <td>Point</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->point; ?></td>
              </tr>
              <!--<tr>
                <td>Quality</td>
                <td align="center"><strong>:</strong></td>
                <td> <*?php print quality_by_id($list_teacher->quality); ?></td>
              </tr>-->
              <!--<tr>
                <td>Quantity</td>
                <td align="center"><strong>:</strong></td>
                <td><*?php print $list_teacher->quantity; ?></td>
              </tr>-->
              <?php if($list_teacher->discount) { ?>
              <tr>
                <td>Discount</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->discount; ?></td>
              </tr>
              <?php } if($list_teacher->discount) { ?>
              <tr>
                <td>Special</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print special_by_id($list_teacher->special); ?></td>
              </tr>
              <?php } ?>
            </table>
        </div>
        <div class="col-md-12">
        	<h4>Description</h4>
            <?php print $list_teacher->description; ?>
        </div>
    </div>
</div>
</div>