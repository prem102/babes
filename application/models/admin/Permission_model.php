<?php
Class Permission_model extends MY_Model {
	public $table      = 'babes_permissions_master';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: removeGroupPermission()
	 * @Description		-: This function used for remove group permission basis on permission id
	 * @Param			-: id(int)
	 * @Created on		-: 01-08-2016
	 */
	
	function removeGroupPermission($id=0){
		try{
			if(!empty($id)){
				$remove = $this->db->where('permission_id',$id)->delete('babes_group_permission');
				if($remove){
					return true;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('error',' unable to remove group permissions '.$ex->getMessage());
		}
	}

}

?>
