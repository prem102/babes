<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagecontent extends CI_Controller {

    function __construct() {
        parent::__construct();
        
    }
    
   function privcayandpolicy()
  {   
	  $data['js']=array('jquery-ui'); 
	  $data['meta']=array();
	  $data['css']=array('common');
	  $this->load->view('frontend/privacyandpolicy', $data);
  }
   function termandconditions()
  {   
	  $data['js']=array('jquery-ui'); 
	  $data['meta']=array();
	  $data['css']=array('common');
	  $this->load->view('frontend/termandconditions', $data);
  }
    
    
}

