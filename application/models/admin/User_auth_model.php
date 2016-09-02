<?php
/**
* Name		-: Ion Auth Model
*
* Author	-: Sandeep, Prem
*
* Created	-: 10-08-22016
*
*/
class User_auth_model extends MY_Model {
	function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model');
        $this->load->helper('cookie');
    }
	
	
	/**
	 * @Function		-: loggedIn()
	 * @Description		-: This function used for check user login or not
	 * @Param			-: No Parameter
	 * Created on		-: 10-08-2016
	 * @Return			-: True/False
	 */
	public function loggedIn(){
		$userName	= $this->session->userdata('loginUserName');
		$email		= $this->session->userdata('loginEmail');
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
	 * Created on		-: 10-08-2016
	 * @Return			-: True/False
	 */
	public function loggedOut(){
		$newdata	= array('loginUserName'=>'','loginEmail'=>'');
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$url = base_url('admin/auth/login');
		redirect($url,'refresh');
	}
	
	
	/**
	 * @Function		-: loggedInUser()
	 * @Description		-: This function used for get and return details of loggedin user 
	 * @Param			-: No Parameter
	 * Created on		-: 10-08-2016
	 * @Return			-: array()
	 */
	public function loggedInUser(){
		try{
			$userName	= $this->session->userdata('loginUserName');
			$email		= $this->session->userdata('loginEmail');
			if(!empty($userName) && !empty($email)){
				$user = $this->User_model->where('username',$userName)->where('email',$email)->get();
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
	public function login($userName=null,$password=null,$remeber=NULL){
		try{
			if(!empty($userName) && !empty($password)){
				$user = $this->User_model->where('username',$userName)
				->where('active',1)->where('password',md5($password))->get();
				if($user){
					$this->session->set_userdata('loginUserName',$userName);
					$this->session->set_userdata('loginEmail',$user->email);
					$this->session->set_userdata('user_id',$user->id);
					if(!empty($remeber)){
						$domain = $_SERVER['SERVER_NAME'];
						$cookie_name = 'rememberUs';
						$cookie_value = $userName.'__'.$password;
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
					}
					return true;
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
