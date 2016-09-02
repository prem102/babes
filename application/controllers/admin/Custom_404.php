<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Custom_404 extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

/**
 * @Methode		-: index()
 * @Description	-: This function used to for display Error Messaeg Page 404
 * @Created		-: 21-06-2016
 * @Param		-: No
 */  
    public function index() {
        $data = array(
            'title' => 'Page Not Found',
            'list_heading' => 'Property Category',
            'breadcrum' => '<li><a href="">Page Not Found</a></li>',
        );
        $this->template->load('admin/base', 'custom_404/index', $data);
    }

}
