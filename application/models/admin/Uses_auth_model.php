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
    }
	
	
	/**
	 * @Function		-: loggedIn()
	 * @Description		-: This function used for check user login or not
	 * @Param			-: No Parameter
	 * Created on		-: 10-08-2016
	 * @Return			-: True/False
	 */
	public function loggedIn(){
		$userName	= $this->session->userdata('userName');
		$email		= $this->session->userdata('email');
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
		$newdata	= array('userName'=>'','email'=>'');
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
			$userName	= $this->session->userdata('userName');
			$email		= $this->session->userdata('email');
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
	 * 
	 * 
	 */
	public function login($userName=null,$password=null,$remeber=NULL){
		try{
			if(!empty($userName) && !empty($password)){
				$password = md5($password);
				$user = $this->User_model->where('username',$userName)->where('active',1)->where('password',$password)->get();
				if($user){
					if(!empty($remeber)){
						$domain = $_SERVER['SERVER_NAME'];
						$cookie = array(
									'name' => 'rememberMe',
									'username' => $userName,
									'password' => $password,
									'expire' => 31536000,
									'domain' => $domain
						);
						$this->input->set_cookie($cookie);
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

}
