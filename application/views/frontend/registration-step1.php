<?php
	$this->load->view('frontend/top');
	$this->load->view('frontend/header');
?>
<!------------main content start------------------->
	<div class="staff-ragistarion-outer">
    	<div class="container">
    		<div class="staff-ragistration-head cf">
            	<h1>Girl Registration</h1>
                <p>Please enter your Detail </p>
                <div class="staff-ragistration-step cf">
                	<ul class="cf">
                    	<li class="active"><label>Personal Detail</label></li>
                        <li><label>Services</label></li>
                        <li><label>Gallery</label></li>
                        <li><label>Social </label></li>
                    </ul>
                </div>
            </div>
            <div class="staf-ragistration-form cf">
            <?= form_open( 'registration/step2', array('id' => 'step1', 'name'=>'step1','Method'=>'POST','data-parsley-validate'=>'data-parsley-validate'))?>
                	<div class="information-client-box cf">
                    	<div class="informataion-details cf">
                        	<h3 class="veiw-able-head">viewable profile details</h3>
                            <div class="user-name-cls">
                            	<label>Display Name<em>*</em>:</label>
                            	<input type="text" data-parsley-whitespace="squish" data-parsley-minlength="3" data-parsley-required="true" placeholder="Enter Your Display Name" id="display_name" name="display_name">
                            </div>
                             
                        </div>
                        <div class="informataion-details cf">
                        	<div class="age-cls select">
                            	<label>Age<em>*</em>:</label>
                            	<select id="age" name="age" data-parsley-required="true">
                                	<option value="">select age</option>
                                    
                                    <?php for($i=18;$i<55;$i++){echo"<option value=".$i.">".$i." Year</option>";} ?>
                                   
                                </select>
                            </div>
                            <div class="age-cls select">
                            	<label>Gender<em>*</em>:</label>
                            	<select name="gender" id="gender" data-parsley-required="true">
                                	<option value="">select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                </div>
                            <div class="age-cls select">
                            	<label> Eye color<em>*</em>: </label>
                            	<div id="eye"><select name="eye-color" id="eye-color" data-parsley-required="true">
                                	<option value="">select eye color</option>
                                	<?php foreach($eyeColors as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select></div>
                            </div>
                            <div class="age-cls select">
                            	<label>Hair Color<em>*</em>:</label>
                            	<div id="hair"><select name="hair_color" id="hair_color" data-parsley-required="true">
                                	<option value="">select color</option>
                                    <?php foreach($hairColors as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select></div>
                            </div>
                        </div>
                        <div class="informataion-details cf">
                        	<div class="age-cls ">
                            	<label>Height:</label>
                                <div class="height-cm select">
                            	<select name="height_feet" id="height_feet">
                                	<option value="">feets</option>
                                     <?php for($i=1;$i<9;$i++){echo'<option value="'.$i.' Feet">'.$i.' Feet</option>';} ?>
                                </select>
                                </div>
                                <div class="height-cm select">
                            	<select name="height_inch" id="height-inch">
                                	<option value="">inches</option>
                                    <?php for($i=1;$i<12;$i++){echo'<option value="'.$i.' Inch">'.$i.' Inch</option>';} ?>
                                </select>
                                </div>
                            </div>
                            <div class="age-cls select">
                            	<label>Body type<em>*</em>:</label>
                            	<div id="body"><select name="body_type" id="body_type" data-parsley-required="true">
                                	<option value="">select body type</option>
                                    <?php foreach($bodyTypes as $val){
										
										echo"<option value=".$val->id."</option>".$val->name."</option>";
									}
                                    ?>
                                </select>
                                </div>  </div>
                            <div class="age-cls select">
                            	<label>Dress size: </label>
                            	<div id="dress"><select name="dress_size" id="dress_size">
                                	<option value="">select</option>
                                    <option value="1">S</option>
                                    <option value="2">SS</option>
                                    <option value="3">L</option>
                                    <option value="4">XL</option>
                                    <option value="5">XXL</option>
                                    
                                </select>
                            </div> </div>
                            <div class="age-cls select">
                            <div id="bust">	<label>Bust size: </label>
                            	<select name="bust_size" id="bust_size">
                                	<option value="">select size</option>
                                     <?php foreach($bustTypes as $val){
										
										echo"<option value=".$val->id."</option>".$val->name."</option>";
									}
                                    ?>
                                </select>
                            </div></div>
                        </div>
                        <div class="informataion-details cf">
                        	<div class="user-name-cls"><div class="user-name-cls serviceable serviceable1">
                            	<label>Serviceable Areas<em>*</em>:</label>
                            	<select id="main-city" name="main-city" data-parsley-required="true" multiple ></select>
                            </div>
                            </div>
                            <div class="user-name-cls serviceable ">
                            	<label>Other Serviceable Areas:</label>
                            	<select id="other-city" name="other-city[]" multiple ></select>
                            </div>
                            <div class="age-cls select">
                            	<label>Ethnicity:</label>
                            	<div id="ethni"><select name="ethnicity" id="ethnicity">
                                	<option  value="">select ethnicity</option>
                                     <?php foreach($ethnicities as $val){
										
										echo"<option value=".$val->id."</option>".$val->name."</option>";
									}
                                    ?>
                                </select>
                            </div>  </div> 
                        </div>
                        <div class="informataion-details cf">
                        	<h3>about me<em>*</em>:</h3>
                            <div class="about-me">
                            	<textarea id="about_me" name="about_me" data-parsley-whitespace="squish" data-parsley-required="true" data-parsley-minlength="60" data-parsley-minlength="500"></textarea>
                                <span>about me text not be exced 500 character</span>
                            </div> 
                        </div>
                        <div class="informataion-details cf">
                        	<h3>no disclosure Information</h3>
                            <div class="age-cls">
                            	<label>first name<em>*</em>:</label>
                            	<input type="text" placeholder="Enter First Name" id="fname" name="fname" data-parsley-required="true" data-parsley-minlength="3" data-parsley-whitespace="squish">
                            </div>
                            <div class="age-cls">
                            <label>last name:</label>
                            	<input type="text" placeholder="Enter Last name" id="lname" name="lname">
                            </div>
                        </div>
                        <div class="informataion-details cf">
                        	<div class="user-name-cls email-cls">
                            	<label>Email:</label>
                            	<input type="email" value="<?=(!empty($this->session->userdata('fronentLoginEmail')))?$this->session->userdata('fronentLoginEmail'):''?>" id="email" name="email" readonly="true">
                            </div>
                            <div class="age-cls">
                            	<label>Phone<em>*</em>:</label>
                            	<input type="text" placeholder="Enter Phone Number" id="phone" name="phone"data-parsley-type="integer" data-parsley-required="true" data-parsley-minlength="10" data-parsley-maxlength="10">
                            </div>
                            <div class="age-cls phone aternate">
                            	<input type="text" placeholder="Enter Alternate Number" id="alt_phone" name="alt_phone" data-parsley-type="integer" data-parsley-minlength="10" data-parsley-maxlength="10">
                            </div>
                        </div>
                        <div class="informataion-details cf">
                            <div class="addres">
                            	<label>Address<em>*</em>:</label>
                            	<input type="text" data-parsley-minlength="6" placeholder="Enter Your Address" id="address" name="address" data-parsley-whitespace="squish" data-parsley-required="true">
                            </div>
                        </div>
                        <div class="informataion-details cf">
                            <div class="user-name-cls phone select">
                            	<label>state<em>*</em>:</label>
                            	<select id="state" name="state" data-parsley-required="true">
                                	<option value="">select state</option>
                                   <?php
                                  $state=getStates();
                                  foreach($state as $sval){
									 echo"<option value=".$sval->id.">".ucfirst($sval->name)."</option>" ;
									  }
                                    ?>
                                </select>
                            </div>
                            <div class="user-name-cls phone select">
                            	<label>city<em>*</em>:</label>
                            	<div id="city_data"><select id="city" name="city" data-parsley-required="true">
                                	<option value="">select city</option>
                                   
                                </select></div>
                            </div>
                            <div class="user-name-cls zip">
                            	<label>zip<em>*</em>:</label>
                            	<input type="text" placeholder="Enter Zip Code" id="zip_code" name="zip_code" data-parsley-maxlength="6" data-parsley-required="true">
                            </div>
                        </div>
                         
                        <div class="btn-box">
                        <button type="submit" value="submit" class="submit" name="submit" id="submit">submit<img src="<?=base_url("assets/front/")?>/images/arrow-submit.png"></button>
                        
                        </div>
                        <div class="btn-box">
                        <button type="reset" value="reset" id="reset" name="reset">reset</button>
                        </div>
                    </div>
              <?=form_close();?>
            </div>
    	</div>
    </div>
<!-----------------main content end-------------->
<?php
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
	
?>
<script type="text/javascript">
	
	//=================================maincity and other city auto complete ===========================
	$(function() {
	 var selectBox = $(".select").find('select').selectBoxIt();
	 });
	 $('#main-city').tokenize({
	   datas: "<?=base_url('frontend/home/')?>/loadBabesCities",
	   placeholder:"Choose Location",
	   searchParam:"q" , 
	   maxElements: 1
	   });
	   $('#other-city').tokenize({
	   datas: "<?=base_url('frontend/home/')?>/loadBabesCities",
		placeholder:"Choose Location",
		searchParam:"q",
		maxElements: 10      
	   });
	   
	   //======================gender changes events ============================
	   $("#gender").change(function(){
		   var str=$(this).val();
		   $.post("<?=base_url('frontend/ajaxcontent/byGenderContent');?>",{'gender':str}, function (response){
		if(response){
		var res=response.split('*');
		$("#eye").html(res[0]);
		$("#hair").html(res[1]);
		$("#body").html(res[2]);
		$("#bust").html(res[3]);
		$("#ethni").html(res[4]);
		$('#step1').parsley().isValid();
		$(".select").find('select').selectBoxIt();
		}
		
	});
		   
		   })
	   
	   //=========================city on state changes =========================
	   $("#state").change(function(){
		    var str=$(this).val();
		   $.post("<?=base_url('frontend/ajaxcontent/cityByState');?>",{'state':str}, function (response){
			if(response){
			$("#city_data").html(response);
			$('#step1').parsley().isValid();
			$("#city").selectBoxIt();
			}
		   });
	   });
	
</script>
