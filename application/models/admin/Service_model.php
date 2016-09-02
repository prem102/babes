<?php
Class Service_model extends MY_Model {
	public $table      = 'babes_services_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: checkUniqueService()
	 * @Description	-: This function used for check unique service name
	 * @Param		-: id(int),name(string)
	 * @Return		-: true/false
	 * @Created on	-: 02-09-2016
	 */
	public function checkUniqueService($name=null,$id=0){
		try{
			if(!empty($name)){
				$result = $this->db->where('name',$name);
				if(!empty($id) && is_numeric($id)){
					$result->where('id !=',$id);
				}
				$check = $result->get('babes_services_master')->result();
				if($check){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to check unique service name'.$ex->getMessage());
		}
	}
	/**
	 * @Function	-: manageService()
	 * @Description	-: This function used for insert or update service
	 * @Param		-: data(array()),serviceId(int)
	 * @Return		-: true/false;
	 * @Created on	-: 02-09-2016
	 */
	public function manageService($data=array(),$serviceId=0){
		try{
			if(!empty($serviceId) && is_numeric($serviceId)){
				$updateService	= $this->Service_model->where('id',$serviceId)->update($data);
				if($updateService){
					return true;
				}else{
					return false;
				}
			}else{
				$insertService	= $this->Service_model->insert($data);
				if($insertService){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex ){
			log_message('',' Unable to insert or update babes master services '.$ex->getMessage());
		}
	}
}

?>
