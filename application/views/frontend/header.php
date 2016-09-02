<body <?=(isset($resetHeaderClass) && !empty($resetHeaderClass)) ? 'class="'.$resetHeaderClass.'"' :''?>>
<div class="wrapper">
<!--<div class="container"> -->
<header class="cf">
<div class="logo"><a href="<?= base_url().'index';?>"><img src="<?=base_url("assets/front/")?>/images/logo.png" alt="logo" /></a></div>
<div class="nav"><ul><li><a href="<?= base_url().'index';?>"><span><img src="<?=base_url("assets/front/")?>/images/home-icon.png" alt="image"></span>Home</a></li>
<li><a href="<?= base_url('stafflist/girls')?>"><span><img src="<?=base_url("assets/front/")?>/images/home-icon2.png" alt="image"></span>Girls</a></li>
<li><a href="<?= base_url('stafflist/guys')?>"><span><img src="<?=base_url("assets/front/")?>/images/home-icon3.png" alt="image"></span>Guys</a></li>
<li><a href="#"><span><img src="<?=base_url("assets/front/")?>/images/home-icon4.png" alt="image"></span>How it Works</a></li>
<li><a href="#"><span><img src="<?=base_url("assets/front/")?>/images/home-icon5.png" alt="image"></span>Contact</a></li></ul>

</div>
<div class="login-section">
	<?php
		$userDetail	= logginUserBasicInfo();
	
		if($userDetail){
			if($userDetail->group_id =='3'){
			$userName	= ($userDetail->display_name)?$userDetail->display_name:($userDetail->userName)?$userDetail->userName:$userDetail->name;
			$userImage	= !empty($userDetail->image) ? $userDetail->image : 'client-img-pro.jpg';
	?>
	<span class="heart-bg add-to-cart-hedd2"><a  href="#" >02</a></span>
	<span class="notification-num-area" onclick="myyFunction()">
		<a href="#"><img src="<?=base_url("assets/front/")?>/images/notification-img-ico.png" alt="image">
		<span class="notification-num">1</span>
		</a>
	<div class="notification-drop-down1" id="notification-drop-down">
		<a href="#"> <div class="notifile-msg-det">
			<div class="noti-profile-pic">
				<img src="<?=base_url("assets/front/")?>/images/notification-profile-img.png" alt="image">
			</div>
			<div class="notife-mg-area">
				 <h6>Christina Robertson</h6>
				 <p> mentioned you in a comment.</p>
			</div>
			</div>
		</a>
	</div>
	</span>
	<div class="dropdown">
		<a href="javascript:void(0)" onclick="myFunction()" class="dropbtn">
			<img src="<?=base_url('assets/front/clients/'.$userImage)?>" alt="image" class="login-profile-image">
			<?=short_content($userName,12);?>
		</a>
	  <div id="myDropdown" class="dropdown-content">
		<ul>
		<li><a href="#home">my order</a></li>
		<li><a href="#contact">history</a></li>
		<li><a href="#contact">account setting</a></li>
		</ul>
		<div class="log-out">
			<a href="<?=base_url('logout');?>">
			<img src="<?=base_url("assets/front/")?>/images/log-out-btn-ico.png" alt="image"> log out</a>
		</div>
	  </div>
	</div>
	<?php 
		}
		
		if($userDetail->group_id =='2'){
			$userName	= ($userDetail->display_name)?$userDetail->display_name:($userDetail->userName)?$userDetail->userName:$userDetail->name;
			$userImage	= !empty($userDetail->image) ? $userDetail->image : 'client-img-pro.png';
	?>
	
	<span class="girls-job-price-head">
    	<span class="girls-job-credit">credit</span>
		
		<span class="gils-job-doler"><img src="<?=base_url("assets/front/")?>/images/girls-jobs-doller.png" alt="image"> 250</span>
		
	</span>
	<div class="dropdown dropdown-gils-job">
		<a href="javascript:void(0)" onclick="myFunction()" class="dropbtn">
			<img src="<?=base_url('assets/front/users_images/'.$userImage)?>" alt="image" class="login-profile-image">
			<?=short_content($userName,12);?>
		</a>
	  <div id="myDropdown" class="dropdown-content">
		<ul>
        <li><a href="#home">view profile</a></li>
		<li><a href="#home">reports</a></li>
		<li><a href="#contact">edit availability</a></li>
		<li><a href="#contact">account setting</a></li>
		</ul>
		<div class="log-out">
			<a href="<?=base_url('logout');?>">
			<img src="<?=base_url("assets/front/")?>/images/log-out-btn-ico.png" alt="image"> log out</a>
		</div>
	  </div>
	</div>
	<?php 
		}
		}else{
	?>
<span class="heart-bg heart-bg1"><a  href="#">02</a></span>
<span class="sign-in"><a  href="<?= base_url().'signin';?>"><span class="icon"><img src="<?=base_url("assets/front/")?>/images/lock-icon.png" alt="image"></span>sign in</a></span>
<span class="sign-up"><a  href="<?= base_url().'signup';?>"><span class="icon"><img src="<?=base_url("assets/front/")?>/images/key-icon.png" alt="image"></span>sign up</a></span>
<span class="book-now"><a  href="#">Book Now</a></span>
	<?php
		}
	?>
</div><!--logon-section -->
</header><!--header -->
<script type='text/javascript' src='http://192.168.1.227/babesdirect/assets/front/js/jquery-1.12.3.min.js'></script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
	
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


</script>
<script>
$(document).ready(function(){
	$(".notification-num-area").click(function(e){
		e.stopPropagation();
		$(".notification-drop-down1").slideToggle();
	});
	
	$('.notification-drop-down1').click(function(e){
		e.stopPropagation();
	});
	
	$(".msg-me h4").click(function(){
		$(".msg-write-area").slideToggle();
	});
});
$(document).click(function(){
	$('.notification-drop-down1').slideUp();
})
</script>
