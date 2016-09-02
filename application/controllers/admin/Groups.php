<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Groups extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Users_Group_model');
        $this->load->model('admin/User_auth_model');
        $this->load->model('admin/Permission_model');
        $this->PageTitle = 'User Management';
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
    }
    
/**
 * @Method		-: index()
 * @Description	-: This function used to for display all groups
 * @Created		-: 25-07-2016
 * @Param		-: No
 */  
    public function index() {
        $data = array(
            'title' => 'Groups',
            'list_heading' => 'Groups',
            'breadcrum' => '<li><a href="'.base_url('admin/groups').'">Groups</a></li>',
        );
        try{
			$groups	= $this->Users_Group_model->where('id !=',1)->get_all();
			if($groups){
				$data['groups'] = $groups;
			}
		}catch(Exception $ex){
			setMessage(' Group not listed!' . $ex->getMessage(),'warning');
			log_message('error', 'Group not listed'.$ex->getMessage());
		}
        $data['permissionValue'] = $this->permissionValue;
        $this->template->load('admin/base', 'admin/groups/index', $data);
    }
    
/**
 * @Method		-: add()
 * @Description	-: This function used to for add User Group
 * @Created		-: 25-07-2016
 * @Param		-: No
 */
 
	public function add(){
	if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Group | Add',
            'list_heading' => 'Group | Add',
            'breadcrum' => '<li><a href="'.base_url('admin/groups').'">Groups</a></li>
            <li><a href="'.base_url('groups/add').'">Add Group</a></li>',
        );
        $postData = $this->input->post();
		if($postData){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|max_length[500]');
			if($this->form_validation->run()==true){
				$permissionValue = $postData['permission'];
				$postData = removeExtraspace($postData);
				$postData['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>$postData['name']);
					$check = $this->Users_Group_model->where($checkCondition)->get_all();
					if(empty($check)){
						$postData['name'] = strtolower($postData['name']);
						$groupInsert = $this->Users_Group_model->insert($postData);//die;
						if($groupInsert){
							/****** Group Permission Update ******/
							$groupPermissionData = array();
							if(!empty($permissionValue)){
								$count = 1;
								foreach($permissionValue as $k=>$v){
									if(!empty($v)){
										$groupPermissionData[$count]['group_id'] = $groupInsert;
										$groupPermissionData[$count]['permission'] = $v;
										$groupPermissionData[$count]['permission_id'] = $k;
										$count++;
									}
								}
							}
							if(!empty($groupPermissionData)){
								$insert = $this->db->insert_batch('babes_group_permission', $groupPermissionData);
							}
							setMessage('Group successfully added','success');
							redirect('admin/groups/');
						}
					}else{
						setMessage('Group already exists','warning');
					}
				}catch (Exception $ex) {
					setMessage(' Group not added!' . $ex->getMessage(),'warning');
					log_message('error', 'Group not added'.$ex->getMessage());
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
			}
		}
		
		$permissions = $this->Permission_model->where('id !=',1)->where('status',1)->get_all();
		if($permissions){
			$data['permissions'] = $permissions;
		}
		$this->template->load('admin/base', 'admin/groups/add', $data);
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
/**
 * @Method		-: edit()
 * @Description	-: This function used to for add User Group
 * @Created		-: 26-07-2016
 * @Param		-: $id (int)
 */
 
	public function edit($id){
	if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
        $data = array(
            'title' => 'Group | Edit',
            'list_heading' => 'Group | Edit',
            'breadcrum' => '<li><a href="'.base_url('admin/groups').'">Groups</a></li>
            <li><a href="'.base_url('groups/edit'.$id).'">Edit Group</a></li>',
        );
        
		$group  = $this->Users_Group_model->where('id',$id)->where('status',1)->get();
		if($group){
			$data['group'] = $group;
		}else{
			redirect('admin/groups/');
		}
		$groupPermissions = $this->db->select('permission,permission_id')->where('group_id',$id)
							->get('babes_group_permission')->result_array();
		if($groupPermissions){
			$permission = array_column($groupPermissions,'permission','permission_id');
			$data['groupPermissions'] = $permission;
		}else{
			$data['groupPermissions'] = array();
		}
		$postData = $this->input->post();
		if($postData){
			$permissionValue = $postData['permission'];
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|max_length[500]');
			if($this->form_validation->run()==true){
				$postData = removeExtraspace($postData);
				$postData['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>strtolower($postData['name']));
					$check = $this->Users_Group_model->where('id !=',$id)->where($checkCondition)->get_all();
					if(empty($check)){
						$postData['name'] = strtolower($postData['name']);
						$groupUpdate = $this->Users_Group_model->where('id',$id)->update($postData);
						if($groupUpdate){
							/****** Group Permission Update ******/
							$groupPermissionData = array();
							if(!empty($permissionValue)){
								$count = 1;
								foreach($permissionValue as $k=>$v){
									if(!empty($v)){
										$groupPermissionData[$count]['group_id'] = $id;
										$groupPermissionData[$count]['permission'] = $v;
										$groupPermissionData[$count]['permission_id'] = $k;
										$count++;
									}
								}
							}
							if(!empty($groupPermissionData)){
								$delete = $this->db->where('group_id',$id)->delete('babes_group_permission');
								$insert = $this->db->insert_batch('babes_group_permission', $groupPermissionData);
							}
							setMessage('Group successfully updated','success');
							redirect('admin/groups/');
						}
					}else{
						setMessage('Group already exists','warning');
					}
				}catch (Exception $ex) {
					setMessage(' Group not added!' . $ex->getMessage(),'warning');
					log_message('error', 'Group not added'.$ex->getMessage());
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
			}
		}
		
		$permissions = $this->Permission_model->where('id !=',1)->where('status',1)->get_all();
		if($permissions){
			$data['permissions'] = $permissions;
		}
		$this->template->load('admin/base', 'admin/groups/edit', $data);
	}else{
		setMessage(' You are not Authorized for this page !','danger');
		redirect('admin/dashboard');
	}
	}
	
	/**
	 * @Method		-: customEdit()
	 * @Description	-: This function used for edit the Group Details
	 * @Created		-: 25-07-2016
	 * @Param		-: No Parameter
	 */ 
	public function customEdit(){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('description', 'Description ', 'trim|min_length[50]|max_length[500]|required',array('required' => 'You must provide a %s.'));
			$responseArray['status'] = 'No';
			$responseArray['msg'] = 'Validate all fields';
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$data = removeExtraspace($data);
				$data['updated_by'] = $this->user_id;
				try{
					$checkCondition = array('name'=>$data['name']);
					$check = $this->Users_Group_model->where('id !=',$data['id'])->where($checkCondition)->get_all();
					//print $this->db->last_query();die;
					if($check){
						$responseArray['msg'] = 'Group already exists';
						$responseArray['status'] = 'No';
					}else{
						$groupUpdate = $this->Users_Group_model->where('id',$data['id'])->update($data);
						if($groupUpdate){
							$responseArray['msg'] = 'Group successfully updated';
							$responseArray['status'] = 'Yes';
						}
					}
				}catch (Exception $ex) {
							$responseArray['msg'] = 'Group not updated'.$ex->getMessage();
							$responseArray['status'] = 'No';
					log_message('error', 'Group not updated'.$ex->getMessage());
				}
			}else{
				$responseArray['msg'] = validation_errors();
				$responseArray['status'] = 'No';
			}
			$responseArray['name'] = $data['name'];
			$responseArray['description'] = substr($data['description'],0,50);
			$responseArray['active'] = $data['status'];
			echo json_encode($responseArray);die;
	}
	/**
	 * @Methode		-: removeService();
	 * @Description	-: This an ajax function used for delate a single Group record basis on group id
	 * @Created on	-: 25-07-2016
	 * @Return		-: true/flase
	 */
	 
	public function removeGroup(){
		$id = $this->input->post('id');
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		try{
			$remove  = $this->Users_Group_model->where('id',$id)->delete();
			if($remove){
				echo 'A';
			}
		}catch(Exception $ex){
			log_message('error', 'Group not removed! ' . $ex->getMessage());
			return false;
		}
	} 


}
