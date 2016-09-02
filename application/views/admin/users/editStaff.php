<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit Staff</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
	<!-- Top According -->
	<div data-widget-editbutton="false" id="ff" class="jarviswidget jarviswidget-sortable" role="widget">
	<div role="content">
		<div class="jarviswidget-editbox"></div>
		<div class="widget-body ">
		<div id="client-edit-page" class="panel-group smart-accordion-default">
		<!-- User Staff Personal Section Start-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="collapsed" data-toggle="collapse" href="#panel1" data-parent="#client-edit-page">
						<i class="fa fa-lg fa-angle-down pull-right"></i>
						<i class="fa fa-lg fa-angle-up pull-right"></i>
						<strong>Personal Details</strong>
					</a>
				</h4>
			</div>
			<div class="panel-collapse collapse in" id="panel1">
				<div class="panel-body no-padding">
					<?= form_open( current_url(), ['class' => 'smart-form','id' => 'staff-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
							<div class="tab-content padding-10">
								<div id="tab1" class="tab-pane active">
									<div class="row">
										<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
												<div class="col-lg-12 col-sm-12">
												<fieldset style="margin-left:5px;">
														<section>
															<label class="label">Staff Name <span class="asterisk">*</span></label>
															<label class="input"> 
																<i class="icon-append fa fa-user"></i>
																<input type="text" placeholder="Staff name" id="first_name" name="first_name" required="" data-parsley-length="[3, 100]"  value="<?=$user->first_name;?>">
															</label>
														</section>
														<section>
															<label class="label">User Name</label>
															<label class="input"> 
																<i class="icon-append fa fa-user"></i>
																<input type="text" placeholder="User name" readonly  value="<?=$user->username;?>">
															</label>
														</section>
														<section>
															<label class="label">Email <span class="asterisk">*</span></label>
															<label class="input"> 
																<i class="icon-append fa fa-envelope-o"></i>
																<input type="text" placeholder="email@example.com" data-parsley-type="email" required="" data-parsley-length="[4, 100]" name="email" id="email" value="<?=$user->email;?>">
															</label>
														</section>
														<section>
															<label class="label">Contact No <span class="asterisk">*</span></label>
															<label class="input"> 
																<i class="icon-append fa fa-mobile"></i>
																<input type="text" placeholder="Contact Number" name="phone" data-parsley-length="[6, 15]" data-parsley-type="digits" required=""  value="<?=$user->phone?>">
															</label>
														</section>
														<section>
															<label class="label">Status</label>
															<div class="input input-radio">
																<div class="col col-3">
																	<label class="radio state-success">
																		<input type="radio" name="active" value="1" <?=(!empty($user->active) && $user->active == 1 ) ? 'checked' : '';?>>
																		<i></i>Active
																	</label>
																	</div>
																	<div class="col col-3">
																	<label class="radio state-error">
																		<input type="radio" name="active" value="0" <?=($user->active == 0 ) ? 'checked' : '';?>>
																		<i></i>Inactive
																	</label>
																</div>
															</div>
														</section>
													</fieldset>
											</div>
										</article>
								</div>
							<footer>
								<hr class="simple">
								<button class="btn btn-success pull-right" type="submit">
									Update
								</button>
							</footer>
						 <?= form_close(); ?>
				</div>
			</div>
			</div>
			</div>
		</div>
		<!-- User Staff Personal Section End-->

		<!-- User Staff Addres Section Start-->
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" href="#panel3" data-parent="#client-edit-page">
							<i class="fa fa-lg fa-angle-down pull-right"></i>
							<i class="fa fa-lg fa-angle-up pull-right"></i>
							<strong>Address Details</strong>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse " id="panel3">
					<div class="panel-body">
					<?= form_open( base_url('admin/users/editStaffAddress'), ['class' => 'smart-form','id' => 'staff-address-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                    <fieldset style="margin-left:5px;">
														<input type="hidden" name="user_id" value="<?=$user->id;?>">
                                                            
                                                            <section>
                                                                <label class="label">State <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <select class="form-control" name="state_id" id="state_id" required>
																		<option value="">Select State</option>
																		<?php
																			$states = getStates();
																			if(!empty($states) && is_array($states)){
																				foreach($states as $state){
																					$selState = !empty($userAddress->state_id) && $userAddress->state_id==$state->id ? 'selected': '';
																					echo '<option value="'.$state->id.'" '.$selState.'>'.ucfirst($state->name).'</option>';
																				}
																			}
																		?>
                                                                    </select>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">City <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <select class="form-control" name="city_id" id="city_id" required>
																		<option value="">Select City</option>
																		<?php
																			$cities = (!empty($userAddress->state_id) && is_numeric($userAddress->state_id)) ? getCities($userAddress->state_id) : array();
																			if(!empty($cities) && is_array($cities)){
																				foreach($cities as $city){
																					$selCity = !empty($userAddress->city_id) && $userAddress->city_id==$city->id ? 'selected': '';
																					echo '<option value="'.$city->id.'" '.$selCity.'>'.ucfirst($city->name).'</option>';
																				}
																			}
																		?>
                                                                    </select>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Pin Code <span class="asterisk">*</span></label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Pincode" name="pincode" 
                                                                    data-parsley-length="[4, 9]" data-parsley-type="alphanum" required=""  value="<?=!empty($userAddress->pincode) ? $userAddress->pincode : '';?>">
                                                                </label>
                                                            </section>
															<section>
                                                                <label class="label">Address</label>
                                                                <label class="textarea">
                                                                    <textarea data-parsley-range="[3, 255]" name="address" placeholder="Address"><?=!empty($userAddress->address) ? $userAddress->address : '';?></textarea>
                                                                </label>
                                                            </section>
                                                            <section>
                                                            
														<!-- **** Main Service City ---->
															<div class="form-filler">
																<?php
																	$cities	= getStaffServiceCities($user->id);
																?>
															<div class="selected-maincity"><label>Main Service City<span class="asterisk">*</span><small id="max-main-city">(You can select only one city for main service city)</small></label>
																		<ul id="sel-maincity">
																		<?php
																			if(!empty($cities) && is_array($cities)){
																				foreach($cities as $city){
																					if($city->cityType=='1'){
																						echo '<li sk-id="'.$city->cityId.'" class="maincity-rem">'.$city->city.'</li>';
																					}
																				}
																			}
																		?>
																		</ul>
																	</div>
																	<div class="select-input">
																	<input type="text" name="maincity" class="form-control" placeholder="Enter your main service city" id="maincity" autocomplete="off"/>
																	<select style="display: none;" multiple="true" name="main_city" id="main_city" required="">
																		<?php
																			if(!empty($cities) && is_array($cities)){
																				foreach($cities as $city){
																					if($city->cityType=='1'){
																						echo '<option value="'.$city->cityId.'" selected>'.$city->city.'</option>';
																					}
																				}
																			}
																		?>
																	</select>
																	<div id="main-city-list" class="auto-comaplete" style="display: none;">
																		<ul id="av-main-city">
																			
																		</ul>
																	</div>
																	<span class="error-msg" id="location_error"></span>
															</div>
															</div>
														<!-- **** Main Service City ---->
														<!-- **** Others Service City ---->
															<div class="form-filler">
															<div class="selected-othercity"><label>Other Service City <small id="max-city">(You can select max 5 cities for other service cities)</small> </label>
																	<ul id="sel-othercity">
																		<?php
																			if(!empty($cities) && is_array($cities)){
																				foreach($cities as $city){
																					if($city->cityType=='0'){
																						echo '<li sk-id="'.$city->cityId.'" class="othercity-rem">'.$city->city.'</li>';
																					}
																				}
																			}
																		?>
																	</ul>
																	</div>
																	<div class="select-input">
																	<input type="text" name="othercity" class="form-control" placeholder="Enter your other service city" id="othercity" autocomplete="off"/>
																	<select style="display: none;" multiple="true" name="other_city[]" id="other_city">
																	<?php
																		if(!empty($cities) && is_array($cities)){
																			foreach($cities as $city){
																				if($city->cityType=='0'){
																					echo '<option value="'.$city->cityId.'" selected>'.$city->city.'</option>';
																				}
																			}
																		}
																	?>
																	</select>
																	<div id="other-city-list" class="auto-comaplete" style="display: none;">
																		<ul id="av-other-city">
																			
																		</ul>
																	</div>
																	<span class="error-msg" id="location_error_other"></span>
															</div>
															</div>
														<!-- **** Other Service City ---->
															</section>
                                                        </fieldset>
												</div>
                                            </article>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Update
                                    </button>
                                </footer>
                             <?= form_close(); ?>
					</div>
				</div>
			</div>
			</div>
			</div>
		<!-- User Staff Addres Section End-->
		
		<!-- User Staff Body details Section Start-->
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" href="#panel-body" data-parent="#client-edit-page">
							<i class="fa fa-lg fa-angle-down pull-right"></i>
							<i class="fa fa-lg fa-angle-up pull-right"></i>
							<strong>Body Details</strong>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse " id="panel-body">
					<div class="panel-body">
					<?= form_open( base_url('admin/users/editStaffDetails'), ['class' => 'smart-form','id' => 'staff-bodydetails-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
						<div class="tab-content padding-10">
							<div id="tab1" class="tab-pane active">
								<div class="row">
								<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
										<div class="col-lg-12 col-sm-12">
										<fieldset style="margin-left:5px;">
											<input type="hidden" name="user_id" value="<?=$user->id;?>">
												<section>
													<label class="label">Hair Color<span class="asterisk">*</span></label>
													<label class="input">
														<select class="form-control" name="hair_color" id="hair_color" required>
															<option value="">Hair Color</option>
															<?php
																if(!empty($staffHairColors) && is_array($staffHairColors)){
																	foreach($staffHairColors as $staffHairColor){
																		$sell = !empty($bodyDetails->hair_color) && $bodyDetails->hair_color==$staffHairColor->id ? 'selected' : '';
																		echo '<option value="'.$staffHairColor->id.'" '.$sell.'>'.$staffHairColor->name.'</option>';
																	}
																} 
															?>
														</select>
													</label>
												</section>
												<section>
													<label class="label">Eye Color</label>
													<label class="input">
															<select class="form-control" name="eye_color" id="eye_color" required>
															<option value="">Eye Color</option>
															<?php
																if(!empty($staffEyeColors) && is_array($staffEyeColors)){
																	foreach($staffEyeColors as $staffEyeColor){
																		$sell = !empty($bodyDetails->eye_color) && $bodyDetails->eye_color==$staffEyeColor->id ? 'selected' : '';
																		echo '<option value="'.$staffEyeColor->id.'" '.$sell.'>'.$staffEyeColor->name.'</option>';
																	}
																} 
															?>
														</select>
													</label>
												</section>
												<section>
													<label class="label">Body Type <span class="asterisk">*</span></label>
													<label class="input">
														<select class="form-control" name="body_type" id="body_type">
															<option value="">Body Type</option>
															<?php
																if(!empty($staffBodyTypes) && is_array($staffBodyTypes)){
																	foreach($staffBodyTypes as $staffBodyType){
																		$sel = !empty($bodyDetails->body_type) && $bodyDetails->body_type==$staffBodyType->id ? 'selected': '';
																		echo '<option value="'.$staffBodyType->id.'" '.$sel.'>'.$staffBodyType->name.'</option>';
																	}
																}
															?>
														</select>
													</label>
												</section>
												<section>
													<?php
														if(!empty($userGender) && $userGender=='Female'){
															$bust = "Bust Type";
														}else{
															$bust = "Chest Type";
														}
													?>
													<label class="label"><?=$bust;?> <span class="asterisk">*</span></label>
													<label class="input">
														<select class="form-control" name="bust_size" id="bust_size">
															<option value=""><?=$bust;?></option>
															<?php
																if(!empty($staffBustTypes) && is_array($staffBustTypes)){
																	foreach($staffBustTypes as $staffBustType){
																		$sel = !empty($bodyDetails->bust_size) && $bodyDetails->bust_size==$staffBustType->id ? 'selected': '';
																		echo '<option value="'.$staffBustType->id.'" '.$sel.'>'.$staffBustType->name.'</option>';
																	}
																}
															?>
														</select>
													</label>
												</section>
												<section>
													<label class="label">Ethnicity <span class="asterisk">*</span></label>
													<label class="input">
														<select class="form-control" name="ethnicity" id="ethnicity">
															<option value="">Ethnicity</option>
															<?php
																if(!empty($staffEthnicities) && is_array($staffEthnicities)){
																	foreach($staffEthnicities as $staffEthnicity){
																		$sel = !empty($bodyDetails->ethnicity) && $bodyDetails->ethnicity==$staffEthnicity->id ? 'selected': '';
																		echo '<option value="'.$staffEthnicity->id.'" '.$sel.'>'.$staffEthnicity->name.'</option>';
																	}
																}
															?>
														</select>
													</label>
												</section>
												<section>
													<label class="label">Age<span class="asterisk">*</span></label>
													<label class="input">
														<input type="text" placeholder="Age" name="age" 
														data-parsley-range="[18, 50]" data-parsley-type="digits" required=""  value="<?=!empty($bodyDetails->age) ? $bodyDetails->age : '';?>">
													</label>
												</section>
												<section>
													<label class="label">Height(feet)<span class="asterisk">*</span></label>
													<label class="input">
														<input type="text" placeholder="Height" name="height" 
														data-parsley-type="number" data-parsley-range="[3,7]" required=""  value="<?=!empty($bodyDetails->height) ? $bodyDetails->height : '';?>">
													</label>
												</section>
												<section>
													<label class="label">Weight (kg)<span class="asterisk">*</span></label>
													<label class="input">
														<input type="text" placeholder="Weight" name="weight" 
															data-parsley-type="number" required="" data-parsley-range="[35,150]"  value="<?=!empty($bodyDetails->weight) ? $bodyDetails->weight : '';?>">
													</label>
												</section>
												<section>
													<label class="label">Body Color</label>
													<label class="input">
														<input type="text" class="form-control" data-parsley-length="[2, 150]" name="body_color" value="<?=!empty($bodyDetails->body_color) ? $bodyDetails->body_color : '';?>">
													</label>
												</section>
												<section>
													<label class="label">Dress Size</label>
													<label class="input">
														<input type="text" class="form-control" data-parsley-length="[1, 50]" name="dress_size" value="<?=!empty($bodyDetails->dress_size) ? $bodyDetails->dress_size : '';?>">
													</label>
												</section>
												<section>
													<label class="label">Mark</label>
													<label class="input">
														<input type="text" data-parsley-length="[5, 150]" class="form-control" name="mark" value="<?=!empty($bodyDetails->mark) ? $bodyDetails->mark : '';?>">
													</label>
												</section>
											</fieldset>
									</div>
								</article>
							</div>
						<footer>
							<hr class="simple">
							<button class="btn btn-success pull-right" type="submit">
								Update
							</button>
						</footer>
							</div>
								</div>
					<?= form_close(); ?>
			</div>
			</div>
			</div>
		<!-- User Staff Body details Section End-->
		<!-- User Staff Services Section Start-->
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" href="#panel-services" data-parent="#client-edit-page">
							<i class="fa fa-lg fa-angle-down pull-right"></i>
							<i class="fa fa-lg fa-angle-up pull-right"></i>
							<strong>Services</strong>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse " id="panel-services">
					<div class="panel-body">
					<?= form_open( base_url('admin/users/editStaffServices'), ['class' => 'smart-form','id' => 'staff-services-form','enctype'=>"multipart/form-data"]); ?>
						<div class="tab-content padding-10">
							<div id="tab1" class="tab-pane active">
								<div class="row">
								<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
										<div class="col-lg-12 col-sm-12">
										<fieldset style="margin-left:5px;">
											<input type="hidden" name="user_id" value="<?=$user->id;?>">
												<section class="staff-services-checkbox">
													<h3> Main Services</h3>
													<?php
														if(!empty($masterServices) && is_array($masterServices)){
															foreach($masterServices as $masterService){
																if($masterService->service_type==0){
																	$checked = in_array($masterService->id,$staffServices) ? 'checked' :'';
													?>
													<label class="checkbox">
														<input type="checkbox" name="staff_services[]" class="class-notified" 
														value="<?=$masterService->id;?>" <?=$checked;?>>
														<span class="service-name"><?=$masterService->name;?></span>
													</label>
													<?php
																}
															}
														}
													?>
												</section>
												<section class="staff-services-checkbox">
													<h3> Extra Services</h3>
													<?php
														if(!empty($masterServices) && is_array($masterServices)){
															foreach($masterServices as $masterService){
																if($masterService->service_type==1){
																	$checked = in_array($masterService->id,$staffServices) ? 'checked' :'';
													?>
													<label class="checkbox">
														<input type="checkbox" name="staff_services[]" class="class-notified" value="<?=$masterService->id;?>"
														 <?=$checked;?>>
														<span class="service-name"><?=$masterService->name;?></span>
													</label>
													<?php
																}
															}
														}
													?>
												</section>
										</fieldset>
									</div>
								</article>
							</div>
						<footer>
							<hr class="simple">
							<button class="btn btn-success pull-right" type="submit">
								Update
							</button>
						</footer>
							</div>
								</div>
					<?= form_close(); ?>
			</div>
			</div>
			</div>
		<!-- User Staff Sevices Section End-->
		<!-- User Staff Notification Section Start-->
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" href="#panel4" data-parent="#client-edit-page">
							<i class="fa fa-lg fa-angle-down pull-right"></i>
							<i class="fa fa-lg fa-angle-up pull-right"></i>
							<strong>Notification Details</strong>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse " id="panel4">
					<div class="panel-body">
					<?= form_open( base_url('admin/users/editStaffNotification'), ['class' => 'smart-form','id' => 'client-notification-form']); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
														<input type="hidden" name="user_id" value="<?=$user->id;?>">
                                                    <fieldset style="margin-left:5px;">
                                                            <section class="notification-checkbox">
																<span class="notification-text">All notification and information will send by</span>
                                                                <label class="checkbox">
																	<input type="checkbox" name="sms_notified" class="class-notified" value="1" <?=!empty($user->sms_notified) ? 'checked' : '';?>>
																	<span class="notified_by">Notified By SMS</span>
                                                                </label>
                                                            </section>
                                                            <section class="notification-checkbox">
																<span class="notification-text">All notification and information will send by</span>
                                                                <label class="checkbox">
																	<input type="checkbox" name="email_notified" class="class-notified" value="1" <?=!empty($user->email_notified) ? 'checked' : '';?>>
																	<span class="notified_by">Notified By Email</span>
                                                                </label>
                                                            </section>
                                                        </fieldset>
												</div>
                                            </article>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right" type="submit">
                                        Update
                                    </button>
                                </footer>
                             <?= form_close(); ?>
					</div>
				</div>
			</div>
			</div>
			</div>
		
		<!-- User Staff Notification Section End-->
		</div>
		</section>
    </div>
</div>
</div>
<script type="text/javascript" src='<?=base_url('assets/admin/js/moment.min.js');?>'></script>
<link href="<?=base_url('assets/admin/css/selectivity-full.css');?>" rel="stylesheet">
<script type="text/javascript" src='<?=base_url('assets/admin/js/selectivity-full.js');?>'></script>
<script>
	$(document).ready(function (){
		$('#state_id').change(function (){
			var stateId = this.value;
			if(stateId!=""){
				$.post('<?=base_url('admin/users/getStateCities');?>',{'state_id':stateId}, function (data){
					var cities = JSON.parse(data);
						$.each(cities,function(key , value){
							var opt = $('<option />'); // here we're creating a new select option with for each city
							opt.val(value.id);
							opt.text(value.name);
							$('#city_id').append(opt);
						});
						if ($('select').length && $.fn.selectpicker) {
							$('#city_id').selectpicker('refresh');
						}
				});
			}
		});
		//****** Select Main service City And Other services city ******//
		 var xhr = null;
			$('#maincity').keyup(function(){
					if($(this).val().length > 2){
						if(xhr && xhr.readystate != 4){
							xhr.abort();
						}
						xhr = jQuery.ajax({
							url:"<?=base_url('admin/users/')?>/loadBabesCities?q="
									+ $(this).val(),
							success: function(data){
								if(data.city){
									$('#av-main-city').html(''); 
									$.each(data.city , function(index , value){
										$('#av-main-city').append('<li ><a id="'+value.id+'" class="sk-item" href="javascript:void(0);" >'+value.text+'</a></li>');
									}); 
									$('#main-city-list').show();
								}else{
										$('#main-city-list').show();
										$('#av-main-city').html('<li><a href="javascript:void(0)">No Result Found</a></li>');
									}
								},
							});
					}else{
						$('#av-main-city').html(''); 
						$('#main-city-list').hide(); 
					}
				});
				$('#main-city-list').on("click" , '.sk-item' , function(){
					var id = $(this).attr('id');
					$('.auto-comaplete').hide(); 
					var chk = false;
					var itm_count = $("#main_city :selected").length;
					if(itm_count >= 1){
						$('#maincity').val('');
						$('#main-city-list').hide();
						$("#max-main-city").show();
						return false;
					}
					$('.maincity-rem').each(function(){
						var idr = $(this).attr("sk-id");
						if(idr == id)
						chk = true;
					});
					if(chk == true){
						chk = false;
					}else{
						 $('#sel-maincity').append('<li class="maincity-rem" sk-id="'+id+'">'+$(this).html()+'</li>');
						 $(this).parent('li').remove();
						 $('#main_city').append('<option value="'+id+'" selected="selected">'+id+'</option>');
						 $('#maincity').val('');
						 $(".formMsgContent").hide();
						 $("#location_error").html('').hide();
					}
				});

			$('#sel-maincity').on("click" , '.maincity-rem' , function(){
				$('#maincity').val('');
				$("#max-main-city").hide();
				var id = $(this).attr('sk-id');
				$(this).remove();
				$("#"+id).remove();
				$("#main_city option[value='"+id+"']").remove();

			});
		//****** Select Main service City And Other services city ******//
		
		var xhr = null;
			$('#othercity').keyup(function(){
					if($(this).val().length > 2){
						if(xhr && xhr.readystate != 4){
							xhr.abort();
						}
						xhr = jQuery.ajax({
							url:"<?=base_url('admin/users/')?>/loadBabesCities?q="
									+ $(this).val(),
							success: function(data){
									if(data.city){
										$('#av-other-city').html(''); 
										$.each(data.city , function(index , value){
											$('#av-other-city').append('<li ><a id="'+value.id+'" class="sk-item" href="javascript:void(0);" >'+value.text+'</a></li>');
										}); 
										$('#other-city-list').show();
									}else{
										$('#other-city-list').show();
										$('#av-other-city').html('<li><a href="javascript:void(0)">No Result Found</a></li>');
									}
								},
							});
					}else{
						$('#av-other-city').html(''); 
						$('#other-city-list').hide(); 
					}
				});
				$('#other-city-list').on("click" , '.sk-item' , function(){
					var id = $(this).attr('id');
					$('.auto-comaplete').hide(); 
					var chk = false;
					var itm_count = $("#other_city :selected").length;
					if(itm_count >= 5){
						$('#othercity').val('');
						$('#other-city-list').hide();
						$("#max-city").show();
						return false;
					}
					$('.othercity-rem').each(function(){
						var idr = $(this).attr("sk-id");
						if(idr == id)
						chk = true;
					});
					if(chk == true){
						chk = false;
					}else{
						 $('#sel-othercity').append('<li class="othercity-rem" sk-id="'+id+'">'+$(this).html()+'</li>');
						 $(this).parent('li').remove();
						 $('#other_city').append('<option value="'+id+'" selected="selected">'+id+'</option>');
						 $('#othercity').val('');
						 $(".formMsgContent").hide();
						 $("#location_error_other").html('').hide();
					}
				});

			$('#sel-othercity').on("click" , '.othercity-rem' , function(){
				$('#othercity').val('');
				$("#max-city").hide();
				var id = $(this).attr('sk-id');
				$(this).remove();
				$("#"+id).remove();
				$("#main_city option[value='"+id+"']").remove();

			});
	});
</script>
