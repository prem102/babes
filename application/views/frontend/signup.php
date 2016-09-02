<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
?>
<!--<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>-->
<div class="banner sign-up-banner cf">
<div class="container cf"> 
<div class="sign-up-page cf">
<div class="sign-up-left">
<figure><img src="<?=base_url("assets/front")?>/images/sign-up-left.jpg"></figure>
</div>

<div class="sign-up-right">
<ul class="tabs-menu">
  <li class="current"><a href="#tab-1"><figure><img src="<?=base_url("assets/front")?>/images/sign-client.png" alt="image"></figure><span>sign up <br>
as a clients</span></a></li>
	<li><a href="#tab-2"><figure><img src="<?=base_url("assets/front")?>/images/sign-up-tab.png" alt="image"></figure><span> sign up <br>
as a staff</span></a></li>
</ul>
<div class="login-form tab">
<div id="tab-1" class="tab-content">
<?= form_open( base_url('clientSignUp'), array('id' => 'client-sign-up-form','enctype'=>"multipart/form-data")); ?>
	<label class="sign-up-form-head-error" id=""></label>
	<input type="text" placeholder="User Name *" name="username" id="client-username" data-error-id="client-userName" class="client-signup-input" value="<?=set_value('username');?>" >
	<span class="sign-up-form-error" id="client-userName"></span>
	<input type="password" placeholder="Password *" name="password" id="client-password" data-error-id="client-userPassword" class="client-signup-input" value="<?=set_value('password');?>">
	<span class="sign-up-form-error" id="client-userPassword"></span>
	<input type="password" placeholder="Repeat password *" name="con-password" id="client-con-password" data-error-id="client-userCon-password" class="client-signup-input" value="<?=set_value('con-password');?>">
	<span class="sign-up-form-error" id="client-userCon-password"></span>
	<input type="text" placeholder="Email *" name="email" id="client-email" data-error-id="client-userEmail" class="client-signup-input" value="<?=set_value('email');?>">
	<span class="sign-up-form-error" id="client-userEmail"></span>
	<div class="google-captcha1" id="google-captcha2">
	</div>
	<span class="sign-up-form-error" id="client-googleCaptcha"></span>
	<button type="button" id="client-form">Complete Registration</button>
<?= form_close(); ?>
<div class="socal-sign-up">
<h6><span>or</span></h6>
<p>Sign Up your Facebok or Google+ account</p>
<a href="#"><img src="<?=base_url("assets/front")?>/images/face-book-sign.jpg" alt="image">facebook sign up</a>
<a href="#" class="google-plus"><img src="<?=base_url("assets/front")?>/images/google-plus.jpg" alt="image"> google+ sign up</a>
</div>
</div>

<div id="tab-2" class="tab-content">
<?= form_open( current_url(), array('id' => 'staff-sign-up-form','enctype'=>"multipart/form-data")); ?>
	<label class="sign-up-form-head-error" id=""><?=isset($error) && !empty($error) ? $error :'' ;?></label>
	<input type="text" placeholder="User Name *" name="username" id="username" data-error-id="userName" class="staff-signup-input" >
	<span class="sign-up-form-error" id="userName"></span>
	<input type="password" placeholder="Password *" name="password" id="password" data-error-id="userPassword" class="staff-signup-input" >
	<span class="sign-up-form-error" id="userPassword"></span>
	<input type="password" placeholder="Repeat password *" name="con-password" id="con-password" data-error-id="userCon-password" class="staff-signup-input">
	<span class="sign-up-form-error" id="userCon-password"></span>
	<input type="text" placeholder="Email *" name="email" id="email" data-error-id="userEmail" class="staff-signup-input" >
	<span class="sign-up-form-error" id="userEmail"></span>
	<div class="google-captcha1" id="google-captcha1">
	</div>
	<span class="sign-up-form-error" id="googleCaptcha"></span>
	<button type="button" id="staff-form">Complete Registration</button>
<?=form_close();?>
<div class="socal-sign-up">
<h6><span>or</span></h6>
<p>Sign Up your Facebok or Google+ account</p>
<a href="#"><img src="<?=base_url("assets/front")?>/images/face-book-sign.jpg" alt="image">facebook sign up</a>
<a href="#" class="google-plus"><img src="<?=base_url("assets/front")?>/images/google-plus.jpg" alt="image"> google+ sign up</a>
</div>
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

<script language='JavaScript' type='text/javascript'>
 $(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
    
   //****** Custom Validation Staff Registration ******//
	function validForm(){
		var username = $('#username').val();
		var password = $('#password').val();
		var conpassword = $('#con-password').val();
		var email = $('#email').val();
		var catptcha = $('#hiddenRecaptcha').val();
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if(username.trim()==""){
			$('#userName').text('Please Enter Username');
			$('#username').focus();
			return false;
		}
		if(username.trim().length <= 2){
			$('#userName').text('Please Enter Valid Username');
			$('#username').focus();
			return false;
		}
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
		if(email.trim()==""){
			$('#userEmail').text('Please Enter email id');
			$('#email').focus();
			return false;
		}
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			$('#userEmail').text('Please Enter Valid Email Address');
			$('#email').focus();
			return false;
		}
		/*if(recaptcha1.getResponse() == '') {
			$('#googleCaptcha').text('Please fill captcha');
			return false;
		}*/
		$('#staff-sign-up-form').submit();
	}
	$('#staff-form').click(function (){
		validForm();
	});
	
	//****** Custom Validation Client Registration ******//
	function validClientForm(){
		var username = $('#client-username').val();
		var password = $('#client-password').val();
		var conpassword = $('#client-con-password').val();
		var email = $('#client-email').val();
		var catptcha = $('#client-hiddenRecaptcha').val();
		var atpos = email.indexOf("@");
		var dotpos = email.lastIndexOf(".");
		if(username.trim()==""){
			$('#client-userName').text('Please Enter Username');
			$('#client-username').focus();
			return false;
		}
		if(username.trim().length <= 2){
			$('#client-userName').text('Please Enter Valid Username');
			$('#client-username').focus();
			return false;
		}
		if(password.trim()==""){
			$('#client-userPassword').text('Please Enter Password');
			$('#client-password').focus();
			return false;
		}
		if(password.trim().length <= 7){
			$('#client-userPassword').text('Please Enter Password Minmum 8 Charactor');
			$('#client-password').focus();
			return false;
		}
		if(conpassword!==password){
			$('#client-userCon-password').text('Confirm password not matching from password');
			$('#client-con-password').focus();
			return false;
		}
		if(email.trim()==""){
			$('#client-userEmail').text('Please Enter email id');
			$('#client-email').focus();
			return false;
		}
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
			$('#client-userEmail').text('Please Enter Valid Email Address');
			$('#client-email').focus();
			return false;
		}
		/*if(recaptcha2.getResponse() == '') {
			$('#client-googleCaptcha').text('Please fill captcha');
			return false;
		}*/
		$('#client-sign-up-form').submit();
	}
	$('#client-form').click(function (){
		validClientForm();
	});
});

function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
var onloadCallback = function() {
	var recaptcha1;
	var recaptcha2;
	recaptcha1 = grecaptcha.render('google-captcha1', {
		'sitekey' : '6LddxSYTAAAAAL-okkjOuVvvh8PCbUR0foBAGM7g'
	});
	recaptcha2 = grecaptcha.render('google-captcha2', {
		'sitekey' : '6LddxSYTAAAAAL-okkjOuVvvh8PCbUR0foBAGM7g'
	});
}

//****** Remove Validation error on key press ******//
$('.staff-signup-input').keypress(function (){
	var id = $(this).attr('data-error-id');
	$('#'+id).text('');
});


//****** Username checking for unique ******//
$('#username').blur( function (){
	var username = $(this).val();
	var id = $(this).attr('data-error-id');
	var group = $(this).attr('data-user-group');
	if(username.trim()!=""){
		$.post("<?=base_url('frontend/home/checkUserName')?>",{'username':username}, function (response){
			var data = JSON.parse(response);
			if(data.status=='Yes'){
				$('#username').focus();
				$('#'+id).text(data.msg);
			}
		})
	}
});

//****** Email checking for unique ******//
$('#email').blur( function (){
	var userEmail = $(this).val();
	var id = $(this).attr('data-error-id');
	if(userEmail.trim()!=""){
		$.post("<?=base_url('frontend/home/checkUserEmail')?>",{'useremail':userEmail}, function (response){
			var data = JSON.parse(response);
			if(data.status=='Yes'){
				$('#userEmail').focus();
				$('#'+id).text(data.msg);
			}
		})
	}
});

//****** Remove Validation error on key press for client form******//
$('.client-signup-input').keypress(function (){
	var id = $(this).attr('data-error-id');
	$('#'+id).text('');
});


//****** Username checking for unique ******//
$('#client-username').blur( function (){
	var username = $(this).val();
	var id = $(this).attr('data-error-id');
	if(username.trim()!=""){
		$.post("<?=base_url('frontend/home/checkUserName')?>",{'username':username}, function (response){
			var data = JSON.parse(response);
			if(data.status=='Yes'){
				$('#client-username').focus();
				$('#'+id).text(data.msg);
			}
		})
	}
});

//****** Email checking for unique ******//
$('#client-email').blur( function (){
	var userEmail = $(this).val();
	var id = $(this).attr('data-error-id');
	if(userEmail.trim()!=""){
		$.post("<?=base_url('frontend/home/checkUserEmail')?>",{'useremail':userEmail}, function (response){
			var data = JSON.parse(response);
			if(data.status=='Yes'){
				$('#client-userEmail').focus();
				$('#'+id).text(data.msg);
			}
		})
	}
});

</script>
