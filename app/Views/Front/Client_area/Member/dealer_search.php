<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>Find Your Nearest Dealer</h1>
                  <hr />
                    <!-- District Search -->
                    <form action="" method="POST" id="form_district" class="form-inline">
                        <select name="division" class="form-control" onchange="get_district(this.value);" required>
                            <option value="0">Choose Division...</option>
                            <?php print get_location(0); ?>
                        </select>
                        <select name="district" class="form-control" id="district" onchange="get_thana(this.value);" required>
                            <option value="0">Select District...</option>
                        </select>
                      	<select name="upozila" class="form-control" id="thana" onchange="get_ward(this.value);" required>
                            <option value="0">Select Thana/Upazila...</option>
                        </select>
                        <select name="union" class="form-control" id="ward" required>
                            <option value="0">Select Union/Ward...</option>
                        </select>
            <input type="submit" class="btn btn-primary" name="search_agent" value="Search" />
                    </form><br />
                    <!-- End District Search -->
                    <table class="table-bordered table-hover table">
                      <tbody>
                        <tr>
                          <th>Username</th>
                          <th>Address</th>
                          <th>Phone</th>
                        </tr>
                        <?php 
            			if (!empty($records))  {
            			foreach($records as $row) { ?>
                        <tr>
                          <td><?php print $row->username; ?></td>
                          <td><?php print $row->address1." ".$row->address2; ?></td>
                           <td><?php print $row->phn_no; ?></td>
                          <?php } ?>
                        </tr>
                        <?php print $pagination;
            			} else { ?>
                        <tr>
                        	<td colspan="3">There is no record yet.</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>



            <script>

            function get_district(division_id) {
            	$.ajax({
            			 url: '<?php print base_url(); ?>ajax.html/?check_district=yes',
            			 type: "POST",
            			 dataType: "text",
            			 data: {division_id: division_id},
            			 beforeSend: function(){
            				   $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            			 },
            			 success: function(msg){
            				  $('#district').html(msg);
            			 }
            	  });
            }


            function get_thana(district_id) {
            	$.ajax({
            			 url: '<?php print base_url(); ?>ajax.html/?check_thana=yes',
            			 type: "POST",
            			 dataType: "text",
            			 data: {district_id: district_id},
            			 beforeSend: function(){
            				   $('#thana').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            			 },
            			 success: function(msg){
            				  $('#thana').html(msg);
            			 }
            	  });
            }


            function get_ward(thana_id) {
            	$.ajax({
            			 url: '<?php print base_url(); ?>ajax.html/?check_ward=yes',
            			 type: "POST",
            			 dataType: "text",
            			 data: {thana_id: thana_id},
            			 beforeSend: function(){
            				   $('#ward').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            			 },
            			 success: function(msg){
            				  $('#ward').html(msg);
            			 }
            	  });
            }

            </script>


          </div>
        </div>
      </div>