<section class="content-section">
    <div class="container-fluid">
        <div class="row">
            <div class="werp col-md-12"
                 style="background-image: url('<?php print base_url(); ?>/uploads/gallery/login-background.jpg');">
                <div class="container" style="padding: 80px;">
                    <div class="col-md-12">
                        <?php $error = isset($_SESSION['error']) ? $_SESSION['error'] : 0;
                        if ($error) { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-md-12">
                        <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0; if ($message) {  echo $message;  } ?>
                    </div>

                    <div class="col-md-3"></div>

                    <?php if (empty($check_user)) { ?>
                    <div class="header inner col-md-8"
                         style=" background: url('<?php print base_url(); ?>uploads/gallery/log_back.jpg'); background-repeat: no-repeat; background-size: cover; ">

                        <form id="regform" role="form" id="login" method="post"
                              action="<?php print base_url(); ?>/member_form/login_action">
                            <h3>Login Form</h3>

                            <div class="form-wrapper">
                                <label for="">Username</label>
                                <input type="text" name="username" class="reg" required>
                                <b id="result"></b>
                            </div>
                            <div class="form-wrapper">
                                <label for="">Password</label>
                                <input name="password" type="password" required class="reg">
                            </div>

                            <button type="submit" name="login">Login</button>
                        </form>

                        <?php } if ($check_user) { ?>
                        <div class="col-md-12">
                            <h1>Member Area</h1>
                            <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Hello <?php print $u_name; ?>!</h2>
                                    <hr/>
                                    <?php if ($check_user == 1) {
                                        $link = 'teacher/view/';
                                    } else {
                                        $link = 'student/view/';
                                    } ?>
                                    <p>Want to see your profile? Please <a
                                                href="<?php //print base_url().$link. $ID; ?>#">click here</a></p>
                                </div>
                            </div>

                            <?php } ?>
                        </div>
                    </div>


                    <div class="col-md-1"></div>


                </div>


            </div>
        </div>
    </div>
</section>
