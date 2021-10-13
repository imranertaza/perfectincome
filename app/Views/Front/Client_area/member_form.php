<?php print $sidebar_left; ?>

	<?php if (empty($check_user)) { ?>
	<div class="col-md-9">
            <h1>Login</h1>
            <hr />
            <div class="row">
            	<div class="col-md-6">
                    <?php print @$failed.@$more_same_user; ?>
                    <form method="post" action="<?php print base_url(); ?>member_form/login.html">
                    <label>Username: </label>
                    <?php echo form_error('username', '<p class="error">', '</p>'); ?>
                    <input type="text" name="username" class="form-control" value="<?php print set_value('username'); ?>" /><br />
                    <label>Password: </label>
                    <?php echo form_error('password', '<p class="error">', '</p>'); ?>
                    <input type="password" name="password" class="form-control" /><br />
                    <input type="submit" name="login" value="Login" class="btn btn-default btn-primary" />
                    </form>
                </div>
            </div>
    </div>
    <?php }
	
	if ($check_user) { ?>
    
    <div class="col-md-8">
            <h1>Member Area</h1>
            <hr />
            <div class="row">
            	<div class="col-md-12">
                	<h2>Hello <?php print $u_name; ?>!</h2>
                    <hr />
                    <?php if ($check_user == 1) { $link = 'teacher/view/'; }else { $link = 'student/view/'; } ?>
                    <p>Want to see your profile? Please <a href="<?php //print base_url().$link. $ID; ?>#">click here</a></p>
                </div>
            </div>
    </div>
    
    <?php } ?>

