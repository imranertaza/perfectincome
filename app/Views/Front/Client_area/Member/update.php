<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">
            <?php print $sidebar_left; ?>

            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1> Update Profile </h1>
                        <div class="message">
                            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                        </div>

                        <hr/>


                        <div class="panel with-nav-tabs panel-default">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab">General</a></li>
                                <li class=""><a href="#tab3account" data-toggle="tab">Account</a></li>
                                <li class=""><a href="#tab3photo" data-toggle="tab">Photo</a></li>

                            </ul>
                            <?php foreach ($user

                            as  $value) { ?>

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab1default">
                                        <form role="form" id="add_user" method="post" action="<?php print base_url(); ?>/member/profile/general_action">
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
                                                    <label>Present Addres <sup class="required"></sup></label>
                                                    <input type="text" class="form-control" name="addr"
                                                           value="<?php echo $value->address1; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Permanent Addres <sup class="required"> </sup></label>
                                                    <input type="text" class="form-control" name="per_addr"
                                                           value="<?php echo $value->address2; ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Blood group <sup class="required">*</sup></label>
                                                    <select name="b_group" class="form-control">

                                                        <?php print get_list_global_settings('blood_group', $value->blood); ?>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input class="form-control" name="phone" type="text"
                                                           value="<?php echo $value->phn_no; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>National ID </label>
                                                    <input class="form-control" name="nid"
                                                           value="<?php echo $value->nid; ?>" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label>Father Name <sup class="required">*</sup></label>
                                                    <input class="form-control" name="father" type="text"
                                                           value="<?php echo $value->father; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother Name <sup class="required">*</sup></label>
                                                    <input class="form-control" name="mother" type="text"
                                                           value="<?php echo $value->mother; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Religion <sup class="required">*</sup></label>
                                                    <select name="religion" class="form-control">
                                                        <?php print get_list_global_settings('religion', $value->religion); ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-12">
                                                <input type="submit" class="btn btn-default btn btn-primary"
                                                       value="Save" name="add_user"/>
                                            </div>
                                        </form>
                                    </div>



                                    <div class="tab-pane fade in" id="tab3account">
                                        <form role="form" id="add_user" method="post"
                                              action="<?php print base_url(); ?>/member/profile/account_action">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>User Name <sup class="required">*</sup></label>
                                                    <input class="form-control" name="uname" type="text"
                                                           value="<?php echo $value->username; ?>"
                                                           onchange="check_valid_username(this.value)" required>
                                                    <p class="help-block" id="user_valid"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email <sup class="required">*</sup></label>
                                                    <input class="form-control" name="email" type="email" id="email"
                                                           value="<?php echo $value->email; ?>" onchange="validate()"
                                                           required>
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
                                                    <label>Confirm Password <sup class="required">*</sup></label>
                                                    <input class="form-control" name="con_pass" type="password"
                                                           id="txtConfirmPassword" onChange="checkPasswordMatch();">
                                                </div>
                                                <p class="help-block" id="divCheckPasswordMatch"></p>
                                            </div>

                                            <div class="col-lg-12">
                                                <input type="submit" class="btn btn-default btn btn-primary"
                                                       value="Save" name=""/>
                                            </div>
                                        </form>

                                    </div>

                                    <div class="tab-pane fade in" id="tab3photo">
                                        <div class="form-group">
                                            <?php $img = (!empty($value->photo))?$value->photo:'images.png'; ?>
                                            <img src="<?php print base_url(); ?>/uploads/user_image/<?php echo $img; ?>"
                                                 width="30%">
                                        </div>
                                        <form role="form" id="add_user" method="post"
                                              action="<?php print base_url(); ?>/member/profile/photo_action"
                                              enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Photo <sup class="required">*</sup></label>
                                                <input class="form-control" name="photo" type="file" required>
                                                <p class="help-block" id="progress_bar">Please put your photo</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="submit" class="btn btn-default btn btn-primary"
                                                       value="Save" name=""/>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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