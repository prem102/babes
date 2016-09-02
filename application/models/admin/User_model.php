<?php
Class User_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
		
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
	 * @Function	-: getUserAddress()
	 * @Description	-: This function used for get and return user address
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 24-08-2016
	 */
	
	public function getUserAddress($userId=0){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$address = $this->db->select('BC.name as country,BCI.name as city, BS.name as state,BUA.*')
							->join('babes_country as BC','BC.id=BUA.country_id')
							->join('babes_state as BS','BS.id=BUA.state_id')
							->join('babes_city as BCI','BCI.id=BUA.city_id')
							->where('BUA.user_id',$userId)->get('babes_users_address as BUA')->row();
				if($address){
					return $address;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user address'.$ex->getMessage());
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
				->where_not_in('groups.id',array(2,3))
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
								->join('users_groups','users_groups.user_id=users.id AND users.deleted_at is null')
								->where('users.email',$updateData['email'])->where('users.id !=',$id)->get('users')->result();
				if(empty($check)){
					$update = $this->db->where('id',$id)->update('users',$updateData);
					if($update){
						setMessage('Client successfully updated ','success');
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
	/**
	 * @Function		-: checkUniqueUsername()
	 * @Description		-: This function used for check unique user name
	 * @Param			-: userName (string)
	 * @Retutn			-: true / false
	 * @Created on		-: 10-08-2016
	 * 
	 */
	public function checkUniqueUsername($userName=null,$id=0){
		try{
			if(!empty($userName)){
				$records = $this->db->where('username',$userName)->where('deleted_at',NULL);
				if(!empty($id) && is_numeric($id)){
					$records->where('id !=',$id);
				}
				$users = $records->get('users')->result();
				if($users){
					return false;
				}else{
					return true;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to check unique user name '.$ex->getMessage());
		}
	}
	/**
	 * @Function		-: checkUniqueEmail()
	 * @Description		-: This function used for check unique email
	 * @Param			-: userName (string)
	 * @Retutn			-: true / false
	 * @Created on		-: 10-08-2016
	 * 
	 */
	public function checkUniqueEmail($email=null,$id=0){
		try{
			if(!empty($email)){
				$records = $this->db->where('email',$email)
				->where('deleted_at',NULL);
				if(!empty($id) && is_numeric($id)){
					$records->where('id !=',$id);
				}
				$users = $records->get('users')->result();
				if($users){
					return false;
				}else{
					return true;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to check unique email '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: userRegisteration()
	 * @Description		-: This function used for user registration
	 * @Param			-: data(array),groupId(int)
	 * @Return			-: True/False
	 * @Created on		-: 10-08-2016
	 */
	public function userRegisteration($data=array(),$groupId=0){
		try{
			if(!empty($data) && !empty($groupId)){
				$userInsert = $this->User_model->insert($data);
				if($userInsert){
					$addUserGroup = $this->addUserToGroup($userInsert,$groupId);
					if($addUserGroup){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to user registration '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: userUpdate()
	 * @Description		-: This function used for user update
	 * @Param			-: data(array),groupId(int)
	 * @Return			-: True/False
	 * @Created on		-: 10-08-2016
	 */
	public function userUpdate($data=array(),$groupId=0){
		try{
			$id = $data['id'];
			if(!empty($data) && !empty($groupId) && !empty($id)){
				$userUpdate = $this->User_model->where('id',$id)->update($data);
				if($userUpdate){
					$userUpdate = $this->addUserToGroup($id,$groupId);
					if($userUpdate){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to user registration '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function		-: addUserToGroup()
	 * @Description		-: This function used for add an user to a group basis on userId and groupId
	 * @Param			-: userId(int),groupId(int)
	 * @Return			-: True/False
	 * @Created on		-: 10-08-2016
	 */
	public function addUserToGroup($userId=0,$groupId=0){
		try{
			if(!empty($userId) && !empty($groupId)){
				$userGroup = $this->db->where('user_id',$userId)->get('users_groups')->result();
				if($userGroup){
					$success = $this->db->where('user_id',$userId)->update('users_groups',array('group_id'=>$groupId));
				}else{
					$success = $this->db->insert('users_groups',array('user_id'=>$userId,'group_id'=>$groupId));
				}
				if($success){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message(' error', 'Unable to add an user to a group '.$ex->getMessage());
		}
	}

}

?>
