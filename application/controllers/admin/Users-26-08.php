<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/User_model');
        $this->load->model('admin/Permission_model');
        $this->load->model('admin/User_auth_model');
        $this->load->model('admin/Group_model');
        $this->load->library('form_validation');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(1,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[1];
        $this->lang->load('auth');
        $this->PageTitle = 'User Management';
        $this->limit = 10;
    }
    /**
     * @Function		-: $index()
     * @Description		-: This function used for display all the sub admins list
     * @Created on		-: 26-07-2016
     * @Param			-: No Parameter
     * 
     */ 
    
    public function index(){
        $data = array(
            'title' => 'Users | Sub Admin',
            'list_heading' => 'Users | Sub Admin',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>',
        );
        try{
			$users	= $this->User_model->getSubAdmin();
			if($users){
				$data['users'] = $users;
			}
			$this->template->load('admin/base', 'admin/users/index', $data);
		}catch(Exception $ex){
			log_message('','Unable to listing Users'.$ex->getMessage());
		}
	}
    
    
    /**
     * @Function		-: add()
     * @Description		-: This function used for add sub admin with permissions
     * @Created on		-: 26-07-2016
     * @Param			-: No Parameter
     */

	public function addUser(){
	if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Users | Add User',
            'list_heading' => 'Users | Add User',
            'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
        );
        try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
					$this->form_validation->set_rules('group', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[10]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|min_length[6]|max_length[10]|matches[password]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('phone', 'Contact Number ', 'trim|min_length[6]|numeric|max_length[15]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('active', 'User Status', 'trim|numeric|required');
					$error = "";
					if($this->form_validation->run()==true){
						$userGroup		= $postData['group'];
						$password		= md5($postData['password']);
						$email			= $postData['email'];
						$userName		= strtolower($postData['username']);
						$userStatus		= $postData['active'];
						$phone			= $postData['phone'];
						$ip_Address		= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
						$registerData	= array('ip_address'=>$ip_Address,'username'=>$userName,'email'=>$email,'password'=>$password,
											'active'=>$userStatus,'phone'=>$phone);
						$userNameCheck 	= $this->User_model->checkUniqueUsername($userName);
						if($userNameCheck){
							$EmailCheck 	= $this->User_model->checkUniqueEmail($email);
							if($EmailCheck){
								$insert		= $this->User_model->userRegisteration($registerData,$userGroup);
								if($insert){
									setMessage('User successfully added','success');
									redirect('admin/users');
								}
							}else{
								setMessage('Email id already exists !.','warning');
							}
						}else{
							setMessage('Username already exists !.','warning');
						}
					}else{
						setMessage(' '.validation_errors(),'warning');
					}
			}
			$groups = $this->User_model->getAllGroup('subAdmin');
			if($groups){
				$data['groups'] = $groups;
			}
			$this->template->load('admin/base', 'admin/users/add', $data);
		}catch(Exception $ex){
			setMessage(' Sub admin not listed!' . $ex->getMessage(),'warning');
			log_message('error', 'Sub admin not listed'.$ex->getMessage());
		}
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
    /**
     * @Function		-: edit()
     * @Description		-: This function used for add sub admin with permissions
     * @Created on		-: 26-07-2016
     * @Param			-: id (int)
     */
	public function editUser($id = 0){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Users | Edit User',
            'list_heading' => 'Users | Edit User',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>',
        );
        try{
			$user = $this->User_model->getUserDetails($id);
			if(empty($user)){
				redirect('admin/users');
			}
			$data['user'] = $user;
			$data['editId'] = $id;
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
				$this->form_validation->set_rules('group', 'User Group', 'trim|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('phone', 'Contact Number ', 'trim|min_length[6]|numeric|max_length[15]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('active', 'User Status', 'trim|numeric');
					$error = "";
					if($this->form_validation->run()==true){
						$userGroup		= $postData['group'];
						$email			= $postData['email'];
						$phone			= $postData['phone'];
						$userName		= strtolower($postData['username']);
						$userStatus		= $postData['active'];
						$updateData= array('username'=>$userName,'phone'=>$phone,'email'=>$email,'active'=>$userStatus,'id'=>$id);
						$userNameCheck 	= $this->User_model->checkUniqueUsername($userName,$id);
							if($userNameCheck){
								$EmailCheck 	= $this->User_model->checkUniqueEmail($email,$id);
								if($EmailCheck){
									$update		= $this->User_model->userUpdate($updateData,$userGroup);
									if($update){
										setMessage('User successfully updated','success');
										redirect('admin/users');
									}
								}else{
									setMessage('Email id already exists !.','warning');
								}
							}else{
								setMessage('Username already exists !.','warning');
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
			}
			$groups = $this->User_model->getAllGroup('subAdmin');
			if($groups){
				$data['groups'] = $groups;
			}
			$this->template->load('admin/base', 'admin/users/edit', $data);
		}catch(Exception $ex){
			setMessage(' User not updated!' . $ex->getMessage(),'warning');
			log_message('error', 'User not Updated'.$ex->getMessage());
		}
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	/****** Clients Section Function Start Here ******/
	
	/**
	 * @Function		-: clients();
	 * @Description		-: This function used for display clients list
	 * @Created on		-: 27-07-2016
	 * @Param			-: No Parameter
	 * 
	 */ 
	
	function clients($offset = 0){
        $data = array(
            'title' => 'Users | Clients',
            'list_heading' => 'Users | Clients',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li><li><a href="'.base_url('admin/users/clients').'">Clients</a></li>',
        );
		try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if(!empty($postData)){
				$userName	= (!empty($postData['username'])) ? $postData['username'] : '';
				$userEmail	= (!empty($postData['email'])) ? $postData['email'] : '';
				$userContact= (!empty($postData['contact'])) ? $postData['contact'] : '';
				$userStatus	= (!empty($postData['active'])) ? $postData['active'] : '';
				if($userName){
					$this->session->set_userdata('userName',$userName);
				}
				if($userEmail){
					$this->session->set_userdata('userEmail',$userEmail);
				}
				if($userContact){
					$this->session->set_userdata('userContact',$userContact);
				}
				$this->session->set_userdata('userStatus',$userStatus);
			}
			if($this->input->post('reset')){
				$this->session->unset_userdata('userName');
				$this->session->unset_userdata('userEmail');
				$this->session->unset_userdata('userContact');
				$this->session->unset_userdata('userStatus');
			}
			//****** Serach form value in session ******//
			$userName	=  $this->session->userdata('userName');
			$userEmail	=  $this->session->userdata('userEmail');
			$userContact=  $this->session->userdata('userContact');
			$userStatus	=  $this->session->userdata('userStatus');
			$searchArray = array('userName'=>$userName,'userEmail'=>$userEmail, 'userContact'=>$userContact,'userStatus'=>$userStatus);
			$data['searchUsername'] = $userName; $data['searchUserEmail'] = $userEmail;$data['searchUserContact'] = $userContact;$data['searchUserStatus'] = $userStatus;
			//print_r($data);
			//****** Serach form value in session ******//
			$totalRow=$this->User_model->getClientsRecords($searchArray,NULL);
			$config = array();
			$data['totalRecords'] = $totalRow;
			$data['limit'] = $this->limit;
			$config["base_url"] = base_url('admin/users/clients');
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
			$results = $this->User_model->getClientsRecords($searchArray,$page);
			$data['users'] = $results;
		}catch(Exception	$ex){
			log_message('error', 'Clients not listed'.$ex->getMessage());
		}
		$this->template->load('admin/base', 'admin/users/clients', $data);
	}
	
    /**
     * @Function		-: editClient()
     * @Description		-: This function used for add client basis on client user id
     * @Created on		-: 28-07-2016
     * @Param			-: id (int)
     */
	public function editClient($id = 0){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Users | Edit',
            'list_heading' => 'Users | Edit',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>li><a href="'.base_url('admin/users/clients').'">Clients</a></li>',
        );
        try{
			$user = $this->User_model->getUserDetails($id);
			if(empty($user)){
				redirect('admin/users');
			}
			$data['user'] = $user;
			$data['editId'] = $id;
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
					$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('phone', 'Contact Number ', 'trim|min_length[6]|numeric|max_length[15]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('active', 'User Status', 'trim|numeric');
					$error = "";
					if($this->form_validation->run()==true){
						$email			= $postData['email'];
						$phone			= $postData['phone'];
						$userName		= strtolower($postData['username']);
						$userStatus		= $postData['active'];
						$updateData= array('username'=>$userName,'phone'=>$phone,'email'=>$email,'active'=>$userStatus);
						$update = $this->User_model->updateClient($updateData,$id);
					}else{
						setMessage(' '.validation_errors(),'warning');
					}
			}
			$this->template->load('admin/base', 'admin/users/editClient', $data);
		}catch(Exception $ex){
			setMessage(' Client not updated!' . $ex->getMessage(),'warning');
			log_message('error', 'Client not updated!'.$ex->getMessage());
		}
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	
}
