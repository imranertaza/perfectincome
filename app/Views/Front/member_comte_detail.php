<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
        	<h1><?php print $list_teacher->name; ?></h1>
            <hr />
            <div class="row">
            
            <div class="col-md-12">
            <h4>Personal Information</h4>
            </div>
            <div class="col-md-8">
            
            <table width="100%" border="0" class="table table-hover">
              <tr>
                <td width="37%">Name</td>
                <td width="1%" align="center"><strong>:</strong></td>
                <td width="62%"><?php print $list_teacher->name; ?></td>
              </tr>
              <tr>
                <td>Father's Name</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->f_name; ?></td>
              </tr>
              <tr>
                <td>Mother's Name</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->m_name; ?></td>
              </tr>
              <tr>
                <td>Date Of Birth</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->dob; ?></td>
              </tr>
              <tr>
                <td>Mobile</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->mobile; ?></td>
              </tr>
            </table>

            
            </div>
            <div class="col-md-4">
            <?php if (!empty($list_teacher->main_image)) {?>
            <img class="std_big_image" src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$tec_path.$list_teacher->main_image; ?>&amp;w=200&amp;h=200&amp;zc=1">
            <?php }else { ?>
            <img src="<?php print base_url().$timthumb; ?>?src=<?php echo base_url().$tec_path."no_thumb.jpg"; ?>&amp;w=200&amp;h=200&amp;zc=1">
            <?php } ?>
            </div>
            <div class="col-md-12">
            <h4>Address Information</h4>
            </div>
            <div class="col-md-12">
            <table width="100%" border="0" class="table table-hover">
              <tr>
                <td width="37%">Parmanent Address</td>
                <td width="1%" align="center"><strong>:</strong></td>
                <td width="62%"><?php print $list_teacher->p_address; ?></td>
              </tr>
              <tr>
                <td>Local Address</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print $list_teacher->l_address; ?></td>
              </tr>
            </table>
            </div>
            
            <div class="col-md-12">
            <h4>More Information</h4>
            </div>
            <div class="col-md-12">
            <table width="100%" border="0" class="table table-hover">
              <tr>
                <td width="37%">Married Status</td>
                <td width="1%" align="center"><strong>:</strong></td>
                <td width="62%"><?php print merried_status($list_teacher->merried);?></td>
              </tr>
              <tr>
                <td>Sex</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print sex_status($list_teacher->sex); ?></td>
              </tr>
              <tr>
                <td>Religion</td>
                <td align="center"><strong>:</strong></td>
                <td><?php print get_religion($list_teacher->religion); ?></td>
              </tr>
            </table>
            </div>
            </div>
        </div>
        <div class="col-md-12">
        	<h4>About</h4>
            <?php print $list_teacher->description; ?>
        </div>
    </div>
</div>