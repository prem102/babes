<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Client extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('frontend/Login_model');
		$this->load->model('frontend/Client_model');
		$this->load->library('form_validation');
        if (!$this->Login_model->loggedIn()) {
			redirect('signin', 'refresh');
        }
        $user_info =$this->Login_model->loggedInUser();
        $this->user_id  = $user_info->id;
    }
	/**
	 * 
	 * @Need to work hard
	 * 
	 */

	public function client(){
		if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='3'){
			redirect('index');
		}
		$data['meta']=array();
		$data['js']=array('jquery-ui','lightbox.min'); 
		$data['css']=array('common','client-page','lightbox');
		$client =$this->Login_model->loggedInUser();
		$data['client'] = $client;
		$this->load->view('frontend/client-page', $data);
	}
	
	public function compleRegistrationForm(){
		$postData = $this->input->post();
		if($postData){
			echo "<pre>";var_dump($postData);die;
		}
	}
	
	
	
	
	/**
	 * @Function	-: updateNotification()
	 * @Description	-: This function used for update notified section basis on client id
	 * @Param		-: No Parameter
	 * @Return		-: json(array())
	 * @Created on	-: 16-08-2016
	 */
	
	function updateNotification(){
		try{
			$status			= $this->input->post('status');
			$notifiedType	= $this->input->post('notifiedType');
			$clientId		= $this->user_id;
			$msg = "Failled";
			$sta = "No";
			$returnStatus = "";
			$responseArray = array();
			if(!empty($status) && !empty($notifiedType)){
				$updateData		= array();
				if($status=='Yes'){
					$updateData[$notifiedType] = 0;
					$returnStatus = "No";
				}else{
					$returnStatus = "Yes";
					$updateData[$notifiedType] = 1;
				}
				$update		= $this->Client_model->updateProfile($updateData,$clientId);
				if($update){
					$msg = "Success";
					$sta = "Yes";
				}
			}
			$responseArray['status']= $sta;
			$responseArray['msg']	= $msg;
			$responseArray['type']	= $returnStatus;
			echo json_encode($responseArray);die;
		}catch(Exception	$ex){
			log_message('error',' Unable to update clients notified section '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: updateProfile()
	 * @Description	-: This function used for update client profile details
	 * @Param		-: No Parameter
	 * @Return		-: json(array())
	 * @Created on	-: 16-08-2016
	 */
	
	function updateProfile(){
		try{
			if(!empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')=='3'){
			
			$status			= $this->input->post('status');
			$notifiedType	= $this->input->post('notifiedType');
			$clientId		= $this->user_id;
			$msg = "Failled";
			$sta = "No";
			$returnStatus = "";
			$responseArray = array();
			if(!empty($status) && !empty($notifiedType)){
				$updateData		= array();
				if($status=='Yes'){
					$updateData[$notifiedType] = 0;
					$returnStatus = "No";
				}else{
					$returnStatus = "Yes";
					$updateData[$notifiedType] = 1;
				}
				$update		= $this->Client_model->updateProfile($updateData,$clientId);
				if($update){
					$msg = "Success";
					$sta = "Yes";
				}
			}
			$responseArray['status']= $sta;
			$responseArray['msg']	= $msg;
			$responseArray['type']	= $returnStatus;
			echo json_encode($responseArray);die;
		}
		}catch(Exception	$ex){
			log_message('error',' Unable to update clients notified section '.$ex->getMessage());
		}
	}
	
	/**
	 * this function use for my booking page view
	 * 
	 * */
	 function mybooking(){
		 if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='3'){
			redirect('index');
			}
		$data['meta']=array();
		$data['js']=array('jquery-ui',); 
		$data['css']=array('common','booking');		
		$this->load->view('frontend/mybooking', $data);
		
		 }
		 
		 /**
		  * 
		  * 
		  * 
		  * */
	function clientregistration(){
		$data['js']=array('jquery-1.12.3.min','jquery-ui','jquery.selectBoxIt','parsley.min'); 
		$data['meta']=array();
		$data['css']=array('common','client-ragistration',);
		$data['resetHeaderClass']	= 'reset-header-class';
		$postData = $this->input->post();
		if(!empty($postData)){
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|max_length[20]|required',array('required' => 'Please select %s.'));
			$this->form_validation->set_rules('phone', 'phone', 'trim|min_length[10]|max_length[10]|required',array('required' => 'Please Enter %s.'));
			$this->form_validation->set_rules('address', 'Address', 'trim|min_length[6]|required',array('required' => 'Please Enter %s.'));
			$this->form_validation->set_rules('state_id', 'State', 'required',array('required' => 'Please select %s.'));
			$this->form_validation->set_rules('city', 'city', 'required',array('required' => 'Please select %s.'));
			$this->form_validation->set_rules('pincode', 'Zip Code', 'trim|min_length[4]|max_length[6]|required',array('required' => 'Please Enter %s.'));
			$this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required',array('required' => 'Please Fill %s.'));
			if($this->form_validation->run()==true){
				$secret = '6LddxSYTAAAAALyZiUSLM1elHJycYSEvi-4Ir9hP';
				//get verify response data
				$verifyResponse		= file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
				$responseData		= json_decode($verifyResponse);
				if($responseData->success){
					$ClientAddressData	= array('user_id'=>$postData['user_id'],'country_id'=>1,'state_id'=>$postData['state_id'],'city_id'=>$postData['city'],'pincode'=>$postData['pincode'],'address'=>$postData['address']);
					$clientData			= array();
					if(!empty($postData['password'])){
						$password	= $postData['password'].'client';
						$pass		= md5($password);
						$clientData['password']	= $pass;
					}else{
						unset($postData['password']);
					}
					$firstName		= $postData['title'].' '.$postData['first_name'];
					$clientData['phone']	= $postData['phone'];
					$clientData['first_name']	= $firstName;
					$sms	= !empty($postData['sms_notification']) ? '1' : '0';
					$email	= !empty($postData['email_notification']) ? '1' : '0';
					$clientData['sms_notified']	= $sms;
					$clientData['email_notified']	= $email;
					$clientData['first_name']	= $firstName;
				}
					echo "<pre>";var_dump($postData);die;
			}else{
				echo $error=validation_errors();
			}
		}
		$this->load->view('frontend/clientregistration', $data);
	}
}
