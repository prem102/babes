<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit Client</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
	<!-- Top According -->
	<div data-widget-editbutton="false" id="ff" class="jarviswidget jarviswidget-sortable" role="widget">
		<!--<header role="heading">
			<h2><strong>Edit Client</strong></h2>
			<span class="jarviswidget-loader">
				<i class="fa fa-refresh fa-spin"></i>
			</span>
		</header>-->
	<div role="content">
		<div class="jarviswidget-editbox"></div>
		<div class="widget-body ">
			<div id="client-edit-page" class="panel-group smart-accordion-default">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" href="#panel2" data-parent="#client-edit-page">
							<i class="fa fa-lg fa-angle-down pull-right"></i>
							<i class="fa fa-lg fa-angle-up pull-right"></i>
							<strong>Personal Details</strong>
						</a>
					</h4>
				</div>
				<div class="panel-collapse collapse in" id="panel2">
					<div class="panel-body no-padding">
						<?= form_open( current_url(), ['class' => 'smart-form','id' => 'client-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                    <fieldset style="margin-left:5px;">
                                                            <section>
                                                                <label class="label">Client Name <span class="asterisk">*</span></label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-user"></i>
                                                                    <input type="text" placeholder="Client name" id="first_name" name="first_name" required="" data-parsley-length="[3, 100]"  value="<?=$user->first_name;?>">
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
                                                                <label class="label">User Status</label>
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
					<?= form_open( base_url('admin/users/editClientAddress'), ['class' => 'smart-form','id' => 'client-address-form','enctype'=>"multipart/form-data",'data-parsley-validate'=>"data-parsley-validate"]); ?>
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                    <fieldset style="margin-left:5px;">
														<input type="hidden" name="user_id" value="<?=$user->id;?>">
                                                            <section>
                                                                <label class="label">Country</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Country" readonly  value="Australia">
                                                                </label>
                                                            </section>
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
					<?= form_open( base_url('admin/users/editClientNotification'), ['class' => 'smart-form','id' => 'client-notification-form']); ?>
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
			
			</div>
		</section>
    </div>
</div>
</div>
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
	});
</script>
