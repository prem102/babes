<?php

class Group_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->has_one['users'] = array('foreign_model'=>'User_model','foreign_table'=>'users');
    }

    public $before_create = array('timestamps');
    public $table = "users_groups";
    public $primary_key = "users_groups.id";
    public $soft_deletes = false;



}

