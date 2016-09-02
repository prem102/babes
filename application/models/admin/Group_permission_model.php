<?php

class Group_permission_model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public $before_create = array('timestamps');
    public $table = "babes_group_permission";
    public $primary_key = "id";
    public $soft_deletes = true;



}

