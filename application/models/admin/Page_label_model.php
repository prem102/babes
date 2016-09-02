<?php
Class Page_label_model extends MY_Model {
	public $table      = 'babes_page_labels';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: getAllLabels();
	 * @Description		-: This function used for get and return pages labels
	 * @Param			-: id(int),pageName(string),pageUrl(string),label(string)
	 * @Created on		-: 28-07-2016
	 * @Return			-: array/false
	 */
	public function getAllLabels($id=0,$pageName=NULL,$pageUrl=NULL,$label=NULL){
		try{
			$record = $this->db->where('deleted_at',NULL);
					if(!empty($id) && is_numeric($id)){
						$record->where('id',$id);
					}
					if($pageName){
						$record->where('page_name',$pageName);
					}
					if($pageUrl){
						$record->where('page_url',$pageUrl);
					}
					if($label){
						$record->where('variable_name',$label);
					}
					if(!empty($id) && is_numeric($id)){
						$records = $record->get('babes_page_labels')->row();
					}else{
						$records = $record->get('babes_page_labels')->result();
					}
			if($records){
				return $records;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to fetching pages labels '.$ex->getMessage());
		}
	}
	
	
	
	
	
	
	/**
	 * @Function		-: manageLabel();
	 * @Description		-: This function used for add/update labels value of different pages
	 * @Param			-: id (int),postData(array)
	 * @Created on		-: 28-07-2016
	 * @Return			-: insertedId/false
	 */
	
	public function manageLabel($postData=array(),$id=0){
		try{
			if(!empty($postData)){
				$postData['page_name'] = strtolower($postData['page_name']);
				$postData['variable_name'] = strtolower($postData['variable_name']);
				$postData['page_url'] = strtolower($postData['page_url']);
				$conditions = array('page_url'=>$postData['page_url'],'variable_name'=>strtolower($postData['variable_name']));
				if(!empty($id) && is_numeric($id)){
					//****** Update Page label ******//
					$check	= $this->Page_label_model->where('id !=',$id)->where($conditions)->get_all();
					if($check){
						setMessage('Label already exists on this page','warning');
						return false;
					}else{
						$update	= $this->Page_label_model->where('id',$id)->update($postData);
						if($update){
							setMessage('Label successfully updated','success');
							return $id;
						}
					}
				}else{
					//****** Insert Page label ******//
					$check	= $this->Page_label_model->where($conditions)->get_all();
					if($check){
						setMessage('Label already exists on this page','warning');
						return false;
					}else{
						$insert	= $this->Page_label_model->insert($postData);
						if($insert){
							setMessage('Label successfully inserted','success');
							return $insert;
						}
					}
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error ',' Unable to insert page labels '.$ex->getMessage());
			return false;
		}
	}
	/**
	 * @Function		-: removeLabel()
	 * @Description		-: This function used for remove page label basis on id
	 * @Param			-: id (id)
	 * @Return			-: true/false
	 * @Created on		-: 29-07-2016
	 */ 
	
	public function removeLabel($id){
		try{
			if(!empty($id) && is_numeric($id)){
				$remove = $this->Page_label_model->where('id',$id)->delete();
				if($remove){
					setMessage('Page Label successfully removed','success');
					return true;
				}
			}
		}catch(Exception	$ex){
			return false;
			log_message('error',' Unable to remove Page label');
		}
	}
	
}

?>
