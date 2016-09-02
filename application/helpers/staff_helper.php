<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
	 * @Function	-: getStaffMinServicePrice()
	 * @Description	-: This function used for get and return user minimum services price basis on user id
	 * @Param		-: userId(int),serviceId(int)
	 * @Return		-: int
	 * @Created On	-: 11-08-2016
	 * 
	 */
	
	function getStaffMinServicePrice($userId=0,$serviceId=0){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$CI = & get_instance();
				$record = $CI->db
						->select('(case when (BUS.charges IS NULL) 
				 THEN
				     babes_services_master.price
				 ELSE
				     BUS.charges
				 END) as minCharge',false)
						->join('babes_users_services as BUS','BUS.service_id=babes_services_master.id')
						->where('BUS.user_id',$userId);
						if($serviceId){
							$record->where('BUS.service_id',$serviceId);
						}
						$service = $record->where('babes_services_master.status','1')
						->where('babes_services_master.deleted_at=',NULL)
						->order_by('babes_services_master.price','ASC')
						->limit(1)->get('babes_services_master')->row();

				$minmumCharge = $service->minCharge;
				if($minmumCharge){
					return $minmumCharge;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error ','Unable to get staff services '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getStaffServices()
	 * @Description	-: This function used for get and return user services basis on user id
	 * @Param		-: userId(int)
	 * @Return		-: array()
	 * @Created On	-: 11-08-2016
	 * 
	 */
	
	function getStaffServices($userId){
		try{
			if(!empty($userId) && is_numeric($userId)){
				$CI = & get_instance();
				$services = $CI->db
						->join('babes_users_services as BUS','BUS.service_id=babes_services_master.id')
						->where('BUS.user_id',$userId)
						->where('babes_services_master.status',1)
						->where('babes_services_master.deleted_at',NULL)
						->get('babes_services_master')->result();
				if($services){
					return $services;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error ','Unable to get staff services '.$ex->getMessage());
		}
	}
	
	
	/**
	 * @Function	-: getServiceDetils()
	 * @Description	-: This function used for get a service details basis on service id
	 * @Param		-: serviceId(int)
	 * @Return		-: array()
	 * @Created On	-: 12-08-2016
	 * 
	 */
	function getServiceDetils($serviceId=0){
		try{
			$CI = & get_instance();
			if(!empty($serviceId) && is_numeric($serviceId)){
				$result	= $CI->db->select('id,description,name')
				->where('id',$serviceId)->get('babes_services_master')->row(); 
				if($result){
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get service details '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: getLocationDetils()
	 * @Description	-: This function used for get a location details basis on location id
	 * @Param		-: serviceId(int)
	 * @Return		-: array()
	 * @Created On	-: 12-08-2016
	 * 
	 */
	function getLocationDetils($location=0){
		try{
			$CI = & get_instance();
			if(!empty($location) && is_numeric($location)){
				$result	= $CI->db->where('id',$location)->get('babes_city')->row(); 
				if($result){
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to get location details '.$ex->getMessage());
		}
	}
?>
