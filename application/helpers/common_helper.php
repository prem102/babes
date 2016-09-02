<?php

/**
 * @Description -: This function used to remove extraspaces from givven string 
 * @Param		-: String ($str)
 * @Created on	-: 28-07-2016
 * @Return		-: String
 */ 
	function removeExtraspace($data=array()) {
		$returnData = array();
		if(!empty($data)){
			foreach($data as $k=>$v){
				if(is_array($v)){
					removeExtraspace($v);
				}else{
					$trimstr = trim($v);
					$val = preg_replace('/\s+/', ' ', $trimstr);
					$returnData[$k] = $val;
				}
			}
		}
		return $returnData;
	}
	


/**
 * @Description -: This function used to print a variable with more details
 * @Param		-: String (Array/String/Int)
 * @Created on	-: 16-06-2016
 */ 

	function dump($array = array()){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

    /**
     * Sets a status message (for displaying small success/error messages).
     * This is used in place of the session->flashdata functions since you
     * don't always want to have to refresh the page to show the message.
     *
     * @param string $message The message to save.
     * @param string $type The string to be included as the CSS class of the containing div.
     */
    function setMessage($message = '', $type = 'info'){
		$CI = & get_instance();
        if (! empty($message)) {
			//dump($CI->session);
            if (isset($CI->session)) {
                $CI->session->set_flashdata('message', $type . '::' . $message);
            }
            $flashdata= array(
                'message_type' => $type,
                'message' => $message
            );
            $CI->session->set_userdata($flashdata);
        }
    }
    

    /**
     * Sets a data variable to be sent to the view during the render() method.
     *
     * @param string $name
     * @param mixed $value
     */
    function setVar($name, $value = null){
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->vars[$k] = $v;
            }
        } else {
            $this->vars[$name] = $value;
        }
    }
    
  /**
   * this function use for short the string for show short string
   * @param contant String
   * @param Char int
   *  $return String
   *  date 05-08-2016
   * 
   * */  
    
    function short_content($content,$char){
		$string = trim(strip_tags($content)); 
		$c = strlen($content);
		$odlstring = $string; 
        $stringCut = substr($string, 0, $char); 
        if($c<$char){
			return $odlstring;
		}
		$string = substr($stringCut, 0, strrpos($stringCut, ' '));
		if(empty($string)){
			return $odlstring;
		}else{
			return $string." ...";
		}
		
    	
}

	/**
	 * this function use for redirect page using javascript 
	 * @param Url
	 * 
	 * */

	function redirect_url($url)	
		{
			echo'<script>';
			echo 'window.location.href="'.$url.'"';	
			echo'</script>';
		}


/**
	 * this function use for get the diffrence between two dates
	 * @param date1 date 
	 * @param date2 date 
	 * @return days int 
	 * 
	 * */
	function getDays($date1=0, $date2=0)
	{
		
		$date1=date_create($date1);
		$date2=date_create($date2);
		$diff=date_diff($date1,$date2);
		$date=$diff->format("%a");
		if($date<1)
		{
			$date=1;
		}		
		return $date;
		
	}
	
	/**
	 * this function use for genrate auto matic login url
	 * @param user_id
	 * @return refferance url
	 * */
	 function genrateRefUrl($user_id=0)
	{	$login_url='';
		$CI =& get_instance();	
		if(!empty($user_id))
		{	$random = md5(uniqid($user_id, true));
			$CI->db->insert('babes_login_token', array("user_id"=>$user_id,"ref"=>$random));
		 $login_url =$CI->config->item("base_url")."/login/autologn/".base64_encode($user_id)."/".$random;	
		}
		return $login_url;
	}





	/**
	 * @Function		-: getUserPermission()
	 * @Description		-: This function used for get and return user permission basis on user id
	 * @Param			-: userId(int)
	 * @Created on		-: 01-08-2016
	 * @Return			-: array()
	 */
	function getUserPermission($userId = 0){
		try{
			$CI = & get_instance();
			$group=$CI->User_auth_model->getUsersGroups();
			if($group->id=='1'){
				$permissions = array(1=>7,2=>7,3=>7,4=>7,5=>7,6=>7,7=>7);
				return $permissions;
			}
			if(empty($userId)){
				return array();
			}
			$permission = $CI->db->join('users_groups','users_groups.group_id=babes_group_permission.group_id','left')
							->select('babes_group_permission.*')
							->where('users_groups.user_id',$userId)
							->get('babes_group_permission')->result();
				if($permission){
					$userPermissions = array_column($permission,'permission','permission_id');
					return $userPermissions;
				}else{
					return array();
				}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user permissions '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserServices()
	 * @Description	-: This function used for get and return user services basis on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 16-08-2016
	 */
	 
	function getUserServices($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$services	= $CI->db->where('babes_users_services.deleted_at',NULL)
						->join('babes_services_master as BSM','BSM.id=babes_users_services.service_id','left')
						->where('babes_users_services.user_id',$userId)
						->select('BSM.name as service,(case when (babes_users_services.charges IS NULL) 
				 THEN
				     BSM.price
				 ELSE
				     babes_users_services.charges
				 END) as price, BSM.service_type')
						->order_by('BSM.name','ASC')->get('babes_users_services')->result();
				if($services){
					return $services;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user services '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUseraddress()
	 * @Description	-: This function used for get and return user address basis on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 16-08-2016
	 */
	 
	function getUseraddress($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$addres	= $CI->db
						->join('babes_country as bc','bc.id=babes_users_address.country_id')
						->join('babes_state','babes_state.id=babes_users_address.state_id')
						->join('babes_city','babes_city.id=babes_users_address.city_id')
						->where('babes_users_address.user_id',$userId)
						->select('bc.name as country,babes_state.name as state,babes_city.name as city,babes_users_address.*')
						->get('babes_users_address')->row();
				if($addres){
					return $addres;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user address '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserDetails()
	 * @Description	-: This function used for get and return user details basis on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 16-08-2016
	 */
	 
	function getUserDetails($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$bodyDetails	= $CI->db
						->join('babes_eye_color_master as becm','becm.id=babes_user_details.eye_color','left')
						->join('babes_ethnicity_master as bem','bem.id=babes_user_details.ethnicity','left')
						->join('babes_hair_master as bhm','bhm.id=babes_user_details.hair_color','left')
						->join('babes_body_type_master as bbtm','bbtm.id=babes_user_details.body_type','left')
						->join('babes_bust_master as bbm','bbm.id=babes_user_details.bust_size','left')
						->where('babes_user_details.user_id',$userId)
						->select('becm.name as eyeColor,bem.name as ethnicity,bhm.name as hairColor,bbtm.name as bodyType,
						bbm.name as bustSize,babes_user_details.age,babes_user_details.dress_size,babes_user_details.gender,babes_user_details.height')
						->get('babes_user_details')->row();
				if($bodyDetails){
					return $bodyDetails;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user details '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserMedias()
	 * @Description	-: This function used for get and return user medias on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 16-08-2016
	 */
	 
	function getUserMedias($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$bodyDetails	= $CI->db
						->where('user_id',$userId)
						->join('users','users.id=babes_user_media.user_id')
						->select('users.image as profileImage,babes_user_media.images as images,babes_user_media.videos as videos')
						->get('babes_user_media')->row();
				if($bodyDetails){
					return $bodyDetails;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user media '.$ex->getMessage());
		}
	}
	/**
	 * @Function	-: getUserIdByUsername()
	 * @Description	-: This function used for get and return user details basis on username
	 * @Param		-: username(string)
	 * @Return		-: array()
	 * @Created on	-: 16-08-2016
	 */
	function getUserIdByUsername($username=null){
		try{
			$CI = & get_instance();
			if(!empty($username)){
				$details = $CI->db->where('username',$username)
						->select('users.email,users.phone,users.image,users.description,users.id, CONCAT(first_name," ",last_name) as userName',false)
						->get('users')->row();
				if($details){
					return $details;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user details by username '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserReviews()
	 * @Description	-: This function used for get and return user review basis on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created on	-: 17-08-2016
	 */
	function getUserReviews($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$reviews = $CI->db->where('babes_client_reviews.staff_id',$userId)
						->where('babes_client_reviews.deleted_at',null)
						->where('babes_client_reviews.approval','1')
						->join('users as staff','staff.id=babes_client_reviews.staff_id')
						->join('users as client','client.id=babes_client_reviews.client_id')
						->select('CONCAT(client.first_name," ",client.last_name) as clientName,babes_client_reviews.comments,
						babes_client_reviews.rating',false)
						->get('babes_client_reviews')->result();
				if($reviews){
					return $reviews;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user review by user id '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: logginUserId()
	 * @Description		-: This function used for get and return details of loggedin user id
	 * @Param			-: No Parameter
	 * @Created on		-: 17-08-2016
	 * @Return			-: int
	 */
	function logginUserId(){
		try{
			$CI = & get_instance();
			$userName	= $CI->session->userdata('fronentLoginUserName');
			$email		= $CI->session->userdata('fronentLoginEmail');
			if(!empty($userName) && !empty($email)){
				$user = $CI->db->where('users.username',$userName)
					->where('users.email',$email)
					->join('users_groups','users_groups.user_id=users.id')->get('users')->row();
				if($user){
					return $user->id;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get loggedIn user details '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: logginUserBasicInfo()
	 * @Description		-: This function used for get and return basic details of loggedin user
	 * @Param			-: No Parameter
	 * @Created on		-: 18-08-2016
	 * @Return			-: array
	 */
	function logginUserBasicInfo(){
		try{
			$CI = & get_instance();
			$userName	= $CI->session->userdata('fronentLoginUserName');
			$email		= $CI->session->userdata('fronentLoginEmail');
			if(!empty($userName) && !empty($email)){
				$user = $CI->db->where('users.username',$userName)
					->where('users.email',$email)
					->select('users.id,CONCAT(users.first_name," ",users.last_name) as userName,users.image,users.email ,users.username as name,users.display_name,users_groups.group_id',false)
					->join('users_groups','users_groups.user_id=users.id')
					->get('users')->row();
				if($user){
					return $user;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error','Unable to get loggedIn user details '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getIpAddress()
	 * @Description	-: This function used for get client or system ip address
	 * @Param		-: No Parameter
	 * @Return		-: IP Address (string) 
	 * @Created on	-: 17-08-2016
	 */
	function getIpAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))  //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip = $_SERVER['REMOTE_ADDR'];
		return $ip;
	}
	
	/**
	 * @Function	-: getRecentlyViewsStaffs()
	 * @Description	-: This function used for return user(staff) list basis on user ids
	 * @Param		-: ids(array())
	 * @Return		-: array()
	 * @Created on	-: 17-08-2016
	 * 
	 */
	function getRecentlyViewsStaffs($ids=array()){
		try{
			$CI = & get_instance();
			if(!empty($ids)){
				$users = $CI->db->select('users.id as userId, users.username,users.email,CONCAT(users.first_name," ",
							users.last_name) as userName,users.image,BUD.*,BC.name as city',false)
					->where('users.active',1)
					->where('users.deleted_at',NULL)
					->join('babes_user_details as BUD','BUD.user_id=users.id')
					->join('babes_users_address as BUA','BUA.user_id=users.id')
					->join('babes_city as BC','BC.id=BUA.city_id')
					->join('users_groups as UG','UG.user_id=users.id AND UG.group_id=2')
					->where_in('users.id',$ids)->limit(4)->get('users')->result();
				if($users){
					return $users;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get users (staff) '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getRecentlyViewsStaffIds()
	 * @Description	-: This function used for get and return recently view staff ids
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 17-08-2016
	 * 
	 */
	function getRecentlyViewsStaffIds(){
		try{
			$CI = & get_instance();
			$ipAddress = getIpAddress();
			$users = $CI->db->where('ip_address',$ipAddress)
					->select('staff_id')->order_by('date_time','DESC')
					->get('babes_recently_views')->result();
			if($users){
				$staffIds = array_column($users,'staff_id');
				return $staffIds;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error','Unable to get recently staff ids '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserGroup()
	 * @Description	-: This function used for get and return user group id
	 * @Param		-: userId(int)
	 * @Return		-: int
	 * @Created on	-: 17-08-2016
	 * 
	 */
	function getUserGroup($userId){
		try{
			$CI = & get_instance();
			if(!empty($userId)){
				$result		= $CI->db->select('group_id')
							->where('user_id',$userId)->get('users_groups')->row();
				if($result){
					return $result->group_id;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get user group '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: generatePassword()
	 * @Description	-: This function used for get and return password basis on password and group
	 * @Param		-: password(string),groupId(int)
	 * @Return		-: password (string)
	 * @Created on	-: 18-08-2016
	 * 
	 */
	function generatePassword($password=null,$groupId=0){
		if(!empty($password) && !empty($groupId)){
			if($groupId==2){
				$password	= $password.'staff';
			}
			if($groupId==3){
				$password	= $password.'client';
			}
			$password = md5($password);
			return $password;
		}
	}
	
	
	/**
	 * @Function	-: getStaticPageContent()
	 * @Description	-: This function used for get and return get Static Page Content by page url
	 * @Param		-: page url(string)
	 * @Return		-: string
	 * @Created on	-: 22-08-2016
	 * 
	 */
	function getStaticPageContent($url){
		try{
			$CI = & get_instance();
			if(!empty($url)){
				$result		= $CI->db->where('page_url',$url)->where('status','1')->get('babes_page_content')->result();
				if($result){
					$dat='';$results='';
					foreach($result as $val)
					{
					if($val->page_content){
					$dat=$val->page_content;
					}
				$results[$val->variables]=$dat;
				}
				return $results;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' Unable to get user group '.$ex->getMessage());
		}
	}

	/**
	 * @Function	-: getStates()
	 * @Description	-: This function used for get and return state lists
	 * @Param		-: countryId(int)
	 * @Return		-: array()
	 * @Created on	-: 24-08-2016
	 */
	 
	function getStates($countryId=0){
		try{
			$CI = & get_instance();
				$result = $CI->db;
				if(!empty($countryId) && is_numeric($countryId)){
					$result->where('country',$countryId);
				}
				$states = $result->where('status','1')
				->order_by('babes_state.name','ASC')
				->get('babes_state')->result();
				if($states){
					return $states;
				}else{
					return false;
				}
		}catch(Exception	$ex){
			log_message('error',' Unable to get state list'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getCities()
	 * @Description	-: This function used for get and return cities list
	 * @Param		-: stateId(int)
	 * @Return		-: array()
	 * @Created on	-: 24-08-2016
	 */
	 
	function getCities($stateId=0){
		try{
			$CI = & get_instance();
				$result = $CI->db->select('BS.name as state,babes_city.*');
				if(!empty($stateId) && is_numeric($stateId)){
					$result->where('BS.id',$stateId);
				}
				$cities = $result->join('babes_state as BS','BS.id=babes_city.state')
								->where('babes_city.status','1')
								->order_by('babes_city.name','ASC')
								->get('babes_city')->result();
				if($cities){
					return $cities;
				}else{
					return false;
				}
		}catch(Exception	$ex){
			log_message('error',' Unable to get cities list'.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getUserGender()
	 * @Description	-: This function used for get and return user(staff) gender Female/Male/Other
	 * @Param		-: userId(int)
	 * @Return		-: string
	 * @Created on	-: 25-06-2016
	 * 
	 */
	function getUserGender($userId=0){
		try{
			$CI = & get_instance();
			if(!empty($userId) && is_numeric($userId)){
				$result	= $CI->db->select('gender')
					->where('user_id',$userId)
					->get('babes_user_details')->row();
				if($result){
					return $result->gender;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get user gender'.$ex->getMessage());
		}
	}
	/**
	 * @Function	-: getStaffServiceCities()
	 * @Description	-: This function used for get staff service cities basis on staff id
	 * @Param		-: StaffId(int)
	 * @Return		-: array()
	 * @Created on	-: 30-08-2016
	 * 
	 */
	function getStaffServiceCities($staffId=0){
		try{
			$CI = & get_instance();
			if(!empty($staffId) && is_numeric($staffId)){
				$result	= $CI->db->select('CONCAT(BC.name," ",BS.name) as city, BUC.city_id as cityId,BUC.main_city as cityType',false)
					->where('user_id',$staffId)
					->join('babes_city as BC','BC.id=BUC.city_id')
					->join('babes_state as BS','BS.id=BC.state')
					->get('babes_user_city as BUC')->result();
				if($result){
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('',' Unable to get Staff service cities (Common Helper) '.$ex->getMessage());
		}
	}
	
