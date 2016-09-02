<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Reset extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('mail_helper');
		$this->load->model('frontend/Reset_model');
		$this->load->library('form_validation');
		$this->load->library('email');
	}
	
	function sendForgotPasswordToken(){
		try{
			$responseArray = array();
			$email = $this->input->post('email');
			if(!empty($email)){
				$result = $this->db->where('email',$email)->where('active',1)->get('users')->row();
				if($result){
					$userName	= $result->username;
					$forgotPasswordCode	= $userName.'-'.mt_rand();
					$data	= array('forgotten_password_code'=>$forgotPasswordCode);
					$insertForgotPassCode = $this->Reset_model->where('email',$email)->update($data);
					$link = "<a href='".base_url('frontend/reset/resetPassword?email='.$email.'&token='.$forgotPasswordCode.'')."'>reset password</a> ";
					$responce = sendResetPasswordMail($email,$userName,$link,'reset-password');
					$msg	= " Reset Password link has been sent on your email";
					$status	= "Yes";
				}else{
					$msg	= "Invalid Email id";
					$status	= "No";
				}
			}
			$responseArray['msg'] = $msg;
			$responseArray['status'] = $status;
			echo json_encode($responseArray);die;
		}catch(Exception $ex){
			log_message('error',' Unable to send forgot password token '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: resetPassword()
	 * @Description	-: This function used for checking token 
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 17-08-2016
	 * 
	 */
	
	function resetPassword(){
		try{
			$token = $this->input->get('token');
			if(!empty($token)){
				$resetPassId = $this->Reset_model->checkingToken($token);
				if($resetPassId){
					$this->session->set_flashdata('resetUserId', $resetPassId);
					$this->reset();
				}else{
					$this->session->set_flashdata('tokenInfo', 'Invalid Token');
					$url = base_url('signin');
					redirect($url);
				}
			}else{
				$url = base_url('signin');
				redirect($url);
			}

		}catch(Exception $ex){
			log_message('error',' Unable to reset password'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: reset()
	 * @Description	-: This function used for password reset
	 * @Param		-: No Parameter
	 * @Return 		-:
	 * @Created on	-: 18-08-2016
	 * 
	 */
	
	
	function reset(){
		$data['js']		= array('jquery-1.12.3.min'); 
		$data['meta']	= array();
		$data['css']	= array('common','signin');
		$userId			= $this->session->flashdata('resetUserId');
		if($userId){
			$this->session->set_flashdata('resetUserId', $userId);
			$data['userId'] = $userId;
			$postData	= $this->input->post();
			if(!empty($postData)){
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[20]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('con-password', 'Confirm Password', 'trim|min_length[8]|max_length[20]|matches[password]|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					$groupId = getUserGroup($postData['user_id']);
					$password= generatePassword($postData['password'],$groupId);
					$updateData		= array('password'=>$password,'forgotten_password_code'=>NULL);
					$resetPass		= $this->Reset_model->updateResetPassword($postData['user_id'],$updateData);
					if($resetPass){
						$this->session->set_flashdata('resetSuccess', 'Your password successfully updated.');
						$url = base_url('signin');
						redirect($url);
					}
				}else{
					$data['error'] = validation_errors();
				}
			}
			$this->load->view('frontend/reset-password', $data);
		}else{
			$data['resetHeaderClass']	= 'reset-header-class';
			$this->session->set_flashdata('totken', 'Invalid token');
		}
	}
	
}
