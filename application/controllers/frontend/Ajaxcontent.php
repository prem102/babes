<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Ajaxcontent extends CI_Controller {

    function __construct() {
        parent::__construct();       
        $this->load->helper('common_helper');         
        $this->load->model('frontend/Home_model');
       
    }
    
    /**
     * 
     * 
     * 
     * */
     function byGenderContent()
     {		
			if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='2'){
			return false;
			}
			$postData = $this->input->post();
			if(!empty($postData)){
				$gender		= !empty($postData['gender']) ? $postData['gender'] :'';
				$searchtype='1';
				$Bust="Bust";
				if($gender=='Female'){
					$searchtype='1';$Bust="Bust";
					}
					if($gender=='Male'){
					$searchtype='2';$Bust="Chest";
					}
					 if($gender=='Other'){$searchtype='2';$Bust="Bust/Chest";}	
				$hairColors	= $this->Home_model->getHairColors($searchtype);
				$eyeColors = $this->Home_model->getEyeColors($searchtype);
				$bodyTypes=$this->Home_model->getBodyTypes($searchtype);
				$bustTypes = $this->Home_model->getBustTypes($searchtype);
				$ethnicities = $this->Home_model->getEthnicities($searchtype); 
				?>
				<select name="eye_color" id="eye_color" data-parsley-required="true">
                                	<option value="">select eye color</option>
                                	<?php foreach($eyeColors as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select>*<select name="hair_color" id="hair_color" data-parsley-required="true">
                                	<option value="">select color</option>
                                    <?php foreach($hairColors as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select>*<select name="body_type" id="body_type" data-parsley-required="true">
                                	<option value="">select body type</option>
                                    <?php foreach($bodyTypes as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select>*<label><?=$Bust?> size: </label>
                            	<select name="bust_size" id="bust_size">
                                	<option value="">select size</option>
                                     <?php foreach($bustTypes as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select>*
				<select name="ethnicity" id="ethnicity" >
                                	<option  value="">select ethnicity</option>
                                     <?php foreach($ethnicities as $val){
										
										echo"<option value=".$val->id.">".$val->name."</option>";
									}
                                    ?>
                                </select>
				<?php
				
			}
	 }
	 
	 /**
	  * 
	  * 
	  * 
	  * 
	  * 
	  * */
	  
	  function cityByState(){
		  $postData = $this->input->post();
			if(!empty($postData)){
				$state		= !empty($postData['state']) ? $postData['state'] :'';
				$city=getCities($state);
				echo'<select id="city" name="city" data-parsley-required="true">
                     <option value="">select city</option>';
                      foreach($city as $cval){
						  echo"<option value=".$cval->id.">".ucfirst($cval->name)."</option>" ; 
						}          	
                                   
              echo'</select>';
			}
		  
		  }
 
 /**
  * 
  * 
  * 
  * 
  * */
  function addMainService(){
	  $postData = $this->input->post();
	   $services= $this->Home_model->getServices($postData['gender']);
			if(!empty($postData)){
	  ?>
	  <img  class="remove-btn remove_main_service"  data="<?=$postData['id']?>" src="<?=base_url("assets/front/")?>/images/crose-icone.png">
                       
                        <div class="step-two-information cf" id="<?=$postData['id']?>">
                            <div class="servise-area select">
                            	<select  name="main_service[]" data-parsley-required="true">
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
                            	<input type="text" placeholder="Ex:$100" name="service_price[]"  data-parsley-trigger="keyup" 
    data-parsley-type="number" data-parsley-required="true">
                            </div>
                            <div class="hours-cls select">
                            	<select  name="service_hours" data-parsley-required="true">
                                	<option value="">hours</option>
                                	<?php for($i=1;$i<13;$i++){echo'<option value="'.$i.' Hr">'.$i.' Hr</option>';} ?>
                                	  </select>
                            </div>
                            <div class="hours-cls select">
                            	<select  name="service_minuts[]">
                                	<option value="">minuts</option>
                                <?php for($i=1;$i<12;$i++){
									$t=$i*5; echo'<option value="'.$t.' Min">'.$t.' Min</option>';} ?>
                                </select>
                            </div> 
                             
                        </div>
	  <?php
	  }
  }
	  /**
  * 
  * 
  * 
  * 
  * */
  function addExtraService(){
	  
	   $postData = $this->input->post();
	   $services= $this->Home_model->getServices($postData['gender']);
			if(!empty($postData)){
	  ?>
	  <img  class="remove-btn  remove_extra_service" data="<?=$postData['id']?>" src="<?=base_url("assets/front/")?>/images/crose-icone.png">
                       
                       <div class="step-two-information cf" id="<?=$postData['id']?>">
                            <div class="servise-area select">
                            	<select  name="extra_service[]" >
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
                            	<input type="text" placeholder="Ex:$100" name="extre_service_price[]" data-parsley-trigger="keyup"  data-parsley-type="number">
                            </div>
                            <div class="hours-cls select">
                            	<select   name="extra_service_hours[]">
                                	<option value="">hours</option>
                                	<?php for($i=1;$i<13;$i++){echo'<option value="'.$i.' Hr">'.$i.' Hr</option>';} ?>
                                </select>
                            </div>
                            <div class="hours-cls select">
                            	<select   name="extra_service_minuts[]">
                                	<option value=""> minuts</option>
                                	 <?php for($i=1;$i<12;$i++){
									$t=$i*5; echo'<option value="'.$t.' Min">'.$t.' Min</option>';} ?>
                                </select>
                            </div>
                            </div>
	  <?php
	  }
  }
 //==============================controller end ======================================   
}
