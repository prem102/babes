<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/Login_model');
        $this->lang->load('auth');
        
    }
    /**
     * 
     * Need to work	
     * 
     */ 
   
	function index(){
		$this->Login_model->loggedOut();
		$url = base_url();
		redirect($url,'refresh');
	}
	

}
