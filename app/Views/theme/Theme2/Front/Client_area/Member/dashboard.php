<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-5">
                            <div class="row">
                                <div class="col-lg-12 mt-5">
                                    <?php if ($acDepoStatus == 1) { ?>
                                        <a href="#>" class="btn btn-success"
                                           style="float: right;">Your request is pending approval</a>
                                    <?php } else {
                                        if ($row->status == 'Inactive') { ?>
                                            <a href="<?php echo base_url('member/dashboard/active_user') ?>"
                                               class="btn btn-success"
                                               style="float: right;">Active</a>
                                        <?php }
                                    } ?>

                                    <h5 class="main-title">Dashboard Statement</h5>
                                    <br>
                                    <!--                                <p class="alert-warning">সম্মানিত গ্রাহক বৃন্দ এখন থেকে এজেন্ট উইথড্র দিতে হবে । উইডথড্র দেওয়ার পূর্বে এজেন্ট এর সাথে যোগাযোগ করে নিবেন । সব সময় আপনার আপলাইন এজেন্টের কাছে উইথড্র দিবেন । উইথড্রো দেওয়ার ১০ মিনিটের মধ্যে টাকা না পেলে আমাদের হোয়াটসঅ্যাপের মাধ্যমে জানাবেন । আমাদের হোয়াটসঅ্যাপ নাম্বার  01609535311</p>-->
                                </div>
                                <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                                if ($message) {
                                    echo $message;
                                } ?>

                                <div class="col-lg-12 mt-2">
<!--                                    <div class="pinlist shadow">-->
                                        <div class="row">
                                            <div class="col-lg-4 ">
                                                <h5>Balance: <?php print Tk_view(number_format($balance, 2)); ?></h5>
<!--                                                <p>--><?php //print Tk_view(number_format($balance, 2)); ?><!--</p>-->
                                            </div>
                                            <?php if( $functionModel->modulePermission('point_option') == 1 ) { ?>
                                            <div class="col-lg-4">
                                                <h5>Point: <?php print $point; ?> PT</h5>
                                            </div>
                                            <?php } ?>
                                            <?php if( $functionModel->modulePermission('user_commission') == 1 ) { ?>
                                            <div class="col-lg-4">
                                                <h5>Commission: <?php print Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)); ?></h5>

                                            </div>
                                            <?php } ?>
<!--                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-lg-7 mt-5">
                                    <div class="pinlist shadow">
                                        <h6 style="font-weight: bold;">Latest Referrals</h6>
                                        <table class=" table mt-4">
                                            <tbody>
                                            <tr>
                                                <th>Username</th>
                                                <th>Joining Date</th>
                                            </tr>
                                            <?php foreach ($query as $ref_info) { ?>
                                                <tr>
                                                    <td><?php echo get_username_by_id($ref_info->u_id); ?></td>
                                                    <td><?php echo $ref_info->d_time; ?></td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-5 mt-5">
                                    <div class="pinlist shadow">
                                        <h6 style="font-weight: bold;"><?php print $u_name; ?></h6>
                                        <div class="row pt-3">
                                            <?php if ($functionModel->modulePermission('point_option') == 1) { ?>
                                                <div class="col-lg-2">
                                                    <div class="icon-round"
                                                         style="background-color: #3afff9;color: #ffffff;">
                                                        <i class="bi bi-crop"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10">
                                                    <h6 style="font-weight: bold; margin-bottom: -5px; font-size: 14px;">
                                                        Pt.</h6>
                                                    <slmall class="st-font"><?php print (!empty($point)) ? $point : '0'; ?></slmall>
                                                </div>
                                            <?php }
                                            if ($functionModel->modulePermission('user_commission') == 1) { ?>
                                                <div class="col-lg-2 pt-2">
                                                    <div class="icon-round"
                                                         style="background-color: #db0013;color: #ffffff;">
                                                        <i class="bi bi-cash"></i>
                                                    </div>
                                                </div>

                                                <div class="col-lg-10 pt-2">
                                                    <h6 style="font-weight: bold; margin-bottom: -5px; font-size: 14px;"><?php print Tk_view(number_format(get_field_by_id_from_table('users', 'commission', 'ID', $ID), 2)); ?></h6>
                                                    <slmall class="st-font">Commission</slmall>
                                                </div>
                                            <?php } ?>
                                            <div class="col-lg-2 pt-2">
                                                <div class="icon-round"
                                                     style="background-color: #571ae1;color: #ffffff;">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 pt-2">
                                                <h6 style="font-weight: bold; margin-bottom: -5px; font-size: 14px;"><?php echo get_field_by_id_from_table('users', 'phn_no', 'ID', $ID) ?></h6>
                                                <slmall class="st-font">Phone number</slmall>
                                            </div>

                                            <div class="col-lg-2 pt-2">
                                                <div class="icon-round"
                                                     style="padding-left: 8px;background-color: #3e3e3f;color: #ffffff;">
                                                    <i class="bi bi-flower1"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 pt-2">
                                                <?php $pacName = (!empty($row->package_id)) ? get_field_by_id_from_table('package', 'package_name', 'package_id', $row->package_id) : ''; ?>
                                                <h6 style="font-weight: bold; margin-bottom: -5px; font-size: 14px;"><?php echo $pacName; ?></h6>
                                                <slmall class="st-font">Package</slmall>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ((!empty($row->package_id)) && ($row->status == 'Active')) {
                                        if ($functionModel->modulePermission('video_option') == 1) { ?>
                                            <div class="pinlist shadow mt-4">
                                                <a href="<?php print base_url(); ?>/Member/Video"
                                                   class="videoBtn btn"><i class="bi bi-youtube"></i> View Ads</a>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->