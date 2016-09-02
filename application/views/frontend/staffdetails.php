<?php
	$this->load->view('frontend/top');
	$this->load->view('frontend/header');
?>
<div class="banner banner-bg-image">

</div><!--banner -->

<div class="girl-details cf">
<div class="container cf">
<div class="girl-details-left">
<div class="girl-dtails-slide">
<div id="slider" class="flexslider">
	<ul class="slides">
	<?php
		if(!empty($userImages) && is_array($userImages)){
			foreach($userImages as $userImage){
	?>
	<li>
	  <img src="<?=base_url('assets/front/users_images/'.$userImage)?>" />
	</li>
	<?php
			}
		}else{
	?>
	<li>
		<img src="<?=base_url('assets/front/users_images/'.$profileImage)?>" />
	</li>
	<?php
		}
	?>
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>
<div id="carousel" class="flexslider">
	<ul class="slides">
	<?php
		if(!empty($userImages) && is_array($userImages)){
			foreach($userImages as $userImage){
	?>
	<li>
	  <img src="<?=base_url('assets/front/users_images/'.$userImage)?>" />
	</li>
	<?php
			}
		}else{
	?>
	<li>
		<img src="<?=base_url('assets/front/users_images/'.$profileImage)?>" />
	</li>
	<?php
		}
	?>
    <!-- items mirrored twice, total of 12 -->
  </ul>
</div>
</div>
<div class="about-girl-descprition">
<h2><?=$userInfo->userName;?></h2>
<ul>
<?php
	if(!empty($userDetails->age)){
		echo '<li><span>Age:</span><span class="girl-dtl">'.$userDetails->age.'</span></li>';
	}
	if(!empty($userDetails->gender)){
		echo '<li><span>Gender:</span><span class="girl-dtl">'.$userDetails->gender.'</span></li>';
	}
	
	if(!empty($userDetails->eyeColor)){
		echo '<li><span>Eye Color:</span><span class="girl-dtl">'.$userDetails->eyeColor.'</span></li>';
	}
	
	if(!empty($userDetails->hairColor)){
		echo '<li><span>Hair:</span><span class="girl-dtl">'.$userDetails->hairColor.'</span></li>';
	}
	if(!empty($userDetails->height)){
		echo '<li><span>Height:</span><span class="girl-dtl">'.$userDetails->height.'</span></li>';
	}
	if(!empty($userDetails->bodyType)){
		echo '<li><span>Body Type:</span><span class="girl-dtl">'.$userDetails->bodyType.'</span></li>';
	}
	if(!empty($userDetails->bustSize)){
		echo '<li><span>Bust Size:</span><span class="girl-dtl">'.$userDetails->bustSize.'</span></li>';
	}
	
	if(!empty($userDetails->dress_size)){
		echo '<li><span>Dress Size:</span><span class="girl-dtl">'.$userDetails->dress_size.'</span></li>';
	}
	if(!empty($useraddress)){
		echo '<li><span>Locate:</span><span class="girl-dtl">'.$useraddress->city.' , '.$useraddress->state.'</span></li>';
	}
?>

</ul>
<div class="girl-details-service">
	<?php
		if(!empty($userServices) && is_array($userServices)){
	?>
<h4>Services</h4>
<ul>
	<?php
		foreach($userServices as $service){
			if($service->service_type==0){
	?>
<li><span><?=!empty($service->service) ? $service->service : "" ;?></span> $<?=$service->price;?></li>
	<?php
			}
		}
	?>
</ul>

</div>
<?php
		}
	if(!empty($userServices)){
?>
<div class="girl-details-service">
<h4>extra</h4>
<ul>
	<?php
	$count = 0;
		foreach($userServices as $service){
			if($service->service_type==1){
				$count ++;
	?>
<li><span><?=!empty($service->service) ? $service->service : "" ;?></span> $<?=$service->price;?></li>
	<?php
			}
		}
	if($count == 0){
		echo '<li><span>Not Available</span></li>';
	}
	?>
</ul>

</div>
<?php } ?>
</div>

</div>
<div class="girl-details-right">
	<div class="availabilty-calendar">
    	<h3><img src="<?=base_url("assets/front")?>/images/avlaiblty-clenader.png" alt="image">Availability Calendar</h3>
    </div>
    <div class="date-area-availabilty">
    	<h4>7 july - 13 july 2016</h4>
        <span class="date-slide"><a href="#"><img src="<?=base_url("assets/front/images/arrow-left-date-slide1.png")?>" alt="image"></a><a href="#">
        <img src="<?=base_url("assets/front/images/arrow-right-date-slide1.png")?>" alt="image"></a>
        </span>
    </div>
    <div class="availbily-calendar-main cf">
    	<a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>7</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder"><div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>8</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>9</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>10</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>11</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>12</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="pop-clnder">
        <div class="availbily-calendar-date-box">
        	<h3>sun</h3>
            <h5>13</h5>
            <div class="time-schedule cf">
            	<h4><span><img src="<?=base_url("assets/front")?>/images/shadule-icone.png" alt="image"></span>time schedule</h4>
            </div>
        </div>
        </a>
        <div class="availbily-calendar-date-box next1">
        	<h6>next week <img src="<?=base_url("assets/front")?>/images/next-arrow-shdule.png" alt="image"></h6>
            
        </div>
        <a href="#">add to cart</a>
    </div>
</div>
</div><!--container -->
</div><!--girl-details -->
<div class="review-outer cf">
<div class="container">
<div class="reviews">
<div class="about-review">

<ul class="tabs-menu">
	<li class="current">
		<a href="#tab-1">about me</a>
	</li>
	<li>
		<a href="#tab-2">reviews</a>
	</li>
</ul>

<div class="connect">
<span>Connect with me</span>
<ul><li><a href="#"><img src="<?=base_url("assets/front")?>/images/face-book-icone.png" alt="image"></a></li> <li><a href="#"><img src="<?=base_url("assets/front")?>/images/linked.png" alt="image"></a></li><li><a href="#"><img src="<?=base_url("assets/front")?>/images/twitter.png" alt="image"></a></li></ul>
</div>
</div>
<div class="reviews-decp tab">
<!--****** Staff Description *****-->
 <div id="tab-1" class="tab-content">
	<?=!empty($userInfo->description) ? '<p>'.$userInfo->description.'</p>' : '';?>
</div>
<!--****** Client Reviews *****-->
<div id="tab-2" class="tab-content review-tab">
	<?php
		if(!empty($reviews) && is_array($reviews)){
			foreach($reviews as $review){
				echo '<h3>Kapil Tyagi<span>*****</span></h3>';
				echo !empty($review->comments) ? '<p>'.$review->comments.'</p>' : '';
			}
		}
	?>
</div>
</div>
<div class="socal-area-fb-tw">
	<div class="facebook-area">
    	<h3><span>Facebook</span></h3>
        <img src="<?=base_url("assets/front")?>/images/face-book.jpg" alt="image">
    </div>
    <div class="facebook-area tweets-area">
    	<h3><span>tweets</span></h3>
        <img src="<?=base_url("assets/front")?>/images/tweeter.jpg" alt="image">
    </div>
</div>
</div>
<div class="instagram">
<?php
	if(!empty($userVideos) && is_array($userVideos)){
?>
<h3><span>watch my videos</span></h3>
<div id="carouse2" class="flexslider">
<ul class="slides">
	<?php
		foreach($userVideos as $userVideo){
			if($userVideo){
				$url = explode('v=',$userVideo);
				echo $url = $url[1];
				if($url){
					echo '<li>
							<a href="javascript:void(0)" class="videopath"  data-toggle="modal" data-target="#myModal-url" value="'.$url.'">
								<img src="http://img.youtube.com/vi/'.$url.'/maxresdefault.jpg" alt="video" id="videos"/> 
								<img src="'.base_url('assets/front/images/play.png').'"  class="icon_position"/>
							</a>
						</li>';
				}
			}
		}
	?>
</ul>
</div>
<?php
	}
?>
<div class="instagram-img">
	<h3><span>Instagram</span></h3>
	<img src="<?=base_url("assets/front/images/instgram-gallery-img.jpg")?>" alt="image">
</div>
</div>
</div>
</div>

<div class="Browse-our">
	<?php
		if(!empty($recentlyViewStaff) && is_array($recentlyViewStaff)){
	?>
<div class="container">
<h3><span><img src="<?=base_url("assets/front")?>/images/left-star.png"></span>Browse our other girls<span><img src="<?=base_url("assets/front")?>/images/right-star.png"></span></h3>
<p class="center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer</p>
<div class="main">
<?php
	foreach($recentlyViewStaff as $featuredGirl){
		$name = !empty($featuredGirl->userName) ? $featuredGirl->userName : '' ;
		$userImg = !empty($featuredGirl->image) ? $featuredGirl->image : 'natalia.jpg' ;
		$city = !empty($featuredGirl->city) ? $featuredGirl->city : '' ;
		$minPrice = getStaffMinServicePrice($featuredGirl->userId);
		$services = getStaffServices($featuredGirl->userId);
?>
	<div class="view view-eighth">
		<img src="<?=base_url("assets/front/users_images")?>/<?=$userImg;?>">
		<div class="name"><?=$name;?></div>
		<div class="age"><?=$city;?></div>
		<div class="mask">
			<span class="form-rate">from $<?=$minPrice;?></span>
						<ul>
							<?php
								if(!empty($services) && is_array($services)){
									foreach($services as $service){
							?>
							<li>
								<span>
									<img src="<?=base_url("assets/front/")?>/images/star.png">
								</span><?=$service->name;?>
							</li>
							<?php
									}
								}
							?>
						</ul>
						 <a class="book_now" href="#">book now</a>
						<a class="info" href="<?=base_url('staffs/'.$featuredGirl->username);?>"><?=$city;?> WAITRESS profile</a>
		</div>
	</div>
<?php } ?>
</div>

</div><!--container -->
<?php } ?>
</div>
<!-- Popup Modal Video -->
<div class="modal fade" id="myModal-url" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
	<div class="col-lg-12">
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-12 form-section-part frm-group">
					<div class="form-group">
						<div class="form-video">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-clender">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="<?=base_url("assets/front/images/close-clen-pop.png")?>" alt="image"> </span>
        </button>
        <h4 class="modal-title">Availability Calendar <img src="<?=base_url("assets/front/images/avlaiblty-clenader.png")?>" alt="image"> </h4>
      </div>
      <div class="modal-body">
      <div class="date-slide-main">
        <h3>7th Sun, July 2016 </h3>
        <span class="date-slide"><a href="#"><span aria-hidden="true"><img src="<?=base_url("assets/front/images/arrow-left-date-slide.png")?>" alt="image"></a><a href="#"><span aria-hidden="true">
        <img src="<?=base_url("assets/front/images/arrow-right-date-slide.png")?>" alt="image"></a></span>
        </span>
      </div>
      <div class="my-clander-avlabilty">
      		<h4>My Availability</h4>
            <ul class="avllabilty-img">
            	<li><img src="<?=base_url("assets/front/images/avlable-icone1.png")?>" alt="image"> Availabile </li>
                <li><img src="<?=base_url("assets/front/images/bocked-icone1.png")?>" alt="image"> Booked</li>
                <li><img src="<?=base_url("assets/front/images/travel-icone1.png")?>" alt="image"> Travel Time</li>
            </ul>
            <div class="avliblity-clander-main cf">
            	<ul class="cf">
                	<li>1:00 <span>am</span></li>
                    <li class="travel-time">2:00 <span>am</span></li>
                    <li class="travel-time">3:00 <span>am</span></li>
                    <li class="bocked-date">4:30 <span>am</span></li>
                    <li class="bocked-date">5:30 <span>am</span></li>
                    <li class="travel-time">6:00 <span>am</span></li>
                    <li class="travel-time">7:00 <span>am</span></li>
                    <li>8:00 <span>am</span></li>
                    <li>9:00 <span>am</span></li>
                    <li>10:00 <span>am</span></li>
                    <li>11:00 <span>am</span></li>
                    <li>12:00 <span>am</span></li>
                    <li>1:00 <span>pm</span></li>
                    <li>2:00 <span>pm</span></li>
                    <li>3:00 <span>pm</span></li>
                    <li>4:00 <span>pm</span></li>
                    <li>5:00 <span>pm</span></li>
                    <li>6:00 <span>pm</span></li>
                    <li class="bocked-date">7:00 <span>pm</span></li>
                    <li class="bocked-date">8:00 <span>pm</span></li>
                    <li class="bocked-date">9:00 <span>pm</span></li>
                    <li>10:00 <span>pm</span></li>
                    <li>11:00 <span>pm</span></li>
                    <li>12:00 <span>pm</span></li>
                    
                </ul>
                
                <div class="date-picker-main cf">
                	<label>choose event time</label>
                    <div class="datepicker-box">
                		<input id="timepicker1" class="time-picker-input" type="text" placeholder="start time" name="timepicker1"/>
                        <span><img src="<?=base_url("assets/front/images/time-icone.png")?>" alt="image"></span>
                    </div>
                    <div class="datepicker-box">
                		<input id="timepicker2" class="time-picker-input" type="text" placeholder="end time" name="timepicker1"/>
                        <span><img src="<?=base_url("assets/front/images/time-icone.png")?>" alt="image"></span>
                    </div>
                    <div class="book-me">
                    	<input type="submit" value="book me">
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
<script src="http://www.efficiencyproviders.com/assets_front/js/bootstrap.min.js" type="text/javascript"> </script>
<script>
$(document).ready(function() {
   $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 78,
    itemMargin: 5,
    asNavFor: '#slider'
  });
 
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
   $('#carouse2').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 5,
    asNavFor: '#slider1'
  });
 
  $('#slider1').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carouse2"
  });

	//****** Staff Pop Videos play ******// 
	$('.videopath').click(function(){
		var url = $(this).attr('value');
		//var url = 'Umcr6R0_C4o';
		$('.form-video').html('<iframe id="VideoPlayer" width="600" height="450" src="http://www.youtube.com/embed/'+url+'?autoplay=1" allowfullscreen frameborder="0"></iframe>');
	});
	
	

	//****** Staff About us and review (Tab) ******//
	$(".tabs-menu a").click(function(event) {
		event.preventDefault();
		$(this).parent().addClass("current");
		$(this).parent().siblings().removeClass("current");
		var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
	});
	//************************* Set cookie for product id **********************//
	function set_cookie(cookiename, cookievalue, hours) {
		var date = new Date();
		date.setTime(date.getTime() + Number(hours) * 3600 * 1000);
		document.cookie = cookiename + "=" + cookievalue + "; path=/;expires = " + date.toGMTString();;
	}

	//************************* Call cookie function  **********************//
	var staffId = "<?=$userInfo->id;?>";
	set_cookie('staffs['+staffId+']', staffId, 24*365*1); // 1 years
});


 </script>
 <script>
	$('#timepicker1').timepicki();
	$('#timepicker2').timepicki();
    </script>
