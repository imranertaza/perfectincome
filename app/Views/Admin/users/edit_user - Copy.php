<?php
//$previous_details = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `ID` = '$user_id'"));
$previous_details = $this->db->query("SELECT * FROM `users` WHERE `ID` = '$user_id'")->row();
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit the user</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <div id="success_report">
						<?php print $msg = $this->user_model->edit_user($user_id);
						if ($msg) { ?>
                        <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>user/edit_user/<?php print $previous_details['ID']; ?>.html" />
                        <?php } ?>
                        </div>
                            <div class="row">
                            	<form role="form" id="edit_user" method="post" action="">
                                <div class="col-lg-8">
                                    
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="username" type="text" value="<?php print $previous_details['username']; ?>">
                                            <p class="help-block">Please put your user name</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="text" value="<?php print $previous_details['email']; ?>">
                                            <p class="help-block">Please put your user email (it will be used for login)</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="pass" type="password">
                                            <p class="help-block">Please put first password</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="con_pass" type="password">
                                            <p class="help-block">Please put confirm password</p>
                                        </div>
                                        <div class="form-group">
                                            <label>User role</label>
                                            <select class="form-control" name="role">
                                            	<option value="<?php print $this->functions->get_user_role_by_userid($user_id, 'roleID'); ?>"><?php print $this->functions->get_user_role($user_id); ?></option>
                                            	<?php $this->functions->role_list($user_id);  ?>
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-default btn btn-primary" value="Update" name="edit_user" />
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