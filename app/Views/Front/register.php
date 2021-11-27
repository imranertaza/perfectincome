<main id="main" class="no-banner">

    <section id="content" class="content">
        <div class="container" data-aos="fade-up">


            <div class="row">
                <div class="col-lg-5">
                    <h1>Registration</h1>
                    <div class="col-md-12">
                        <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0; if ($message) {  echo $message;  } ?>
                    </div>
                    <form id="regform" role="form" id="add_user" method="post" action="<?php print base_url(); ?>/member_form/register_action">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="fname" id="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" name="uname" id="username" onchange="check_valid_username(this.value)" required class="form-control">
                                    <b id="user_valid"></b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" onchange="validate()" class="form-control" required>
                                    <b id="result"></b>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <span class="float-end"><i class="bi bi-eye-slash"></i></span>
                                    <input type="password" name="pass" id="txtNewPassword" class="form-control" required>
                                    <b class="help-block"></b>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <span class="float-end"><i class="bi bi-eye-slash"></i></span>
                                    <input type="password" name="con_pass" id="txtConfirmPassword" onChange="checkPasswordMatch();" class="form-control" required>
                                    <b id="divCheckPasswordMatch"></b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sponsor">Sponsor ID</label>
                                    <input type="text" name="spon_id" id="sponsor" class="form-control" onchange="check_spon(this.value)" required>
                                    <b id="spon_bar"></b>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="placement">Placement ID</label>
                                    <input name="p_id" type="text"  onchange="parent_check(this.value)" required id="placement" class="form-control">
                                    <b id="parent_check"></b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="hand">Choose hand</label>
                                    <select class="form-control" name="position" id="hand" style="background-color:#3e6278;" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="accept">
                                        <input type="checkbox" name="accept" id="accept" required> I accept the Terms of use and Privacy Policy
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" name="add_user" class="btn btn-submit" value="Register Now">
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



<script>

function check_username(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/?check_username=yes',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#progress_bar').css( 'color','#238A09');
				   $('#progress_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				  //$('#progress_bar').html(msg);
				if (message==0) {
					$('#progress_bar').html('<span style="color:red">Invalid Username</span>');
				}else {
					$('#progress_bar').html('<span style="color:green">Valid Username</span>');
				 }
			 }
	  });
}


function check_spon(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/check_username',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#spon_bar').css( 'color','#238A09');
				   $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				if (message==0) {
					$('#spon_bar').html('<span style="color:red">Invalid Username</span>');
                    document.getElementById('sponsor').value = '';
				}else {
					$('#spon_bar').html('<span style="color:green">Valid Username</span>');
				 }
			 }
	  });
}



function parent_check(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/check_username',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#parent_check').css( 'color','#238A09');
				   $('#parent_check').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				if (msg==0) {
					$('#parent_check').html('<span style="color:red">Invalid Username</span>');
                    document.getElementById('placement').value = '';
				}else {
				  	$('#parent_check').html('<span style="color:green">Valid Username</span>');
					
					$.ajax({
						 url: '<?php print base_url(); ?>/Ajax/check_hand',
						 type: "POST",
						 dataType: "text",
						 data: {username: uname},
						 beforeSend: function(){
							   $('#hand').css( 'color','#ffff');
							   $('#hand').html('Progressing...');
						 },
						 success: function(msg){
							  $('#hand').html(msg);
						 }
				  });
					
				}
			 }
	  });
	  
}



function check_valid_username(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/check_username',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#user_valid').css( 'color','#238A09');
				   $('#user_valid').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  //$('#user_valid').html(msg);
                 if (msg == 1) {
                     $('#user_valid').html('<span style="color:red">Invalid Username</span>');
                     document.getElementById('username').value = '';
                 }else {
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
	if (password.length<6){ message = '<span style="color:red;">Please input minimum 6 charecters.</span>'; }
    else if (password != confirmPassword){
		message = "<span style='color:red;'>Passwords do not match!</span>";
	}
    else {
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
      document.getElementById('email').value = '';
  }
  return false;
}
</script>