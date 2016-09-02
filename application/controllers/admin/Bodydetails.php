<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bodydetails extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Hair_model');
        $this->load->model('admin/Eye_model');
        $this->load->model('admin/Body_model');
        $this->load->model('admin/Bust_model');
        $this->load->model('admin/Ethnicity_model');
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
        $this->PageTitle = 'Body Details Management';
        $this->limit = 10;
    }
    
    /**
     * @Function		-: hairColors()
     * @Description		-: This function used for display hair colors
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function hairColors(){
        $data = array(
            'title' => 'Body Detail | Hair Colors',
            'list_heading' => 'Body Detail | Hair Colors',
            'breadcrum' => '<li><a href="'.base_url('admin/bodydetils/hairColors').'">Hair Color</a></li>',
        );
		try{
			$hairs = $this->Hair_model->getAllHairColors();
			if(!empty($hairs) && is_array($hairs)){
				$data['hairs'] = $hairs;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/bodydetails/hairs', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of hair colors'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addHairColor()
     * @Description		-: This function used for add hair color
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addHairColor(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Body Detail | Add Hair Colors',
					'list_heading' => 'Body Detail | Add Hair Colors',
					'breadcrum' => '<li><a href="'.base_url('admin/bodydetails/hairColors').'">Hair Colors</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'Hair Color Name', 'trim|alpha|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$type					= $postData['type'];
							$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$checkUniqueHair		= $this->Hair_model->checkUniqueHairColor($postData['name'],$type);
							if($checkUniqueHair){
								setMessage('Hair color already exists for '.$genderArray[$type].'' ,'warning');
							}else{
								$insertedId = $this->Hair_model->insertHairColor($postData);
								if($insertedId){
									setMessage('Hair color successfully inserted.','success');
									redirect('admin/bodydetails/hairColors');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/bodydetails/addhaircolor', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add Hair color '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customHairColorEdit()
     * @Description		-: This function used for update hair color 
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customHairColorEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Hair Color Name', 'trim|alpha|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				
				$id	= $updateData['id'];
				$type					= $updateData['type'];
				$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueHair	= $this->Hair_model->checkUniqueHairColor($updateData['name'],$type,$id);
				if($checkUniqueHair){
					setMessage('Hair color already exists for '.$genderArray[$type].'' ,'warning');
					redirect('admin/bodydetails/hairColors');
				}else{
					$updateState	= $this->Hair_model->updateHairColor($updateData,$id);
					if($updateState){
						setMessage('Hair color successfully updated.','success');
						redirect('admin/bodydetails/hairColors');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/bodydetails/hairColors');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
/**
     * @Function		-: eyeColors()
     * @Description		-: This function used for display eye colors
     * @Created on		-: 28-07-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function eyeColors(){
        $data = array(
            'title' => 'Body Detail | Eye Colors',
            'list_heading' => 'Body Detail | Eye Colors',
            'breadcrum' => '<li><a href="'.base_url('admin/bodydetils/eyeColors').'">Eye Color</a></li>',
        );
		try{
			$eyeColors = $this->Eye_model->getAllEyeColors();
			if(!empty($eyeColors) && is_array($eyeColors)){
				$data['eyeColors'] = $eyeColors;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/bodydetails/eyecolors', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of eye colors'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addEyeColor()
     * @Description		-: This function used for add eye color
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addEyeColor(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Body Detail | Add Hair Colors',
					'list_heading' => 'Body Detail | Add Hair Colors',
					'breadcrum' => '<li><a href="'.base_url('admin/bodydetails/eyeColors').'">Eye Colors</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'Eye Color Name', 'trim|alpha|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$type					= $postData['type'];
							$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$checkUniqueHair		= $this->Eye_model->checkUniqueEyeColor($postData['name'],$type);
							if($checkUniqueHair){
								setMessage('eye color already exists for '.$genderArray[$type].'' ,'warning');
							}else{
								$insertedId = $this->Eye_model->insertEyeColor($postData);
								if($insertedId){
									setMessage('Eye color successfully inserted.','success');
									redirect('admin/bodydetails/eyeColors');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/bodydetails/addeyecolor', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add eye color '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customEyeColorEdit()
     * @Description		-: This function used for update eye color details
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customEyeColorEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Eye Color Name', 'trim|alpha|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				
				$id	= $updateData['id'];
				$type					= $updateData['type'];
				$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueHair	= $this->Eye_model->checkUniqueEyeColor($updateData['name'],$type,$id);
				if($checkUniqueHair){
					setMessage('Eye color already exists for '.$genderArray[$type].'' ,'warning');
					redirect('admin/bodydetails/eyeColors');
				}else{
					$updateState	= $this->Eye_model->updateEyeColor($updateData,$id);
					if($updateState){
						setMessage('Eye color successfully updated.','success');
						redirect('admin/bodydetails/eyeColors');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/bodydetails/eyeColors');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}

	/**
     * @Function		-: bodyTypes()
     * @Description		-: This function used for display body types
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function bodyTypes(){
        $data = array(
            'title' => 'Body Detail | Body Type',
            'list_heading' => 'Body Detail | Body Type',
            'breadcrum' => '<li><a href="'.base_url('admin/bodydetils/bodyTypes').'">Body Types</a></li>',
        );
		try{
			$bodyTypes = $this->Body_model->getAllBodytypes();
			if(!empty($bodyTypes) && is_array($bodyTypes)){
				$data['bodyTypes'] = $bodyTypes;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/bodydetails/bodytypes', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of Body Types'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addBodyType()
     * @Description		-: This function used for add body type
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addBodyType(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Body Detail | Add Body Type',
					'list_heading' => 'Body Detail | Add Body Type',
					'breadcrum' => '<li><a href="'.base_url('admin/bodydetails/bodyTypes').'">Body Details</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'Body Type Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$type					= $postData['type'];
							$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$checkUniqueHair		= $this->Body_model->checkUniqueBodyType($postData['name'],$type);
							if($checkUniqueHair){
								setMessage('Body Type already exists for '.$genderArray[$type].'' ,'warning');
							}else{
								$insertedId = $this->Body_model->insertBodyType($postData);
								if($insertedId){
									setMessage('Body Type successfully inserted.','success');
									redirect('admin/bodydetails/bodyTypes');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/bodydetails/addbodytype', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add Body Type '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customBodyTypeEdit()
     * @Description		-: This function used for update body type details
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customBodyTypeEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Body Type', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				$id	= $updateData['id'];
				$type					= $updateData['type'];
				$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueHair	= $this->Body_model->checkUniqueBodyType($updateData['name'],$type,$id);
				if($checkUniqueHair){
					setMessage('Body Type already exists for '.$genderArray[$type].'' ,'warning');
					redirect('admin/bodydetails/bodyTypes');
				}else{
					$updateState	= $this->Body_model->updateBodyType($updateData,$id);
					if($updateState){
						setMessage('Body Type successfully updated.','success');
						redirect('admin/bodydetails/bodyTypes');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/bodydetails/bodyTypes');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: bustTypes()
     * @Description		-: This function used for display bust types
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function bustTypes(){
        $data = array(
            'title' => 'Body Detail | Bust Type',
            'list_heading' => 'Body Detail | Bust Type',
            'breadcrum' => '<li><a href="'.base_url('admin/bodydetils/bustTypes').'">Bust Types</a></li>',
        );
		try{
			$bustTypes = $this->Bust_model->getAllBusttypes();
			if(!empty($bustTypes) && is_array($bustTypes)){
				$data['bustTypes'] = $bustTypes;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/bodydetails/busttypes', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of Bust type'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addBustType()
     * @Description		-: This function used for add bust type
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addBustType(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Body Detail | Add Bust Type',
					'list_heading' => 'Body Detail | Add Bust Type',
					'breadcrum' => '<li><a href="'.base_url('admin/bodydetails/bustTypes').'">Bust Details</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'Bust Type Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$type					= $postData['type'];
							$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$checkUniqueHair		= $this->Bust_model->checkUniqueBustType($postData['name'],$type);
							if($checkUniqueHair){
								setMessage('Bust Type already exists for '.$genderArray[$type].'' ,'warning');
							}else{
								$insertedId = $this->Bust_model->insertBustType($postData);
								if($insertedId){
									setMessage('Bust Type successfully inserted.','success');
									redirect('admin/bodydetails/bustTypes');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/bodydetails/addbusttype', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add Bust Type '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customBustTypeEdit()
     * @Description		-: This function used for update bust type details
     * @Created on		-: 23-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customBustTypeEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Bust Type', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				$id	= $updateData['id'];
				$type					= $updateData['type'];
				$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueHair	= $this->Bust_model->checkUniqueBustType($updateData['name'],$type,$id);
				if($checkUniqueHair){
					setMessage('Bust Type already exists for '.$genderArray[$type].'' ,'warning');
					redirect('admin/bodydetails/bustTypes');
				}else{
					$updateState	= $this->Bust_model->updateBustType($updateData,$id);
					if($updateState){
						setMessage('Bust Type successfully updated.','success');
						redirect('admin/bodydetails/bustTypes');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/bodydetails/bustTypes');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: ethnicities()
     * @Description		-: This function used for display ethnicities
     * @Created on		-: 24-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function ethnicities(){
        $data = array(
            'title' => 'Body Detail | Ethnicities',
            'list_heading' => 'Body Detail | Ethnicities',
            'breadcrum' => '<li><a href="'.base_url('admin/bodydetils/ethnicities').'">Ethnicities</a></li>',
        );
		try{
			$ethnicities = $this->Ethnicity_model->getAllEthnicity();
			if(!empty($ethnicities) && is_array($ethnicities)){
				$data['ethnicities'] = $ethnicities;
			}
			$data['permissionValue'] = $this->permissionValue;
			$this->template->load('admin/base', 'admin/bodydetails/ethnicities', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of Ethnicities'.$ex->getMessage());
		}
	}

    
    /**
     * @Function		-: addEthnicity()
     * @Description		-: This function used for add ethnicity
     * @Created on		-: 23-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function addEthnicity(){
		if($this->permissionValue==4 || $this->permissionValue==5 || $this->permissionValue==6 || $this->permissionValue==7){
			try{
				$data = array(
					'title' => 'Body Detail | Add Ethnicity',
					'list_heading' => 'Body Detail | Add Ethnicity',
					'breadcrum' => '<li><a href="'.base_url('admin/bodydetails/ethnicities').'">Ethnicities</a></li>',
				);
				$postData = $this->input->post();
				$postData = removeExtraspace($postData);
				if($postData){
						$this->form_validation->set_rules('name', 'Ethnicity Name', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
						$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
						$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
						if($this->form_validation->run()==true){
							$postData['created_by']	= $this->user_id;
							$type					= $postData['type'];
							$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
							$postData['alias']		= ucfirst($postData['name']);
							$postData['name']		= ucfirst($postData['name']);
							$checkUniqueHair		= $this->Ethnicity_model->checkUniqueEthnicity($postData['name'],$type);
							if($checkUniqueHair){
								setMessage('Ethnicity already exists for '.$genderArray[$type].'' ,'warning');
							}else{
								$insertedId = $this->Ethnicity_model->insertEthnicity($postData);
								if($insertedId){
									setMessage('Ethnicity successfully inserted.','success');
									redirect('admin/bodydetails/ethnicities');
								}
							}
						}else{
							setMessage(' '.validation_errors(),'warning');
						}
				}
				$this->template->load('admin/base', 'admin/bodydetails/addethnicity', $data);
			}catch(Exception $ex){
				log_message('error',' Unable to add ethnicity '.$ex->getMessage());
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}
	
	/**
     * @Function		-: customEthnicityEdit()
     * @Description		-: This function used for update ethnicity details
     * @Created on		-: 24-08-2016
     * @Param			-: id (int)
     * 
     */ 
	public function customEthnicityEdit(){
		if($this->permissionValue==2 || $this->permissionValue==3 || $this->permissionValue==6 || $this->permissionValue==7){
			$this->form_validation->set_rules('name', 'Ethnicity', 'trim|min_length[3]|max_length[50]|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Gender Type', 'trim|numeric|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|numeric|required');
			$data = $this->input->post();
			if($this->form_validation->run()==true){
				$updateData = removeExtraspace($data);
				$id	= $updateData['id'];
				$type					= $updateData['type'];
				$genderArray			= array('1'=>'Female','2'=>'Male','3'=>'Other');
				$updateData['updated_by']	= $this->user_id;
				$updateData['name']			= ucfirst($updateData['name']);
				$checkUniqueHair	= $this->Ethnicity_model->checkUniqueEthnicity($updateData['name'],$type,$id);
				if($checkUniqueHair){
					setMessage('Ethnicity already exists for '.$genderArray[$type].'' ,'warning');
					redirect('admin/bodydetails/ethnicities');
				}else{
					$updateState	= $this->Ethnicity_model->updateEthnicity($updateData,$id);
					if($updateState){
						setMessage('Ethnicity successfully updated.','success');
						redirect('admin/bodydetails/ethnicities');
					}
				}
			}else{
				setMessage(' '.validation_errors(),'warning');
				redirect('admin/bodydetails/ethinicities');
			}
		}else{
			setMessage(' You are not Authorized for this page !','danger');
			redirect('admin/dashboard');
		}
	}

}
