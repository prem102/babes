<?php
Class Email_model extends MY_Model {
	public $table      = 'babes_email_templates';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: getAllTemplates();
	 * @Description		-: This function used for get and return eamil templates
	 * @Param			-: id(int),templateName(string),templateSubject(string)
	 * @Created on		-: 29-07-2016
	 * @Return			-: array/false
	 */
	public function getAllTemplates($id=0,$templateName=NULL,$templateSubject=NULL){
		try{
			$record = $this->db->where('babes_email_templates.deleted_at',NULL)
						->join('groups','groups.id=babes_email_templates.user_group_id')
						->select('babes_email_templates.*,groups.name as userGroup');
				if(!empty($id) && is_numeric($id)){
					$record->where('babes_email_templates.id',$id);
				}
				if($templateName){
					$record->where('babes_email_templates.template_name',$templateName);
				}
				if($templateSubject){
					$record->where('babes_email_templates.template_subject',$templateSubject);
				}
				if(!empty($id) && is_numeric($id)){
					$records = $record->get('babes_email_templates')->row();
				}else{
					$records = $record->get('babes_email_templates')->result();
				}
			if($records){
				return $records;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to fetching emails templates '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function		-: manageEmailTemplate();
	 * @Description		-: This function used for add or updated email template basis on id
	 * @Param			-: id (int),postData(array)
	 * @Created on		-: 29-07-2016
	 * @Return			-: insertedId/false
	 */
	
	public function manageEmailTemplate($postData=array(),$id=0){
		try{
			if(!empty($postData)){
				$postData['template_name'] = strtolower($postData['template_name']);
				$conditions = array('template_name'=>strtolower($postData['template_name']),	
									'template_subject'=>$postData['template_subject'],'user_group_id'=>$postData['user_group_id']);
				if(!empty($id) && is_numeric($id)){
					//****** Update Page content ******//
					$check	= $this->Email_model->where('id !=',$id)->where($conditions)->get_all();
					if($check){
						setMessage('Email Template already exists in selected group!','warning');
						return false;
					}else{
						$update	= $this->Email_model->where('id',$id)->update($postData);
						if($update){
							setMessage('Email Template successfully updated','success');
							return $id;
						}
					}
				}else{
					//****** Insert Page content ******//
					$check	= $this->db->where($conditions)->get('babes_email_templates')->num_rows();
					if($check){
						setMessage('Email Template already exists in selected group !','warning');
						return false;
					}else{
						$insert	= $this->Email_model->insert($postData);
						if($insert){
							setMessage('Email Template successfully inserted','success');
							return $insert;
						}
					}
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error ',' Unable to insert Email Template '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function 		-: getUsersRecords() 
	 * @Description		-: This function used for get and return clients list using filter or without filter
	 * @Param			-: searchData (array), start (int)
	 * @Return			-: array()
	 * @Created on		-: 05-08-2016
	 */
	 
	public function getUsersRecords($searchData = array(), $start=NULL){
		try{
			$clientsCount = $this->db;
				if($start){
					$clientsCount->select('users.id,users.username,users.email,users.active,users.phone,users.username,users.active,groups.name as group');
				}
				$clientsCount->join('users_groups','users_groups.user_id=users.id  AND users.deleted_at is null')
				->join('groups','groups.id=users_groups.group_id')
				->where('users.active',1);
				if($searchData['userName']){
					$clientsCount->like('users.username',$searchData['userName']);
				}
				if($searchData['userEmail']){
					$clientsCount->like('users.email',$searchData['userEmail']);
				}
				if($searchData['userContact']){
					$clientsCount->like('users.phone',$searchData['userContact']);
				}
				if($searchData['userGroup']){
					$clientsCount->where('groups.id',$searchData['userGroup']);
				}else{
					$clientsCount->where('groups.id',2);
				}
				if(!empty($start)){
					$start = ($start=='A') ? 0 : $start;
					$clients = $clientsCount->limit($this->limit,$start)->group_by('users.id')->get('users')->result();
				}else{
					$clients = $clientsCount->group_by('users.id')->get('users')->num_rows();
				}
				if($clients){
					return $clients;
				}else{
					return false;
				}
		}catch(Exception	$ex){
			log_message('error', 'Clients not listed'.$ex->getMessage());
		}
	}

	/**
	 * @Method		-: getAllGroup()
	 * @Description	-: This function used for fetch all user group basis on condition
	 * @Param		-: condition (string)
	 * @Created on	-: 17-07-2016
	 * @Updated on	-: 05-08-2016
	 * @Return 		-: array()
	 * 
	 */ 
	public function getAllGroup($condition=null){
		try{
			$groups = $this->db->where('id !=',1)->where('deleted_at',NULL);
			if(!empty($condition) && $condition=='subAdmin'){
				$groups->where_not_in('id',array('2','3'));
			}
			$groups = $groups->where('status','1')->get('groups')->result();
			if($groups){
				return $groups;
			}
		}catch(Exception $ex){
			log_message('error ',' Error on fetching users group');
			return false;
		}
	}
	
	/**
	 * @Function		-: getAllMailTemplate()
	 * @Descriptionq	-: This function used for get and return mail templates
	 * @Param			-: No Parameter
	 * @Created on		-: 05-08-2016
	 */ 
	
	public function getAllMailTemplate($groupId=0){
		try{
			$templates = $this->db->where('deleted_at',NULL);
			if($groupId){
				$templates->where('group_id',$groupId);
			}else{
				//$templates->where('user_group_id',2);
			}
			$templates = $templates->where('status',1)->get('babes_email_templates')->result();
			if($templates){
				return $templates;
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error ',' Error on fetching mail template'.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function		-: getUserEmails()
	 * @Description		-: This function used for get and return users email id basis on user id
	 * @Param			-: usersId(array)
	 * @Return			-: array
	 * @Created on		-: 06-08-2016
	 */ 
	
	public function getUserEmails($usersId=array()){
		try{
			if(!empty($usersId)){
				$emails = $this->db->select('email,id')->where_in('id',$usersId)->get('users')->result();
				if($emails){
					return $emails;
				}else{
					return false; 
				}
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error ',' Error on fetching user email'.$ex->getMessage());
			return false;
		}
	}
	
}

?>
