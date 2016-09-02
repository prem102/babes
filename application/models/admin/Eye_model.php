<?php
Class Eye_model extends MY_Model {
	public $table      = 'babes_eye_color_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllEyeColors()
	 * @Description	-: This function used for get and return eye colors list
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllEyeColors(){
		try{
			$eyeColors	= $this->Eye_model->get_all();
			if($eyeColors){
				return $eyeColors;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get Eye color list '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: checkUniqueEyeColor()
	 * @Description	-: This function used for check unique eye color
	 * @Param		-: $name(string), $type(int), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueEyeColor($name=NULL, $type=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id) && !empty($name)){
				$check	= $this->Eye_model->where('id !=',$id)->where('type',$type)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->Eye_model->where('name',$name)->where('type',$type)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique eye color name'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertEyeColor();
	 * @Description	-: This function used for insert eye details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertEyeColor($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->Eye_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert eye color details'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: updateEyeColor();
	 * @Description	-: This function used for update eye details basis on id
	 * @Param		-: data(array()), id(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateEyeColor($data=array(),$id=0){
		try{
			if(!empty($data) && !empty($id) && is_numeric($id)){
				$update	= $this->Eye_model->where('id',$id)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update eye color details'.$ex->getMessage());
		}
	}

}

?>
