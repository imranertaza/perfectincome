<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit The General Member</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <form method="post" action="<?php echo base_url('Admin_area/Member/update') ?>"
                              enctype="multipart/form-data">
                            <div class="col-lg-4">

                                <div class="form-group">
                                    <label>First Name <sup class="required">*</sup></label>
                                    <input class="form-control" value="<?php print $row->f_name; ?>" name="fname"
                                           type="text" required>
                                    <p class="help-block">Please put your first name</p>
                                </div>
                                <div class="form-group">
                                    <label>Last Name <sup class="required">*</sup></label>

                                    <input class="form-control" value="<?php print $row->l_name; ?>" name="lname"
                                           type="text" required>
                                    <p class="help-block">Please put your last name</p>
                                </div>
                                <div class="form-group">
                                    <label>Present Addres <sup class="required">*</sup></label>
                                    <textarea class="form-control" name="addr" cols="5" rows="3"
                                              required><?php print $row->address1; ?></textarea>
                                    <p class="help-block">Please put your address</p>
                                </div>
                                <div class="form-group">
                                    <label>Permanent Addres <sup class="required">*</sup></label>
                                    <textarea class="form-control" name="per_addr" cols="5" rows="3"
                                              required><?php print $row->address2; ?></textarea>
                                    <p class="help-block">Please put your address</p>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input value="<?php print $row->phn_no; ?>" class="form-control" name="phone"
                                           type="text" required>
                                    <p class="help-block">Please put your phone</p>
                                </div>
                                <div class="form-group">
                                    <label>National ID </label>
                                    <input value="<?php print $row->nid; ?>" class="form-control" name="nid"
                                           type="text">
                                    <p class="help-block">Please put your national ID</p>
                                </div>
                                <div class="form-group">
                                    <label>Father Name <sup class="required">*</sup></label>
                                    <input class="form-control" value="<?php print $row->father; ?>" name="father"
                                           type="text" required>
                                    <p class="help-block">Please enter father name</p>
                                </div>
                                <div class="form-group">
                                    <label>Mother Name <sup class="required">*</sup></label>
                                    <input value="<?php print $row->mother; ?>" class="form-control" name="mother"
                                           type="text" required>
                                    <p class="help-block">Please enter mother name</p>
                                </div>
                                <div class="form-group">
                                    <label>Religion <sup class="required">*</sup></label>
                                    <select name="religion" class="form-control" required>
                                        <?php print get_list_global_settings('religion', $row->religion); ?>
                                    </select>
                                    <p class="help-block">Please select the religion</p>
                                </div>
                                <div class="form-group">
                                    <label>Sex <sup class="required">*</sup></label>
                                    <select name="sex" class="form-control" required>
                                        <option value="0">Choose Sex...</option>
                                        <?php print get_list_global_settings('sex', $row->sex); ?>
                                    </select>
                                    <p class="help-block">Please select sex</p>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Blood group <sup class="required">*</sup></label>
                                    <select name="b_group" class="form-control" required>
                                        <option value="0">Choose Blood Group...</option>
                                        <?php print get_list_global_settings('blood_group', $row->blood); ?>
                                    </select>
                                    <p class="help-block">Please select blood group</p>
                                </div>
                                <div class="form-group">
                                    <label>Division <sup class="required">*</sup></label>
                                    <select name="division" class="form-control" onchange="get_district(this.value);"
                                            required>
                                        <?php print get_division($row->division); ?>
                                    </select>
                                    <p class="help-block">Please select division</p>
                                </div>
                                <div class="form-group">
                                    <label>District <sup class="required">*</sup></label>
                                    <select name="district" class="form-control" id="district"
                                            onchange="get_thana(this.value);" required>
                                        <?php echo get_district($row->district,$row->division);?>
                                    </select>
                                    <p class="help-block">Please select district</p>
                                </div>
                                <div class="form-group">
                                    <label>Upozila <sup class="required">*</sup></label>
                                    <select name="upozila" class="form-control" id="thana"
                                            onchange="get_ward(this.value);" required>
                                        <?php echo get_upozila($row->upozila,$row->district);?>
                                    </select>
                                    <p class="help-block">Please select upozila </p>
                                </div>
                                <div class="form-group">
                                    <label>Union/Ward <sup class="required">*</sup></label>
                                    <select name="union" class="form-control" id="ward" required>
                                        <?php echo get_upozila($row->union,$row->upozila);?>
                                    </select>
                                    <p class="help-block">Please select union </p>
                                </div>
                                <div class="form-group">
                                    <label>Postcode <sup class="required">*</sup></label>
                                    <input class="form-control" name="post_code" type="text"
                                           value="<?php print $row->post; ?>" required>
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
                                    <input class="form-control" name="photo" type="file">
                                    <p class="help-block" id="progress_bar">Please put your photo</p>
                                </div>
                                <div class="form-group">
                                    <label>Nominee Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="non" value="<?php print $row->nominee; ?>"
                                           type="text" required>
                                    <p class="help-block" id="progress_bar">Please put nominee name</p>
                                </div>
                                <div class="form-group">
                                    <label>Relationship <sup class="required">*</sup></label>
                                    <select name="relation" class="form-control" required>
                                        <option value="0">Choose One--</option>
                                        <?php print get_list_global_settings('relationship', $row->relationship ); ?>
                                    </select>
                                    <p class="help-block" id="progress_bar">Please put nominee relationship</p>
                                </div>
                                <div class="form-group">
                                    <label>Nominee's DOB <sup class="required">*</sup></label>
                                    <input class="form-control" name="nodob" type="date" value="<?php print $row->nom_dob; ?>" required>
                                    <p class="help-block" id="progress_bar">Please put nominee's data of birth</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name <sup class="required">*</sup></label>
                                    <select name="banks" class="form-control" required>
                                        <option value="0">Choose Bank...</option>
                                        <?php print bank_list($row->bank_name); ?>
                                    </select>
                                    <p class="help-block" id="progress_bar">Please put bank name</p>
                                </div>
                                <div class="form-group">
                                    <label>Bank Account No <sup class="required">*</sup></label>
                                    <input class="form-control" name="account_no"
                                           value="<?php print $row->account_no; ?>" type="text" required>
                                    <p class="help-block" id="progress_bar">Please put bank account number</p>
                                </div>

                                <div class="form-group">
                                    <label>User Name <sup class="required">*</sup></label>
                                    <input class="form-control" name="uname" type="text"
                                           onchange="check_valid_username(this.value)"
                                           value="<?php print $row->username; ?>" required>
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
                                           onchange="validate()" value="<?php print $row->email; ?>" required>
                                    <input name="id" type="hidden" value="<?php print $row->ID; ?>" required>
                                    <p class="help-block" id="result">Please put your user email (it will be used for
                                        login)</p>
                                </div>
                                <input type="submit" class="btn btn-default btn btn-primary" value="Update Member"
                                       name="edit_user"/>
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
                // $('#user_valid').html(msg);
                if (msg == 0) {
                    $('#user_valid').html('<span style="color:red">Invalid Username</span>');
                } else {
                    $('#user_valid').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }


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

    function validate(){
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

<!--<script>
	function add_user(){
   var error = 0;    

   var username = $('[name=username]').val();
   if(!username){
    $('[name=username]').css('background-color','#ffffc5').css('border','1px solid #f00');
    error = 1;
   }else{
    $('[name=username]').css('border','1px solid #999').css('background-color','#FFF');
   }
   
   var email = $('[name=email]').val();
   if(!email){
    $('[name=email]').css('background-color','#ffffc5').css('border','1px solid #f00');
    error = 1;
   }else{
    $('[name=email]').css('border','1px solid #999').css('background-color','#FFF');
   }
   
   var pass = $('[name=pass]').val();
   if(!pass){
    $('[name=pass]').css('background-color','#ffffc5').css('border','1px solid #f00');
    error = 1;
   }else{
    $('[name=pass]').css('border','1px solid #999').css('background-color','#FFF');
   }
   
   var con_pass = $('[name=con_pass]').val();
   if(!con_pass){
    $('[name=con_pass]').css('background-color','#ffffc5').css('border','1px solid #f00');
    error = 1;
   }else{
    $('[name=con_pass]').css('border','1px solid #999').css('background-color','#FFF');
   }
   
   var role = $('[name=role]').val();
   if(!role){
    $('[name=role]').css('background-color','#ffffc5').css('border','1px solid #f00');
    error = 1;
   }else{
    $('[name=role]').css('border','1px solid #999').css('background-color','#FFF');
   }
   
     
   if(!error){
		
		

		var formData = $('#add_user').serialize();
		$.ajax({
			url: '<?php print base_url(); ?>ajax_files/user_functions.php?add_user=yes',
			type: "POST",
			//dataType: "text", need check with multi part for image upload
			data: formData,
			beforeSend: function(){
				$('#success_report').html('Loading...');	
			},
			success: function(msg){		
				$( "#success_report" ).slideDown('slow').html( msg );
				
				setTimeout(function() {
						$( "#success_report" ).hide('slow').html( msg );	
					}, 2000);
				
			}
		});
		
		
	}
}
</script>-->