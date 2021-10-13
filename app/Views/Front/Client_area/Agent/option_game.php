<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>Option Game</h1>
                  <hr />
                    <?php
                    print $this->session->flashdata('msg');
                    ?>

                  <div class="dashboard_left_area">

                      <div class="row">
                          <div class="col-md-5">
                              <b>Game Name: </b> <?php print $gameInfo->game_name; ?>
                          </div>
                          <div class="col-md-4">
                              <b>Game Time: </b> <?php print $gameInfo->execution_time; ?>  AND 10:30:00
                          </div>
                          <div class="col-md-3">
                              <b>Game Status: </b> <span class="btn btn-success"><?php print $gameInfo->status; ?></span>
                          </div>
                      </div>
                      <br>


                      <ul class="list-group">
                          <?php
                          $i = 1;
                          foreach($optionTakenList as $opiton) {
                              $optionName = get_field_by_id_from_table('options', 'option_name', 'option_id', $opiton->option_id);
                              $this->db->select_sum('amount');
                              $this->db->order_by("option_id", "asc");
                              $totalAmount = $this->db->get_where('op_game_participate', array("option_id" => $opiton->option_id, "user_id" => $ID))->row();
                              //print $this->db->last_query();

                              print '<li class="list-group-item">'.$i.') You have perticipated on <b>'.$optionName.'</b> = '.$totalAmount->amount.' BDT</li>';
                              $i++;
                          }
                          ?>
                      </ul>

                      <h3>Choose Your Option</h3>
                      <form method="post" action="<?php print base_url(); ?>agent/option_game/option_game_action/">
                        <table class="table-bordered table-hover table">
                          <tbody>

                          <tr>
                              <th>Options</th>
                              <th>Amount</th>
                            </tr>
                            <tr>
                              <td>
                                  <?php foreach ($options as $option) { ?>
                                      <div class="custom-control custom-radio">
                                          <input type="radio" class="custom-control-input" <?php if($option->option_id == 1){ print "checked"; } ?>  value="<?php print $option->option_id; ?>" id="option_<?php print $option->option_name; ?>" name="option">
                                          <input type="hidden" value="<?php print $option->game_id; ?>" name="gameId">
                                          <label class="custom-control-label" for="option_<?php print $option->option_name; ?>"><?php print $option->option_name; ?></label>
                                      </div>
                                  <?php } ?>
                              </td>
                              <td>
                                  <div class="col-md-6">
                                      <label for="amount">Enter Amount</label>
                                      <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount you want to play" required>
                                      <br>
                                      <button type="submit" class="btn btn-primary">Participate</button>
                                  </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
                  </div>

              </div>
            </div>
      </div>
    </div>
  </div>
  
