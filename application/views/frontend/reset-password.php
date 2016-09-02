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
<h3 id="page-title">Reset Password</h3>
</div>
<div class="login-form tab">
<div id="tab-1" class="tab-content">
<?= form_open( base_url('frontend/reset/reset'), array('id' => 'reset-password-form','enctype'=>"multipart/form-data")); ?>
	<label class="sign-up-form-head-error" id=""><?=isset($error) && !empty($error) ? $error :'' ;?></label>
	<input type="password" placeholder="Password *" name="password" id="password" data-error-id="userPassword" class="staff-signup-input" >
	<span class="reset-pass-form-error" id="userPassword"></span>
	<input type="password" placeholder="Repeat password *" name="con-password" id="con-password" data-error-id="userCon-password" class="staff-signup-input">
	<span class="reset-pass-form-error" id="userCon-password"></span>
	<input type="hidden" name="user_id" value="<?=$userId;?>">
	<button type="button" id="staff-form">Reset </button>
<?=form_close();?>
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
	$('#staff-form').click(function (){
		validForm();
	});
});
	function validForm(){
		var password = $('#password').val();
		var conpassword = $('#con-password').val();
		if(password.trim()==""){
			$('#userPassword').text('Please Enter Password');
			$('#password').focus();
			return false;
		}
		if(password.trim().length <= 7){
			$('#userPassword').text('Please Enter Password Minmum 8 Charactor');
			$('#password').focus();
			return false;
		}
		if(conpassword!==password){
			$('#userCon-password').text('Confirm password not matching from password');
			$('#con-password').focus();
			return false;
		}
		$('#reset-password-form').submit();
	}
</script>
