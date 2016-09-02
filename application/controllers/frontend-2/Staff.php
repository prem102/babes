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
        if (!$this->Login_model->loggedIn()) {
            //redirect('signin', 'refresh');
        }
        $user_info =$this->Login_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $this->username  = $user_info->username;
    }
    
    /**
     * 
     * 
     * Need To work
     * 
     */ 
   
	function index(){
        $data['userName'] = $this->username;
        
		$data['js']=array('jquery-1.12.3.min','jquery-ui','jquery.selectBoxIt','jquery.flexslider'); 
		$data['meta']=array();
		$data['css']=array('flexslider','tab','common','home');   
		$this->load->view('frontend/staff-page', $data);
	} 

}
