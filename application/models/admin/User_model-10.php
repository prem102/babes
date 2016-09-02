<?php
Class User_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
		$this->has_many['users_groups'] = array('foreign_model'=>'Group_model','foreign_table'=>'users_groups','foreign_key'=>'user_id','local_key'=>'id');
		$this->has_one['user_commission'] = array('foreign_model'=>'Commission_model','foreign_table'=>'seller_commission','foreign_key'=>'user_id','local_key'=>'id');
	}
	
	/**
	 * @Method		-: getAllGroup()
	 * @Description	-: This function used for fetch all user group basis on condition
	 * @Param		-: condition (string)
	 * @Created on	-: 17-07-2016
	 * @Updated on	-: 04-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function getAllGroup($condition=null){
		try{
			$groups = $this->db->where('id !=',1)->where('deleted_at',NULL);
			if(!empty($condition) && $condition=='subAdmin'){
				$groups->where_not_in('id',array('2','3'));
			}
			$groups = $groups->where('status','1')->get('groups')->result();
			if($groups){
				return $groups;
			}
		}catch(Exception $ex){
			log_message('error ',' Error on fetching users group');
			return false;
		}
	}
	/**
	 * @Function		-: getUserDetails();
	 * @Description		-: This function used for get and return user details basis on id
	 * @Param			-: id (int), groupId
	 * @Return			-: array()
	 * @Craeted on		-: 27-07-2016
	 * @Modify on		-: 28-07-2016
	 */ 
	
	public function getUserDetails($id=0){
		try{
			if(!empty($id) && is_numeric($id) ){
				$result = $this->db
				->join('users_groups','users_groups.user_id=users.id AND users.deleted_at is null ')
				->where('users.id',$id)->get('users')->row();
				if($result){
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message(' error', 'Error on getting user details '.$ex->getMessage());
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
					$clientsCount->select('users.id,users.username,users.email,users.active,users.phone,users.username,users.active,groups.name as group');
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
				if($searchData['userContact']){
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
	
	//****** Sub Admin functions start here ******//
	
	
	/**
	 * @Function 		-: getSubAdmin() 
	 * @Description		-: This function used for get and return sub admins list
	 * @Param			-: No Parameter
	 * @Return			-: array()
	 * @Created on		-: 27-07-2016
	 */
	
	public function getSubAdmin(){
		try{
			$results = $this->db
				->select('users.id,users.username,users.email,users.active,users.phone,users.username,users.active,groups.name as group')
				->join('users_groups','users_groups.user_id=users.id  AND users.deleted_at is null')
				->join('groups','groups.id=users_groups.group_id')
				->where('groups.id !=',1)
				->group_by('users.id')->get('users')->result();
			if($results){
				return $results;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message(' error', 'Sub Admin not listed '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: insertSubadmin()
	 * @Description		-: This function used for insert subadmin details 
	 * @Param			-: identity(string),password(string),email(string),additional_data (array), groups (array)
	 * @Return			-: True/False
	 * @Created on		-: 27-07-2016
	 */
	public function insertSubadmin($identity, $password, $email, $additional_data = array(), $groups = array()){
		try{
				/****** Inserting ******/
				$check	= $this->db
								->join('users_groups','users_groups.user_id=users.id AND users.active=1 AND users.deleted_at is null AND users_groups.group_id=2')
								->where('users.username',$additional_data['username'])->where('users.email',$identity)->get('users')->result();
				if(empty($check)){
					$register = $this->Ion_auth_model->register($identity, $password, $email, $additional_data = array(), $groups = array());
					dump($register);
					if($register){
						setMessage('Sub Admin successfully added ','success');
						redirect('admin/users/');
					}
				}else{
					setMessage('Username/Email id already exists ','warning');
				}
		}catch(Exception $ex){
			log_message(' error', 'Error on Inserting Sub Admin '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: UpdateSubadmin()
	 * @Description		-: This function used for update subadmin details basis on id
	 * @Param			-: updateData(array), id (int)
	 * @Return			-: True/False
	 * @Created on		-: 27-07-2016
	 */
	public function updateSubadmin($updateData = array(), $id = 0){
		try{
				/****** Updating  ******/
			if(!empty($id) && is_numeric($id)){
				$check	= $this->db
								->join('users_groups','users_groups.user_id=users.id AND users.active=1 AND users.deleted_at is null AND users_groups.group_id=2')
								->where('users.username',$updateData['username'])->where('users.id !=',$id)->get('users')->result();
				if(empty($check)){
					$update = $this->db->where('id',$id)->update('users',$updateData);
					if($update){
						setMessage('Sub Admin successfully added ','success');
						redirect('admin/users/');
					}
				}else{
					setMessage('Username/Email already exists ','warning');
				}
			}
		}catch(Exception $ex){
			log_message(' error', 'Error on Updating Sub Admin '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function		-: UpdateClient()
	 * @Description		-: This function used for update client details basis on id
	 * @Param			-: updateData(array), id (int)
	 * @Return			-: True/False
	 * @Created on		-: 28-07-2016
	 */
	public function updateClient($updateData = array(), $id = 0){
		try{
				/****** Updating  ******/
			if(!empty($id) && is_numeric($id)){
				$check	= $this->db
								->join('users_groups','users_groups.user_id=users.id AND users.deleted_at is null AND users_groups.group_id=3')
								->where('users.username',$updateData['username'])->where('users.id !=',$id)->get('users')->result();
				if(empty($check)){
					$update = $this->db->where('id',$id)->update('users',$updateData);
					if($update){
						setMessage('Client successfully added ','success');
						redirect('admin/users/clients');
					}
				}else{
					setMessage('Username/Email already exists ','warning');
				}
			}
		}catch(Exception $ex){
			log_message(' error', 'Error on Updating Client '.$ex->getMessage());
		}
	}
}

?>
