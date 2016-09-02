<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Seo extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Seo_model');
        $this->load->model('admin/User_auth_model');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(4,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[4];
        $this->lang->load('auth');
        $this->PageTitle = 'Seo Management';
        $this->limit = 10;
    }
    
	/****** ### Indivisual Pages Meta Details ### ******/
	
    /**
     * @Function		-: index()
     * @Description		-: This function used for display pages labels
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function index(){
        $data = array(
            'title' => 'SEO | Page',
            'list_heading' => 'SEO | Page',
            'breadcrum' => '<li><a href="'.base_url('admin/seo/').'"> Individual Pages Meta</a></li>',
        );
		try{
			$pages = $this->Seo_model->getAllPages();
			if(!empty($pages) && is_array($pages)){
				$data['pages'] = $pages;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/seo/pages', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of static pages'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addIndivisualPageMeta()
     * @Description		-: This function used for add Indivisual Page Meta
     * @Created on		-: 29-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addIndivisualPageMeta(){
		try{
			$data = array(
				'title' => 'Contents | Add Page ',
				'list_heading' => 'Contents | Add Page ',
				'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li>
				<li><a href="'.base_url('admin/contents/pages').'">Static Pages</a></li>',
			);
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
					$this->form_validation->set_rules('page_name', 'Page Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('page_url', 'Page Url', 'trim|min_length[3]|max_length[200]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_title', 'Meta Titlte', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
					if($this->form_validation->run()==true){
						$postData['created_by'] = $this->user_id;
						$insertedId = $this->Seo_model->managePageMeta($postData);
						if($insertedId){
							redirect('admin/seo/');
						}
					}else{
						setMessage(' '.validation_errors(),'warning');
					}
			}
			$this->template->load('admin/base', 'admin/seo/addpage', $data);
		}catch(Exception $ex){
			log_message('error',' Unable to add Indivisual Page Meta '.$ex->getMessage());
		}
	}
	
	/**
     * @Function		-: editIndivisualPageMeta()
     * @Description		-: This function used for edit Indivisual Page Meta basis on id
     * @Created on		-: 29-07-2016
     * @Param			-: id (int)
     * 
     */ 
	public function editIndivisualPageMeta($id){
		try{
			$data = array(
				'title' => 'Contents | Edit Page',
				'list_heading' => 'Contents | Edit Page',
				'breadcrum' => '<li><a href="'.base_url('admin/seo/').'">Indivisual Pages Meta</a></li>',
			);
			$page = $this->Seo_model->getAllPages($id);
			if(empty($page)){
				redirect('admin/seo/');
			}
			$data['page'] = $page;
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
					$this->form_validation->set_rules('page_name', 'Page Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('page_url', 'Page Url', 'trim|min_length[3]|max_length[200]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_title', 'Meta Titlte', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
					if($this->form_validation->run()==true){
						$postData['updated_by'] = $this->user_id;
						$updatedId = $this->Seo_model->managePageMeta($postData,$id);
						if($updatedId){
							redirect('admin/seo/');
						}
					}else{
						setMessage(' '.validation_errors(),'warning');
					}
			}
			$this->template->load('admin/base', 'admin/seo/editpage', $data);
		}catch(Exception $ex){
			log_message('error',' Unable to Updated Page Meta '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: googleAnalytics()
	 * @Description		-: This function used for managing google analytics code for whole site
	 * @Created on		-: 04-08-2016
	 * @Param			-: No Parameter
	 */ 
	public function googleAnalytics(){
		try{
			$data = array(
				'title' => 'SEO | Manage Google Analytic code ',
				'list_heading' => 'SEO | Manage Google Analytic code ',
				'breadcrum' => '<li><a href="'.base_url('admin/seo/googleAnalytics').'">Google Analytic Code</a></li>',
			);
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if(!empty($postData)){
				$postData['status'] = 1;
				$postData['updated_by'] = $this->user_id;
				if(!empty($postData['code'])){
					$update = $this->Seo_model->manageGoogleAnalyticCode($postData);
					if($update){
						setMessage('Google Analytic Code successfully updated','success');
					}
				}else{
					setMessage('Please enter your Google Analytic Code','warning');
				}
			}
			$previousCode = $this->Seo_model->getPreviousGoogleAnalyticCode();
			if(!empty($previousCode)){
				$data['preCode'] = $previousCode;
			}
			$code = $this->Seo_model->getGoogleAnalyticCode();
			$data['code'] = $code;
			$this->template->load('admin/base', 'admin/seo/analyticCode', $data);
		}catch(Exception	$ex){
			log_message('error','Unable to manage google analytics code '.$ex->getMessage());
		}
	}
	

}
