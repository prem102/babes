<?php
Class Client_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: updateProfile()
	 * @Description	-: This function used for update client profile
	 * @Param		-: data(array()),id(int)
	 * @Return		-: true/false
	 * @Created On	-: 16-08-2016
	 */
	public function updateProfile($data=array(),$clientId=0){
		try{
			if(!empty($data) && !empty($clientId) && is_numeric($clientId)){
				$update		= $this->Client_model->where('id',$clientId)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update client details '.$ex->getMessage());
		}
	}
	/**
	 * @Function	-: updateClientAddress()
	 * @Description	-: This function used for update client address
	 * @Param		-: addressData(array()),clientId(int)
	 * @Return		-: true/false
	 * @Created on	-: 02-09-2016
	 */
	public function updateClientAddress($addressData=array(),$clientId=0){
		try{
			if(!empty($clientId) && is_numeric($clientId)){
				$check	= $this->db->where('user_id',$clientId)->get('babes_users_address')->row();
				if($check){
					$update	= $this->db->where('user_id',$clientId)->update('babes_users_address',$addressData);
					if($update){
						return true;
					}else{
						return false;
					}
				}else{
					$insert	= $this->db->insert('babes_users_address',$addressData);
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update client address '.$ex->getMessage());
		}
	}
}

?>
