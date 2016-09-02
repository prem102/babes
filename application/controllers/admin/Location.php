<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Location extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/State_model');
        $this->load->model('admin/City_model');
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
        $this->PageTitle = 'Location Management';
        $this->limit = 10;
    }
    
    /**
     * @Function		-: states()
     * @Description		-: This function used for display States
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function states(){
        $data = array(
            'title' => 'Location | States',
            'list_heading' => 'Location | States',
            'breadcrum' => '<li><a href="'.base_url('admin/location/states').'">States</a></li>',
        );
		try{
			$states = $this->State_model->getAllStates();
			if(!empty($states) && is_array($states)){
				$data['states'] = $states;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/location/states', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of locations states'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addState()
     * @Description		-: This function used for add state
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addState(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Location | Add State',
					'list_heading' => 'Location | Add State',
					'breadcrum' => '<li><a href="'.base_url('admin/location/states').'">States</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'State Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('status', 'State Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$postData['country']	= 1;
							$checkUniqueState		= $this->State_model->checkUniqueState($postData['name']);
							if($checkUniqueState){
								setMessage('State already exists.','warning');
							}else{
								$insertedId = $this->State_model->insertState($postData);
								if($insertedId){
									setMessage('State successfully inserted.','success');
									redirect('admin/location/states');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/location/addstate', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add page labels value '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customStateEdit()
     * @Description		-: This function used for edit page labels value
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customStateEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				$stateId	= $updateData['state_id'];
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueState	= $this->State_model->checkUniqueState($updateData['name'],$stateId);
				if($checkUniqueState){
					setMessage('State name already exists','warning');
					redirect('admin/location/states');
				}else{
					$updateState	= $this->State_model->updateState($updateData,$stateId);
					if($updateState){
						setMessage('State successfully updated.','success');
						redirect('admin/location/states');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/location/states');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	
	/****** ### Cities Functionality Details ### ******/
	
    /**
     * @Function		-: cities()
     * @Description		-: This function used for display cities
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function cities(){
        $data = array(
            'title' => 'Location | Cities',
            'list_heading' => 'Location | Cities',
            'breadcrum' => '<li><a href="'.base_url('admin/location/cities').'">Cities</a></li>',
        );
		try{
			$cities = $this->City_model->getAllCities();
			if(!empty($cities) && is_array($cities)){
				$data['cities'] = $cities;
			}
			$states = $this->City_model->getAllStates();
			if(!empty($states) && is_array($states)){
				$data['states'] = $states;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/location/cities', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of cities '.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addCity()
     * @Description		-: This function used for add city
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addCity(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Location | Add City ',
					'list_heading' => 'Location | Add City ',
					'breadcrum' => '<li><a href="'.base_url('admin/location/cities').'">Cities</a></li>
					<li><a href="'.base_url('admin/location/addCity').'">Add City</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
					$this->form_validation->set_rules('name', 'City Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('state', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
					$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
					if($this->form_validation->run()==true){
						$postData['created_by'] = $this->user_id;
						$postData['country']	= 1;
						$postData['alias']		= ucfirst($postData['name']);
						$postData['name']		= ucfirst($postData['name']);
						$checkUniqueCity		= $this->City_model->checkUniqueCity($postData['name'],$postData['state']);
						if($checkUniqueCity){
							setMessage('City already exists.','warning');
						}else{
							$insertedId = $this->City_model->insertCity($postData);
							if($insertedId){
								setMessage('City inserted successfully.','success');
								redirect('admin/location/cities');
							}
						}
					}else{
						setMessage(' '.validation_errors(),'warning');
					}
				}
				$states = $this->City_model->getAllStates();
				if(!empty($states) && is_array($states)){
					$data['states'] = $states;
				}
				$this->template->load('admin/base', 'admin/location/addcity', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add city in a state '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customCityEdit()
     * @Description		-: This function used for edit city details
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customCityEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'City Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('state', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				$cityId	= $updateData['city_id'];
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueState	= $this->City_model->checkUniqueCity($updateData['name'],$updateData['state'],$cityId);
				if($checkUniqueState){
					setMessage('City name already exists','warning');
					redirect('admin/location/cities');
				}else{
					$updateState	= $this->City_model->updateCity($updateData,$cityId);
					if($updateState){
						setMessage('City successfully updated.','success');
						redirect('admin/location/cities');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/location/cities');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}

}
