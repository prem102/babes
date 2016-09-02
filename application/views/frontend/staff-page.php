<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
?>
<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
<div class="banner sign-in-banner cf">
<div class="container cf"> 
<div class="sign-in-page cf">


<div class="sign-in-right">
<div class="sign-in-title">
<h3>Staff</h3>
</div>
<div class="login-form tab">
<div id="tab-1" class="tab-content">
Hello 
<?php
	echo !empty($userName) ? '<strong>'.ucfirst($userName).'</strong>' : '';
?>
<a href="<?=base_url('logout');?>"><strong>Logout</strong></a>

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
