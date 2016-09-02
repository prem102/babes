<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('mail_helper');
        $this->load->helper('staff_helper'); 
        $this->load->helper('frontend_helper');
        $this->load->model('frontend/Home_model');
        $this->load->library('form_validation');
        $this->load->library('email');
    }
	
	/**
	 * @Function	-: index()
	 * @Description	-: This function used for display home of site
	 * @Param		-: No Parameter
	 * @Created on	-: 05-08-2016
	 * 
	 */
	function index(){
		$data['js']=array('jquery-ui','jquery.selectBoxIt','jquery.flexslider','jquery.tokenize'); 
		$data['meta']=array();
		$data['css']=array('flexslider','tab','common','home','jquery.tokenize');
		try{
			$data['services']= $this->Home_model->getServices();
			$data['locations']= $this->Home_model->getLocation();
			$data['featuredGirls']= $this->Home_model->allStaff('1');
			$data['banners']=$this->Home_model->getHomePageBanner('1');
			$data['resetHeaderClass']	= 'reset-header-class';
		}catch(Exception $ex){
			log_message('error','Unable to find front end home page details '.$ex->getMessage());
		}
		$this->load->view('frontend/home-index', $data);
	} 

	/**
	 * @Function		-: signUp()
	 * @Description		-: This function used for staff registration
	 * @Param			-: No Parameter
	 * @Return			-: Redirect/error
	 * Created on		-: 09-08-2016
	 */ 
	function signUp(){
		if(!empty($this->session->userdata('fronentLoginUserName'))){
			redirect('index');
			}
		$data['js']=array('jquery-ui');
		$data['meta']=array();
		$data['css']=array('common','signup');
		try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
				$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[20]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('con-password', 'Confirm Password', 'trim|min_length[8]|max_length[20]|matches[password]|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					$userGroup		= 2;
					$password		= $postData['password'];
					$password		= $password.'staff';
					$password		= md5($password);
					$email			= $postData['email'];
					$userName		= strtolower($postData['username']);
					$userStatus		= 0;
					$activationCode	= $userName.'-'.mt_rand();
					$ip_Address		= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
					$registrationData= array('username'=>$userName,
											'email'=>$email,
											'password'=>$password,
											'active'=>$userStatus,
											'activation_code'=>$activationCode,
											'ip_address'=> $ip_Address
											);
						$userNameCheck 	= $this->Home_model->checkUniqueUsername($userName);
						if($userNameCheck){
							$EmailCheck 	= $this->Home_model->checkUniqueEmail($email);
							if($EmailCheck){
								$insert = $this->Home_model->userRegisteration($registrationData,$userGroup);
								if($insert){
									$link = "<a href='".base_url('frontend/home/accountActivation?email='.$email.'&token='.$activationCode.'')."'>activate your account</a> ";
									$responce = sendActivationMail($email,$userName,$link,'account-activation');
									$url  = base_url();
									redirect($url);
								}
							}else{
								$data['error'] = 'Email id already exists !.';
							}
						}else{
							$data['error'] = 'Username already exists !';
						}

				}else{
					$data['error'] = validation_errors();
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to sign up staff registration '.$ex->getMessage());
		}
		$data['resetHeaderClass']	= 'reset-header-class';
		$this->load->view('frontend/signup', $data);
	}
	
	/**
	 * @Function		-: clientSignUp()
	 * @Description		-: This function used for client registration
	 * @Param			-: No Parameter
	 * @Return			-: Redirect/error
	 * Created on		-: 09-08-2016
	 */ 
	function clientSignUp(){
		if(!empty($this->session->userdata('fronentLoginUserName'))){
			redirect('index');
			}
		$data['js']=array('jquery-ui');
		$data['meta']=array();
		$data['css']=array('common','signup');
		try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if($postData){
				$this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('email', 'Email Id', 'trim|min_length[3]|valid_email|max_length[100]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|max_length[20]|required',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('con-password', 'Confirm Password', 'trim|min_length[8]|max_length[20]|matches[password]|required',array('required' => 'You must provide a %s.'));
				if($this->form_validation->run()==true){
					
					$userGroup		= 3;
					$password		= $postData['password'];
					$password		= $password.'client';
					$password		= md5($password);
					$email			= $postData['email'];
					$userName		= strtolower($postData['username']);
					$userStatus		= 0;
					$activationCode	= $userName.'-'.mt_rand();
					$ip_Address		= !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
					$registrationData= array('username'=>$userName,
											'email'=>$email,
											'password'=>$password,
											'active'=>$userStatus,
											'activation_code'=>$activationCode,
											'ip_address'=> $ip_Address
											);
						$userNameCheck 	= $this->Home_model->checkUniqueUsername($userName);
						if($userNameCheck){
							$EmailCheck 	= $this->Home_model->checkUniqueEmail($email);
							if($EmailCheck){
								$insert = $this->Home_model->userRegisteration($registrationData,$userGroup);
								if($insert){
									$link = "<a href='".base_url('frontend/home/accountActivation?email='.$email.'&token='.$activationCode.'')."'>activate your account</a> ";
									$responce = sendActivationMail($email,$userName,$link,'account-activation');
									$url  = base_url();
									redirect($url);
								}
							}else{
								$data['error'] = 'Email id already exists !.';
							}
						}else{
							$data['error'] = 'Username already exists !';
						}

				}else{
					$data['error'] = validation_errors();
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to sign up staff registration '.$ex->getMessage());
		}
		$data['resetHeaderClass']	= 'reset-header-class';
		$this->load->view('frontend/signup', $data);
	}
	
	
	/**
	 * @Function		-: checkUserName()
	 * @Description		-: This ajax function used for check unique user name 
	 * @Param			-: No Parameter
	 * @Return 			-: array()
	 * @Created on		-: 08-08-2016
	 * 
	 */
	
	public function checkUserName(){
		try{
			$userName = $this->input->post('username');
			$userName = trim($userName);
			$status	= "No";
			$msg	= "";
			$responseArray = array();
			if(!empty($userName)){
				$check = $this->Home_model->checkUniqueUsername($userName);
				if($check){
					$status	= "No";
					$msg	= "User name available !";
				}else{
					$status	= "Yes";
					$msg	= "User name already exists !";
				}
			}
			$responseArray['status'] = $status;$responseArray['msg'] = $msg;
			echo json_encode($responseArray);die;
		}catch(Exception $ex){
			log_message('error','unable to check unique user name '.$ex->getMessage());
		}
	}
    
	/**
	 * @Function		-: checkUserEmail()
	 * @Description		-: This ajax function used for check unique user email id 
	 * @Param			-: No Parameter
	 * @Return 			-: array()
	 * @Created on		-: 08-08-2016
	 * 
	 */
	
	public function checkUserEmail(){
		try{
			$userEmail = $this->input->post('useremail');
			$userEmail = trim($userEmail);
			$status	= "No";
			$msg	= "";
			$responseArray = array();
			if(!empty($userEmail)){
				$check = $this->Home_model->checkUniqueEmail($userEmail);
				if($check){
					$status	= "No";
					$msg	= "Email id available !";
				}else{
					$status	= "Yes";
					$msg	= "Email id already exists !";
				}
			}
			$responseArray['status'] = $status;$responseArray['msg'] = $msg;
			echo json_encode($responseArray);die;
		}catch(Exception $ex){
			log_message('error','unable to check unique user name '.$ex->getMessage());
		}
	}

	/**
	 * @Function	-: search()
	 * @Description	-: This function used for display searching staff list
	 * @Param		-: No Parameter
	 * @Created On	-: 08-08-2016
	 * 
	 */
	
	
	function search($type,$service=null,$start=0){
		$data['js']=array('jquery-ui','jquery.selectBoxIt','ion.rangeSlider'); 
		$data['meta']=array();
		$data['css']=array('common','stafflist','normalize','ion.rangeSlider','ion.rangeSlider.skinFlat');
		try{			$service=($service)?$service:'';
						$gender='';
						$location='';
						$searchtype='';
						$data['searchService']	= '';
						$data['searchGender']	= 'Female';
						$data['searchLocation']	= '';
			$postData = $this->input->post();
			
			if(!empty($postData)){
				$service	= !empty($postData['service_id']) ? $postData['service_id'] :'';
				$gender		= !empty($postData['gender']) ? $postData['gender'] :'';
				$location	= !empty($postData['location_id']) ? $postData['location_id'] :'';
				if(empty($gender)){
					$gender='Female';
					}
				
				if($gender=='Female'){
					$searchtype='1';
					}
					if($gender=='Male'){
					$searchtype='2';
					}
					 if($gender=='Other'){$searchtype='2';}		
				$data['searchService']	= $service;
				$data['searchGender']	= $gender;
				$data['searchLocation']	= $location;	
								
			}else{
				if(!empty($type)&&($type=='girls'||$type=='featured'))
				{
					$gender='Female';
					$data['searchGender']='Female';
					$searchtype='1';
				}
				if(!empty($type)&&$type=='guys')
				{
					$gender='Male';
					$data['searchGender']='Male';
					$searchtype='2';
				}
				 if(!empty($type)&&$type=='Other'){$gender='Male';$searchtype='2';$data['searchGender']='Male';}		
			}		
				/****** Getting Master tables data ******/
				$hairColors	= $this->Home_model->getHairColors($searchtype);
				$data['hairColors'] = $hairColors;
				$eyeColors	= $this->Home_model->getEyeColors($searchtype);
				$data['eyeColors'] = $eyeColors;
				$bodyTypes	= $this->Home_model->getBodyTypes($searchtype);
				$data['bodyTypes'] = $bodyTypes;
				$bustTypes	= $this->Home_model->getBustTypes($searchtype);
				$data['bustTypes'] = $bustTypes;
				$ethnicities= $this->Home_model->getEthnicities($searchtype);
				$data['ethnicities'] = $ethnicities;
				$locations		= $this->Home_model->getLocation();
				if($locations){
					$data['locations'] = $locations;
				}
				/****** Ending Master tables data ******/
				
				$services		= $this->Home_model->getServices($searchtype);
				if($services){
					$data['services'] = $services;
				}				
		if(!empty($type)&&$type=='featured'){
			$staffLists = $this->Home_model->allStaff('1');
		}else{
			$staffLists = $this->Home_model->searchStaff($service,$gender,$location);
		}
				if($staffLists){
					$data['searchedStaffs'] = $staffLists;
				}
			$data['resetHeaderClass']	= 'reset-header-class';
			$this->load->view('frontend/stafflist', $data);
		}catch(Exception $ex){
			log_message('error',' Unable to display search page properly '.$ex->getMessage());
		}
		
	}
	
	/**
	 * 
	 * @Function	-: ajaxStaffSearching()
	 * @Description	-: This function used for searching staff list
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created On	-: 12-08-2016
	 * 
	 */
	
	function ajaxStaffSearching(){
		try{
			$formData	= $this->input->post();
			$service	= !empty($formData['service_id']) ? $formData['service_id'] :'';
			$gender		= !empty($formData['gender']) ? $formData['gender'] :'';
			$location	= !empty($formData['location_id']) ? $formData['location_id'] :'';
			$hairColors	= !empty($formData['hair_colors']) ? $formData['hair_colors'] : array();
			$eyeColors	= !empty($formData['eye_colors']) ? $formData['eye_colors'] : array();
			$bodyTypes	= !empty($formData['body_types']) ? $formData['body_types'] : array();
			$bustTypes	= !empty($formData['bust_types']) ? $formData['bust_types'] : array();
			$ethnicities= !empty($formData['ethnicities']) ? $formData['ethnicities'] : array();
			/****** Slider Values Price,Age Height ******/
			$defaultPrice	= '10;500';$defaultAge	= '16;50';$defaultHeight	= '4;7';
			$price		= !empty($formData['price_range']) ? $formData['price_range'] : $defaultPrice;
			$age		= !empty($formData['age_range']) ? $formData['age_range'] : $defaultAge;
			$height		= !empty($formData['height_range']) ? $formData['height_range'] : $defaultHeight;
			$staffs		= $this->Home_model->searchStaff($service,$gender,$location,$hairColors,$eyeColors,$bodyTypes,$bustTypes,$ethnicities,$price,$age,$height);
			$responseArray = array();
			/****** Searching Staffs Lists ******/
			$html		= ""; 
			if(!empty($staffs)){
				foreach($staffs as $staff){
					$name = !empty($staff->first_name) ? $staff->first_name .' '.$staff->last_name : '' ;
					$userImg = !empty($staff->image) ? $staff->image : 'natalia.jpg' ;
					$city = !empty($staff->city) ? $staff->city : '' ;
					$serviceId = !empty($staff->serviceId) ? $staff->serviceId : 0 ;
					$minPrice = getStaffMinServicePrice($staff->userId,$serviceId);
					$html .= '<a href="'.base_url('staffs/'.$staff->username).'"><div class="view view-eighth"><img src="'.base_url('assets/front/users_images/'.$userImg).'">';
					$html .= '<div class="view-prof"><div class="name">'.$name.'</div>';
					$html .= '<div class="age">'.$city.'</div></div>';
					$html .= '<div class="mask"><span class="form-rate">from $'.$minPrice.'</span></div></div></a>';
				}
			}else{
				$html .= '<h3 class="no-result-found"> No Staff Found </h3>';
			}
			//****** Top Service name location and service description ******/
			$htmlTop	= "";
			$locationName ="";
				if(!empty($location) && is_numeric($location)){
					$locationDetails= getLocationDetils($location);
					$locationName	= !empty($locationDetails->name) ? ' in '.$locationDetails->name : '';
				}

				if(!empty($service) && is_numeric($service)){
					$serviceDetails	= getServiceDetils($service);
					$serviceName	= !empty($serviceDetails->name) ? $serviceDetails->name : '' ;
					$serviceDesc	= !empty($serviceDetails->description) ? $serviceDetails->description : '' ;
				$htmlTop .= '<h3><span><img src="'.base_url('assets/front/images/left-star.png').'"></span>';
				$htmlTop .= '<span id="serviceInLocation">'.$serviceName.' '.$locationName.'</span>';
				$htmlTop .= '<span><img src="'.base_url('assets/front/images/right-star.png').'"></span>';
				$htmlTop .= '</h3><p class="center" id="serviceDesc">'.$serviceDesc.'</p>';
				}
			$responseArray['headInfo'] = $htmlTop;
			$responseArray['staffs'] = $html;
			echo json_encode($responseArray);die;
		}catch(Exception	$ex){
			log_message('error',' Unable to search staff list '.$ex->getMessage());
		}
	}
	

	function staffs($username){
		try{
			$url = base_url();
			if(empty($username)){
				redirect($url);
			}
			$userdetails = getUserIdByUsername($username);
			if(empty($userdetails)){
				redirect($url);
			}
			$userId		= $userdetails->id;
			$userProfile= $userdetails->image;
			if($userProfile){
				$data['profileImage'] = $userProfile;
			}
			/****** Manage Recently Staff Views Section ******/
			$clientId	= logginUserId();
			$viewStaffId	= $userId;
			$ipAddress		= getIpAddress();
			$dateTime		= date('Y-m-d H:i');
			$recentlyViewData	= array('staff_id'=>$viewStaffId,'client_id'=>$clientId,'ip_address'=>$ipAddress,'date_time'=>$dateTime);
			$manageRecentlyView = $this->Home_model->manageRecentlyStaffViews($recentlyViewData);
			//****** Get Cookies view staff id ******//
			if(!empty($_COOKIE['staffs'])){
				$viewStaffId = $_COOKIE['staffs'];
			}else{
				$viewStaffId = getRecentlyViewsStaffIds();
			}
			$recentlyViewStaffs = getRecentlyViewsStaffs($viewStaffId);
			if($recentlyViewStaffs){
				$data['recentlyViewStaff']	= $recentlyViewStaffs;
			}
			//dump($recentlyViewStaffs);die;
			$userName			= !empty($userdetails->first_name) ? $userdetails->first_name.' '.$userdetails->last_name : "";
			$data['userInfo']	= $userdetails;
			$userServices		= getUserServices($userId);
			if($userServices){
				$data['userServices'] = $userServices; 
			}
			$useraddress	= getUseraddress($userId);
			if($useraddress){
				$data['useraddress'] = $useraddress; 
			}
			$userDetails	= getUserDetails($userId);
			if($userDetails){
				$data['userDetails'] = $userDetails; 
			}
			$clientReview	= getUserReviews($userId);
			if($clientReview){
				$data['reviews'] = $clientReview;
			}
			//dump($clientReview);die;
			$userMedias		= getUserMedias($userId);
			if($userMedias){
				$userImages		= $userMedias->images;
				$userVideos		= $userMedias->videos;
				if(!empty($userImages)){
					$userImages = explode(',',$userImages);
				}
				
				$data['userImages'] = $userImages;
				//dump($userImages);die;
				if(!empty($userVideos)){
					$userVideos = explode(',',$userVideos);
				}
				$data['userVideos'] = $userVideos;
				
			}
			$data['js']		= array('jquery-ui','jquery.flexslider','timepicki'); 
			$data['meta']	= array();
			$data['css']	= array('flexslider','common','staffdetails','timepicki');
			$this->load->view('frontend/staffdetails', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to user details on staff details page');
		} 
	}
	
	/**
	 * @Function	-: sendCustomMail()
	 * @Description	-: This function used for send an email (Custom) 
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 08-08-2016
	 * 
	 */
	
	function sendCustomMail($email,$subject,$content){
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'tisuser@gmail.com',
				'smtp_pass' => '#tisindia123#',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1'
			);
			$this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('tisuser@gmail.com', 'Babes Direct');
            $this->email->to($email);  // replace it with receiver mail id
            $this->email->subject($subject); // replace it with relevant subject
            $this->email->message($content);
            $email_sent = $this->email->send();
            if ($email_sent) {
                return true;
            } else {
                return $this->email->print_debugger();
            }
	}
	
	/**
	 * @Function	-: accountActivation()
	 * @Description	-: This function used for activate an account
	 * @Param		-: No Parameter
	 * @Return		-: array()
	 * @Created on	-: 08-08-2016
	 * 
	 */
	
	function accountActivation(){
		try{
			$email = $this->input->get('email');
			$token = $this->input->get('token');
			$checkActivation = $this->Home_model->activeAccount($email,$token);
			if($checkActivation){
				//echo "Now your account activated.";
			}else{
				//echo "Unable to active your account";
			}
			redirect('index');
		}catch(Exception $ex){
			log_message('error',' Unable to active the account'.$ex->getMessage());
		}
	}
	
/**
 * 
 * 
 * */
 
 function getServiceByGender()
 {
	 $gender = $this->input->post('gender');
	 if(!empty($gender)){
		 if($gender=='Female'){$gender='1';}
		 if($gender=='Male'){$gender='2';}
		 if($gender=='Other'){$gender='3';}		 
		 $services		= $this->Home_model->getServices($gender);
		?>
		<select name="service_id" class="checkempty">
	<option value="">Select Service</option>
	<?php
		if(!empty($services) && is_array($services)){
			foreach($services as $service){
				echo '<option value="'.$service->id.'">'.$service->name.'</option>';
			}
		}
	?>
</select>
		<?php 
		 
		 }
 }
 
 public function loadBabesCities(){
		$key =	$this->input->get('q');
		$suggest="";
		if(!empty($key) && strlen($key) > 2){
			
			$key = str_replace("%20"," ",$key);
			$key = trim($key);
		}
		$suggest=cityautocomplete($key);
			
		$this->output->set_content_type('application/json')->set_output(json_encode($suggest));
	}
}
