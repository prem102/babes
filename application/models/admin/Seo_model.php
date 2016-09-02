<?php
Class Seo_model extends MY_Model {
	public $table      = 'babes_seo_page_meta';
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
						$records = $record->get('babes_seo_page_meta')->row();
					}else{
						$records = $record->get('babes_seo_page_meta')->result();
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
	 * @Function		-: managePageMeta();
	 * @Description		-: This function used for add/update indivisual page meta
	 * @Param			-: id (int),postData(array)
	 * @Created on		-: 29-07-2016
	 * @Return			-: insertedId/false
	 */
	
	public function managePageMeta($postData=array(),$id=0){
		try{
			if(!empty($postData)){
				$postData['page_name'] = strtolower($postData['page_name']);
				$postData['page_url'] = trim($postData['page_url']);
				$conditions = array('page_name'=>strtolower($postData['page_name']),'page_url'=>$postData['page_url']);
				if(!empty($id) && is_numeric($id)){
					//****** Update Page content ******//
					$check	= $this->Seo_model->where('id !=',$id)->where($conditions)->get_all();
					if($check){
						setMessage('Page already exists !','warning');
						return false;
					}else{
						$update	= $this->Seo_model->where('id',$id)->update($postData);
						if($update){
							setMessage('Page Meta successfully updated','success');
							return $id;
						}
					}
				}else{
					//****** Insert Page content ******//
					$check	= $this->Seo_model->where($conditions)->get_all();
					if($check){
						setMessage('Page already exists !','warning');
						return false;
					}else{
						$insert	= $this->Seo_model->insert($postData);
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
			log_message('error ',' Unable to insert page meta '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function		-: manageGoogleAnalyticCode()
	 * @Description		-: This function managing the google analytics code
	 * @Param			-: data (array)
	 * @Created on		-: 04-08-2016
	 * @Return			-: True/False
	 */ 
	
	function manageGoogleAnalyticCode($data=array()){
		try{
			$analyticCode = $this->getGoogleAnalyticCode();
			$code = "";
			if(!empty($analyticCode)){
				$code = $analyticCode;
			}
			if($code==$data['code']){
				return true;
			}else{
				$update	= $this->db->update('babes_google_analytics',array('status'=>'0','updated_by'=>$data['updated_by']));
				$insert	= $this->db->insert('babes_google_analytics',$data);
				if($insert){
					return true;
				}
			}
		}catch(Exception	$ex){
			log_message('error ',' Unable to manage google analytic code '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function		-: getGoogleAnalyticCode()
	 * @Description		-: This function get the google analytics code
	 * @Param			-: No Parameter
	 * @Created on		-: 04-08-2016
	 * @Return			-: True/False
	 */ 
	
	function getGoogleAnalyticCode(){
		try{
			$analyticCode = $this->db->select('code')->where('status',1)
							->get('babes_google_analytics')->row();
			if($analyticCode){
				$code = $analyticCode->code;
				$code = !empty($code) ? $code : '';
				return $code;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error ',' Unable to get google analytic code '.$ex->getMessage());
			return false;
		}
	}
	
	/**
	 * @Function		-: getPreviousGoogleAnalyticCode()
	 * @Description		-: This function get and return the google analytics code
	 * @Param			-: No Parameter
	 * @Created on		-: 04-08-2016
	 * @Return			-: array()
	 */ 
	
	function getPreviousGoogleAnalyticCode(){
		try{
			$analyticCode = $this->db->select('code,updated_at')->where('status','0')
							->limit(1)->order_by('id','DESC')
							->get('babes_google_analytics')->row();
			if($analyticCode){
				return $analyticCode;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error ',' Unable to get previous google analytic code '.$ex->getMessage());
			return false;
		}
	}

}

?>
