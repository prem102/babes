<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/User_auth_model');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
    }

    public function index() {
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin', 'refresh');
        }
        $data = array(
            'title' => 'Dashboard',
        );
        $this->template->load('admin/base', 'admin/landing_page', $data);
    }

}
