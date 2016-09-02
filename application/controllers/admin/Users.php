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
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Staff_model');
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
				$userContact= (isset($postData['contact'])) ? $postData['contact'] : '';
				$userStatus	= (!empty($postData['active'])) ? $postData['active'] : '';
				if($userName){
					$this->session->set_userdata('userName',$userName);
				}
				if($userEmail){
					$this->session->set_userdata('userEmail',$userEmail);
				}
				$this->session->set_userdata('userContact',$userContact);
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
			$totalRow=$this->Client_model->getClientsRecords($searchArray,NULL);
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
			$results = $this->Client_model->getClientsRecords($searchArray,$page);
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
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>
            <li><a href="'.base_url('admin/users/clients').'">Clients</a></li>',
        );
        try{
			$user = $this->User_model->getUserDetails($id);
			if(empty($user)){
				redirect('admin/users');
			}
			$data['user']	= $user;
			$userAddress	= $this->User_model->getUserAddress($id);
			if($userAddress){
				$data['userAddress']	= $userAddress;
			}
			$data['editId'] = $id;
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
					$this->form_validation->set_rules('first_name', 'Client Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('phone', 'Contact Number ', 'trim|min_length[6]|numeric|max_length[15]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('active', 'User Status', 'trim|numeric');
					$error = "";
					if($this->form_validation->run()==true){
						$email			= $postData['email'];
						$phone			= $postData['phone'];
						$Name		= $postData['first_name'];
						$userStatus		= $postData['active'];
						$updateData= array('first_name'=>$Name,'phone'=>$phone,'email'=>$email,'active'=>$userStatus);
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
	
	/**
	 * @Function	-: editClientAddress()
	 * @Description	-: This funtion used for update client address basis on client id
	 * @Param		-: No Parameter
	 * @Created On	-: 24-08-2016
	 * 
	 */
	
	public function editClientAddress(){
		try{
			$postData = $this->input->post();
			if(!empty($postData)){
				//$this->form_validation->set_rules('address_type', 'Address Type', 'trim|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('state_id', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('city_id', 'City ', 'trim|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('pincode', 'Pincode ', 'trim|min_length[4]|max_length[9]|alpha_numeric|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					$clientId	= $postData['user_id'];
					if(!empty($clientId) && is_numeric($clientId)){
						$postData['country_id'] = 1;
						$update		= $this->Client_model->updateClientAddress($postData,$clientId);
						if($update){
							setMessage('Client address successfully updated.','success');
							redirect('admin/users/clients');
						}
					}
				}else{
					setMessage(' '.validation_errors(),'warning');
					redirect('admin/users/clients');
				}
			}
		}catch(Exception	 $ex){
			log_message('error',' Unable to update client adddress'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: editClientAddress()
	 * @Description	-: This funtion used for update client address basis on client id
	 * @Param		-: No Parameter
	 * @Created On	-: 24-08-2016
	 * 
	 */
	
	public function editClientNotification(){
		try{
			$postData = $this->input->post();
			if(!empty($postData)){
					$clientId	= $postData['user_id'];
					$updateData	= array();
					$updateData['sms_notified'] = !empty($postData['sms_notified']) ? 1 : 0;
					$updateData['email_notified'] = !empty($postData['email_notified']) ? 1 : 0;
					if(!empty($clientId) && is_numeric($clientId)){
						$update		= $this->Client_model->updateClientNotification($updateData,$clientId);
						if($update){
							setMessage('Client Notification successfully updated.','success');
							redirect('admin/users/clients');
						}
					}
			}
		}catch(Exception	 $ex){
			log_message('error',' Unable to update client notification'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: getStateCities() //Ajax
	 * @Description	-: Thsi function used for get and return city list bassi on state id
	 * @Param		-: No Parameter
	 * @Return		-: string
	 * @Created on	-: 24-08-2016
	 */
	
	public function getStateCities(){
		try{
			$stateId	= $this->input->post('state_id');
			$cities		= getCities($stateId);
			
			print json_encode($cities);die;
		}catch(Exception	$ex){
			log_message('error',' Unable to get cities basis on state '.$ex->getMessage());
		}
	}
	
	/****** Staff Section Function Start Here ******/
	
	/**
	 * @Function		-: staff();
	 * @Description		-: This function used for display staff list
	 * @Created on		-: 25-08-2016
	 * @Param			-: No Parameter
	 * 
	 */ 
	
	function staffs($offset = 0){
        $data = array(
            'title' => 'Users | Staffs',
            'list_heading' => 'Users | Staffs',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>
            <li><a href="'.base_url('admin/users/staffs').'">Staffs</a></li>',
        );
		try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if(!empty($postData)){
				$userName		= (!empty($postData['username'])) ? $postData['username'] : '';
				$userEmail		= (!empty($postData['email'])) ? $postData['email'] : '';
				$userContact	= (!empty($postData['contact'])) ? $postData['contact'] : '';
				$userLocation	= (!empty($postData['location'])) ? $postData['location'] : '';
				$userGender		= (!empty($postData['gender'])) ? $postData['gender'] : '';
				$userStatus		= (!empty($postData['active'])) ? $postData['active'] : '';
				if($userName){
					$this->session->set_userdata('userName',$userName);
				}
				if($userEmail){
					$this->session->set_userdata('userEmail',$userEmail);
				}
				if($userContact){
					$this->session->set_userdata('userContact',$userContact);
				}
				if($userLocation){
					$this->session->set_userdata('userLocation',$userLocation);
				}
				if($userGender){
					$this->session->set_userdata('userGender',$userGender);
				}
				
				$this->session->set_userdata('userStatus',$userStatus);
			}
			if($this->input->post('reset')){
				$this->session->unset_userdata('userName');
				$this->session->unset_userdata('userEmail');
				$this->session->unset_userdata('userContact');
				$this->session->unset_userdata('userLocation');
				$this->session->unset_userdata('userGender');
				$this->session->unset_userdata('userStatus');
			}
			//****** Serach form value in session ******//
			$userName		=  $this->session->userdata('userName');
			$userEmail		=  $this->session->userdata('userEmail');
			$userContact	=  $this->session->userdata('userContact');
			$userLocation	=  $this->session->userdata('userLocation');
			$userGender		=  $this->session->userdata('userGender');
			$userStatus		=  $this->session->userdata('userStatus');
			$searchArray	= array('userName'=>$userName,'userEmail'=>$userEmail, 'userContact'=>$userContact,
									'userLocation'=>$userLocation,
									'userGender'=>$userGender,
									'userStatus'=>$userStatus);
			$data['searchUsername']		= $userName;	$data['searchUserEmail']	= $userEmail;
			$data['searchUserContact']	= $userContact;	$data['searchUserLocation']	= $userLocation;
			$data['searchUserGender']	= $userGender;	$data['searchUserStatus']	= $userStatus;
			//print_r($data);
			//****** Serach form value in session ******//
			$totalRow=$this->Staff_model->getStaffRecords($searchArray,NULL);
			$config = array();
			$data['totalRecords'] = $totalRow;
			$data['limit'] = $this->limit;
			$config["base_url"] = base_url('admin/users/staffs');
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
			$results = $this->Staff_model->getStaffRecords($searchArray,$page);
			$data['users'] = $results;
		}catch(Exception	$ex){
			log_message('error', ' Unable to find staffs lists'.$ex->getMessage());
		}
		$cities	= getCities();
		if(!empty($cities)){
			$data['cities'] = $cities;
		}
		$this->template->load('admin/base', 'admin/users/staffs', $data);
	}
	
	/**
     * @Function		-: editStaff()
     * @Description		-: This function used for add staff basis on staff user id
     * @Created on		-: 25-08-2016
     * @Param			-: id (int)
     */
	public function editStaff($id = 0){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Users | Edit Staff',
            'list_heading' => 'Users | Edit Staff',
            'breadcrum' => '<li><a href="'.base_url('admin/users/').'">Users</a></li>
            <li><a href="'.base_url('admin/users/staffs').'">Staffs</a></li>',
        );
			try{
				$user = $this->User_model->getUserDetails($id);
				if(empty($user)){
					redirect('admin/users');
				}
				$data['user']	= $user;
				$userAddress	= $this->Staff_model->getUserAddress($id);
				if($userAddress){
					$data['userAddress']	= $userAddress;
				}
				$bodyDetails = $this->Staff_model->getStaffBodyDetails($id);
				if($bodyDetails){
					$data['bodyDetails']	= $bodyDetails;
				}
				$staffServices	= $this->Staff_model->getStaffServices($id);
				if($staffServices){
					$data['staffServices']	= $staffServices;
				}
				/****** Staff Gender Type *******/
				$genderArray	= array('Female'=>1,'Male'=>2,'Other'=>3);
				$userGender		= getUserGender($id);
				if($userGender){
					$data['userGender']		= $userGender;
				}
				$genderType		= $genderArray[$userGender];
				/****** Masters Services *******/
				$masterServices	= $this->Staff_model->getMasterServices();
				if($masterServices){
					$data['masterServices']	= $masterServices;
				}
				/****** Staff Hair Colors Basis on staff gender *******/
				$staffHairColors= $this->Staff_model->getHairColors($genderType);
				if($staffHairColors){
					$data['staffHairColors']	= $staffHairColors;
				}
				/****** Staff Ere Colors Basis on staff gender *******/
				$staffEyeColors= $this->Staff_model->getEyeColors($genderType);
				if($staffEyeColors){
					$data['staffEyeColors']	= $staffEyeColors;
				}
				/****** Staff Body Type Basis on staff gender *******/
				$staffBodyTypes= $this->Staff_model->getBodyTypes($genderType);
				if($staffBodyTypes){
					$data['staffBodyTypes']	= $staffBodyTypes;
				}
				/****** Staff Bust type Basis on staff gender *******/
				$staffBustTypes= $this->Staff_model->getBustTypes($genderType);
				if($staffBustTypes){
					$data['staffBustTypes']	= $staffBustTypes;
				}
				/****** Staff Ethnicities Basis on staff gender *******/
				$staffEthnicities= $this->Staff_model->getEthnicities($genderType);
				if($staffEthnicities){
					$data['staffEthnicities']	= $staffEthnicities;
				}
				$data['editId'] = $id;
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('first_name', 'Client Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('phone', 'Contact Number ', 'trim|min_length[6]|numeric|max_length[15]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('active', 'User Status', 'trim|numeric');
						$error = "";
						if($this->form_validation->run()==true){
							$email			= $postData['email'];
							$phone			= $postData['phone'];
							$Name			= $postData['first_name'];
							$userStatus		= $postData['active'];
							$updateData= array('first_name'=>$Name,'phone'=>$phone,'email'=>$email,'active'=>$userStatus);
							$update = $this->Staff_model->updateStaff($updateData,$id);
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/users/editStaff', $data);
			}catch(Exception $ex){
				setMessage(' Staff details not updated!' . $ex->getMessage(),'warning');
				log_message('error', ' Unable to update staff details!'.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
	 * @Function	-: editStaffAddress()
	 * @Description	-: This funtion used for update staff address basis on staff id
	 * @Param		-: No Parameter
	 * @Created On	-: 25-08-2016
	 * 
	 */
	
	public function editStaffAddress(){
		try{
			$postData = $this->input->post();
			if(!empty($postData)){
				$this->form_validation->set_rules('state_id', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('city_id', 'City ', 'trim|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('pincode', 'Pincode ', 'trim|min_length[4]|max_length[9]|alpha_numeric|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					$staffId	= $postData['user_id'];
					$mainCity	= $postData['main_city'];
					$otherCities= $postData['other_city'];
					unset($postData['maincity']);unset($postData['main_city']);unset($postData['othercity']);unset($postData['other_city']);
					if(!empty($staffId) && is_numeric($staffId)){
						$postData['country_id'] = 1;
						$update		= $this->Staff_model->updateStaffAddress($postData,$staffId);
						if($update){
							$updateBabesUserCity = $this->Staff_model->updateStaffServiceCities($staffId,$mainCity,$otherCities);
							setMessage('Staff address successfully updated.','success');
							redirect('admin/users/staffs');
						}
					}
				}else{
					setMessage(' '.validation_errors(),'warning');
					redirect('admin/users/staffs');
				}
			}
		}catch(Exception	 $ex){
			log_message('error',' Unable to update staff adddress'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: editStaffNotification()
	 * @Description	-: This funtion used for update staff notification details basis staff id
	 * @Param		-: No Parameter
	 * @Created On	-: 25-08-2016
	 * 
	 */
	
	public function editStaffNotification(){
		try{
			$postData = $this->input->post();
			if(!empty($postData)){
					$staffId	= $postData['user_id'];
					$updateData	= array();
					$updateData['sms_notified'] = !empty($postData['sms_notified']) ? 1 : 0;
					$updateData['email_notified'] = !empty($postData['email_notified']) ? 1 : 0;
					if(!empty($staffId) && is_numeric($staffId)){
						$update		= $this->Staff_model->updateStaffNotification($updateData,$staffId);
						if($update){
							setMessage('Staff Notification successfully updated.','success');
							redirect('admin/users/staffs');
						}
					}
			}
		}catch(Exception	 $ex){
			log_message('error',' Unable to update staff notification'.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: editStaffServices()
	 * @Description	-: This funtion used for update staff services details basis staff id
	 * @Param		-: No Parameter
	 * @Created On	-: 25-08-2016
	 * 
	 */
	
	public function editStaffServices(){
		try{
			$postData = $this->input->post();
			if(!empty($postData)){;
					$staffId	= $postData['user_id'];
					$updateData	= array();
					$postData	= !empty($postData['staff_services']) ? $postData['staff_services'] : array();
					if(!empty($postData)){
						$count = 1;
						foreach($postData as $services){
							$updateData[$count]['user_id']= $staffId;
							$updateData[$count]['service_id']= $services;
							$count ++;
						}
					}
					if(!empty($staffId) && is_numeric($staffId)){
						$update		= $this->Staff_model->updateStaffServices($updateData,$staffId);
						if($update){
							setMessage('Staff servicess successfully updated.','success');
							redirect('admin/users/staffs');
						}
					}
			}
		}catch(Exception	 $ex){
			log_message('error',' Unable to update staff notification'.$ex->getMessage());
		}
	}
	
	public function editStaffDetails(){
		try{
			$postData	= $this->input->post();
			if(!empty($postData)){
				$this->form_validation->set_rules('hair_color', 'Hair Color', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('eye_color', 'City Color', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('body_type', 'Body Type ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('bust_size', 'Bust Type ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('ethnicity', 'Ethnicity ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('age', 'Age ', 'trim|greater_than_equal_to[18]|numeric|less_than_equal_to[50]|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('height', 'Height ', 'trim|greater_than_equal_to[3]|numeric|less_than_equal_to[7]|numeric|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('weight', 'Weight ', 'trim|greater_than_equal_to[35]|numeric|less_than_equal_to[150]|numeric|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					$staffId	= $postData['user_id'];
					if(!empty($staffId) && is_numeric($staffId)){
						$update		= $this->Staff_model->updateStaffBodydetails($postData,$staffId);
						if($update){
							setMessage('Staff body details successfully updated.','success');
							redirect('admin/users/staffs');
						}
					}
				}else{
					setMessage(' '.validation_errors(),'warning');
					redirect('admin/users/staffs');
				}
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update staff body details '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: changeUserStatus()
	 * @Description	-: This function used for change user status basis on user id and status
	 * @Param		-: No Parameter
	 * @Return 		-: array
	 * @Created on	-: 26-08-2016
	 */
	public function changeUserStatus(){
		try{
			$userId		= $this->input->post('user_id');
			$active		= $this->input->post('status');
			if($active==1){
				$active = 0;
			}else{
				$active = 1;
			}
			$updateData	= array('active'=>$active);
			$responseAr	= array();
			$status		= "No";
			$msg		= "Unable to change user status.";
			if(!empty($userId) && is_numeric($userId)){
				$update = $this->User_model->where('id',$userId)->update($updateData);
				if($update){
					$status		= "Yes";
					$msg		= "User Status changed successfully.";
				}
			}
			$responseAr['status'] = $status;$responseAr['msg'] = $msg;
			echo json_encode($responseAr);die;
		}catch(Exception $ex){
			log_message('error',' Unable to update user status '.$ex->getMessage());
		}
	}
	
	public function loadBabesCities(){
		$key =	$this->input->get('q');
		$country =	$this->input->get('c');
		if(!empty($key) && strlen($key) > 2){
			$suggest  = array();
			$key = str_replace("%20"," ",$key);
			$key = trim($key);
		}
		$results=	$this->db
					->select('BC.id, BC.id as cityId,CONCAT(BC.name," ",BS.name) as city')
					->like('BC.name',$key)
					->join('babes_state as BS','BS.id=BC.state')
					->get('babes_city as BC')->result();
			if(!empty($results)){
				foreach($results as $result):
				if(!empty($result->city))
					$suggest['city'][] = array( 'id' => $result->cityId ,  'text' => $result->city,'country' => $result->cityId);
				endforeach;
			}
		$this->output->set_content_type('application/json')->set_output(json_encode($suggest));
	}
}
