<main id="main" class="no-banner">

    <section id="content" class="content">
        <div class="container" data-aos="fade-up">


            <div class="row">
                <div class="col-lg-5">
                    <h1>Login</h1>
                    <?php $error = isset($_SESSION['error']) ? $_SESSION['error'] : 0;
                    if ($error) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <form id="regform" role="form" id="login" method="post" action="<?php print base_url(); ?>/member_form/login_action">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <span class="float-end"><i class="bi bi-eye-slash"></i></span>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" name="login" class="btn btn-submit" value="Login">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7 text-end">
                    <img src="<?php echo base_url(); ?>/assets/img/vector.png" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->
