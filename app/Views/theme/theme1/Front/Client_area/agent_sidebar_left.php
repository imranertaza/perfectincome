<div class="sidebar">
    <div class="user-info text-center">
        <?php $photo = get_field_by_id_from_table('users', 'photo', 'ID', $ID);?>
<!--        <img src="assets/img/offer1.png" class="img-fluid" alt="">-->
        <?php print view_user_image($ID, 90, 90); ?>
        <h3>Profile</h3>
        <p>User Name: <?php print $u_name; ?><br>Full Name: <?php print $f_name; ?></p>
    </div>
    <div class="user-data" id="balance">
<!--        <p>Point <span class="float-end"><strong>--><?php //print $point; ?><!-- PT</strong></span></p>-->
<!--        <p>Commission <span class="float-end"><strong>--><?php //print Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)); ?><!--</strong></span></p>-->
        <p id="balUp">Balance <span class="float-end"><strong><?php print Tk_view(number_format($balance, 2)); ?></strong></span></p>
    </div>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <a href="<?php print base_url(); ?>/Agent/dashboard" class="nav-link align-middle px-0">
                <i class="bi bi-house-fill"></i> <span class="ms-1">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Agent/Profile" class="nav-link px-0 align-middle">
                <i class="bi bi-person-fill"></i> <span class="ms-1">Profile</span></a>
        </li>
        <li>
            <a href="<?php print base_url(); ?>/Agent/Profile/profile_update" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Edit Profile</span></a>
        </li>

        <li>
            <a href="<?php print base_url(); ?>/Agent/Withdraw" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Withdraw by admin</span></a>
        </li>

        <li>
            <a href="<?php print base_url(); ?>/Agent/Withdraw/withdraw_list" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Withdraw list</span></a>
        </li>

        <li>
            <a href="<?php print base_url(); ?>/Agent/Withdraw/list" class="nav-link px-0 align-middle">
                <i class="bi bi-file-person-fill"></i> <span class="ms-1">Get withdraw request</span></a>
        </li>

    </ul>
</div>