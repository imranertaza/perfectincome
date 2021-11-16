<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
              <div class="right_contant dashboard_right">
                <div class="top_right_content">
                  <h1>Change Password</h1>
                  <hr />
                    <?php echo validation_errors(); ?>
                    <?php print $this->session->flashdata('msg'); ?>
                    <div class="col-md-4">
                        <form method="post" action="<?php print base_url(); ?>member/profile/change_password_action/">
                            <div class="row">
                                <div class="form-group">
                                  <label for="pwd">Current Password :</label>
                                  <input type="password" name="current_pass" placeholder="Current Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                  <label for="pwd">New Password :</label>
                                  <input type="password" name="new_pass" required placeholder="New Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Confirm Password :</label>
                                    <input type="password" name="confirm_pass" required placeholder="Confirm Password" class="form-control" id="pwd">
                                </div>
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
