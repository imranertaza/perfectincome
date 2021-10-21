<div class="col-md-3 sidebar">
    	<div class="head_teacher_comment">
        	<h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> <?php if (empty($check_user)) { print "Login"; }else{ print "Profile"; } ?></h4>
            <div class="">
            <ul class="nav"> 
            <?php 
			if (empty($check_user)) { ?>
            <form method="post" action="<?php print base_url(); ?>/member_form/login">
            	Username :<br /><input type="text" name="username" id="user_name" class="log" value="<?php print set_value('mobile'); ?>" /><br />
                Password :<br /><input type="password" name="password" id="password" class="log" /><br />
                <input type="submit" name="login" value="login" id="login"  class="log1"  />

            </form>
            <?php } 
            if (($check_user == true) && ($role == 6)){
                
                
                print "<div style='text-align: center; margin-top:20px;' >".view_user_image($ID, 90, 90)."</div><br>";
				print "<div style='text-align: center;'> <b>Username:</b> ".$u_name."</div><br />";

				print "<li><a><b>Full Name :</b><span style='float: right;' > ".$f_name."</span></a></li>";
                print "<li><a><b>Point :</b><span style='float: right;' > ".$point." Pt.</span></a></li>";
                print "<li><a><b>Commission :</b> <span style='float: right;'> ".Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2))."</span> </a></li>";
                print "<li><a><b>Balance :</b> <span style='float: right;'>".Tk_view(number_format(get_field_by_id_from_table('users', 'balance', 'ID', $ID), 2))."</span> </a></li>";
			?>
            
			<?php }

			/* if (($check_user == true) && ($role == 5)){
				print "Username: ".$u_name."<br />";
				print "First Name: ".$f_name."<br />";
				print "Last Name: ".$l_name."<br />";
				print "Balance: ".number_format($balance, 2)."<br />";
				print "Commission: ".number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)."<br />";
			?>
            <div class="see_all"><a href="<?php //print base_url().$link. $ID; ?>#">View Profile <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i></a></div>
            <?php } */
            
			if (($check_user == true) && ($role == 4)){
                print "<div style='text-align: center; margin-top:20px;' >".view_user_image($ID, 90, 90)."</div><br>";
				print "<div style='text-align: center;'> <b>First Name:</b> ".$u_name."</div><br />";

				print "<li><a><b> First Name:</b> <span style='float: right;' >".$f_name." </span></a></li>";
				print "<li><a><b> Last Name:</b> <span style='float: right;' >".$l_name."</span></a></li>";
				print "<li><a><b> Balance:</b> <span style='float: right;' >".Tk_view(number_format($balance, 2))."</span></a></li> ";
				print "<li><a><b> Commission: </b> <span style='float: right;' >".Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2))."</span></a></li>";
			?>
            
            
			<?php	} ?>
            </ul> 
            <a href=""></a>
             <br class="clear" style="text-align: " />
            </div>
        </div>
        <?php if ($check_user==1){ ?>
        <div class="notice">
        	<h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> Menus</h4>            
            <ul class="nav">
				<?php if (($check_user == true) && ($role == 4)) { ?>                
            	<li><a href="<?php print base_url(); ?>/Agent/dashboard/"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                <li><a href="<?php print base_url(); ?>/Agent/profile/"><i class="fa fa-user"></i> My Profile</a></li>
                <li><a href="<?php print base_url(); ?>/Agent/agent_pin/"><i class="fa fa-refresh"></i> Pin Generate</a></li>
                <li><a href="#"><i class="fa fa-indent"></i> Product Inventory</a></li>
                <li><a href="#"><i class="fa fa-truck"></i> Purchased Products</a></li>
                <li><a href="<?php print base_url(); ?>/Agent/product_sale/"><i class="fa fa-file-text"></i> Product Sales </a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Product Sales History</a></li>
                <li><a href="#"><i class="fa fa-briefcase"></i> Sales</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Sales Commission History</a></li>                
                <li><a href="#"><i class="fa fa-arrow-circle-down"></i> Load Balance</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Load Balance History</a></li>
                <li><a href="#"><i class="fa fa-paper-plane-o"></i> Transaction</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Transaction Balance History</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i> Expensive History</a></li>
                

                <?php } ?>
                <?php /* if (($check_user == true) && ($role == 5)) { ?>
                <li><a href="<?php print base_url(); ?>stockist/dashboard/">Dashboard</a></li>
                <li><a href="<?php print base_url(); ?>profile/">My Profile</a></li>
                <li><a href="<?php print base_url(); ?>stockist/store/">Store</a></li>
                <li><a href="<?php print base_url(); ?>stockist/stock/">My Products</a></li>
                <li><a href="<?php print base_url(); ?>stockist/requested_products/">Requested Products</a></li>
                <li><a href="<?php print base_url(); ?>stockist/product_delevery/">Product Delevery</a></li>
                <li><a href="<?php print base_url(); ?>stockist/delivery_report/">Delivery Report</a></li>
                <li><a href="<?php print base_url(); ?>stockist/balance_receive/">Balance Received</a></li>
                <!--<li><a href="<?php print base_url(); ?>stockist/balance_log/">Balance Log</a></li>-->
                <li><a href="<?php print base_url(); ?>stockist/balance_request/">Balance Request</a></li>
                <li><a href="<?php print base_url(); ?>stockist/commission/">Commission</a></li>
                <li><a href="<?php print base_url(); ?>stockist/withdraw_report/">Withdraw Report</a></li>
                <?php } */ ?>
                <?php
                if (($check_user == true) && ($role == 6)) { ?>
                    <li>
                        <a href="<?php print base_url(); ?>/member/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/general/tree"><i class="fa fa-sitemap"></i> My Tree</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/profile"><i class="fa fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/profile/profile_update"><i class="fa fa-pencil-square-o"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/general/referrals"><i class="fa fa-share-alt-square"></i> Referrals</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/general/withdraw"><i class="fa fa-paper-plane-o"></i> Withdraw</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/general/withdraw_report"><i class="fa fa-file-text"></i> Withdraw Report</a>
                    </li>
                    <li>
                        <a href="<?php print base_url(); ?>/member/general/matching_report"><i class="fa fa-file-text"></i> Matching Report</a>
                    </li>
<!--                    <li>-->
<!--                        <a href=""><i class="fa fa-indent"></i>Product</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href=""><i class="fa fa-file-text"></i>Product Purchase History</a>-->
<!--                    </li>-->
                <?php } ?>
            </ul>
        </div>
        <?php } ?>

        <div class="important_links">
            <h4><i class="fa fa-bars logo_3_color" aria-hidden="true"></i> Follow Us</h4>
            <ul class="nav">
                <li><a href="https://www.facebook.com/groups/174963189571676/" target="_blank"><i class="fa fa-facebook fb"></i>  Facebook</a></li>
                <li><a href="#"><i class="fa fa-twitter fb"></i> Twitter</a></li>
                <li><a href="#"><i class="fa fa-linkedin fb"></i> Linked In</a></li>
                <li><a href="#"><i class="fa fa-google-plus fb"></i> Google +</a></li>
            </ul>
        </div>
        
    </div>
