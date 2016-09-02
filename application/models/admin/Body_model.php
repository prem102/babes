<?php
Class Body_model extends MY_Model {
	public $table      = 'babes_body_type_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllBodyTypes()
	 * @Description	-: This function used for get and return body types
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllBodyTypes(){
		try{
			$bodyTypes	= $this->Body_model->get_all();
			if($bodyTypes){
				return $bodyTypes;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get Body Type list '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: checkUniqueBodyType()
	 * @Description	-: This function used for check unique Body Type
	 * @Param		-: $name(string), $type(int), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueBodyType($name=NULL, $type=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id) && !empty($name)){
				$check	= $this->Body_model->where('id !=',$id)->where('type',$type)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->Body_model->where('name',$name)->where('type',$type)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique Body type'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertBodyType();
	 * @Description	-: This function used for insert body type details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertBodyType($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->Body_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert body type details'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: updateBodyType();
	 * @Description	-: This function used for update body type details basis on id
	 * @Param		-: data(array()), id(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateBodyType($data=array(),$id=0){
		try{
			if(!empty($data) && !empty($id) && is_numeric($id)){
				$update	= $this->Body_model->where('id',$id)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update body type details'.$ex->getMessage());
		}
	}

}

?>
