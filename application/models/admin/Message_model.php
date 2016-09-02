<?php
Class Message_model extends MY_Model {
	public $table      = 'babes_message_templates';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: getAllTemplates();
	 * @Description		-: This function used for get and return message templates
	 * @Param			-: id(int),templateName(string)
	 * @Created on		-: 01-08-2016
	 * @Return			-: array/false
	 */
	public function getAllTemplates($id=0,$templateName=NULL){
		try{
			$record = $this->db->where('babes_message_templates.deleted_at',NULL)
						->join('groups','groups.id=babes_message_templates.user_group_id')
						->select('babes_message_templates.*,groups.name as userGroup');
				if(!empty($id) && is_numeric($id)){
					$record->where('babes_message_templates.id',$id);
				}
				if($templateName){
					$record->where('babes_message_templates.template_name',$templateName);
				}
				if(!empty($id) && is_numeric($id)){
					$records = $record->get('babes_message_templates')->row();
				}else{
					$records = $record->get('babes_message_templates')->result();
				}
			if($records){
				return $records;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to fetching message templates '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function		-: manageMessageTemplate();
	 * @Description		-: This function used for add or updated message template basis on id
	 * @Param			-: id (int),postData(array)
	 * @Created on		-: 04-08-2016
	 * @Return			-: insertedId/false
	 */
	
	public function manageMessageTemplate($postData=array(),$id=0){
		try{
			if(!empty($postData)){
				$postData['template_name'] = strtolower($postData['template_name']);
				$conditions = array('template_name'=>strtolower($postData['template_name']),'user_group_id'=>$postData['user_group_id']);
				if(!empty($id) && is_numeric($id)){
					//****** Update Page content ******//
					$check	= $this->Message_model->where('id !=',$id)->where($conditions)->get_all();
					if($check){
						setMessage('Message Template already exists in selected group!','warning');
						return false;
					}else{
						$update	= $this->Message_model->where('id',$id)->update($postData);
						if($update){
							setMessage('Message Template successfully updated','success');
							return $id;
						}
					}
				}else{
					//****** Insert Page content ******//
					$check	= $this->Message_model->where($conditions)->get_all();
					if($check){
						setMessage('Message Template already exists in selected group !','warning');
						return false;
					}else{
						$insert	= $this->Message_model->insert($postData);
						if($insert){
							setMessage('Message Template successfully inserted','success');
							return $insert;
						}
					}
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error ',' Unable to Insert/Update Message Template '.$ex->getMessage());
			return false;
		}
	}

}

?>
