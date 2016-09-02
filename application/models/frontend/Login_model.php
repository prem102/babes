<?php
Class Login_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: loggedIn()
	 * @Description		-: This function used for check user login or not
	 * @Param			-: No Parameter
	 * @Created on		-: 10-08-2016
	 * @Return			-: True/False
	 */
	public function loggedIn(){
		
		$userName	= $this->session->userdata('fronentLoginUserName');
		$email		= $this->session->userdata('fronentLoginEmail');
		
		if(!empty($userName) && !empty($email)){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * @Function		-: loggedOut()
	 * @Description		-: This function used for check user login or not
	 * @Param			-: No Parameter
	 * @Created on		-: 10-08-2016
	 * @Return			-: True/False
	 */
	public function loggedOut(){
		$newdata	= array('fronentLoginUserName'=>'','fronentLoginEmail'=>'');
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$url = base_url('signin');
		redirect($url,'refresh');
	}
	
	
	/**
	 * @Function		-: loggedInUser()
	 * @Description		-: This function used for get and return details of loggedin user 
	 * @Param			-: No Parameter
	 * @Created on		-: 10-08-2016
	 * @Return			-: array()
	 */
	public function loggedInUser(){
		try{
			$userName	= $this->session->userdata('fronentLoginUserName');
			$email		= $this->session->userdata('fronentLoginEmail');
			if(!empty($userName) && !empty($email)){
				$user = $this->db->where('users.username',$userName)
					->where('users.email',$email)
					->join('users_groups','users_groups.user_id=users.id')->get('users')->row();
				if($user){
					return $user;
				}else{
					$this->loggedOut();
				}
			}else{
				$this->loggedOut();
			}
		}catch(Exception $ex){
			log_message('error','Unable to get loggedIn user details '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: login()
	 * @Description		-: This function used for user login
	 * @Param			-: userName(string),password(string),remeber(true/false)
	 * @Return			-: true/false
	 * @Created on		-: 10-08-2016
	 */
	public function login($userName=null,$password=null,$remember=NULL){
		try{
			if(!empty($userName) && !empty($password)){
				$clientPassword	= md5($password.'client');
				$staffPassword	= md5($password.'staff');
				$user = $this->db
				->select('users.id,users.username,users.email,users_groups.group_id as groupId')
				->where('users.username',$userName)
				->where(" (users.password='".$clientPassword."' OR users.password='".$staffPassword."' )")
				->join('users_groups','users_groups.user_id=users.id AND users.active=1')
				->where_in('users_groups.group_id',array(2,3))
				->get('users')->row();
				if($user){
					$this->session->set_userdata('fronentLoginUserName',$user->username);
					$this->session->set_userdata('fronentLoginEmail',$user->email);
					$this->session->set_userdata('user_id',$user->id);
					$this->session->set_userdata('group_id',$user->groupId);
					$userGroup = $user->groupId;
					if(!empty($remember)){
						$domain = $_SERVER['SERVER_NAME'];
						$cookie_name = 'frontRememberUs';
						$cookie_value = $user->username.'__'.$password;
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
					}
					return $userGroup;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error','Unable to user login '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUsersGroups()
	 * @Description	-: This function used for get and return logged in user group
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 10-08-2016
	 */
	
	public function getUsersGroups(){
		try{
			$userId = $this->session->userdata('user_id');
			if(!empty($userId) && is_numeric($userId)){
				$group = $this->db->where('user_id',$userId)->get('users_groups')->row();
				if($group){
					return $group;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message('error','Unable to get user group '.$ex->getMessage());
		}
	}
	

}

?>
