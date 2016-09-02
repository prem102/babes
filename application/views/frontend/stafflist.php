<?php
	$this->load->view('frontend/top');
	$this->load->view('frontend/header');
	$static_content['listing-banner']='';
	if(!empty($searchGender) && $searchGender=='Male'){
		$static_content=getStaticPageContent('guys-listing');
		}
		if(!empty($searchGender) && $searchGender=='Female'){
		$static_content=getStaticPageContent('girls-listing');
		}
		if(!empty($searchGender) && $searchGender=='Other'){
		$static_content=getStaticPageContent('other-listing');
		}
?>
<div class="banner banner-bg-image">
<?=($static_content['listing-banner'])?$static_content['listing-banner']:"";?>

<div class="search-module">
<h2>Search Module</h2>
<div class="search-service-module">
<?=form_open(current_url(),array('id'=>'searching-staff-top-form'));?>
<div class="location-module select">
<select name="location_id" class="checkempty">
	<option value="">Select Location</option>
	<?php
		if(!empty($locations) && is_array($locations)){
			foreach($locations as $location){
				$sell = (!empty($searchLocation) && $searchLocation== $location->id ) ? "selected" : "";
				echo '<option value="'.$location->id.'" '.$sell.'>'.$location->name.'</option>';
			}
		}
	?>
</select>

</div>


<div class="gender-module select">
<select name="gender" class="checkempty" onchange="ServicesByGender(this.value)">
	<option value="" >Select Gender</option>
	<option value="Female" <?=!empty($searchGender) && $searchGender=='Female' ? 'selected' : '';?>>Female</option>
	<option value="Male" <?=!empty($searchGender) && $searchGender=='Male' ? 'selected' : '';?> >Male</option>
	<option value="Other" <?=!empty($searchGender) && $searchGender=='Other' ? 'selected' : '';?>>Other</option>
</select>

</div>
<div class="service-module">

<select name="service_id" class="checkempty">
	<option value="">Select Service</option>
	<?php
		if(!empty($services) && is_array($services)){
			foreach($services as $service){
				$sell = (!empty($searchService) && $searchService== $service->id ) ? "selected" : "";
				echo '<option value="'.$service->id.'" '.$sell.'>'.$service->name.'</option>';
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

<div class="Topless">
<div class="container">
<?php
	
	if(!empty($searchLocation) && is_numeric($searchLocation)){
		$locationDetails= getLocationDetils($searchLocation);
		$locationName	= !empty($locationDetails->name) ? $locationDetails->name : '';
	}

	if(!empty($searchService) && is_numeric($searchService)){
		$serviceDetails	= getServiceDetils($searchService);
		$serviceName	= !empty($serviceDetails->name) ? $serviceDetails->name : '' ;
		$serviceDesc	= !empty($serviceDetails->description) ? $serviceDetails->description : '' ;

?>
<div id="top-header">
<h3>
	<span>
		<img src="<?=base_url("assets/front")?>/images/left-star.png"></span>
	<span id="serviceInLocation"><?=$serviceName;?> <?=!empty($locationName) ? ' in '.$locationName : '';?></span>
	<span>
		<img src="<?=base_url("assets/front")?>/images/right-star.png">
	</span>
</h3>
<p class="center" id="serviceDesc"><?=$serviceDesc;?></p>
</div>
<?php } ?>
<div class="topless-waitress">
<div class="topless-service-left">

<?=form_open(current_url(),array('id'=>'searching-staff-left-form'));?>
<div class="choose-price">
<h4>choose price <span class="clear-all" id="reset-filter">Clear All</span></h4>
<input type="text" id="price_range" value="" name="price_range" />
</div>
<div class="choose-price">
<h4>age</h4>
<input type="text" id="age_range" value="" name="age_range" />
</div>
<div class="choose-price">
<h4>height</h4>
<input type="text" id="height_range" value="" name="height_range" />
</div>


<div class="service-left">
<h4>Choose Hair</h4>
	<?php
		if(!empty($hairColors) && is_array($hairColors)){
			foreach($hairColors as $hairColor){
	?>
	<div>
		<input id="hairColor<?=$hairColor->id;?>" class="checkbox-custom" name="hair_colors[<?=$hairColor->id?>]" 
		type="checkbox" value="<?=$hairColor->id;?>">
		<label for="hairColor<?=$hairColor->id;?>" class="checkbox-custom-label"><?=$hairColor->name;?></label>
	</div>
	<?php
			}
		}
	?>
</div>

<div class="service-left">
<h4>Choose Eye Colour</h4>
	<?php
		if(!empty($eyeColors) && is_array($eyeColors)){
			foreach($eyeColors as $eyeColor){
	?>
	<div>
		<input id="eyeColor<?=$eyeColor->id;?>" class="checkbox-custom" name="eye_colors[<?=$eyeColor->id;?>]"
		 type="checkbox" value="<?=$eyeColor->id;?>">
		<label for="eyeColor<?=$eyeColor->id;?>" class="checkbox-custom-label"><?=$eyeColor->name;?></label>
	</div>
	<?php
			}
		}
	?>
</div>
<div class="service-left">
<h4>Choose Body type</h4>
	<?php
		if(!empty($bodyTypes) && is_array($bodyTypes)){
			foreach($bodyTypes as $bodyType){
	?>
	<div>
		<input id="bodyType<?=$bodyType->id;?>" class="checkbox-custom" name="body_types[<?=$bodyType->id?>]" 
		type="checkbox" value="<?=$bodyType->id;?>">
		<label for="bodyType<?=$bodyType->id;?>" class="checkbox-custom-label"><?=$bodyType->name;?></label>
	</div>
	<?php
			}
		}
	?>
</div>

<div class="service-left">
<h4><?=($searchGender=='Female')?'Bust':'Chest';?></h4>
	<?php
		if(!empty($bustTypes) && is_array($bustTypes)){
			foreach($bustTypes as $bustType){
	?>
	<div>
		<input id="bustType<?=$bustType->id;?>" class="checkbox-custom" name="bust_types[<?=$bustType->id?>]" 
		type="checkbox" value="<?=$bustType->id;?>">
		<label for="bustType<?=$bustType->id;?>" class="checkbox-custom-label"><?=$bustType->name?></label>
	</div>
	<?php
			}
		}
	?>
</div>

<div class="service-left">
<h4>Ethnicity</h4>
	<?php
		if(!empty($ethnicities) && is_array($ethnicities)){
			foreach($ethnicities as $ethnicity){
	?>
	<div>
		<input id="ethnicity<?=$ethnicity->id;?>" class="checkbox-custom" name="ethnicities[<?=$ethnicity->id?>]" 
		type="checkbox" value="<?=$ethnicity->id;?>">
		<label for="ethnicity<?=$ethnicity->id;?>"class="checkbox-custom-label"><?=$ethnicity->name; ?></label>    
	</div>
	<?php
			}
		}
	?>
</div>
<?=form_close();?>

</div> 
<!--topless-service-left -->
<!--topless-service-right -->
<div class="topless-service-right" id="staff-list">
			
			<?php
			if(!empty($searchedStaffs) && is_array($searchedStaffs)){
				foreach($searchedStaffs as $searchedStaff){
					$name = !empty($searchedStaff->first_name) ? $searchedStaff->first_name .' '.$searchedStaff->last_name : '' ;
					$userImg = !empty($searchedStaff->image) ? $searchedStaff->image : 'natalia.jpg' ;
					$city = !empty($searchedStaff->city) ? $searchedStaff->city : '' ;
					$serviceId = !empty($searchedStaff->serviceId) ? $searchedStaff->serviceId : 0 ;
					$minPrice = getStaffMinServicePrice($searchedStaff->userId,$serviceId);
			?>
			<a href="<?=base_url('staffs/'.$searchedStaff->username);?>">
			<div class="view view-eighth">
					<img src="<?=base_url("assets/front/users_images")?>/<?=$userImg;?>">
					<div class="view-prof">
						<div class="name"><?=$name;?></div>
						<div class="age"><?=$city;?></div>
					</div> <!--view-prof -->
					<div class="mask">
						<span class="form-rate">from $<?=$minPrice;?></span>
					</div>
			</div></a>
			<?php
					}
				}else{
			?>
				<h3 class="no-result-found"> No Staff Found</h3>
			<?php } ?>
            <!-- Pagination Section 
			<div class="pagination-section">
				<ul class="pagination">
					<li><a href="#">«</a></li>
					<li><a href="#">1</a></li>
					<li><a class="active" href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">»</a></li>
				</ul>
			</div>
			Pagination Section -->
		</div>
</div>
<!--topless-service-Right End -->

</div><!--container -->
</div> <!--featured-girl -->

<!--<div class="girls-so-good">
<div class="container">
<div class="good-girl">
<div class="good-girl-left">
<h3>Girls so Good you'll 
think you're in Heaven</h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer</p>

<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer</p>
</div>
<div class="good-girl-right">
<firure><img src="<?=base_url("assets/front")?>/images/good-girl.jpg"></figure>
</div>
</div>
</div>
</div>--><!--good-girl -->
<!--****** Loader Section ****** -->
<div id="loader-parent" >
<div class="loader-wrapper"></div>
<div class="loader">
	<img src="<?=base_url("assets/front/images/loader.gif")?>">
</div>
</div>
<!--****** Loader Section ****** -->
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
?>
<script>
$(function() {
	var selectBox = $("select").selectBoxIt();
});
 
$(function() {
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		" - $" + $( "#slider-range" ).slider( "values", 1 ) );
});

// ****** Searching Functionality ****** //
$('.topless-service-left').on('click','.checkbox-custom', function (){
	searching();
});

$('.checkempty').change(function (){
	searching();
});

$('#reset-filter').click(function (){
	location.reload();
});

function searching(){
	$('#loader-parent').show();
	$.post("<?=base_url('frontend/home/ajaxStaffSearching');?>",$('#searching-staff-top-form,#searching-staff-left-form').serialize(), function (response){
		if(response){
			var data = JSON.parse(response);
			$('#staff-list').html(data.staffs);
			$('#top-header').html(data.headInfo);
		}
		$('#loader-parent').hide();
	});
}



//------------------------------------------sliders js -------------------------------------

		var saveResult	= function (data){
			searching();
		}

    $(function () {
//------------------------------------------price slider -------------------------------------

		$("#price_range").ionRangeSlider({
			hide_min_max: true,
			keyboard: true,
			min: 10,
			max: 500,
			from: 10,
			to: 500,
			type: 'double',
			step: 1,
			prefix: "$",
			//onChange: saveResult,
			onFinish: saveResult,
		});
		
//------------------------------------------age slider -------------------------------------

        $("#age_range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 16,
            max: 50,
            from: 16,
            to: 50,
            type: 'double',
            step: .3,
            //onChange: saveResult,
            onFinish: saveResult,
        });
//------------------------------------------height slider -------------------------------------

        $("#height_range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 4,
            max: 7,
            from: 4,
            to: 7,
            type: 'double',
            step: .1,
            //onChange: saveResult,
            onFinish: saveResult,
        });

    });
    
    //======================= gender change events ===================
function ServicesByGender(str){
	  $("#genderSelectBoxItText").css("color",'#000');
	$.post("<?=base_url('frontend/home/getServiceByGender');?>",{'gender':str}, function (response){
		if(response){
		$(".service-module").html(response);	
		var selectBox = $("select").selectBoxIt();
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

</script>
