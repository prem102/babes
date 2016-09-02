<?php
Class Review_model extends MY_Model {
	public $table      = 'babes_client_reviews';
	public $primary_key = "id";
	public $soft_deletes = TRUE;
	public $limit = 10;
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @Function		-: getAllReviews();
	 * @Description		-: This function used for get and return client review
	 * @Param			-: clientId(int),staffId(int),approval(int)
	 * @Created on		-: 04-08-2016
	 * @Return			-: array/false
	 */
	public function getAllReviews($client=NULL,$staff=NULL,$approval=NULL,$start=NULL){
		try{
			$record = $this->db
				->join('users as ctable','ctable.id=babes_client_reviews.client_id')
				->join('users as stable','stable.id=babes_client_reviews.staff_id')
				->join('users as atable','atable.id=babes_client_reviews.approved_by','left')
				->where('babes_client_reviews.deleted_at',NULL);
				if($start){
					$record->select('babes_client_reviews.id,ctable.username as client,ctable.email as clientEmail,
					stable.username as staff,stable.email as staffEmail,atable.username as approvedBy,
					babes_client_reviews.comments,babes_client_reviews.approval,babes_client_reviews.rating');
				}
				if(!empty($client)){
					$record->like('ctable.username',$client);
					$record->or_like('ctable.email',$client);
				}
				if(!empty($staff)){
					$record->like('stable.username',$staff);
					$record->or_like('stable.email',$staff);
				}
				if(!empty($approval) && $approval==1){
					$record->where('babes_client_reviews.approval','1');
				}
				if(!empty($approval) && $approval==2){
					$record->where('babes_client_reviews.approval','0');
				}
				if(!empty($start)){
					$start = ($start=='A') ? 0 : $start;
					$records = $record->limit($this->limit,$start)->get('babes_client_reviews')->result();
				}else{
					$records = $record->get('babes_client_reviews')->num_rows();
				}
			if($records){
				return $records;
			}else{
				return false;
			}
		}catch(Exception	$ex){
			log_message('error',' Unable to fetching client review '.$ex->getMessage());
		}
	}


}

?>
