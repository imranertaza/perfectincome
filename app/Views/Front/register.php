<section class="content-section" >
        <div class="container-fluid" >
            <div class="row"  >
                    <div class="werp col-md-12" style="background-image: url('<?php print base_url(); ?>/uploads/gallery/gg.jpg');">
                            <div class="container" style="padding: 80px;">
                            <div class="col-md-3"></div>
                                <div class="header inner col-md-12"
                                     style=" background: url('<?php print base_url(); ?>/uploads/gallery/banner6.jpg'); background-repeat: no-repeat; background-size: cover; ">
                                <form id="regform" role="form" id="add_user" method="post" action="<?php print base_url(); ?>/member_form/register_action">
                                    <h3>Registration Form</h3>
                                    <div class="col-md-12">
                                        <?php $error = isset($_SESSION['error']) ? $_SESSION['error'] : 0;
                                        if ($error) { ?>
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $error; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-register">
                                        <div class="form-wrapper">
                                            <label for="">Full Name</label>
                                            <input name="fname" type="text" class="reg" required>
                                        </div>
                                        <div class="form-wrapper">
                                            <label for="">User Name</label>
                                            <input name="uname" id="uname" type="text" onchange="check_valid_username(this.value)" required class=" reg">
                                            <b id="user_valid"></b>
                                        </div>
                                    </div>
                                    <div class="form-wrapper">
                                        <label for="">Email</label>
                                        <input name="email" type="text" id="email" onchange="validate()" class=" reg" required>
                                        <b id="result"></b>
                                    </div>
                                    <div class="form-wrapper">
                                        <label for="">Password</label>
                                        <input name="pass" type="password" id="txtNewPassword" required class=" reg">
                                        <b class="help-block"></b>
                                    </div>
                                    <div class="form-wrapper">
                                        <label for="">Confirm Password</label>
                                        <input name="con_pass" type="password" id="txtConfirmPassword" onChange="checkPasswordMatch();" required class=" reg"><b id="divCheckPasswordMatch"></b>
                                    </div>

                                    <div class="form-register">
                                        <div class="form-wrapper">
                                            <label for="">Pin</label>
                                            <input id="myInput" name="pin" type="text"  onchange="pin_check(this.value)" required class=" reg"><b id="pin_bar"></b>
                                        </div>
                                        <div class="form-wrapper">
                                            <label for="">Sponsor ID</label>
                                            <input name="spon_id" type="text"  onchange="check_spon(this.value)" required class=" reg">
                                            <b id="spon_bar"></b>
                                        </div>
                                    </div>
                                    <div class="form-register">
                                        <div class="form-wrapper">
                                            <label for="">Placement ID</label>
                                            <input name="p_id" type="text"  onchange="parent_check(this.value)" required class=" reg"><b id="parent_check"></b>
                                        </div>
                                        <div class="form-wrapper" >
                                            <label for="">Choose hand</label>
                                            <select class="reg" name="position" id="hand" style="background-color:#3e6278;" required>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" required> I caccept the Terms of Use & Privacy Policy.
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <button type="submit" name="add_user">Register Now</button>
                                </form>
                            </div>
                            <div class="col-md-1"></div>

                    </div>


            </div>
        </div>
    </div>
</section>








<script>

function get_district(division_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_district=yes',
			 type: "POST",
			 dataType: "text",
			 data: {division_id: division_id},
			 beforeSend: function(){
				   $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#district').html(msg);
			 }
	  });
}


function get_thana(district_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_thana=yes',
			 type: "POST",
			 dataType: "text",
			 data: {district_id: district_id},
			 beforeSend: function(){
				   $('#thana').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#thana').html(msg);
			 }
	  });
}


function get_ward(thana_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_ward=yes',
			 type: "POST",
			 dataType: "text",
			 data: {thana_id: thana_id},
			 beforeSend: function(){
				   $('#ward').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#ward').html(msg);
			 }
	  });
}



function check_username(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
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
				}else {
					$('#spon_bar').html('<span style="color:green">Valid Username</span>');
				 }
			 }
	  });
}
//Pin Check
function pin_check(pin){
	  $.ajax({
			 url: '<?php print base_url(); ?>/Ajax/check_pin',
			 type: "POST",
			 dataType: "text",
			 data: {pin: pin},
			 beforeSend: function(){
				   $('#pin_bar').css( 'color','#238A09');
				   $('#pin_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				if (message == 0) {
					$('#pin_bar').html('<span style="color:red">Invalid pin</span>');
					document.getElementById('myInput').value = ''
				}else {
					$('#pin_bar').html('<span style="color:green">Valid pin</span>');
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
				  $('#user_valid').html(msg);
                 if (msg == 1) {
                     $('#user_valid').html('<span style="color:red">Invalid Username</span>');
                     document.getElementById('uname').value = '';
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




<!--<script>

function get_district(division_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_district=yes',
			 type: "POST",
			 dataType: "text",
			 data: {division_id: division_id},
			 beforeSend: function(){
				   $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#district').html(msg);
			 }
	  });
}


function get_thana(district_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_thana=yes',
			 type: "POST",
			 dataType: "text",
			 data: {district_id: district_id},
			 beforeSend: function(){
				   $('#thana').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#thana').html(msg);
			 }
	  });
}


function get_ward(thana_id) {
	$.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_ward=yes',
			 type: "POST",
			 dataType: "text",
			 data: {thana_id: thana_id},
			 beforeSend: function(){
				   $('#ward').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#ward').html(msg);
			 }
	  });
}


function check_referal(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
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
			 url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#spon_bar').css( 'color','#238A09');
				   $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(message){
				  //$('#progress_bar').html(msg);
				if (message==0) {
					$('#spon_bar').html('<span style="color:red">Invalid Username</span>');
				}else {
					$('#spon_bar').html('<span style="color:green">Valid Username</span>');
				 }
			 }
	  });
}

function parent_check(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_username=yes',
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
				}else {
				  	$('#parent_check').html('<span style="color:green">Valid Username</span>');
					
					$.ajax({
						 url: '<?php print base_url(); ?>ajax.html/?check_hand=yes',
						 type: "POST",
						 dataType: "text",
						 data: {username: uname},
						 beforeSend: function(){
							   $('#hand').css( 'color','#238A09');
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



function check_username(uname){
	  $.ajax({
			 url: '<?php print base_url(); ?>ajax.html/?check_valid_username=yes',
			 type: "POST",
			 dataType: "text",
			 data: {username: uname},
			 beforeSend: function(){
				   $('#user_valid').css( 'color','#238A09');
				   $('#user_valid').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
			 },
			 success: function(msg){
				  $('#user_valid').html(msg);
			 }
	  });
}


// Password and confirm password
function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
	var message;
	if (password.length<6){ message = '<span style="color:red;">Please input minimum 10 charecters.</span>'; }
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
  }
  return false;
}
</script>-->
