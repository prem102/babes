<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Contents extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Page_label_model');
        $this->load->model('admin/Page_content_model');
        $this->load->model('admin/User_auth_model');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(3,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[3];
        $this->lang->load('auth');
        $this->PageTitle = 'Content Management';
        $this->limit = 10;
    }
    
    /**
     * @Function		-: index()
     * @Description		-: This function used for display pages labels
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function index(){
        $data = array(
            'title' => 'Contents | Page Label',
            'list_heading' => 'Contents | Page Label',
            'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li>',
        );
		try{
			$labels = $this->Page_label_model->getAllLabels();
			if(!empty($labels) && is_array($labels)){
				$data['pagesLabels'] = $labels;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/contents/index', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of pages lables'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addLabel()
     * @Description		-: This function used for add page labels value
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addLabel(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Contents | Add Page Label',
					'list_heading' => 'Contents | Add Page Label',
					'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('page_name', 'Page Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('page_url', 'Page Url', 'trim|min_length[3]|max_length[200]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('variable_name', 'Label', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('variable_value', 'Label Value', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'User Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by'] = $this->user_id;
							$postData['alias'] = $postData['variable_value'];
							$insertedId = $this->Page_label_model->manageLabel($postData);
							if($insertedId){
								redirect('admin/contents/');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/contents/add', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add page labels value '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: editLabel()
     * @Description		-: This function used for edit page labels value
     * @Created on		-: 28-07-2016
     * @Param			-: id (int)
     * 
     */ 
	public function editLabel($id){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Contents | Edit Page Label',
					'list_heading' => 'Contents | Edit Page Label',
					'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li>',
				);
				$label = $this->Page_label_model->getAllLabels($id);
				if(empty($label)){
					redirect('admin/contents/');
				}
				$data['label'] = $label;
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('page_name', 'Page Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('page_url', 'Page Url', 'trim|min_length[3]|max_length[200]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('variable_name', 'Label', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('variable_value', 'Label Value', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'User Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['updated_by'] = $this->user_id;
							$updatedId = $this->Page_label_model->manageLabel($postData,$id);
							if($updatedId){
								redirect('admin/contents/');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/contents/edit', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to updated page labels value '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
	 * @Function		-: removeLabel()
	 * @Description		-: This function used for remove page label basis on id
	 * @Param			-: id (id)
	 * @Return			-: true/false
	 * @Created on		-: 29-07-2016
	 */ 
	public function removeLabel(){
		$id = $this->input->post('id');
		$label = $this->Page_label_model->getAllLabels($id);
		if(empty($label)){
			return false;
		}
		try{
			$remove  = $this->Page_label_model->removeLabel($id);
			if($remove){
				echo 'A';
			}
		}catch(Exception $ex){
			log_message('error', 'Page label not removed! ' . $ex->getMessage());
			return false;
		}
	}
	
	/****** ### Page Content Details ### ******/
	
    /**
     * @Function		-: pages()
     * @Description		-: This function used for display pages labels
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function pages(){
        $data = array(
            'title' => 'Contents | Static Page',
            'list_heading' => 'Contents | Static Page',
            'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li><li><a href="'.base_url('admin/contents/pages').'">Static Pages</a></li>',
        );
		try{
			$pages = $this->Page_content_model->getAllPages();
			if(!empty($pages) && is_array($pages)){
				$data['pages'] = $pages;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/contents/pages', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of static pages'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addPage()
     * @Description		-: This function used for add static page content
     * @Created on		-: 29-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addPage(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
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
						$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('variables', 'variables', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by'] = $this->user_id;
							$insertedId = $this->Page_content_model->managePage($postData);
							if($insertedId){
								redirect('admin/contents/pages');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/contents/addpage', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add page content value '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: editPage()
     * @Description		-: This function used for edit page content
     * @Created on		-: 29-07-2016
     * @Param			-: id (int)
     * 
     */ 
	public function editPage($id){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Contents | Edit Page',
					'list_heading' => 'Contents | Edit Page',
					'breadcrum' => '<li><a href="'.base_url('admin/contents/').'">Contents</a></li>
					<li><a href="'.base_url('admin/contents/pages').'">Static Pages</a></li>',
				);
				$page = $this->Page_content_model->getAllPages($id);
				if(empty($page)){
					redirect('admin/contents/pages');
				}
				$data['page'] = $page;
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('page_name', 'Page Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('page_url', 'Page Url', 'trim|min_length[3]|max_length[200]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['updated_by'] = $this->user_id;
							$updatedId = $this->Page_content_model->managePage($postData,$id);
							if($updatedId){
								redirect('admin/contents/pages');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/contents/editpage', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to updated page content '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
	 * @Function		-: removePage()
	 * @Description		-: This function used for remove static page basis on page id
	 * @Param			-: id (id)
	 * @Return			-: true/false
	 * @Created on		-: 29-07-2016
	 */ 
	public function removePage(){
		$id = $this->input->post('id');
		$page = $this->Page_content_model->getAllPages($id);
		if(empty($page)){
			return false;
		}
		try{
			$remove  = $this->Page_content_model->removePage($id);
			if($remove){
				echo 'A';
			}
		}catch(Exception $ex){
			log_message('error', 'Static page not removed! ' . $ex->getMessage());
			return false;
		}
	}

}
