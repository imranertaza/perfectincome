<div class="col-md-3 sidebar" style="background-color: white;">
    	<div class="head_teacher_comment" >
        	<h4 style=" "><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> <?php if (empty($check_user)) { print "Login"; }else{ print "Profile"; } ?></h4>
            <div class="login_box">
            <?php 
			if (empty($check_user)) { ?>

            <form method="post" action="<?php print base_url(); ?>/member_form/login.html">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text"  name="username" id="user_name" class="form-control" placeholder="Enter Username" >
                    <small id="emailHelp" class="form-text text-muted">Please enter your username.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <small id="emailHelp" class="form-text text-muted">Please enter your password.</small>
                </div>
                <input type="submit" class="btn btn-primary" name="login" value="login" id="login" />
            </form>
            <?php } if (!empty($check_user)){
				print "Username: ".$u_name."<br />";
				print "First Name: ".$f_name."<br />";
				print "Last Name: ".$l_name."<br />";
				print "Points: ".$point."<br />";
				print "Balance: ".$balance."<br />";
			?>
            <div class="see_all"><a href="<?php //print base_url().$link. $ID; ?>#">View Profile <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></div>
			<?php	} ?>
             <br class="clear" />
            </div>
        </div>
        <div class="important_links">
        	<h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i>  Notice</h4>
        	<ul>
            <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" behavior="scroll" scrollamount="2" scrolldelay="2">
                <?php 
				if (is_array($list_notice)) {
				foreach ($list_notice as $row) { ?>
                <li><i class="fa fa-angle-right"></i> <a href="<?php print base_url(); ?>downloads/details/<?php print $row->dwn_id; ?>.html"><?php print $row->title; ?></a></li>
                <?php } }else { print $list_notice; } ?>
            </marquee>
            </ul>
            <?php if (is_array($list_notice)) { ?>
            <div class="see_all"><a href="<?php print base_url(); ?>details/page/notice.html">See All <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></div>
            <?php } ?>
            <br class="clear" />
        </div>
        <div class="notice">
        	<h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> Incentives</h4>
            <ul>
            	<li>One Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
				<li>Two Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i> <i class="fa fa-star logo_3_color" aria-hidden="true"></i> .</li>
                <li>Three Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
                <li>Four Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
                <li>Five Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
                <li>Six Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
                <li>Seven Star <i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i><i class="fa fa-star logo_3_color" aria-hidden="true"></i>.</li>
            </ul>
        </div>
        
        
        <div class="important_links">
        	<h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> Follow Us</h4>
        	<ul>
                <li><a href="#"></i>  Facebook</a></li>
                <li><a href="#"><i class="fa fa-twitter fb"></i> Twitter</a></li>
                <li><a href="#"><i class="fa fa-linkedin fb"></i> Linked In</a></li>
                <li><a href="#"><i class="fa fa-google-plus fb"></i> Google +</a></li>
            </ul>
        </div>
        
    </div>
    
