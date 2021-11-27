<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content">
                            <h1><b>User Active</b></h1>
                            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                            if ($message) {
                                echo $message;
                            } ?>
                            <hr/>
                            <div class="dashboard_left_area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="border: 1px solid;padding: 20px;">
                                            <center><h4>Pin Active</h4></center>
                                            <form action="<?php echo base_url('member/dashboard/pin_active')?>" method="post" >
                                                <div class="input">
                                                    <label>Pin</label>
                                                    <input type="text" id="myInput" class="form-control" name="pin" placeholder="pin" onchange="pin_check(this.value)" required >
                                                    <b id="pin_bar"></b>
                                                </div>
                                                <div class="input" style="padding-top: 20px;">
                                                    <button type="submit" class="btn btn-primary">Active</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div style="border: 1px solid;padding: 20px;">
                                            <h4>Perfect Money Active</h4>
                                        </div>
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