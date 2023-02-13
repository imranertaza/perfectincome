<?php

use App\Models\FunctionModel;
$this->functionModel = new \App\Models\FunctionModel();
?>
<div class="sidebar">
    <div class="user-info text-center">
        <?php $photo = get_field_by_id_from_table('users', 'photo', 'ID', $ID);?>
        <?php print view_user_image($ID, 90, 90); ?>
        <h3>Profile</h3>
        <p>User Name: <?php print $u_name; ?><br>Full Name: <?php print $f_name; ?></p>
    </div>
    <div class="user-data">
        <?php if( $this->functionModel->modulePermission('point_option') == 1 ) { ?>
        <p>Point <span class="float-end"><strong><?php print $point; ?> PT</strong></span></p>
        <?php } ?>
        <?php if( $this->functionModel->modulePermission('user_commission') == 1 ) { ?>
        <p>Commission <span class="float-end"><strong><?php print Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)); ?></strong></span></p>
        <?php } ?>
        <p id="balUp">Balance <span class="float-end"><strong><?php print Tk_view(number_format($balance, 2)); ?></strong></span></p>
    </div>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <a href="<?php print base_url(); ?>/Member/dashboard" class="nav-link align-middle px-0">
                <i class="bi bi-house-fill"></i> <span class="ms-1">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/tree" class="nav-link px-0 align-middle">
                <i class="bi bi-collection"></i> <span class="ms-1">My Team</span></a>
        </li>
<!--        <li>-->
<!--            <a href="--><?php //print base_url(); ?><!--/Member/General/pin_generate" class="nav-link px-0 align-middle">-->
<!--                <i class="bi bi-pin-angle-fill"></i> <span class="ms-1">Pin Genarate</span></a>-->
<!--        </li>-->
        <li>
            <a href="<?php print base_url(); ?>/Member/profile" class="nav-link px-0 align-middle">
                <i class="bi bi-people-fill"></i> <span class="ms-1">Profile</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/profile/profile_update" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Edit Profile</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/referrals" class="nav-link px-0 align-middle">
                <i class="bi bi-journal-album"></i> <span class="ms-1">Referral</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/withdraw" class="nav-link px-0 align-middle">
                <i class="bi bi-sd-card-fill"></i> <span class="ms-1">Cashout</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/withdraw_report" class="nav-link px-0 align-middle">
                <i class="bi bi-receipt"></i> <span class="ms-1">Cashout Report</span></a>
        </li>
        <?php if( $this->functionModel->modulePermission('agent_option') == 1 ) { ?>
        <li>
            <a href="<?php print base_url(); ?>/Member/WithdrawbyAgent" class="nav-link px-0 align-middle">
                <i class="bi bi-card-image"></i> <span class="ms-1">Withdraw by Agent</span></a>
        </li>

        <li>
            <a href="<?php print base_url(); ?>/Member/WithdrawbyAgent/list" class="nav-link px-0 align-middle">
                <i class="bi bi-card-checklist"></i> <span class="ms-1">Agent Withdraw List</span></a>
        </li>
        <?php } ?>

        <li>
            <a href="<?php print base_url(); ?>/Member/general/matching_report" class="nav-link px-0 align-middle">
                <i class="bi bi-bar-chart"></i> <span class="ms-1">Matching Report</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Member/general/sponser_report" class="nav-link px-0 align-middle">
                <i class="bi bi-bar-chart-fill"></i> <span class="ms-1">Sponsor Report</span></a>
        </li>
        <?php
            $packId = get_id_by_data('package_id','users','ID',new_session()->user_id_client);
            $status = get_id_by_data('status','users','ID',new_session()->user_id_client);
            if ((!empty($packId)) && ($status == 'Active')){
            if( $this->functionModel->modulePermission('video_option') == 1 ) { ?>
        <li>
            <a href="<?php print base_url(); ?>/Member/Video" class="nav-link px-0 align-middle">
                <i class="bi bi-youtube"></i> <span class="ms-1">View Ads</span></a>
        </li>
        <?php } } ?>
    </ul>
</div>