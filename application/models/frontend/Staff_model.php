<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Staff_model extends MY_Model {
	
	
	public function __construct(){
		
		parent::__construct();
	}
//==========================================model function start here ==========================

/**
 * ths function use for staff full registration step1 
 * 
 * 
 * */
 
 function staffFullRegistrationStep1($input){
	 if(!empty($this->session->userdata('user_id'))&&!empty($input))
	 {
		$user_id=$this->session->userdata('user_id');		
		$userdata=array(
		'display_name'=>$input['display_name'],'first_name'=>$input['fname'],'last_name'=>$input['lname'],'phone'=>$input['phone'],'alt_phone'=>$input['alt_phone'],'description'=>$input['about_me']
		);
		$userdetail=array('user_id'=>$user_id,'age'=>$input['age'],'gender'=>$input['gender'],
		'height'=>trim($input['height_feet'].','.$input['height_inch'],','),'hair_color'=>$input['hair_color'],'eye_color'=>$input['eye_color']
		,'body_type'=>$input['body_type'],'bust_size'=>$input['bust_size'],'ethnicity'=>$input['ethnicity'],'dress_size'=>$input['dress_size']);
		
		$useraddress=array('user_id'=>$user_id,'country_id'=>1,'state_id'=>$input['state'],'city_id'=>$input['city'],'pincode'=>$input['zip_code'],'address'=>$input['address']);
		
		
		$this->db->where('id',$user_id);
		$this->db->update('users',$userdata); 
		$this->db->insert('babes_user_details',$userdetail);
		$this->db->insert('babes_users_address',$useraddress);
		$usercity=array('user_id'=>$user_id,'main_city'=>1,'city_id'=>$input['main-city']);
		$sta=$this->db->insert('babes_user_city',$usercity);
		$othercity=$input['other-city'];
		if(!empty($othercity))
		{
			foreach($othercity as $ocity)
			{
			$userocity[]=array('user_id'=>$user_id,'city_id'=>$ocity);	
			}
			$sta=$this->db->insert_batch('babes_user_city',$userocity);
		}
		if($sta){
			return true;
			}
			
			
	 }
	 return false;
	 }

/**
 * ths function use for staff full registration step1 
 * 
 * 
 * */
 
 function staffFullRegistrationStep2($input){
	 if(!empty($this->session->userdata('user_id'))&&!empty($input))
	 {
		$user_id=$this->session->userdata('user_id');		
		
		$mainservice=array_unique($input['main_service']);
		if(!empty($mainservice))
		{$i=0;
			foreach($mainservice as $mainser)
			{
			$mainserv[]=array('user_id'=>$user_id,'service_id'=>$mainser,'charges'=>$input['service_price'][$i],'duration'=>trim($input['service_hours'][$i].', '.$input['service_minuts'][$i] ,','));	
			$i++;
			}
			$sta=$this->db->insert_batch('babes_users_services',$mainserv);
		}
		$extraservice=array_unique($input['extra_service']);
		if(!empty($extraservice))
		{$i=0;
			foreach($extraservice as $extraser)
			{
			$extraserv[]=array('user_id'=>$user_id,'service_id'=>$extraser,'charges'=>$input['extre_service_price'][$i],'duration'=>trim($input['extra_service_hours'][$i].', '.$input['extra_service_minuts'][$i] ,','),'extra'=>'1');	
			$i++;
			}
			$sta=$this->db->insert_batch('babes_users_services',$extraserv);
		}
		if($sta){
			return true;
			}
			
			
	 }
	 return false;
	 }

//============================================== model close =============================	
}	
	
