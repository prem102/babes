<?php
Class Users_Group_model extends MY_Model {
	public $table      = 'groups';
	public $primary_key = "users_groups.id";
	public $soft_deletes = TRUE;
	public function __construct(){
		parent::__construct();
	}
	

}

?>
