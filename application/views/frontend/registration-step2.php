<?php  $this->load->view('frontend/top');
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
                        <li class="active"><label>Services</label></li>
                        <li><label>Gallery</label></li>
                        <li><label>Social </label></li>
                    </ul>
                </div>
            </div>
            <div class="staf-ragistration-form cf">
            <?= form_open( 'registration/step3', array('id' => 'step2', 'name'=>'step2','Method'=>'POST','data-parsley-validate'=>'data-parsley-validate'))?>
           
                	<div class="information-client-box cf">
                    	<div class="informataion-details cf">
                        	<h3>services</h3>
                        	<input type="hidden" id="gender" value="<?=(!empty($gender))?$gender:''?>" />
                        	
                            <div class="step-two-information cf" >
                            <div class="servise-area select">
                            	<select id="main_service" name="main_service[]" data-parsley-required="true">
                                	<option value="">select service</option>
                                	<?php if(!empty($services)){
										$m=0;
										foreach($services as $sval)
										{
										if($sval->service_type=='1')continue;
										echo "<option value=".$sval->id.">".$sval->name."</option>";
										$m++;	
										}										
										}?>
                                </select>
                            </div>
                            <div class="doller-cls">
                            	<input type="text" placeholder="Ex:$100" name="service_price[]" id="service_price" data-parsley-required="true"  data-parsley-trigger="keyup" 
    data-parsley-type="number">
                            </div>
                            <div class="hours-cls select">
                            	<select id="service_hours" name="service_hours[]" data-parsley-required="true">
                                	<option value="">hours</option>
                                	<?php for($i=0;$i<13;$i++){echo'<option value="'.$i.' Hr">'.$i.' Hr</option>';} ?>
                                	  </select>
                            </div>
                            <div class="hours-cls select">
                            	<select id="service_minuts" name="service_minuts[]">
                                	<option value="">minuts</option>
                                <?php for($i=1;$i<12;$i++){
									$t=$i*5; echo'<option value="'.$t.' Min">'.$t.' Min</option>';} ?>
                                </select>
                            </div> 
                             
                        </div>
                         
                        <img  class="remove-btn" id="add_main_service" src="<?=base_url("assets/front/")?>/images/add-icone.png">
                          
                        
                        </div>
                        <div class="informataion-details cf">
                        	<h3>extra services</h3>
                            <div class="step-two-information cf" id="extra-service-input">
                            <div class="servise-area select">
                            	<select id="extra_service" name="extra_service[]" >
                                	<option value="">select extra service</option>
                                	<?php if(!empty($services)){
										$e=0;
										foreach($services as $sval)
										{
										if($sval->service_type=='0')continue;
										echo "<option value=".$sval->id.">".$sval->name."</option>";
										$e++;	
										}										
										}?>
                                </select>
                            </div>
                            <div class="doller-cls">
                            	<input type="text" placeholder="Ex:$100" name="extre_service_price[]"  data-parsley-trigger="keyup" 
    data-parsley-type="number" id="extra_service_price">
                            </div>
                            <div class="hours-cls select">
                            	<select  id="extra_service_hours" name="extra_service_hours[]">
                                	<option value="">hours</option>
                                	<?php for($i=1;$i<13;$i++){echo'<option value="'.$i.' Hr">'.$i.' Hr</option>';} ?>
                                </select>
                            </div>
                            <div class="hours-cls select">
                            	<select  id="extra_service_minuts" name="extra_service_minuts[]">
                                	<option value=""> minuts</option>
                                	 <?php for($i=1;$i<12;$i++){
									$t=$i*5; echo'<option value="'.$t.' Min">'.$t.' Min</option>';} ?>
                                </select>
                            </div> 
                            
                        </div>
                         <img  class="remove-btn" id="add_extra_service" src="<?=base_url("assets/front/")?>/images/add-icone.png">
                           
                        </div>
                        <div class="btn-box">
							<input type="hidden" id="main_service_count" value="<?=(!empty($m))?$m:''?>" />
							<input type="hidden" id="other_service_count" value="<?=(!empty($e))?$e:''?>" />
                        <button type="submit" value="submit" class="submit" name="submit" id="submit" >submit<img src="<?=base_url("assets/front/")?>/images/arrow-submit.png"></button>
                        
                        </div>
                        <div class="btn-box">
                        <button type="reset" value="reset" name="reset" id="reset">reset</button>
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
	$(function() {
	 var selectBox = $("select").selectBoxIt();
	 });
	 
	 //============================add main service ==============================
	$("#add_main_service").click(function(){
		 var str=$("#gender").val();
		var service= $("#main_service_count").val();		
		if(service>1){
		service=parseInt(service)-1;
		$("#main_service_count").val(service);
		var ser=service+"_main";
		   $.post("<?=base_url('frontend/ajaxcontent/addMainService');?>",{'gender':str,'id':ser}, function (response){
			if(response){
			$("#add_main_service").before(response);
			$('#step2').parsley().isValid(); $("select").selectBoxIt();
			}
		   });
		}
		}) ;
		 //============================add main service ==============================
	$("#add_extra_service").click(function(){
		 var str=$("#gender").val();
		var service= $("#other_service_count").val();		
		if(service>1){
		service=parseInt(service)-1;
		$("#other_service_count").val(service);
			var ser=service+"extra";
		   $.post("<?=base_url('frontend/ajaxcontent/addExtraService');?>",{'gender':str,'id':ser}, function (response){
			if(response){
			$("#add_extra_service").before(response);
			$('#step2').parsley().isValid();
			$("select").selectBoxIt();
			
			}
		   });
		}
		}) 
  //================================ remove service ====================================
  $(".informataion-details").on('click','.remove_main_service',function(){
	 var d= $(this).attr('data');	
	 $("#"+d).remove();
	 $(this).remove();
	  });
	 $(".informataion-details").on('click','.remove_extra_service', function(){
	 var d= $(this).attr('data');
	 $("#"+d).remove();
	 $(this).remove();
	  });
</script>
