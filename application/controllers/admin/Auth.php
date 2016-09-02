<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('admin/User_auth_model');
        $this->load->library('form_validation');
        $this->load->helper('cookie');
    }
    
    
    public function index(){
		$loggedIn = $this->User_auth_model->loggedIn();
		if($loggedIn){
			redirect('admin/dashboard');
		}else{
			$this->login();
		}
	}
	
	public function login(){
		if ($this->User_auth_model->loggedIn()) {
            redirect('admin/dashboard', 'refresh');
        }
		$data = array(
			'title' => 'Login',
		);
		if(isset($_COOKIE['rememberUs'])){
			$value = $_COOKIE['rememberUs'];
			$value = explode('__',$value);
			$usernameRem = $value[0];
			$passwordRem = $value[1];
			$data['remUser'] = $usernameRem;
			$data['remPass'] = $passwordRem;
		}

		
		$postData=$this->input->post();
        if (!empty($postData)){
			$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == true) {
                $remember	= !empty($postData['remember']) ? $postData['remember'] : NULL;
                $userName	= $postData['username'];
                $password	= $postData['password'];
                $login		= $this->User_auth_model->login($userName, $password, $remember);
                if ($login){
					setMessage('Welcome Back ','success');
                    redirect('admin/dashboard', 'refresh');
                } else {
					$data['error'] = 'Invalid Username or Password';
                }
            } else {
				$data['error'] = validation_errors();
            }
        }
        $this->template->load('admin/login', 'admin/login', $data);
	}
	
	public function logout(){
		$this->User_auth_model->loggedOut();
	}


}
