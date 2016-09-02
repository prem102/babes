<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @Description -: This function used to search city from given string 
 * @Param		-: String ($str)
 * @Created on	-: 28-07-2016
 * @Return		-: String
 */ 
function cityautocomplete($text){
	$CI = & get_instance();
	if(!empty($text)){
		$suggest='';
	$results=	$CI->db
					->select('BC.id ,CONCAT(BC.name," - ",BS.name) as value')
					->like('BC.name',$text)
					->join('babes_state as BS','BS.id=BC.state')
					->get('babes_city as BC')->result();
					
			if(!empty($results)){
				foreach($results as $result):
				if(!empty($result->id))
					$suggest[] =array('text'=>ucfirst($result->value),'value'=>$result->id);
				endforeach;
			}
			return $suggest;
		}
	}
?>
