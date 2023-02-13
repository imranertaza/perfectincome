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

                                    <h5 class="main-title">Dashboard Statement</h5>
                                </div>
                                <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                                if ($message) {
                                    echo $message;
                                } ?>


                                <div class="col-lg-7 mt-5">
                                    <div class="pinlist shadow">
                                        <h6 style="font-weight: bold;">Latest Referrals</h6>

                                    </div>
                                </div>

                                <div class="col-lg-5 mt-5">
                                    <div class="pinlist shadow">
                                        <h6 style="font-weight: bold;"><?php print $u_name; ?></h6>

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->