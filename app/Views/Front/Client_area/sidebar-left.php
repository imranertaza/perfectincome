<div class="sidebar">
    <div class="user-info text-center">
        <?php $photo = get_field_by_id_from_table('users', 'photo', 'ID', $ID);?>
<!--        <img src="assets/img/offer1.png" class="img-fluid" alt="">-->
        <?php print view_user_image($ID, 90, 90); ?>
        <h3>Profile</h3>
        <p>User Name: <?php print $u_name; ?><br>Full Name: <?php print $f_name; ?></p>
    </div>
    <div class="user-data">
        <p>Point <span class="float-end"><strong><?php print $point; ?> PT</strong></span></p>
        <p>Commission <span class="float-end"><strong><?php print Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)); ?></strong></span></p>
        <p>Balance <span class="float-end"><strong><?php print Tk_view(number_format($balance, 2)); ?></strong></span></p>
    </div>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <a href="<?php print base_url(); ?>/Member/dashboard" class="nav-link align-middle px-0">
                <i class="bi bi-house-fill"></i> <span class="ms-1">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/tree" class="nav-link px-0 align-middle">
                <i class="bi bi-diagram-3-fill"></i> <span class="ms-1">My Tree</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/General/pin_generate" class="nav-link px-0 align-middle">
                <i class="bi bi-pin-angle-fill"></i> <span class="ms-1">Pin Genarate</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/profile" class="nav-link px-0 align-middle">
                <i class="bi bi-person-fill"></i> <span class="ms-1">Profile</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/profile/profile_update" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Edit Profile</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/referrals" class="nav-link px-0 align-middle">
                <i class="bi bi-link-45deg"></i> <span class="ms-1">Referral</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/withdraw" class="nav-link px-0 align-middle">
                <i class="bi bi-layer-forward"></i> <span class="ms-1">Withdraw</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/withdraw_report" class="nav-link px-0 align-middle">
                <i class="bi bi-receipt"></i> <span class="ms-1">Withdraw Report</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/matching_report" class="nav-link px-0 align-middle">
                <i class="bi bi-subtract"></i> <span class="ms-1">Matching Report</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/sponser_report" class="nav-link px-0 align-middle">
                <i class="bi bi-pip-fill"></i> <span class="ms-1">Sponsor Report</span></a>
        </li>

        <li>
            <a href="<?php print base_url(); ?>/Member/Video" class="nav-link px-0 align-middle">
                <i class="bi bi-youtube"></i> <span class="ms-1">Videos</span></a>
        </li>
    </ul>
</div>