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
        if (!$this->Login_model->loggedIn()) {
            redirect('signin', 'refresh');
        }
        $user_info =$this->Login_model->loggedInUser();
        $this->user_id  = $user_info->id;
    }
	/**
	 * 
	 * @Need to work 
	 * 
	 */

	public function client(){
		$data['meta']=array();
		$data['js']=array('jquery-ui','lightbox.min'); 
		$data['css']=array('common','client-page','lightbox');
		$client =$this->Login_model->loggedInUser();
		$data['client'] = $client;
		$this->load->view('frontend/client-page', $data);
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
}
