<?php
Class Ethnicity_model extends MY_Model {
	public $table      = 'babes_ethnicity_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllEthnicity()
	 * @Description	-: This function used for get and return ethnicity
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllEthnicity(){
		try{
			$ethnicities	= $this->Ethnicity_model->get_all();
			if($ethnicities){
				return $ethnicities;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get ethnicity list '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: checkUniqueEthnicity()
	 * @Description	-: This function used for check unique ethnicity
	 * @Param		-: $name(string), $type(int), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 24-08-2016
	 */
	
	public function checkUniqueEthnicity($name=NULL, $type=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id) && !empty($name)){
				$check	= $this->Ethnicity_model->where('id !=',$id)->where('type',$type)->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$check	= $this->Ethnicity_model->where('name',$name)->where('type',$type)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check ethnicity '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertEthnicity();
	 * @Description	-: This function used for insert ethnicity details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 24-08-2016
	 */
	public function insertEthnicity($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->Ethnicity_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert ethnicity details'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: updateEthnicity();
	 * @Description	-: This function used for update ethnicity details basis on id
	 * @Param		-: data(array()), id(int)
	 * @Return		-: True/False
	 * @Created on	-: 24-08-2016
	 */
	public function updateEthnicity($data=array(),$id=0){
		try{
			if(!empty($data) && !empty($id) && is_numeric($id)){
				$update	= $this->Ethnicity_model->where('id',$id)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update ethnicity details'.$ex->getMessage());
		}
	}

}

?>
