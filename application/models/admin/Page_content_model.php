<?php
Class Page_content_model extends MY_Model {
	public $table      = 'babes_page_content';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: getAllPages();
	 * @Description		-: This function used for get and return pages
	 * @Param			-: id(int),pageName(string),pageUrl(string)
	 * @Created on		-: 29-07-2016
	 * @Return			-: array/false
	 */
	public function getAllPages($id=0,$pageName=NULL,$pageUrl=NULL){
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
					if(!empty($id) && is_numeric($id)){
						$records = $record->get('babes_page_content')->row();
					}else{
						$records = $record->get('babes_page_content')->result();
					}
			if($records){
				return $records;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to fetching pages details '.$ex->getMessage());
		}
	}
	
	
	
	/**
	 * @Function		-: managePage();
	 * @Description		-: This function used for add/update page content
	 * @Param			-: id (int),postData(array)
	 * @Created on		-: 29-07-2016
	 * @Return			-: insertedId/false
	 */
	
	public function managePage($postData=array(),$id=0){
		try{
			if(!empty($postData)){
				$postData['page_name'] = strtolower($postData['page_name']);
				$postData['page_url'] = strtolower(trim($postData['page_url']));
				$postData['variables'] = strtolower(trim($postData['variables']));
				
				$conditions = array('variables'=>$postData['variables'],'page_url'=>$postData['page_url']);
				if(!empty($id) && is_numeric($id)){
					//****** Update Page content ******//
					$check	= $this->Page_content_model->where('id !=',$id)->where($conditions)->get();
					if($check){
						setMessage('Page url '.$postData['page_url'].' and variable '.$postData['variables'].' already exists !','warning');
						return false;
					}else{
						$update	= $this->Page_content_model->where('id',$id)->update($postData);
						if($update){
							setMessage('Page successfully updated','success');
							return $id;
						}
					}
				}else{
					//****** Insert Page content ******//
					$check	= $this->Page_content_model->where($conditions)->get_all();
					if($check){
						setMessage('Page already exists !','warning');
						return false;
					}else{
						$insert	= $this->Page_content_model->insert($postData);
						if($insert){
							setMessage('Page successfully inserted','success');
							return $insert;
						}
					}
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error ',' Unable to insert page content '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function		-: removePage()
	 * @Description		-: This function used for remove static page basis on page id
	 * @Param			-: id (id)
	 * @Return			-: true/false
	 * @Created on		-: 29-07-2016
	 */ 
	
	public function removePage($id){
		try{
			if(!empty($id) && is_numeric($id)){
				$remove = $this->Page_content_model->where('id',$id)->delete();
				if($remove){
					setMessage('Page successfully removed','success');
					return true;
				}
			}
		}catch(Exception	$ex){
			return false;
			log_message('error',' Unable to remove static page');
		}
	}
	
}

?>
