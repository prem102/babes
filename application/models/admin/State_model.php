<?php
Class State_model extends MY_Model {
	public $table      = 'babes_state';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllStates()
	 * @Description	-: This function used for get and return states list
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllStates(){
		try{
			$states	= $this->State_model->order_by('name','DESC')->get_all();
			if($states){
				return $states;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get states list'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: checkUniqueState()
	 * @Description	-: This function used for check unique state name
	 * @Param		-: $name(string), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueState($name=NULL,$id=0){
		try{
			if(!empty($id) && is_numeric($id)){
				$check	= $this->State_model->where('id !=',$id)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->State_model->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique state name'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: addState();
	 * @Description	-: This function used for update state details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertState($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->State_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert state details'.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: updateState();
	 * @Description	-: This function used for update state details basis on state id
	 * @Param		-: data(array()), statId(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateState($data=array(),$stateId=0){
		try{
			if(!empty($data) && !empty($stateId) && is_numeric($stateId)){
				$update	= $this->State_model->where('id',$stateId)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update state details'.$ex->getMessage());
		}
	}

}

?>
