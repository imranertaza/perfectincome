<?php print $sidebar_left; ?>
	<div class="col-md-8">
            <h1>Member Area</h1>
            <hr />
            <div class="row">
            	<div class="col-md-12">
                	<h2>Hello <?php print $u_name; ?>!</h2>
                    <hr />
                    <?php if ($check_user == 1) { $link = 'teacher/view/';
					?>
                    <!--<p>Do you want to see all students? Please <a href="<?php print base_url(); ?>student.html">click here</a></p>-->
                    <?php }else { $link = 'student/view/'; } ?>
                    <p>Want to see your profile? Please <a href="<?php //print base_url().$link. $ID; ?>#">click here</a></p>
                </div>
            </div>
    </div>