<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
		$static_content=getStaticPageContent('index');
		//print_r($banners);
		
?>

<div class="banner banner-flex">
<!-- ****** Banner End ****** --> 
<div class="flexslider">
  <ul class="slides">
	  <?php foreach($banners as $ban_val){
    echo'<li><img src="'.base_url("assets/front/").'/featured-images/'.$ban_val->featured_image.'">';
	
	echo'<div class="caption">';
	echo'<h3>'.ucwords($ban_val->first_name.' '.$ban_val->last_name).'</h3>';
	echo'<ul><li><span><img src="'.base_url("assets/front/").'/images/cake.png"></span>'.$ban_val->age.'</li><li><span><img src="'.base_url("assets/front/").'/images/map.png"></span>'.$ban_val->city_name.'</li></ul>';
	echo'</div><!--caption -->
	</li>';
  
  } ?>
  
  </ul>
</div>
<!-- ****** Banner End ****** --> 


<div class="search-module">
<h2>Search Module</h2>
<div class="search-service-module">
<?=form_open(base_url('stafflist/search'),array('id'=>'searching-staff-top-form'));?>
<div class="location-module select">
<select name="location_id" class="checkempty">
	<option value="">Select Location</option>
	<?php
		if(!empty($locations) && is_array($locations)){
			foreach($locations as $location){
				echo '<option value="'.$location->id.'">'.$location->name.'</option>';
			}
		}
	?>
</select>

</div>

<div class="gender-module select">
<select name="gender" id="gender" class="checkempty" onchange="ServicesByGender(this.value)" >
	<option value="">Select Gender</option>
	<option value="Female">Female</option>
	<option value="Male">Male</option>
	<option value="Other">Other</option>
</select>

</div>


<div class="service-module">
<select name="service_id" class="checkempty">
	<option value="">Select Service</option>
	<?php
		if(!empty($services) && is_array($services)){
			foreach($services as $service){
				echo '<option value="'.$service->id.'">'.$service->name.'</option>';
			}
		}
	?>
</select>
</div>
<button class="search-button">Search</button>
<?=form_close();?>

</div>
</div>
</div><!--banner -->
<div class="featured-girl">
<div class="container">
<h3><span><img src="<?=base_url("assets/front/")?>/images/left-star.png"></span><?=$static_content['featured-girls-header'];?><span><img src="<?=base_url("assets/front/")?>/images/right-star.png"></span></h3>
<?=$static_content['featured-girls-text'];?>

<div class="main flexslider1">
	<ul class="slides">
		<?php
		//dump($featuredGirls);
			if(!empty($featuredGirls) && is_array($featuredGirls)){
				foreach($featuredGirls as $featuredGirl){
					$name = !empty($featuredGirl->first_name) ? $featuredGirl->first_name .' '.$featuredGirl->last_name : '' ;
					$userImg = !empty($featuredGirl->image) ? $featuredGirl->image : 'natalia.jpg' ;
					$city = !empty($featuredGirl->city) ? $featuredGirl->city : '' ;
					$minPrice = getStaffMinServicePrice($featuredGirl->userId);
					$fservices = getStaffServices($featuredGirl->userId);
		?>
		<li>
			<div class="view view-eighth">
					<img src="<?=base_url("assets/front/users_images")?>/<?=$userImg;?>">
					<div class="view-prof">
						<div class="name"><?=$name;?></div>
						<div class="age"><?=$city;?></div>
					</div> <!--view-prof -->
					<div class="mask">
						<span class="form-rate">from $<?=$minPrice;?></span>
						<ul>
							<?php
								if(!empty($fservices) && is_array($fservices)){
									foreach($fservices as $service){
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
		</li>
		<?php
				}
			}
		?>
	</ul>
</div>

<span class="show-more"><a href="<?=base_url('stafflist/featured');?>">show more</a></span>



</div><!--container -->
</div> <!--featured-girl -->
<div class="book-online">
<div class="container">
<div class="online-book">
<h3><span><img src="<?=base_url("assets/front/")?>/images/left-star.png"></span><?=$static_content['book-online-now-header'];?><span><img src="<?=base_url("assets/front/")?>/images/right-star.png"></span></h3>
<div class="location-service">
<div class="location">
<h3>step 1</h3>
<figure><img src="<?=base_url("assets/front/")?>/images/location.png"></figure>
<h4>Choose location</h4>
</div>

<div class="location">
<h3>step 2</h3>
<figure><img src="<?=base_url("assets/front/")?>/images/service.png"></figure>
<h4>Choose Service</h4>
</div>
<div class="location">
<h3>step 3</h3>
<figure><img src="<?=base_url("assets/front/")?>/images/choose-girl.png"></figure>
<h4>Choose Price</h4>
</div>
<span class="search-map"><figure><img src="<?=base_url("assets/front/")?>/images/map1.png"></figure>

<select id="select-city"  class="tokenize-sample search" >
	
</select>
<button>go</button>
</span>
</div><!--location-service -->
</div><!--online-book -->
</div>
</div><!--book-online -->
<div class="we-got-all">
<div class="container">
<h3><span><img src="<?=base_url("assets/front/")?>/images/left-star.png"></span><?=$static_content['we-got-all-header'];?><span><img src="<?=base_url("assets/front/")?>/images/right-star.png"></span></h3>
<?=$static_content['we-got-all-info'];?><div class="six-section">
	<?php 
	$ser=1;
	foreach($services as $ser_val){
		if(strlen($ser_val->description)<150)continue;
		if($ser>6)break;
echo'<div class="section-box">
<figure><img src="'.base_url("assets/front/").'/services-images/'.$ser_val->images.'"></figure>
<h5>'.ucwords($ser_val->name).'</h5>
<p>'.ucfirst(short_content($ser_val->description,160)).'</p>
</div>';
$ser++;
}?>
<!--section-box -->
<!--section-box -->
</div><!--six-section -->


</div><!--container -->
</div> <!--we-got-all -->
<div class="hire-section">
<?=$static_content['hire_girl_and_guy'];?>


</div>
<!--hire-section -->
<div class="our-latest-update">
<div class="container">
<h3><span><img src="<?=base_url("assets/front/")?>/images/left-star.png"></span><?=$static_content['our-latest-update-header'];?><span><img src="<?=base_url("assets/front/")?>/images/right-star.png"></span></h3>
<?=$static_content['our-latest-update-info'];?><div class="three-section">
<div class="box">
<figure><img src="<?=base_url("assets/front/")?>/images/box-image.jpg"></figure>
<span class="years">20/06/2016</span>
<p>Explore our website to see all of the incredible hens and bucks ideas, to meet</p>
</div>
<div class="box">
<figure><img src="<?=base_url("assets/front/")?>/images/box-image2.jpg"></figure>
<span class="years">20/06/2016</span>
<p>Explore our website to see all of the incredible hens and bucks ideas, to meet</p>
</div>
<div class="box">
<figure><img src="<?=base_url("assets/front/")?>/images/box-image3.jpg"></figure>
<span class="years">20/06/2016</span>
<p>Explore our website to see all of the incredible hens and bucks ideas, to meet</p>
</div>

</div>
<!--three-section -->

<span class="show-more"><a href="#">show more</a></span>
</div><!--container -->
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
?>

<script>
	$(function() {
	 var selectBox = $(".checkempty").selectBoxIt();
	 });
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
	
     slideshow: false
  });
  
  // Click on search button //
  
  
});

(function() {
 
  // store the slider in a local variable
  var $window = $(window),
      flexslider;
 
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 600) ? 2 :
           (window.innerWidth < 900) ? 3 : 4;
  }
 
  $(function() {
   // SyntaxHighlighter.all();
  });
 
  $window.load(function() {
    $('.flexslider1').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 210,
      itemMargin: 5,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });
  });
 
  // check grid size on resize event
  $window.resize(function() {
    var gridSize = getGridSize();
 
    flexslider.minItems = gridSize;
    flexslider.maxItems = gridSize;
  });
}());

//======================= gender change events ===================
function ServicesByGender(str){
	  $("#genderSelectBoxItText").css("color",'#000');
	$.post("<?=base_url('frontend/home/getServiceByGender');?>",{'gender':str}, function (response){
		if(response){
		$(".service-module").html(response);	
		var selectBox = $(".checkempty").selectBoxIt();
		}
		
	});
	}
	
	$( "#searching-staff-top-form" ).submit(function( event ) {
  var v=$("#gender").val();
  if(v==''){
  $("#genderSelectBoxItText").css("color",'red');
   return false;
	}
 
});
  $('#select-city').tokenize({
	   datas: "<?=base_url('frontend/home/')?>/loadBabesCities",
	   placeholder:"Choose Location",
	   searchParam:"q",
	   maxElements: 1
	   });
</script>
