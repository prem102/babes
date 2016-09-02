<?php
Class City_model extends MY_Model {
	public $table      = 'babes_city';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getAllCities()
	 * @Description	-: This function used for get and return cities list
	 * @Param		-: No Parameter
	 * @Return 		-: array()
	 * @Created on	-: 23-08-216
	 * 
	 */
	
	public function getAllCities(){
		try{
			$cities	= $this->db->select('bs.name as stateName,babes_city.*')
							->join('babes_state as bs','bs.id=babes_city.state')
							->order_by('name','DESC')
							->get('babes_city')->result();
			if($cities){
				return $cities;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get cities list'.$ex->getMessage());
		}
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
			$states	= $this->State_model->where('status','1')->order_by('name','ASC')->get_all();
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
	 * @Function	-: checkUniqueCity()
	 * @Description	-: This function used for check unique state name
	 * @Param		-: $name(string), $id(int)
	 * @Return		-: true/false
	 * @Created on	-: 23-08-2016
	 */
	
	public function checkUniqueCity($name=NULL,$stateId=0,$id=0){
		try{
			if(!empty($id) && is_numeric($id)){
				$records= $this->City_model->where('id !=',$id);
					if(!empty($stateId) && is_numeric($stateId)){
						$records->where('state',$stateId);
					}
				$check	= $records->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				$records	= $this->City_model;
					if(!empty($stateId) && is_numeric($stateId)){
						$records->where('state',$stateId);
					}
				$check	= $records->where('name',$name)->get_all();
				if($check){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique city name'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: insertCity();
	 * @Description	-: This function used for insert city details 
	 * @Param		-: No Parameter
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function insertCity($data=array()){
		try{
			if(!empty($data)){
				$insert	= $this->City_model->insert($data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to insert city details'.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function	-: updateCity();
	 * @Description	-: This function used for update city details basis on city id
	 * @Param		-: data(array()), statId(int)
	 * @Return		-: True/False
	 * @Created on	-: 23-08-2016
	 */
	public function updateCity($data=array(),$cityId=0){
		try{
			if(!empty($data) && !empty($cityId) && is_numeric($cityId)){
				$update	= $this->City_model->where('id',$cityId)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update city details'.$ex->getMessage());
		}
	}

}

?>
