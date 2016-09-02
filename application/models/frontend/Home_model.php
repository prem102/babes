<?php
Class Home_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: getHairColors()
	 * @Description	-: This function used for get and return hair colors
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 */
	public function getHairColors($type){
		try{
			$hairColors = $this->db->where('status','1')->where('type',$type)->order_by('name','ASC')->get('babes_hair_master')->result();
			if($hairColors){
				return $hairColors;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get hair colors '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getEyeColors()
	 * @Description	-: This function used for get and return eye colors
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 */
	public function getEyeColors($type){
		try{
			$eyeColors = $this->db->where('status','1')->where('type',$type)->order_by('name','ASC')
			->get('babes_eye_color_master')->result();
			if($eyeColors){
				return $eyeColors;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get eye colors '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getBodyTypes()
	 * @Description	-: This function used for get and return body Types
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 */
	public function getBodyTypes($type){
		try{
			$bodyTypes = $this->db->where('status','1')->where('type',$type)->order_by('name','ASC')
			->get('babes_body_type_master')->result();
			if($bodyTypes){
				return $bodyTypes;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get body types '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getBustTypes()
	 * @Description	-: This function used for get and return bust types
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 */
	public function getBustTypes($type){
		try{
			$bustTypes = $this->db->where('status','1')->where('type',$type)->order_by('name','ASC')
			->get('babes_bust_master')->result();
			if($bustTypes){
				return $bustTypes;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get bust types '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getEthnicities()
	 * @Description	-: This function used for get and return ethenicity
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 */
	public function getEthnicities($type){
		try{
			$ethenicity = $this->db->where('status','1')->where('type',$type)->order_by('name','ASC')
			->get('babes_ethnicity_master')->result();
			if($ethenicity){
				return $ethenicity;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get ethenicity '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: getServices()
	 * @Description	-: This function used for get and return services
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-201
	 * 
	 */
	 
	public function getServices($type=0){
		try{
			$services = $this->db->where('deleted_at',NULL);
			$services->where('status','1');
			if(!empty($type)){
			$services->where('type',$type);
			}
			$services=$services->get('babes_services_master')->result();
			
			if($services){
				return $services;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get services '.$ex->getMessage());
		}
	}
	/**
	 * @Function	-: getLocation()
	 * @Description	-: This function used for get and return location 
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 * 
	 */
	public function getLocation(){
		try{
			$location = $this->db->where('status','1')->get('babes_city')->result();
			if($location){
				return $location;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get location '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: allStaff()
	 * @Description	-: This function used for get and return staff list
	 * @Param		-: featured(int)
	 * @Return 		-: array()
	 * @created On	-: 11-08-2016
	 */
	public function allStaff($featured=null){
		try{
			$records = $this->db->select('users.id as userId, users.username,users.email,users.first_name,
							users.last_name,users.image,BUD.*,group_concat(DISTINCT(BC.name)) as city')
					->where('users.active',1)
					->where('users.deleted_at',NULL)
					->join('babes_user_details as BUD','BUD.user_id=users.id')
					->join('babes_user_city as BUA','BUA.user_id=users.id')
					->join('babes_city as BC','BC.id=BUA.city_id')
					->join('users_groups as UG','UG.user_id=users.id AND UG.group_id=2');
					if($featured){
						$records->where('users.featured','1');
					}
					$this->db->group_by('users.id');
					$users = $records->get('users')->result();
			if($users){
				return $users;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get users (staff) '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: searchStaff()
	 * @Description	-: This function used for get and return staff list
	 * @Param		-: service(int),gender(string),location(int),hairColors(array),eyeColors(array),bodyTypes(array),bustTypes(array),ethnicities(array)
	 * @Return 		-: array()
	 * @created On	-: 12-08-2016
	 */
	public function searchStaff($service=0,$gender=null,$location=null,$hairColors=array(),$eyeColors=array(),
	$bodyTypes=array(),$bustTypes=array(),$ethnicities=array(),$price=null,$age=null,$height=null){
		try{
			if(!empty($price)){
				$rangePrice	= explode(';',$price);
				$minPrice	= $rangePrice[0];$maxPrice	= $rangePrice[1];
			}
			if(!empty($age)){
				$rangeAge	= explode(';',$age);
				$minAge		= $rangeAge[0];$maxAge	= $rangeAge[1];
			}
			if(!empty($height)){
				$rangeHeight= explode(';',$height);
				$minHeight	= $rangeHeight[0];$maxHeight	= $rangeHeight[1];
			}
			$records = $this->db->select('users.id as userId, users.username,users.email,users.first_name,
							users.last_name,users.image,BUD.*,group_concat(DISTINCT(BC.name)) as city,BSM.id as serviceId')
					->where('users.active',1)
					->where('BUS.deleted_at',NULL)
					->where('users.deleted_at',NULL)
					->join('babes_user_details as BUD','BUD.user_id=users.id')
					->join('babes_users_services as BUS','BUS.user_id=users.id')
					->join('babes_services_master as BSM','BSM.id=BUS.service_id')
					->join('babes_user_city as BUA','BUA.user_id=users.id')
					->join('babes_city as BC','BC.id=BUA.city_id')
					->join('users_groups as UG','UG.user_id=users.id AND UG.group_id=2');
					$this->db->group_by('users.id');
					if(!empty($service) && is_numeric($service)){
						$records->where('BUS.service_id',$service);
					}
					if(!empty($gender)){
						$records->where('BUD.gender',$gender);
					}
					if(!empty($location) && is_numeric($location)){
						$records->where('BUA.city_id',$location);
					}
					if(!empty($hairColors) && is_array($hairColors)){
						$records->where_in('BUD.hair_color',$hairColors);
					}
					if(!empty($eyeColors) && is_array($eyeColors)){
						$records->where_in('BUD.eye_color',$eyeColors);
					}
					if(!empty($bodyTypes) && is_array($bodyTypes)){
						$records->where_in('BUD.body_type',$bodyTypes);
					}
					if(!empty($bustTypes) && is_array($bustTypes)){
						$records->where_in('BUD.bust_size',$bustTypes);
					}
					if(!empty($ethnicities) && is_array($ethnicities)){
						$records->where_in('BUD.ethnicity',$ethnicities);
					}
					if(!empty($minPrice) && !empty($maxPrice)){
						$records->where('(BSM.price >= '.$minPrice.' OR  BUS.charges >= '.$minPrice.' ) AND (BSM.price <= '.$maxPrice.' OR  BUS.charges <= '.$maxPrice.' ) ');
					}
					if(!empty($maxPrice)){
						//$records->where('BSM.price <= '.$maxPrice.' OR  BUS.charges <= '.$maxPrice.' ');
					}
					if(!empty($minAge)){
						$records->where('BUD.age >= ',$minAge);
					}
					if(!empty($maxAge)){
						$records->where('BUD.age <= ',$maxAge);
					}
					if(!empty($minHeight)){
						$records->where('BUD.height >= ',$minHeight);
					}
					if(!empty($maxHeight)){
						$records->where('BUD.height <= ',$maxHeight);
					}
					$users = $records->group_by('users.id')->get('users')->result();
				//print $this->db->last_query();
			if($users){
				return $users;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get searches (staff) '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: activeAccount()
	 * @Description		-: This function used for active account
	 * @Param			-: email(string),token (string)
	 * @Return			-: true/false
	 * @Created on		-: 09-08-2016 
	 */
	public function activeAccount($email=null,$token=null){
		try{
			if(!empty($email) && !empty($token)){
				$checkActivation = $this->db
				->where('email',$email)->where('activation_code',$token)->get('users')->result();
				if($checkActivation){
					$activeAccount = $this->db->where('email',$email)
							->update('users',array('active'=>1,'activation_code'=>NULL));
					if($activeAccount){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to active account '.$ex->getMessage());
		}
	}
	/**
	 * @Function		-: checkUniqueUsername()
	 * @Description		-: This function used for check unique user name
	 * @Param			-: userName (string)
	 * @Retutn			-: true / false
	 * @Created on		-: 10-08-2016
	 * 
	 */
	public function checkUniqueUsername($userName=null,$id=0){
		try{
			if(!empty($userName)){
				$records = $this->db->where('username',$userName)->where('deleted_at',NULL);
				if(!empty($id) && is_numeric($id)){
					$records->where('id !=',$id);
				}
				$users = $records->get('users')->result();
				if($users){
					return false;
				}else{
					return true;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to check unique user name '.$ex->getMessage());
		}
	}
	/**
	 * @Function		-: checkUniqueEmail()
	 * @Description		-: This function used for check unique email
	 * @Param			-: userName (string)
	 * @Retutn			-: true / false
	 * @Created on		-: 10-08-2016
	 * 
	 */
	public function checkUniqueEmail($email=null,$id=0){
		try{
			if(!empty($email)){
				$records = $this->db->where('email',$email)
				->where('deleted_at',NULL);
				if(!empty($id) && is_numeric($id)){
					$records->where('id !=',$id);
				}
				$users = $records->get('users')->result();
				if($users){
					return false;
				}else{
					return true;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to check unique email '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: userRegisteration()
	 * @Description		-: This function used for user registration
	 * @Param			-: data(array),groupId(int)
	 * @Return			-: True/False
	 * @Created on		-: 10-08-2016
	 */
	public function userRegisteration($data=array(),$groupId=0){
		try{
			if(!empty($data) && !empty($groupId)){
				$userInsert = $this->Home_model->insert($data);
				if($userInsert){
					$addUserGroup = $this->addUserToGroup($userInsert,$groupId);
					if($addUserGroup){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message(' error', 'Unable to user registration '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: addUserToGroup()
	 * @Description		-: This function used for add an user to a group basis on userId and groupId
	 * @Param			-: userId(int),groupId(int)
	 * @Return			-: True/False
	 * @Created on		-: 10-08-2016
	 */
	public function addUserToGroup($userId=0,$groupId=0){
		try{
			if(!empty($userId) && !empty($groupId)){
				$userGroup = $this->db->where('user_id',$userId)->get('users_groups')->result();
				if($userGroup){
					$success = $this->db->where('user_id',$userId)->update('users_groups',array('group_id'=>$groupId));
				}else{
					$success = $this->db->insert('users_groups',array('user_id'=>$userId,'group_id'=>$groupId));
				}
				if($success){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception $ex){
			log_message(' error', 'Unable to add an user to a group '.$ex->getMessage());
		}
	}
	
	/**
	 * @Fuction		-: manageRecentlyStaffViews()
	 * @Description	-: This function used for manage staff recently view 
	 * @Param		-: data(array()),$staffId(int)
	 * @Return		-: True/False;
	 * @Created on	-: 17-08-2016
	 */
	public function manageRecentlyStaffViews($data=array()){
		try{
			if(!empty($data) && !empty($data['staff_id']) && is_numeric($data['staff_id'])){
				$result	= $this->db->where('staff_id',$data['staff_id'])
							->where('ip_address',$data['ip_address'])
							->get('babes_recently_views')->row();
				if($result){
					$update = $this->db->where('ip_address',$data['ip_address'])
					->where('staff_id',$data['staff_id'])->update('babes_recently_views',$data);
					if($update){
						return true;
					}
				}else{
					$insert = $this->db->insert('babes_recently_views',$data);
					if($insert){
						return true;
					}
				}
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to manage recently staff view '.$ex->getMessage());
		}
	} 
	
	/**
	 * @Function	-: getHomePageBanner()
	 * @Description	-: This function used for get and return featured girls details with featured image
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 20-08-2016
	 * 
	 */
	
	public function getHomePageBanner($featured=null){
		try{
			$records = $this->db->select('users.id as userId, users.username,users.email,users.first_name,
							users.last_name,users.image,umedia.featured_image, group_concat(DISTINCT(BC.name)) as city_name,BUD.age')
					->where('users.active',1)
					->where('users.deleted_at',null)
					->where('umedia.featured_image is NOT NULL', NULL, FALSE)					
					->join('users_groups as UG','UG.user_id=users.id AND UG.group_id=2')
					->join('babes_user_details as BUD','BUD.user_id=users.id')
					->join('babes_user_media as umedia','umedia.user_id=users.id ')
					->join('babes_user_city as BUA','BUA.user_id=users.id and BUA.main_city="1"')
					->join('babes_city as BC','BC.id=BUA.city_id');
					if($featured){
						$records->where('users.featured','1');
					}
					$this->db->order_by('users.id', 'RANDOM');
					$this->db->limit(10);
					$this->db->group_by('users.id');
					$users = $records->get('users')->result();
					
			if($users){
				return $users;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get users (staff) '.$ex->getMessage());
		}
	}
	
}

?>
