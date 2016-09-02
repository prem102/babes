<?php
Class Hair_model extends MY_Model {
	public $table      = 'babes_hair_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllHairColors()
	 * @Description	-: This function used for get and return hair colors list
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllHairColors(){
		try{
			$hairs	= $this->Hair_model->get_all();
			if($hairs){
				return $hairs;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get hair list'.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: checkUniqueHairColor()
	 * @Description	-: This function used for check unique hair color
	 * @Param		-: $name(string), type(int), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueHairColor($name=NULL, $type=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id) && !empty($name)){
				$check	= $this->Hair_model->where('id !=',$id)->where('type',$type)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->Hair_model->where('name',$name)->where('type',$type)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique hair color name'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertHairColor();
	 * @Description	-: This function used for insert hair details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertHairColor($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->Hair_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert hair details'.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: updateHairColor();
	 * @Description	-: This function used for update hair details basis on id
	 * @Param		-: data(array()), id(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateHairColor($data=array(),$id=0){
		try{
			if(!empty($data) && !empty($id) && is_numeric($id)){
				$update	= $this->Hair_model->where('id',$id)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update hair details'.$ex->getMessage());
		}
	}

}

?>
