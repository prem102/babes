<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer'></script>
<?php
	$this->load->view('frontend/top');
	$this->load->view('frontend/header');
?>
<!------------main content start------------------->
<div class="clientregistration-outer">
	<div class="client-regstration-hed">
    	<h1>Client Registration</h1>
        <p>Lorem Ipsum is simply dummy text</p>
    </div>
    <div class="clientregstration-main">
    	<div class="top-client-regstration-pic">
        	<img src="<?=base_url("assets/front/")?>/images/profile-img.png" alt="imgaes">
            <a href="#" class="edit-profile"><img src="<?=base_url("assets/front/")?>/images/edit-profile-img.png" alt="img"></a>
        </div>
    	<?= form_open(current_url(), array('id' => 'client-form','class'=>'persnail-details-clent-box', 'name'=>'client','Method'=>'POST','data-parsley-validate'=>'data-parsley-validate'))?>
        	<div class="persnail-details cf">
            	<h3><img src="<?=base_url("assets/front/")?>/images/persnoal-icone.png" alt="img">personal detail</h3>
                <div class="title-cle select">
                	<label>title<em>*</em></label>
                	<select name="title" required>
                    	<option value="">select</option>
                    	<option value="Mr">Mr.</option>
                    	<option value="Mrs">Mrs.</option>
                    </select>
                </div>
                <div class="name-cle">
                	<label>name <em>*</em></label>
                    <input type="text" placeholder="Enter Name" value="<?=set_value('first_name');?>" id="first_name" name="first_name" data-parsley-required="true" data-parsley-minlength="3" data-parsley-whitespace="squish">
                </div>
                <div class="name-cle">
                	<label>email <em>*</em></label>
                    <input type="email" placeholder="Enter Email" id="email" name="email" value="prem@gmail.com" readonly>
                </div>
            </div>
            <div class="persnail-details cf">
                <div class="name-cle">
                	<label>phone <em>*</em></label>
                    <input type="text" placeholder="Phone Number" value="<?=set_value('phone');?>" name="phone" data-parsley-type="digits" data-parsley-required="true" data-parsley-minlength="10" data-parsley-maxlength="10">
                </div>
                <div class="name-cle">
                <label>How the want to be notified ? </label>
                	<div class="check-sms">
                        <input id="checkbox-1" value="1" class="checkbox-custom" name="sms_notification" type="checkbox" checked>
                        <label for="checkbox-1"value="1" class="checkbox-custom-label">SMS </label>
                    </div>
                    <div class="check-sms">
                        <input id="checkbox-2" class="checkbox-custom" name="email_notification" type="checkbox">
                        <label for="checkbox-2" class="checkbox-custom-label">Email </label>
                    </div>
                </div>
            </div>
            <div class="persnail-details cf">
            	<h3><img src="<?=base_url("assets/front/")?>/images/persnoal-icone1.png" alt="img">address detail</h3>
                <div class="add-cle">
                	<label>address <em>*</em></label>
                    <input type="text" placeholder="" name="address" required="">
                </div>
            </div>
            <div class="persnail-details cf">
                <div class="state-cle select">
                	<label>state <em>*</em></label>
					<select id="state" name="state_id" data-parsley-required="true">
						<option value="">Select State</option>
						<?php
						$state=getStates();
						if(!empty($state) && is_array($state)){
							foreach($state as $sval){
								echo"<option value=".$sval->id.">".ucfirst($sval->name)."</option>" ;
							}
						}
						?>
					</select>
                </div>
                <div class="state-cle select">
                	<label>city <em>*</em></label>
                    <div id="city_data">
						<select id="city" name="city_id" data-parsley-required="true">
							<option value="">select city</option>
						</select>
					</div>
                </div>
                <div class="zip-cle">
                	<label>zip <em>*</em></label>
                    <input type="text" placeholder="Enter Zip Code" value="<?=set_value('pincode');?>" id="zip_code" name="pincode" data-parsley-type="digits" data-parsley-length="[4,6]" data-parsley-required="true">
                </div>
            </div>
            <div class="persnail-details cf">
            	<h3><img src="<?=base_url("assets/front/")?>/images/persnoal-icone2.png" alt="img">account setting</h3>
                <div class="user-edit-cle">
                	<label>user name <em>*</em></label>
                    <input type="text" placeholder="" name="username" value="prem102" readonly>
                </div>
                <div class="user-edit-cle">
                	<label>password </label>
                    <input type="password" name="password" id="password" placeholder="Password" data-parsley-length="[6, 20]" value="<?=set_value('password')?>">
                </div>
                <div class="user-edit-cle">
                	<label>confirm password </label>
                    <input type="password" placeholder="Confirm Password" data-parsley-equalto="#password" id="con_password" name="con_password" value="<?=set_value('con_password')?>">
                </div>
            </div>
            <div class="persnail-details cf">
                <div class="captha-cle">
                	<div class="g-recaptcha" data-sitekey="6LddxSYTAAAAAL-okkjOuVvvh8PCbUR0foBAGM7g" data-callback="correctCaptcha"></div>
                	<span class="captcha-error" style="display:none">Please validate the captcha !</span>
                </div>
            </div>
            <div class="persnail-details cf">
                <div class="submit-cls">
                	<button type="submit" value="submit" class="submit" name="submit">
                    submit <img src="<?=base_url("assets/front/")?>/images/arrow-submit.png" alt="img">
                </div>
                <div class="submit-cls">
                	<input type="reset" value="reset">
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>
<!-----------------main content end-------------->
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
	
?>
<script type="text/javascript">
$(function() {
	var selectBox = $("select").selectBoxIt();
});

	$("#client-form").submit(function( event ) {
		var captcha_response = grecaptcha.getResponse();
		if(captcha_response.length == 0){
			$('.captcha-error').show();
			return false;
		}
	});

	$("#state").change(function(){
		var str=$(this).val();
		$.post("<?=base_url('frontend/ajaxcontent/cityByState');?>",{'state':str}, function (response){
			if(response){
				$("#city_data").html(response);
				$('#client-form').parsley().isValid();
				$("#city").selectBoxIt();
			}
		});
   });
</script>
