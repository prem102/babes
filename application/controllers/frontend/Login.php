<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Login_model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->lang->load('auth');
       
        
    }
    /**
     * @Function	-: index()
     * @Description	-: This function used for log front end use (Staff/CLient)
     * @Param		-: No Parameter
     * @Created on	-: 08-08-2016
     * 
     */
     
	function index(){
		$data['js']		= array('jquery-1.12.3.min'); 
		$data['meta']	=array();
		$data['css']	=array('common','signin');
		try{
			if(isset($_COOKIE['frontRememberUs'])){
				$value = $_COOKIE['frontRememberUs'];
				$value = explode('__',$value);
				$usernameRem = $value[0];
				$passwordRem = $value[1];
				$data['frontRemUser'] = $usernameRem;
				$data['frontRemPass'] = $passwordRem;
			}
			$postData = $this->input->post();
			if(!empty($postData)){
				$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
				if ($this->form_validation->run() == true){
					$remember	= !empty($postData['remember']) ? $postData['remember'] : NULL;
					$userName	= $postData['username'];
					$password	= $postData['password'];
					$login		= $this->Login_model->login($userName, $password, $remember);
					if($login){
						if($login==2){
							$url = base_url('staff');
							redirect($url);
						}else{
							$url = base_url('client');
							redirect($url);
						}
					}else{
						$data['error'] = 'Invalid Username or Password';
					}
				}else{
					$data['error'] = validation_errors();
				}
			}
			$data['resetHeaderClass']	= 'reset-header-class';
			$this->load->view('frontend/signin', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to user login '.$ex->getMessage());
		}

	}
	
	/**
	 * @Function		-: getUserGroup()
	 * @Description		-: This function used for get user group basis on email id and user id
	 * @Param			-: userId(int),email(string)
	 * @Return			-: array()
	 * @Created on		-: 09-08-2016
	 * 
	 */
	public function getUserGroup($userId=null,$email=null){
		try{
			if(!empty($userId) && !empty($email)){
				$result = $this->db
							->select('users.id,users.username as userName,users.email,groups.id as groupId')
							->join('users_groups as ug','ug.user_id=users.id')
							->join('groups','groups.id=ug.group_id')
							->where('users.id',$userId)
							->where('users.email',$email)
							->get('users')->row();
				if($result){
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('Error','Unable to get user group '.$ex->getMessage());
		}
	}
	
	function googleLogin(){
		if($this->session->userdata('login') == true){
			redirect('index');
		}
		
		if (isset($_GET['code'])) {
			
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login',true);
			$this->session->set_userdata('user_profile',$this->googleplus->getUserInfo());
			redirect('index');
			
		} 
			
		redirect($this->googleplus->loginURL());
		
		}
	/**
	 * @Function		-: facebookLogin()
	 * @Description		-: This function used to user get loged in using facebook. 
	 * @Param			-: 
	 * @Return			-: 
	 * @Created on		-: 25-10-2016
	 * 
	 */	
	function facebookLogin(){
		$data = $this->fbapi->fblogin();
		echo"<pre>";
		print_r($data);
		die;
	}
		
	
}
