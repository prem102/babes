<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Emails extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Email_model');
        $this->load->model('admin/Message_model');
        $this->load->model('admin/Users_Group_model');
        $this->load->model('admin/User_auth_model');
        $this->load->helper('mail_helper');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(5,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[5];
        $this->lang->load('auth');
        $this->PageTitle = 'Email Management';
        $this->limit = 10;
    }

	
    /**
     * @Function		-: index()
     * @Description		-: This function used for display email templates
     * @Created on		-: 29-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function index(){
        $data = array(
            'title' => 'Email | Template',
            'list_heading' => 'Email | Template',
            'breadcrum' => '<li><a href="'.base_url('admin/emails/').'">Email Templates</a></li>',
        );
		try{
			$emailTemplates = $this->Email_model->getAllTemplates();
			if(!empty($emailTemplates) && is_array($emailTemplates)){
				$data['templates'] = $emailTemplates;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/emails/templates', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of email templates'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addEmailTemplate()
     * @Description		-: This function used for add email template
     * @Created on		-: 29-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addEmailTemplate(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Email | Add Email Template ',
					'list_heading' => 'Email | Add Email Template ',
					'breadcrum' => '<li><a href="'.base_url('admin/emails/').'">Email Templates</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_name', 'Template Name', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_subject', 'Template Subject', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_header', 'Template Header', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_content', 'Template Content', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_text', 'Template Text', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$alias = str_replace(' ', '-', $postData['template_name']);
							$postData['alias'] = $alias;
							$postData['created_by'] = $this->user_id;
							$postData['lang_id'] = 'en';
							$insertedId = $this->Email_model->manageEmailTemplate($postData);
							if($insertedId){
								redirect('admin/emails/');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$groups = $this->Users_Group_model->where('id !=',1)->get_all();
				if($groups){
					$data['userGroups'] = $groups;
				}
				$this->template->load('admin/base', 'admin/emails/addtemplate', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add email template '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}			
	}
	
	/**
     * @Function		-: editEmailTemplate()
     * @Description		-: This function used for edit email template basis on id
     * @Created on		-: 29-07-2016
     * @Param			-: id (int)
     * 
     */ 
	public function editEmailTemplate($id){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Emails | Edit Email Template',
					'list_heading' => 'Emails | Edit Email Template',
					'breadcrum' => '<li><a href="'.base_url('admin/emails/').'">Email Templates</a></li>',
				);
				$template = $this->Email_model->getAllTemplates($id);
				if(empty($template)){
					redirect('admin/emails/');
				}
				$data['template'] = $template;
				$groups = $this->Users_Group_model->where('id !=',1)->get_all();
				if($groups){
					$data['userGroups'] = $groups;
				}
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_name', 'Template Name', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_subject', 'Template Subject', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_header', 'Template Header', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_content', 'Template Content', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_text', 'Template Text', 'trim|min_length[3]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$alias = str_replace(' ', '-', $postData['template_name']);
							$postData['alias'] = $alias;
							$postData['updated_by'] = $this->user_id;
							$postData['lang_id'] = 'en';
							$updatedId = $this->Email_model->manageEmailTemplate($postData,$id);
							if($updatedId){
								redirect('admin/emails/');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/emails/edittemplate', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to Updated email template '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	//****** Message Template Section Start ******//
	
	
	
	/**
	 * @Function 		-: messageTemplates()
	 * @Descroption		-: This function used for display message templates
	 * @Param			-: No Parameter
	 * @Created on		-: 01-08-2016
	 */ 
	
	public function messageTemplates(){
		try{
			$data = array(
				'title' => 'Emails | Message Template',
				'list_heading' => 'Emails | Message Template',
				'breadcrum' => '<li><a href="'.base_url('admin/emails/messageTemplates').'">Message Templates</a></li>',
			);
			$emailTemplates = $this->Message_model->getAllTemplates();
			if(!empty($emailTemplates) && is_array($emailTemplates)){
				$data['templates'] = $emailTemplates;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/emails/message-templates', $data);
		}catch(Exception $ex){
			log_message('error',' Unable to listed Message Templates '.$ex->getMessage());
		}
	}
	
	
	/**
     * @Function		-: addEmailTemplate()
     * @Description		-: This function used for add email template
     * @Created on		-: 29-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addMessageTemplate(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Email | Add Message Template ',
					'list_heading' => 'Email | Add Message Template ',
					'breadcrum' => '<li><a href="'.base_url('admin/emails/messageTemplates').'">Message Templates</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_name', 'Template Name', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_text', 'Template Text', 'trim|min_length[3]|max_length[140]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$alias = str_replace(' ', '-', $postData['template_name']);
							$postData['alias'] = $alias;
							$postData['created_by'] = $this->user_id;
							$postData['lang_id'] = 'en';
							$insertedId = $this->Message_model->manageMessageTemplate($postData);
							if($insertedId){
								redirect('admin/emails/messageTemplates');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$groups = $this->Users_Group_model->where('id !=',1)->get_all();
				if($groups){
					$data['userGroups'] = $groups;
				}
				$this->template->load('admin/base', 'admin/emails/addmessagetemplate', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add message template '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: editMessageTemplate()
     * @Description		-: This function used for edit message template basis on id
     * @Created on		-: 01-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function editMessageTemplate($id){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Emails | Edit Message Template',
					'list_heading' => 'Emails | Edit Message Template',
					'breadcrum' => '<li><a href="'.base_url('admin/emails/messageTemplates').'">Message Templates</a></li>',
				);
				$template = $this->Message_model->getAllTemplates($id);
				if(empty($template)){
					redirect('admin/emails/messageTemplates');
				}
				$data['template'] = $template;
				$groups = $this->Users_Group_model->where('id !=',1)->get_all();
				if($groups){
					$data['userGroups'] = $groups;
				}
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('user_group_id', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_name', 'Template Name', 'trim|min_length[3]|max_length[255]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('template_text', 'Template Text', 'trim|min_length[3]|max_length[140]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'Page Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$alias = str_replace(' ', '-', $postData['template_name']);
							$postData['alias'] = $alias;
							$postData['updated_by'] = $this->user_id;
							$postData['lang_id'] = 'en';
							$updatedId = $this->Message_model->manageMessageTemplate($postData,$id);
							if($updatedId){
								redirect('admin/emails/messageTemplates');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/emails/editmessagetemplate', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to Updated message template '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	
	/****** Sending mail view & functionality start ******/
	
	/**
	 * @Function		-: sendMail()
	 * @Description		-: This function used for display users list basis on group by , username, emailid, contact no
	 * @Param			-: No Parameter
	 * @Created on		-: 06-08-2016
	 * 
	 */
	
	public function sendMail($offset=0){
		try{
			$data = array(
				'title' => 'Sending | Mail',
				'list_heading' => 'Sending | Mail',
				'breadcrum' => '<li><a href="'.base_url('admin/emails/users').'">Users</a></li>',
			);
			$groups = $this->Email_model->getAllGroup(NULL);
			if(!empty($groups)){
				$data['groups'] = $groups;
			}
			$templates = $this->Email_model->getAllMailTemplate();
			if(!empty($templates) && is_array($templates)){
				$data['templates'] = $templates;
			}
			
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if(!empty($postData)){
				$userName	= (!empty($postData['username'])) ? $postData['username'] : '';
				$userEmail	= (!empty($postData['email'])) ? $postData['email'] : '';
				$userContact= (!empty($postData['contact'])) ? $postData['contact'] : '';
				$userGroup	= (!empty($postData['group'])) ? $postData['group'] : '';
				if($userName){
					$this->session->set_userdata('userName',$userName);
				}
				if($userEmail){
					$this->session->set_userdata('userEmail',$userEmail);
				}
				if($userContact){
					$this->session->set_userdata('userContact',$userContact);
				}
				if($userGroup){
					$this->session->set_userdata('userGroup',$userGroup);
				}
			}
			if($this->input->post('reset')){
				$this->session->unset_userdata('userName');
				$this->session->unset_userdata('userEmail');
				$this->session->unset_userdata('userContact');
				$this->session->unset_userdata('userGroup');
			}
			//****** Serach form value in session ******//
			$userName	=  $this->session->userdata('userName');
			$userEmail	=  $this->session->userdata('userEmail');
			$userContact=  $this->session->userdata('userContact');
			$userGroup	=  $this->session->userdata('userGroup');
			$searchArray = array('userName'=>$userName,'userEmail'=>$userEmail, 'userContact'=>$userContact,
			'userGroup'=>$userGroup);
			$data['searchUsername'] = $userName; $data['searchUserEmail'] = $userEmail;
			$data['searchUserContact'] = $userContact;$data['searchUserGroup'] = $userGroup;
			//****** Serach form value in session ******//
			$totalRow=$this->Email_model->getUsersRecords($searchArray,NULL);
			$config = array();
			$data['totalRecords'] = $totalRow;
			$data['limit'] = $this->limit;
			$config["base_url"] = base_url('admin/emails/sendMail');
			$config["total_rows"] = $totalRow;
			$config["per_page"] = $this->limit;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $totalRow;
			$config['cur_tag_open'] = '<li class="table-red paginate_button active" ><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="paginate_button" >';
			$config['num_tag_close'] = '</li>';
			$config['full_tag_open'] = '<li class="paginate_button">';
			$config['full_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="paginate_button next">';
			$config['prev_tag_open'] = '<li class="paginate_button previous">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="paginate_button" >';
			$config['num_tag_close'] = '</li>';
			$config['last_tag_close'] = '<li class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$this->pagination->initialize($config);
			if($offset > 1){
				$page = ($offset - 1) * $this->limit;
			}
			else{
				 $page = $offset;
			}
			$data['recordsFrom'] = $page;
			$str_links = $this->pagination->create_links();
			$data["links"] = $str_links;
			$page = (empty($page)) ? 'A' : $page;
			$results = $this->Email_model->getUsersRecords($searchArray,$page);
			$data['users'] = $results;
			$this->template->load('admin/base', 'admin/emails/users', $data);
		}catch(Exception $ex){
			log_message('',' Unable to find user by group and individual'.$ex->getMessage());
		}
	}
	
	
	public function mail(){
		try{
			$userIds = $this->input->post('userIds');
			$templateAlias = $this->input->post('templateAlias');
			$subject = $this->input->post('subject');
			$content = $this->input->post('content');
			$msg = "";
			$response = "";
			if(empty($userIds)){
				$msg = "Please select users to send mail";
				$response = "No";
			}
			$userIds = explode(',',$userIds);
			$emails = $this->Email_model->getUserEmails($userIds);
			$responce = "";
			if(is_array($emails)){
				foreach($emails as $email){
					$responce = sendCustomMail($email->email,$content,$subject);
					dump($responce);
				}
			}
			if($responce){
				//dump($responce);
				//setMessage('Mail send','success');
				//redirect('admin/emails/sendMail');
			}
		}catch(Exception	$ex){
			
		}
	}
	

}
