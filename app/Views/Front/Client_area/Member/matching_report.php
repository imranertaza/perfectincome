<div class="container-fluid dash_body">
  <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

          <?php print $sidebar_left; ?>

          <div class="col-md-9">
            <div class="right_contant dashboard_right">
              <div class="top_right_content">
                <h1>Matching Report</h1>
                <hr />
                
                <div class="top_right_content">
                  <div id="tabs">

                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#accept">Accept</a></li>
                        <li><a data-toggle="tab" href="#waiting">Waiting</a></li>
                      </ul>
                      
                      
                      <div class="tab-content">
                        <div id="accept" class="tab-pane fade in active">
                        			<h4>All Accepted Matching Commissions</h4><hr />
                          		Total Accepted Matching: <?php echo $com_taken_matching; ?><br />
          						Total Matching Commission: <?php //echo $total_matching_amount[0]["SUM(amount)"]; ?>
                                <table class="table-bordered table-hover table">
                                  <tbody>
                                    <tr>
                                      
                                      <th>Matching Date / Time</th>
                                      <th>Status</th>
                                    </tr>
                                    
                                     <?php
                              foreach ($querya as $row)
                              {
                               ?>
                                    <tr>
                                      
                                      <td><?php echo $row->date;?></td>
                                      <td>Accept</td>
                                    </tr>
                                   <?php } ?>
                                    
                                  </tbody>
                                </table>
                        </div>
                        <div id="waiting" class="tab-pane fade">
                          <h4>All Waiting Matching Commissions</h4><hr />
                          <p>This page is under development</p>
                        </div>
                      </div>



                    
                    </div>
                    <!--End tabs container--> 
                  </div>
                  <!--End tabs--> 
                  
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    
