<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Permissions extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Permission_model');
        $this->load->model('admin/User_auth_model');
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
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->PageTitle = 'User Management';
    }
    
/**
 * @Method		-: index()
 * @Description	-: This function used to for display all Permissions
 * @Created		-: 25-07-2016
 * @Param		-: No
 */  
    public function index() {
        $data = array(
            'title' => 'Permissions',
            'list_heading' => 'Permissions',
            'breadcrum' => '<li><a href="'.base_url('admin/permissions').'">Permissions</a></li>',
        );
        $permissions		= $this->Permission_model->order_by('id','ASC')->get_all();
        //echo "<pre>";print_r($permissions);die;
        if($permissions){
			$data['permissions'] = $permissions;
		}
		$data['permissionValue'] = $this->permissionValue;
        $this->template->load('admin/base', 'admin/permissions/index', $data);
    }
    
/**
 * @Method		-: add()
 * @Description	-: This function used to for add Permission
 * @Created		-: 25-07-2016
 * @Param		-: No
 */
 
	public function add(){
	if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Permission | Add',
            'list_heading' => 'Permission | Add',
            'breadcrum' => '<li><a href="'.base_url('admin/permissions').'">Permissions</a></li>
            <li><a href="'.base_url('permissiosn/add').'">Add Permission</a></li>',
        );
        $postData = $this->input->post();
		if(!empty($postData)){
			$error = "";
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|max_length[500]');
			if($this->form_validation->run()==true){
				$postData = removeExtraspace($postData);
				$postData['alias'] = $postData['name'];
				$postData['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>$postData['name'],'status'=>1);
					$check = $this->Permission_model->where($checkCondition)->get_all();
					if(empty($check)){
						$serviceInsert = $this->Permission_model->insert($postData);
						if($serviceInsert){
							setMessage('Permission successfully added','success');
							redirect('admin/permissions/');
						}
					}else{
						setMessage('Permission already exists','warning');
					}
				}catch (Exception $ex) {
					setMessage(' Permission not added!' . $ex->getMessage(),'warning');
					log_message('error', 'Permission not added'.$ex->getMessage());
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
			}
		}
		$this->template->load('admin/base', 'admin/permissions/add', $data);
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}	
	}
	
	/**
	 * @Method		-: edit()
	 * @Description	-: This function used for edit the Permission details basis on permission id
	 * @Created		-: 16-06-2016
	 * @Param		-: $id (int)
	 */ 
	public function edit($id=0){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
		if(empty($id) || !is_numeric($id)){
			redirect('admin/permissions/');
		}
		$permissionDetails = $this->Permission_model->where('id',$id)->get();
		if(empty($servicDetails)){
			redirect('admin/permissions/');
		}
		$data['editId'] = $id;
		$data['permission'] = $permissionDetails;
		$data['title'] = 'Permission | Edit';
		$data['list_heading'] = 'Edit Permission';
		$data['breadcrum'] = '<li><a href="'.base_url('admin/permissions').'">Permissions</a></li>
		<li><a href="'.base_url('admin/permissions/edit/'.$id).'">Edit Permission</a></li>';
		$postData = $this->input->post();
		if(!empty($postData)){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|max_length[500]');
			if($this->form_validation->run()==true){
				$postData = removeExtraspace($postData);
				$postData['alias'] = $postData['name'];
				$postData['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>$postData['name'],'status'=>1);
					$check = $this->Permission_model->where('id !=',$id)->where($checkCondition)->get_all();
					$serviceUpdate = $this->Permission_model->where('id',$id)->update($postData);
					if($serviceUpdate){
						setMessage(' Permission successfully updated','success');
						redirect('permissions/');
					}
				}catch (Exception $ex) {
					setMessage(' Permission not updated!' . $ex->getMessage(),'warning');
					log_message('error', 'Permission not updated'.$ex->getMessage());
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
			}
		}
		$this->template->load('admin/base','admin/permissions/edit',$data);
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	/**
	 * @Method		-: customEdit()
	 * @Description	-: This function used for edit the permision details
	 * @Created		-: 25-07-2016
	 * @Param		-: No Parameter
	 */ 
	public function customEdit(){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|max_length[500]');
			$responseArray['status'] = 'No';
			$responseArray['msg'] = 'Validate all fields';
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$data = removeExtraspace($data);
				$data['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>$data['name'],'status'=>1);
					$check = $this->Permission_model->where('id !=',$data['id'])->where($checkCondition)->get_all();
					if($check){
						$responseArray['msg'] = 'Permission already exists';
						$responseArray['status'] = 'No';
					}else{
						$serviceUpdate = $this->Permission_model->where('id',$data['id'])->update($data);
						if($serviceUpdate){
							$responseArray['msg'] = 'Permission successfully updated';
							$responseArray['status'] = 'Yes';
						}
					}
				}catch (Exception $ex) {
							$responseArray['msg'] = 'Permission not updated'.$ex->getMessage();
							$responseArray['status'] = 'No';
					log_message('error', 'Permission not updated'.$ex->getMessage());
				}
			}else{
				$responseArray['msg'] = validation_errors();
				$responseArray['status'] = 'No';
			}
			$responseArray['name'] = $data['name'];
			$responseArray['description'] = !empty($data['description']) ? substr($data['description'],0,50) : 'N/A';
			$responseArray['active'] = $data['status'];
			echo json_encode($responseArray);die;
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	/**
	 * @Methode		-: removePermission();
	 * @Description	-: This an ajax function used for delate a single permission record basis on permission id
	 * @Created on	-: 25-07-2016
	 * @Return		-: true/flase
	 */
	 
	public function removePermission(){
		$id = $this->input->post('id');
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		try{
			$remove  = $this->Permission_model->where('id',$id)->delete();
			if($remove){
				$remove  = $this->Permission_model->removeGroupPermission($id);
				echo 'A';
			}
		}catch(Exception $ex){
			log_message('error', 'Permission not removed! ' . $ex->getMessage());
			return false;
		}
	} 


}
