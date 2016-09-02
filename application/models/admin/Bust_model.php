<?php
Class Bust_model extends MY_Model {
	public $table      = 'babes_bust_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllBustTypes()
	 * @Description	-: This function used for get and return bust types
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllBustTypes(){
		try{
			$bustTypes	= $this->Bust_model->get_all();
			if($bustTypes){
				return $bustTypes;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get Bust Type list '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: checkUniqueBustType()
	 * @Description	-: This function used for check unique Bust Type
	 * @Param		-: $name(string), $type(int), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueBustType($name=NULL, $type=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id) && !empty($name)){
				$check	= $this->Bust_model->where('id !=',$id)->where('type',$type)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->Bust_model->where('name',$name)->where('type',$type)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique Bust type'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertBustType();
	 * @Description	-: This function used for insert bust type details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertBustType($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->Bust_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert bust type details'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: updateBustType();
	 * @Description	-: This function used for update bust type details basis on id
	 * @Param		-: data(array()), id(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateBustType($data=array(),$id=0){
		try{
			if(!empty($data) && !empty($id) && is_numeric($id)){
				$update	= $this->Bust_model->where('id',$id)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update bust type details'.$ex->getMessage());
		}
	}

}

?>
