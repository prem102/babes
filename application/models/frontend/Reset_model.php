<?php
Class Reset_model extends MY_Model {
	public $table      = 'users';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function	-: updateResetPassword();
	 * @Description	-: This function used for update new reset password
	 * @Param		-: 
	 * @Return		-: True/False
	 * @Created on	-: 18-08-2016
	 * 
	 */
	
	public function updateResetPassword($userId=0,$data=array()){
		try{
			if(!empty($userId) && is_numeric($userId) && !empty($data)){
				$update	= $this->Reset_model->where('id',$userId)->update($data);
				if($update){
					return true;
				}else{
					return false;
				}
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to update new reset password '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function	-: checkingToken()
	 * @Description	-: This function used for checking forgot password token basis on token
	 * @Param		-: token(string)
	 * @Return		-: userId(int)
	 * @Created On	-: 18-08-2016
	 */
	
	public function checkingToken($token=null){
		try{
			if(!empty($token)){
				$info	= $this->Reset_model->where('forgotten_password_code',$token)->get('users');
				if($info){
					$userId	= $info->id;
					return $userId;
				}
			}else{
				return false;
			}
		}catch(Exception $ex){
			log_message('',' Unable to check reset password token '.$ex->getMessage());
		}
	}
}

?>
