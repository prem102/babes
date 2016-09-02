<?php


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
			$group=$CI->ion_auth->get_users_groups()->row();
			if($group->id=='1'){
				$r=array(1=>7,2=>7,3=>7,4=>7,5=>7,6=>7,7=>7);
				return $r;
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
			log_message('error','Unable to get user permissions '.$ex->getMessage());
		}
	}
