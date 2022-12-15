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
                            <h5 class="main-title"> Update Profile </h5>
                            <div class="message">
                                <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                                if ($message) {
                                    echo $message;
                                } ?>
                            </div>
                            <div class="mt-5 border-con">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">General
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile" type="button" role="tab"
                                                aria-controls="profile"
                                                aria-selected="false">Account
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#contact" type="button" role="tab"
                                                aria-controls="contact"
                                                aria-selected="false">Photo
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <?php foreach ($user as $value) { ?>
                                        <div class="tab-pane fade show active pt-4" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <form role="form" id="add_user" method="post"
                                                  action="<?php print base_url(); ?>/member/profile/general_action">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>First Name <sup class="required"></sup></label>
                                                            <input class="form-control" name="fname" type="text"
                                                                   value="<?php echo $value->f_name; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Last Name <sup class="required"></sup></label>
                                                            <input class="form-control" name="lname" type="text"
                                                                   value="<?php echo $value->l_name; ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control" name="phone" type="text"
                                                                   value="<?php echo $value->phn_no; ?>">
                                                        </div>


                                                    </div>
                                                    <div class="col-lg-6">


                                                        <div class="form-group">
                                                            <label>Present Addres <sup class="required"></sup></label>
                                                            <input type="text" class="form-control" name="addr"
                                                                   value="<?php echo $value->address1; ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Permanent Addres <sup
                                                                        class="required"> </sup></label>
                                                            <input type="text" class="form-control" name="per_addr"
                                                                   value="<?php echo $value->address2; ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Country <sup class="required"> </sup></label>
                                                            <select class="form-control" name="country">
                                                                <option value="">Please select</option>
                                                                <?php foreach (country() as $key => $val) {
                                                                    $sel = ($key == $value->country) ? 'selected' : ''; ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo $sel; ?> ><?php echo $val; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="submit" class="btn btn-default btn btn-primary"
                                                               value="Save" name="add_user"/>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="tab-pane fade pt-4" id="profile" role="tabpanel"
                                             aria-labelledby="profile-tab">
                                            <form role="form" id="add_user" method="post"
                                                  action="<?php print base_url(); ?>/member/profile/account_action">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>User Name <sup class="required">*</sup></label>
                                                            <input class="form-control" name="uname" type="text"
                                                                   value="<?php echo $value->username; ?>"
                                                                   onchange="check_valid_username(this.value)" readonly required>
                                                            <p class="help-block" id="user_valid"></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email <sup class="required">*</sup></label>
                                                            <input class="form-control" name="email" type="email"
                                                                   id="email"
                                                                   value="<?php echo $value->email; ?>"
                                                                   onchange="validate()"
                                                                   required readonly>
                                                            <p class="help-block" id="result"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Password <sup class="required">*</sup></label>
                                                            <input class="form-control" name="pass" type="password"
                                                                   id="txtNewPassword">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm Password <sup
                                                                        class="required">*</sup></label>
                                                            <input class="form-control" name="con_pass" type="password"
                                                                   id="txtConfirmPassword"
                                                                   onChange="checkPasswordMatch();">
                                                        </div>
                                                        <p class="help-block" id="divCheckPasswordMatch"></p>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <input type="submit" class="btn btn-default btn btn-primary"
                                                               value="Save" name=""/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade pt-4" id="contact" role="tabpanel"
                                             aria-labelledby="contact-tab">
                                            <div class="form-group">
                                                <?php $img = (!empty($value->photo)) ? $value->photo : 'images.png'; ?>
                                                <img src="<?php print base_url(); ?>/uploads/user_image/<?php echo $img; ?>"
                                                     width="30%">
                                            </div>
                                            <form role="form" id="add_user" method="post"
                                                  action="<?php print base_url(); ?>/member/profile/photo_action"
                                                  enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label>Photo <sup class="required">*</sup></label>
                                                        <input class="form-control" name="photo" type="file" required>
                                                        <p class="help-block" id="progress_bar">Please put your
                                                            photo</p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input type="submit" class="btn btn-default btn btn-primary"
                                                               value="Save" name=""/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->


<script>

    function get_district(division_id) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/district',
            type: "POST",
            dataType: "text",
            data: {division_id: division_id},
            beforeSend: function () {
                $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                $('#district').html(msg);
            }
        });
    }


    function get_thana(district_id) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/thana',
            type: "POST",
            dataType: "text",
            data: {district_id: district_id},
            beforeSend: function () {
                $('#thana').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                $('#thana').html(msg);
            }
        });
    }


    function get_ward(thana_id) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/ward',
            type: "POST",
            dataType: "text",
            data: {thana_id: thana_id},
            beforeSend: function () {
                $('#ward').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                $('#ward').html(msg);
            }
        });
    }


    function check_username(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/check_username',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#progress_bar').css('color', '#238A09');
                $('#progress_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (message) {
                //$('#progress_bar').html(msg);
                if (message == 0) {
                    $('#progress_bar').html('<span style="color:red">Invalid Username</span>');
                } else {
                    $('#progress_bar').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }


    function check_spon(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#spon_bar').css('color', '#238A09');
                $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');

            },
            success: function (message) {
                //$('#progress_bar').html(msg);
                if (message == 0) {
                    $('#spon_bar').html('<span style="color:red">Invalid Username</span>');
                } else {
                    $('#spon_bar').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }

    function parent_check(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#parent_check').css('color', '#238A09');
                $('#parent_check').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                if (msg == 0) {
                    $('#parent_check').html('<span style="color:red">Invalid Username</span>');
                } else {
                    $('#parent_check').html('<span style="color:green">Valid Username</span>');

                    $.ajax({
                        url: '<?php print base_url(); ?>ajax.html/?check_hand=yes',
                        type: "POST",
                        dataType: "text",
                        data: {username: uname},
                        beforeSend: function () {
                            $('#hand').css('color', '#238A09');
                            $('#hand').html('Progressing...');
                        },
                        success: function (msg) {
                            $('#hand').html(msg);
                        }
                    });

                }
            }
        });

    }


    function check_valid_username(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/check_username',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#user_valid').css('color', '#238A09');
                $('#user_valid').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                if (msg == 1) {
                    $('#user_valid').html('<span style="color:red">Invalid Username</span>');
                } else {
                    $('#user_valid').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }

    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        var message;
        if (password.length < 6) {
            message = '<span style="color:red;">Please input minimum 10 charecters.</span>';
        } else if (password != confirmPassword) {
            message = "<span style='color:red;'>Passwords do not match!</span>";
            $("#txtNewPassword").val('');
        } else {
            message = "<span style='color:green;'>Passwords match.</span>";
        }
        $("#divCheckPasswordMatch").html(message);
    }

</script>