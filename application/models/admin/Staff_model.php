<?php
Class Staff_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: UpdateStaff()
	 * @Description		-: This function used for update staff details basis on id
	 * @Param			-: updateData(array), id (int)
	 * @Return			-: True/False
	 * @Created on		-: 25-08-2016
	 */
	public function updateStaff($updateData = array(), $id = 0){
		try{
				/****** Updating  ******/
			if(!empty($id) && is_numeric($id)){
				$check	= $this->db
								->join('users_groups','users_groups.user_id=users.id AND users.deleted_at is null')
								->where('users.email',$updateData['email'])->where('users.id !=',$id)->get('users')->result();
				if(empty($check)){
					$update = $this->db->where('id',$id)->update('users',$updateData);
					if($update){
						setMessage('Staff successfully updated ','success');
						redirect('admin/users/staffs');
					}
				}else{
					setMessage('Staff/Email already exists ','warning');
				}
			}
		}catch(Exception $ex){
			log_message(' error', ' Unable to update staff details '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Method		-: updateStaffBodydetails()
	 * @Description	-: This function used for update user body details
	 * @Param		-: data (array),staffId(int)
	 * @Created on	-: 25-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	
	public function updateStaffBodydetails($data=array(),$staffId=0){
		try{
			if(!empty($staffId) && is_numeric($staffId)){
				$update	= $this->db->where('user_id',$staffId)->update('babes_user_details',$data);
				if($update){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message('error',' Unable to update staff body details '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Method		-: updateStaffAddress()
	 * @Description	-: This function used for update user address
	 * @Param		-: data (array),staffId(int)
	 * @Created on	-: 25-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function updateStaffAddress($data=array(),$staffId=0){
		try{
			if(!empty($staffId) && is_numeric($staffId)){
				$check	= $this->db->where('user_id',$staffId)->get('babes_users_address')->row();
				if($check){
					$update	= $this->db->where('user_id',$staffId)->update('babes_users_address',$data);
					if($update){
						return true;
					}else{
						return false;
					}
				}else{
					$insert	= $this->db->insert('babes_users_address',$data);
					if($insert){
						return true;
					}else{
						return false;
					}
				}
			}
		}catch(Exception $ex){
			log_message('error ',' Unable to update staff address '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function	-: updateStaffServiceCities()
	 * @Description	-: This function used for update staff service cities basis on staff id
	 * @Param		-: staffId(int),mainCity(int),otherCities(array())
	 * @Return		-: true/false
	 * @Created on	-: 30-08-2016
	 */
	
	public function updateStaffServiceCities($staffId=0,$mainCity=0,$otherCities=array()){
		try{
			if(!empty($staffId) && is_numeric($staffId)){
				$delete	= $this->db->where('user_id',$staffId)->delete('babes_user_city'); 
				if(!empty($mainCity) && is_numeric($mainCity)){
					/** Main Service City Insert **/
					$data	= array('city_id'=>$mainCity,'user_id'=>$staffId,'main_city'=>'1');
					$insert	= $this->db->insert('babes_user_city',$data);
					if($insert){
					/** Other Service Cities Insert **/
						if(!empty($otherCities) && is_array($otherCities)){
							foreach($otherCities as $otherCity){
								$OtherCityData	= array('city_id'=>$otherCity,'user_id'=>$staffId,'main_city'=>'0');
								$otherInsert	= $this->db->insert('babes_user_city',$OtherCityData);
							}
						}
						return true;
					}
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to update staff service city (admin/staff_model) '.$ex->getMessage());
		}
	}
	
	
	
	
	/**
	 * @Method		-: updateStaffNotification()
	 * @Description	-: This function used for update user notification
	 * @Param		-: data (array),staffId(int)
	 * @Created on	-: 25-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function updateStaffNotification($data=array(),$staffId=0){
		try{
			if(!empty($staffId) && is_numeric($staffId)){
					$update	= $this->db->where('id',$staffId)->update('users',$data);
					if($update){
						return true;
					}else{
						return false;
					}
			}
		}catch(Exception $ex){
			log_message('error ',' Error on updateing staff notification '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Method		-: updateStaffServices()
	 * @Description	-: This function used for update user services
	 * @Param		-: data (array),staffId(int)
	 * @Created on	-: 25-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function updateStaffServices($data=array(),$staffId=0){
		try{
			if(!empty($staffId) && is_numeric($staffId)){
				$delete = $this->db->where('user_id',$staffId)->delete('babes_users_services');
				$update	= $this->db->where('id',$staffId)->insert_batch('babes_users_services',$data);
				if($update){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message('error ',' Error on updateing staff services '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function 		-: getClientsRecords() 
	 * @Description		-: This function used for get and return clients list using filter or without filter
	 * @Param			-: searchData (array), start (int)
	 * @Return			-: array()
	 * @Created on		-: 27-07-2016
	 */
	 
	public function getStaffRecords($searchData = array(), $start=NULL){
		try{
			$staffsCount = $this->db;
				if($start){
					$staffsCount->select('users.id,users.username,users.email,users.active,users.phone,users.active,
					groups.name as group,users.first_name as clientName,users.image,BC.name as city,BUD.gender');
				}
				$staffsCount->join('users_groups','users_groups.user_id=users.id  AND users.deleted_at is null')
				->join('groups','groups.id=users_groups.group_id')
				->join('babes_user_details as BUD','BUD.user_id=users.id','left')
				->join('babes_user_city as BUC','BUC.user_id=users.id')
				->join('babes_city as BC','BC.id=BUC.city_id')
				->where_in('groups.id',array(2));
				if($searchData['userName']){
					$staffsCount->like('users.first_name',$searchData['userName']);
				}
				if($searchData['userName']){
					$staffsCount->like('users.first_name',$searchData['userName']);
				}
				if($searchData['userEmail']){
					$staffsCount->like('users.email',$searchData['userEmail']);
				}
				if($searchData['userContact']){
					$staffsCount->like('users.phone',$searchData['userContact']);
				}
				if(isset($searchData['userGender'])){
					$staffsCount->where('BUD.gender',$searchData['userGender']);
				}
				if(isset($searchData['userLocation'])){
					$staffsCount->where('BUC.city_id',$searchData['userLocation']);
				}
				if($searchData['userStatus']==2){
					$staffsCount->where('users.active',0);
				}
				if($searchData['userStatus']==1){
					$staffsCount->where('users.active',1);
				}
				if(!empty($start)){
					$start = ($start=='A') ? 0 : $start;
					$staffs = $staffsCount->limit($this->limit,$start)->group_by('users.id')->get('users')->result();
				}else{
					$staffs = $staffsCount->group_by('users.id')->get('users')->num_rows();
				}
				if($staffs){
					return $staffs;
				}else{
					return false;
				}
		}catch(Exception	$ex){
			log_message('error', 'Unable to get staff list '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: getUserAddress()
	 * @Description	-: This function used for get and return user address
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 */
	
	public function getUserAddress($userId=0){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$address = $this->db->select('BC.name as country,BCI.name as city, BS.name as state,BUA.*')
							->join('babes_country as BC','BC.id=BUA.country_id')
							->join('babes_state as BS','BS.id=BUA.state_id')
							->join('babes_city as BCI','BCI.id=BUA.city_id')
							->where('BUA.user_id',$userId)->get('babes_users_address as BUA')->row();
				if($address){
					return $address;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user address'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getStaffBodyDetails()
	 * @Description	-: This function used for get and return user body details basis on user id 
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getStaffBodyDetails($userId=0){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$details = $this->db
						->join('babes_user_details as BUD','BUD.user_id=users.id')
						->select('BUD.*')
						->where('BUD.user_id',$userId)
						->get('users')->row();
				if($details){
					return $details;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user body details'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getStaffServices()
	 * @Description	-: This function used for get and return user services basis on user id 
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getStaffServices($userId=0){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$services = $this->db
						->join('babes_users_services as BUS','BUS.user_id=users.id')
						->select('BUS.*')
						->where('BUS.user_id',$userId)
						->get('users')->result();
				$staffServices = array();
				if($services){
					foreach($services as $service){
						$staffServices[] = $service->service_id;
					}
					return $staffServices;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user body details'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getMasterServices()
	 * @Description	-: This function used for get all master services
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getMasterServices(){
		try{
			$services = $this->db->where('status','1')->get('babes_services_master')->result();
			if($services){
				return $services;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get master services'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getHairColors()
	 * @Description	-: This function used for get all hair colors basis on staff gender 
	 * @Param		-: gender(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getHairColors($gender=0){
		try{
			if(!empty($gender) && is_numeric($gender)){
				$hairColors = $this->db
					->select('BHM.name,BHM.id')
					->where('status','1')
					->where('type',$gender)
					->get('babes_hair_master as BHM')->result();
				if($hairColors){
					return $hairColors;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get staff hair colors basis of gender'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getEyeColors()
	 * @Description	-: This function used for get all eye colors basis on staff gender 
	 * @Param		-: gender(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getEyeColors($gender=0){
		try{
			if(!empty($gender) && is_numeric($gender)){
				$eyeColors = $this->db
					->select('BECM.name,BECM.id')
					->where('status','1')
					->where('type',$gender)
					->get('babes_eye_color_master as BECM')->result();
				if($eyeColors){
					return $eyeColors;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get staff eye colos basis of gender'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getBodyTypes()
	 * @Description	-: This function used for get all body types basis on staff gender 
	 * @Param		-: gender(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getBodyTypes($gender=0){
		try{
			if(!empty($gender) && is_numeric($gender)){
				$bodyTypes = $this->db
					->select('BBTM.name,BBTM.id')
					->where('status','1')
					->where('type',$gender)
					->get('babes_body_type_master as BBTM')->result();
				if($bodyTypes){
					return $bodyTypes;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get body types basis of gender'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getBustTypes()
	 * @Description	-: This function used for get all bust types basis on staff gender 
	 * @Param		-: gender(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getBustTypes($gender=0){
		try{
			if(!empty($gender) && is_numeric($gender)){
				$bustTypes = $this->db
					->select('BBM.name,BBM.id')
					->where('status','1')
					->where('type',$gender)
					->get('babes_bust_master as BBM')->result();
				if($bustTypes){
					return $bustTypes;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get bust types basis of gender'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getEthnicities()
	 * @Description	-: This function used for get all Ethnicities basis on staff gender 
	 * @Param		-: gender(int)
	 * @Return		-: array()
	 * @Created on	-: 25-08-2016
	 * 
	 */
	public function getEthnicities($gender=0){
		try{
			if(!empty($gender) && is_numeric($gender)){
				$ethnicities = $this->db
					->select('BEM.name,BEM.id')
					->where('status','1')
					->where('type',$gender)
					->get('babes_ethnicity_master as BEM')->result();
				if($ethnicities){
					return $ethnicities;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get ethnicities basis of gender'.$ex->getMessage());
		}
	}
	
}

?>
