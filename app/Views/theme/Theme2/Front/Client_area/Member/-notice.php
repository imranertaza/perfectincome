
<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

          <?php print $sidebar_left; ?>

          <div class="col-md-9">
            <div class="right_contant dashboard_right">
              <div class="top_right_content">
                <h1>Important Notice</h1>
                <hr />
                    <table class="table-bordered table-hover table">
                      <tbody>
                        <tr>
                        
                          <ul>            
                          <?php 
          				if (is_array($list_notice)) {
          				foreach ($list_notice as $row) { ?>
                          <li><i class="fa fa-angle-right"></i> <a href="<?php print base_url(); ?>downloads/details/<?php print $row->dwn_id; ?>.html"><?php print $row->title; ?></a></li>
                          <?php } }else { print $list_notice; } ?>         
                      </ul>
                        </tr>
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
