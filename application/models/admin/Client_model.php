<?php
Class Client_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Method		-: updateClientAddress()
	 * @Description	-: This function used for update user address
	 * @Param		-: data (array),clientId(int)
	 * @Created on	-: 24-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function updateClientAddress($data=array(),$clientId=0){
		try{
			if(!empty($clientId) && is_numeric($clientId)){
				$check	= $this->db->where('user_id',$clientId)->get('babes_users_address')->row();
				if($check){
					$update	= $this->db->where('user_id',$clientId)->update('babes_users_address',$data);
					if($update){
						return true;
					}else{
						return false;
					}
				}else{
					$insert	= $this->db->insert('babes_users_address',$data);
					if($insert){
						return true;
					}else{
						return false;
					}
				}

			}
		}catch(Exception $ex){
			log_message('error ',' Unable to update client address '.$ex->getMessage());
			return false;
		}
	}
	
/**
	 * @Method		-: updateClientNotification()
	 * @Description	-: This function used for update user notification
	 * @Param		-: data (array),clientId(int)
	 * @Created on	-: 24-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function updateClientNotification($data=array(),$clientId=0){
		try{
			if(!empty($clientId) && is_numeric($clientId)){
					$update	= $this->db->where('id',$clientId)->update('users',$data);
					if($update){
						return true;
					}else{
						return false;
					}
			}
		}catch(Exception $ex){
			log_message('error ',' Error on updateing client notification '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function 		-: getClientsRecords() 
	 * @Description		-: This function used for get and return clients list using filter or without filter
	 * @Param			-: searchData (array), start (int)
	 * @Return			-: array()
	 * @Created on		-: 27-07-2016
	 */
	 
	public function getClientsRecords($searchData = array(), $start=NULL){
		try{
			$clientsCount = $this->db;
				if($start){
					$clientsCount->select('users.id,users.username,users.email,users.active,users.phone,users.active,groups.name as group,users.first_name as clientName,users.image');
				}
				$clientsCount->join('users_groups','users_groups.user_id=users.id  AND users.deleted_at is null')
				->join('groups','groups.id=users_groups.group_id')
				->where_in('groups.id',array(3));
				if($searchData['userName']){
					$clientsCount->like('users.username',$searchData['userName']);
				}
				if($searchData['userEmail']){
					$clientsCount->like('users.email',$searchData['userEmail']);
				}
				if(isset($searchData['userContact'])){
					$clientsCount->like('users.phone',$searchData['userContact']);
				}
				if($searchData['userStatus']==2){
					$clientsCount->where('users.active',0);
				}
				if($searchData['userStatus']==1){
					$clientsCount->where('users.active',1);
				}
				if(!empty($start)){
					$start = ($start=='A') ? 0 : $start;
					$clients = $clientsCount->limit($this->limit,$start)->group_by('users.id')->get('users')->result();
				}else{
					$clients = $clientsCount->group_by('users.id')->get('users')->num_rows();
				}
				if($clients){
					return $clients;
				}else{
					return false;
				}
		}catch(Exception	$ex){
			log_message('error', 'Clients not listed'.$ex->getMessage());
		}
	}
	
	
}

?>
