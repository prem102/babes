<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Staff extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Login_model'); 
        $this->load->model('frontend/Home_model');
        $this->load->model('frontend/Staff_model');
		$this->load->helper('common_helper');
        $this->load->library('form_validation');
    }
    
    /**
     * 
     * 
     * Need To work
     * 
     */ 
   
	function index(){
		if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='2'){
			redirect('index');
			}
		  $user_info =$this->Login_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $this->username  = $user_info->username;
        $data['userName'] = $this->username;
        
		$data['js']=array('jquery-1.12.3.min','jquery-ui','jquery.selectBoxIt','jquery.flexslider'); 
		$data['meta']=array();
		$data['css']=array('flexslider','tab','common','home');   
		$this->load->view('frontend/staff-page', $data);
	} 
	
	/**
	 * 
	 * 
	 * 
	 * */
	 
	 function myJobs()
	 {	if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='2'){
			redirect('index');
			}
		$data['js']=array('jquery-1.12.3.min','jquery-ui','easyResponsiveTabs'); 
		$data['meta']=array();
		$data['css']=array('common','myjobs','easy-responsive-tabs');
		$data['resetHeaderClass']	= 'reset-header-class';  
		$this->load->view('frontend/myjobs', $data); 
	  }

	/**
	 * 
	 * 
	 * 
	 * */
	 function registration($step)
	 {		
		 if(empty($this->session->userdata('fronentLoginUserName'))&&$this->session->userdata('fronentLoginUserName')!='2'){
			redirect('index');
			}
		$data['js']=array('jquery-1.12.3.min','jquery-ui','jquery.selectBoxIt','jquery.tokenize','parsley.min'); 
		$data['meta']=array();
		$data['css']=array('common','staff-registration','jquery.tokenize');
		$data['resetHeaderClass']	= 'reset-header-class';
		if(empty($step)){
			redirect('index');
			}
			
		if(!empty($step)&&$step=='step1'){	
				$searchtype='1';
				$data['hairColors']	= $this->Home_model->getHairColors($searchtype);
				$data['eyeColors'] = $this->Home_model->getEyeColors($searchtype);
				$data['bodyTypes'] =$this->Home_model->getBodyTypes($searchtype);
				$data['bustTypes'] = $this->Home_model->getBustTypes($searchtype);
				$data['ethnicities'] = $this->Home_model->getEthnicities($searchtype);			
				$this->load->view('frontend/registration-step1', $data);
			} 
			//===============================step2 =====================================
			if(!empty($step)&&$step=='step2'){
				$searchtype='1';
				if(!empty($this->session->flashdata('gender'))){
					$gender=$this->session->flashdata('gender');
					if($gender=='Female'){
					$searchtype='1';
					}
					if($gender=='Male'){
					$searchtype='2';
					}
					 if($gender=='Other'){$searchtype='2';}	
					}
					$data['gender']=$searchtype;
				$data['services']= $this->Home_model->getServices($searchtype);
				$postData = $this->input->post();	
							
				if(!empty($postData)){	
					print_r($postData);die;			
				$this->form_validation->set_rules('display_name', 'Display Name', 'trim|min_length[3]|max_length[20]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('age', 'Age', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('gender', 'Gender', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('eye_color', 'Eye Color', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('hair_color', 'Hair Color', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('body_type', 'Body Type', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('main-city', 'Serviceable Areas', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('fname', 'First Name', 'trim|min_length[3]|max_length[20]|required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('about_me', 'About Me ', 'trim|min_length[60]|max_length[500]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('phone', 'phone', 'trim|min_length[10]|max_length[10]|required',array('required' => 'Please Enter %s.'));
				$this->form_validation->set_rules('address', 'Address', 'trim|min_length[6]|required',array('required' => 'Please Enter %s.'));
				$this->form_validation->set_rules('state', 'State', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('city', 'city', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|min_length[6]|required',array('required' => 'Please Enter %s.'));
				if($this->form_validation->run()==true){
					
					$this->Staff_model->staffFullRegistrationStep1($postData);
					$this->session->set_flashdata('gender',$postData['gender']);
					redirect('registration/step2');
					}else{			
				$error=validation_errors();
				$this->session->set_flashdata('error',$error);
				redirect('registration/step1');
					}
				}else{
					$this->load->view('frontend/registration-step2', $data);
					}
			} 
			
			//======================================step3 ====================================
			if(!empty($step)&&$step=='step3'){
				$postData = $this->input->post();	
							
				if(!empty($postData)){	
				$this->form_validation->set_rules('main_service[]', 'Main Service', 'required',array('required' => 'Please select %s.'));
				$this->form_validation->set_rules('service_price[]', 'Main service price', 'required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('service_hours[]', 'Main service hours', 'required',array('required' => 'Please select %s.'));
				if($this->form_validation->run()==true){
					print_r($postData);	
					$this->Staff_model->staffFullRegistrationStep2($postData);
					redirect('registration/step3');
					}else{			
				$error=validation_errors();
				$this->session->set_flashdata('error',$error);
				redirect('registration/step2');
				
					}
					
				}
				$this->load->view('frontend/registration-step3', $data);
			} 
			//=======================================step4 ======================================
			if(!empty($step)&&$step=='step4'){
				$this->load->view('frontend/registration-step4', $data);
			} 
	 }
	 
	 
	 /**
	  * 
	  * 
	  * 
	  * 
	  * */
	  function profileEdit()
	  {
		  $data['js']=array('jquery-1.12.3.min','easyResponsiveTabs','jquery-ui','jquery.selectBoxIt',); 
		$data['meta']=array();
		$data['css']=array('common','staff-edit','easy-responsive-tabs');
		$data['resetHeaderClass']	= 'reset-header-class';
		$this->load->view('frontend/staffProfileEdit', $data);
	  }
}
