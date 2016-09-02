<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Services extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Service_model');
        $this->PageTitle = 'Service Management';
        $this->load->model('admin/User_auth_model');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(2,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[2];
    }
    
/**
 * @Method		-: index()
 * @Description	-: This function used to for display all services
 * @Created		-: 23-07-2016
 * @Param		-: No
 */  
    public function index() {
        $data = array(
            'title' => 'Services',
            'list_heading' => 'Services',
            'breadcrum' => '<li><a href="'.base_url('admin/services').'">Services</a></li>',
        );
        $services		= $this->Service_model->get_all();
        if($services){
			$data['services'] = $services;
		}
		$data['permissionValue'] = $this->permissionValue;
        $this->template->load('admin/base', 'admin/services/index', $data);
    }
    
/**
 * @Method		-: add()
 * @Description	-: This function used to for add Services
 * @Created		-: 23-07-2016
 * @Param		-: No
 */
 
	public function add(){
	if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Service | Add',
            'list_heading' => 'Service | Add',
            'breadcrum' => '<li><a href="'.base_url('admin/services').'">Services</a></li>
            <li><a href="'.base_url('services/add').'">Add Service</a></li>',
        );
        $postData = $this->input->post();
		if(!empty($postData)){
			$error = "";
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('price', 'Service Price ', 'trim|max_length[5]|numeric');
			if($this->form_validation->run()==true){
				$postData = removeExtraspace($postData);
				$postData['alias'] = $postData['name'];
				$postData['updated_by'] = $this->user_id;
				try{
					$check = $this->Service_model->checkUniqueService($postData['name']);
					if(empty($check)){
						$file_name='';
						$f_name='';$error='';
						if(isset($_FILES) && !empty($_FILES['images']) && $_FILES['images']['name']!=''){
							$config['upload_path'] = FCPATH.'assets/front/services-images/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = '30000';
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('images')){
								$error = $this->upload->display_errors();
							}else{
								$res = $this->upload->data();
								$file_path     = $res['file_path'];
								$file         = $res['full_path'];
								$file_ext     = $res['file_ext'];
								$file_name = time().$file_ext;
								 
								// here is the renaming functon
								rename($file, $file_path . $file_name);
								$f_name=explode('/',$file);
								$f_name=$f_name[sizeof($f_name)-1];
							}
							$postData['images']=$file_name;	
						}
						if(empty($error)){
							$serviceInsert = $this->Service_model->manageService($postData);
							if($serviceInsert){
								setMessage(' Service successfully added','success');
								redirect('admin/services/');
							}
						}else{
							setMessage($error,'warning');
						}
					}else{
						setMessage(' Services already exists','warning');
					}
				}catch (Exception $ex) {
					setMessage(' Services not added!' . $ex->getMessage(),'warning');
					log_message('error', 'Service not added'.$ex->getMessage());
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
			}
		}
		$this->template->load('admin/base', 'admin/services/add', $data);
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	
	public function customEdit(){
		
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('price', 'Service Price ', 'trim|max_length[5]|numeric');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$data = removeExtraspace($data);
				try{
					$check = $this->Service_model->checkUniqueService($data['name'],$data['id']);
					if($check){
						setMessage('Service already exists','warning');
						redirect('admin/services/');
					}else{
						$file_name='';$error='';
						$f_name='';
						if(isset($_FILES) && !empty($_FILES['images']) && $_FILES['images']['name']!=''){
							$config['upload_path'] = FCPATH.'assets/front/services-images/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = '30000';
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if (! $this->upload->do_upload('images')){
								$error = $this->upload->display_errors();
								setMessage($error,'warning');
								redirect('admin/services/');
							}else{
								$res = $this->upload->data();
								$file_path     = $res['file_path'];
								$file         = $res['full_path'];
								$file_ext     = $res['file_ext'];
								$file_name = time().$file_ext;
								 
								// here is the renaming functon
								rename($file, $file_path . $file_name);
								$f_name=explode('/',$file);
								$f_name=$f_name[sizeof($f_name)-1];
							}
							$data['images'] = $file_name;
						}
						$data['alias'] = $data['name'];
						$data['updated_by'] = $this->user_id;
						$serviceUpdate = $this->Service_model->manageService($data,$data['id']);
						if($serviceUpdate){
							setMessage('Service successfully updated','success');
							redirect('admin/services/');
						}
					}
				}catch (Exception $ex) {
					log_message('error', ' Service not updated'.$ex->getMessage());
				}
			}else{
				setMessage(validation_errors(),'warning');
				redirect('admin/services/');
			}
			
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	/**
	 * @Methode		-: removeService();
	 * @Description	-: This an ajax function used for delate a single service record basis on service id
	 * @Created on	-: 23-07-2016
	 * @Return		-: true/flase
	 */
	 
	public function removeService(){
	if($this->permissionValue==1 || $this->permissionValue==3 || $this->permissionValue==5 || $this->permissionValue==7){
		$id = $this->input->post('id');
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		try{
			$remove  = $this->Service_model->where('id',$id)->delete();
			if($remove){
				echo 'A';
			}
		}catch(Exception $ex){
			log_message('error', 'Service not removed! ' . $ex->getMessage());
			return false;
		}
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
}
