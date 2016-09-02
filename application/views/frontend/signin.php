<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
?>
<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
<div class="banner sign-in-banner cf">
<div class="container cf"> 
<div class="sign-in-page cf">
<div class="sign-in-left">
<figure><img src="<?=base_url("assets/front")?>/images/sign-up-left.jpg"></figure>
</div>

<div class="sign-in-right">
<div class="sign-in-title">
<h3 id="page-title">sign in</h3>
</div>
<div class="login-form tab">
<div id="sign-in" class="tab-content">
<?php
	$successReset	= $this->session->flashdata('resetSuccess');
	if(isset($successReset)){
		echo '<label class="reset-pass-success">'.$successReset.'</label>';
	}
	$invalidToken	= $this->session->flashdata('tokenInfo');
	if(isset($invalidToken)){
		echo '<label class="invalid-token">'.$invalidToken.'</label>';
	}
?>
<?= form_open( '', array('id' => 'user-sign-in-form','enctype'=>"multipart/form-data")); ?>
	<label class="sign-in-form-head-error"><?=isset($error) && !empty($error) ? $error :'' ;?></label>
	<input type="text" placeholder="Username *" name="username" id="username" data-error-id="userName" class="staff-signup-input" value="<?=!empty($frontRemUser) ? $frontRemUser : '';?>" >
	<span class="sign-in-form-error" id="userName"></span>
	<input type="password" placeholder="Password *" name="password" id="password" data-error-id="userPassword" class="staff-signup-input" value="<?=!empty($frontRemPass) ? $frontRemPass : '';?>" >
	<span class="sign-in-form-error" id="userPassword"></span>
    <div class="remender">
	<span id="remider-checkbox">
		<input type="checkbox" id="test1" value="1" name="remember" <?=!empty($frontRemUser) ? 'checked' : '';?> />
		<label for="test1">Remember me on this device</label>
	</span>
		<a href="javascript:void(0)" class="forgot" id="forgot-pass-btn">Forgot Password</a>
  	</div>
	<button type="button" id="sign-in-form-btn">Sign IN</button>
<?=form_close();?>
</div>

<div class="forgot-form tab" style="display:none">
<div id="tab-2" class="tab-content">
	<label class="sign-in-form-head-success" id="forgot-head-success-msg">
		<?=isset($error) && !empty($error) ? $error :'' ;?>
	</label>
	<input type="text" placeholder="E-mail *" name="email" id="email" data-error-id="forgot-email" class="forgot-email" >
	<span class="forgot-error" id="forgot-email"></span>
	<button type="submit" id="forgot_password_form">Continue
	 <span ><img src="<?=base_url('assets/front/images/ajax-loader-042310.gif')?>" id="forgot-loader" alt="loader img"></span></button>
</div>
</div>

</div>


</div>


</div>
</div>
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
?>
<script>
$(document).ready( function () {
	$('#forgot-pass-btn').click( function (){
		$('#forgot-head-success-msg').text('');
		$('#page-title').text('Forgot Password');
		$('#sign-in').hide();
		$('.forgot-form').show();
	});

	$('#forgot_password_form').click(function (){
		var email = $('#email').val();
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if(email.trim()==""){
			$('#forgot-email').text('Please Enter email id');
			$('#email').focus();
			return false;
		}
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			$('#forgot-email').text('Please Enter Valid Email Address');
			$('#email').focus();
			return false;
		}
		$('#forgot-loader').show();
		$.post('<?=base_url('frontend/reset/sendForgotPasswordToken');?>',{'email':email}, function (response){
			var data = JSON.parse(response);
			if(data.status=='Yes'){
				$('#forgot-head-success-msg').text(data.msg);
				$('#forgot-email').text('');
				$('#forgot-loader').hide();
			}else{
				$('#forgot-email').text(data.msg);
				$('#forgot-head-success-msg').text('');
				$('#forgot-loader').hide();
			}
		});
	});
	
	$('#email').keypress(function (){
		$('#forgot-email').text('');
	});
	
	$('#sign-in-form-btn').click(function (){
		validForm();
	});
	
});
	function validForm(){
		var username = $('#username').val();
		var password = $('#password').val();
		if(username.trim()==""){
			$('#userName').text('Please Enter Username');
			$('#username').focus();
			return false;
		}
		if(password.trim()==""){
			$('#userPassword').text('Please Enter Password');
			$('#password').focus();
			return false;
		}
		$('#user-sign-in-form').submit();
	}
</script>
