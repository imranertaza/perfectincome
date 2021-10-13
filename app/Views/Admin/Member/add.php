<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add A New General Member</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form role="form" id="add_user" method="post" action="<?php echo base_url('Admin_area/Member/action')?>" enctype="multipart/form-data">
                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>First Name <sup class="required">*</sup></label>

                                    <input class="form-control" name="fname" type="text" required>
                                    <p class="help-block">Please put your first name</p>
                                </div>
                                <div class="form-group">
                                    <label>Last Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="lname" type="text" required>
                                    <p class="help-block">Please put your last name</p>
                                </div>
                                <div class="form-group">
                                    <label>Present Addres <sup class="required">*</sup></label>
                                    <textarea class="form-control" name="addr" cols="5" rows="3" required></textarea>
                                    <p class="help-block">Please put your address</p>
                                </div>
                                <div class="form-group">
                                    <label>Permanent Addres <sup class="required">*</sup></label>
                                    <textarea class="form-control" name="per_addr" cols="5" rows="3"
                                              required></textarea>
                                    <p class="help-block">Please put your address</p>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" type="text" required>
                                    <p class="help-block">Please put your phone</p>
                                </div>
                                <div class="form-group">
                                    <label>National ID </label>
                                    <input class="form-control" name="nid" type="text">
                                    <p class="help-block">Please put your national ID</p>
                                </div>
                                <div class="form-group">
                                    <label>Father Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="father" type="text" required>
                                    <p class="help-block">Please enter father name</p>
                                </div>
                                <div class="form-group">
                                    <label>Mother Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="mother" type="text" required>
                                    <p class="help-block">Please enter mother name</p>
                                </div>
                                <div class="form-group">
                                    <label>Religion <sup class="required">*</sup></label>
                                    <select name="religion" class="form-control" required>
                                        <option value="0">Choose Religion...</option>
                                        <?php print get_list_global_settings('religion', 0); ?>
                                    </select>
                                    <p class="help-block">Please select the religion</p>
                                </div>
                                <div class="form-group">
                                    <label>Sex <sup class="required">*</sup></label>
                                    <select name="sex" class="form-control" required>
                                        <option value="0">Choose Sex...</option>
                                        <?php print get_list_global_settings('sex', 0); ?>
                                    </select>
                                    <p class="help-block">Please select sex</p>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Blood group <sup class="required">*</sup></label>
                                    <select name="b_group" class="form-control" required>
                                        <option value="0">Choose Blood Group...</option>
                                        <?php print get_list_global_settings('blood_group', 0); ?>
                                    </select>
                                    <p class="help-block">Please select blood group</p>
                                </div>
                                <div class="form-group">
                                    <label>Division <sup class="required">*</sup></label>
                                    <select name="division" class="form-control" onchange="get_district(this.value);"
                                            required>
                                        <option value="0">Choose Division...</option>
                                        <?php print get_location(0); ?>
                                    </select>
                                    <p class="help-block">Please select division</p>
                                </div>
                                <div class="form-group">
                                    <label>District <sup class="required">*</sup></label>
                                    <select name="district" class="form-control" id="district"
                                            onchange="get_thana(this.value);" required>
                                        <option value="0">Select District...</option>
                                    </select>
                                    <p class="help-block">Please select district</p>
                                </div>
                                <div class="form-group">
                                    <label>Upozila <sup class="required">*</sup></label>
                                    <select name="upozila" class="form-control" id="thana"
                                            onchange="get_ward(this.value);" required>
                                        <option value="0">Select Thana/Upazila...</option>
                                    </select>
                                    <p class="help-block">Please select upozila </p>
                                </div>
                                <div class="form-group">
                                    <label>Union/Ward <sup class="required">*</sup></label>
                                    <select name="union" class="form-control" id="ward" required>
                                        <option value="0">Select Union/Ward...</option>
                                    </select>
                                    <p class="help-block">Please select union </p>
                                </div>
                                <div class="form-group">
                                    <label>Postcode <sup class="required">*</sup></label>
                                    <input class="form-control" name="post_code" type="text" required>
                                    <p class="help-block">Please put your post code</p>
                                </div>
                                <div class="form-group">
                                    <label>Sponsor ID</label>
                                    <input class="form-control" name="spon_id" type="text" list="spo_id"
                                           onchange="check_spon(this.value)" required>
                                    <datalist id="spo_id">
                                        <?php print get_username_as_list(); ?>
                                    </datalist>
                                    <p class="help-block" id="spon_bar">Please put your phone</p>
                                </div>
                                <div class="form-group">
                                    <label>Referal ID</label>
                                    <input class="form-control" name="ref_id" type="text" list="ref_id"
                                           onchange="check_username(this.value)" required>
                                    <datalist id="ref_id">
                                        <?php print get_username_as_list(); ?>
                                    </datalist>
                                    <p class="help-block" id="progress_bar">Please put your phone</p>
                                </div>
                                <div class="form-group">
                                    <label>Placement ID</label>
                                    <input class="form-control" name="p_id" type="text" list="parent"
                                           onchange="parent_check(this.value)" required>
                                    <datalist id="parent">
                                        <?php print get_username_as_list(); ?>
                                    </datalist>
                                    <p class="help-block" id="parent_check">Please put your national ID</p>
                                </div>
                                <div class="form-group">
                                    <label>Choose hand</label>
                                    <select class="form-control" name="position" id="hand" required>
                                    </select>
                                    <p class="help-block">Please choose a side to add</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Photo </label>
                                    <input class="form-control" name="photo" type="file" >
                                    <p class="help-block" id="progress_bar">Please put your photo</p>
                                </div>
                                <div class="form-group">
                                    <label>Nominee Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="non" type="text" required>
                                    <p class="help-block" id="progress_bar">Please put nominee name</p>
                                </div>
                                <div class="form-group">
                                    <label>Relationship <sup class="required">*</sup></label>
                                    <select name="relation" class="form-control" required>
                                        <option value="0">Choose One--</option>
                                        <?php print get_list_global_settings('relationship'); ?>
                                    </select>
                                    <p class="help-block" id="progress_bar">Please put nominee relationship</p>
                                </div>
                                <div class="form-group">
                                    <label>Nominee's DOB <sup class="required">*</sup></label>
                                    <input class="form-control" name="nodob" type="date" required>
                                    <p class="help-block" id="progress_bar">Please put nominee's data of birth</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name <sup class="required">*</sup></label>
                                    <select name="banks" class="form-control" required>
                                        <option value="0">Choose Bank...</option>
                                        <?php print bank_list(0); ?>
                                    </select>
                                    <p class="help-block" id="progress_bar">Please put bank name</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Account No <sup class="required">*</sup></label>
                                    <input class="form-control" name="account_no" type="text" required>
                                    <p class="help-block" id="progress_bar">Please put bank account number</p>
                                </div>

                                <div class="form-group">
                                    <label>User Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="uname" type="text"
                                           onchange="check_valid_username(this.value)" required>
                                    <p class="help-block" id="user_valid">Please put username</p>
                                </div>
                                <div class="form-group">
                                    <label>Password <sup class="required">*</sup></label>
                                    <input class="form-control" name="pass" type="password" id="txtNewPassword"
                                           required>
                                    <p class="help-block">Please put password</p>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password <sup class="required">*</sup></label>
                                    <input class="form-control" name="con_pass" type="password" id="txtConfirmPassword"
                                           onChange="checkPasswordMatch();" required>
                                    <p class="help-block" id="divCheckPasswordMatch">Please put confirm password</p>
                                </div>
                                <div class="form-group">
                                    <label>Email <sup class="required">*</sup></label>
                                    <input class="form-control" name="email" type="text" id="email"
                                           onchange="validate()" required>
                                    <p class="help-block" id="result">Please put your user email (it will be used for
                                        login)</p>
                                </div>
                                <input type="submit" class="btn btn-default btn btn-primary" value="Add Member"
                                       name="add_user"/>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
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
                // alert(msg);
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
                //alert(msg);
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
            url: '<?php print base_url(); ?>/Ajax/check_username',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#spon_bar').css('color', '#238A09');
                $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (message) {
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
            url: '<?php print base_url(); ?>/Ajax/check_username',
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
                        url: '<?php print base_url(); ?>/Ajax/check_hand',
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


    //function check_valid_username(uname) {
    //    $.ajax({
    //        url: '<?php //print base_url(); ?>///Ajax/check_username',
    //        type: "POST",
    //        dataType: "text",
    //        data: {username: uname},
    //        beforeSend: function () {
    //            $('#user_valid').css('color', '#238A09');
    //            $('#user_valid').html('<img src="<?php //print base_url(); ?>///assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
    //        },
    //        success: function (msg) {
    //            if (msg == 0) {
    //                $('#user_valid').html('<span style="color:red">Invalid Username</span>');
    //            } else {
    //                $('#user_valid').html('<span style="color:green">Valid Username</span>');
    //            }
    //
    //
    //        }
    //    });
    //}


    // Password and confirm password
    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        var message;
        if (password.length < 6) {
            message = '<span style="color:red;">Please input minimum 10 charecters.</span>';
        } else if (password != confirmPassword) {
            message = "<span style='color:red;'>Passwords do not match!</span>";
        } else {
            message = "<span style='color:green;'>Passwords match.</span>";
        }
        $("#divCheckPasswordMatch").html(message);
    }


    // Email validation
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function validate() {
        var email = $("#email").val();
        if (validateEmail(email)) {
            $("#result").text(email + " is valid");
            $("#result").css("color", "green");
        } else {
            $("#result").text(email + " is not valid");
            $("#result").css("color", "red");
        }
        return false;
    }
</script>

