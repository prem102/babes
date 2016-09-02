<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * this function use for remove the extra space in url
 *  @param string
 * 
 * */
	function seoUrl($string) 
	{ if(!empty($string)){
		$CI =& get_instance();
		$string = strtolower($string); //Strip any unwanted characters 
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string); //Clean multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string); //Convert whitespaces and underscore to dash 
        $string = preg_replace("/[\s_]/", "-", $string); 
        return $string;
		}
		return false;
	 }
	 
	 
	 /**
	  * this function use for get dynamic meta data
	  *  @param alias string
	  *  @return array() mix
	  * */
	  
	  function getMataData($alias=null){		
			$CI =& get_instance();
	     if(!empty($alias)){						  
					$temp_data=	 $CI->db->where('page_url', $alias)->where('status', '1')->get('babes_seo_page_meta')->result();
					if($temp_data){
				   }else{
					$temp_data=	 $CI->db->where('page_url', 'default')->get('babes_seo_page_meta')->result();
					   }
					$data['id']  =$temp_data[0]->id;
					$data['title'] = $temp_data[0]->title;
					$data['page_url'] = $temp_data[0]->page_url;			
					$data['meta_title'] = $temp_data[0]->meta_title;
					$data['meta_keyword'] = $temp_data[0]->meta_keywords;
					$data['meta_description'] = $temp_data[0]->meta_description;
					return $data;
		     }
		   return false;	
		
		
		}
		
		/**
		 * this function use for get dynamic google analytic code.
		 * @return string
		 * 
		 * */
		 
		 function getAnalytic()
		 {	$data='';
			$CI =& get_instance();
			$temp_data=	 $CI->db->where('status', '1')->get('babes_google_analytics')->result();
					
			if($temp_data){
				$data=$temp_data[0]->code;
				} 
				return $data;
		  }
		  
		 /**
		  * this function use for get all atatic page contents
		  * @param Page_url string
		  * @return array() mix 
		  * */
		  
		  function getStaticPageContent($alias=null)
		  {  	$data='';
			    $CI =& get_instance();
				if(!empty($alias)){						  
					$temp_data=	 $CI->db->where('page_url', $alias)->where('status', '1')->get('babes_page_content')->result();
					if($temp_data){
						
					$data['id']  =$temp_data[0]->id;
					$data['title'] = $temp_data[0]->title;
					$data['page_url'] = $temp_data[0]->page_url;			
					$data['meta_title'] = $temp_data[0]->meta_title;
					$data['page_content'] = $temp_data[0]->page_content;
					$data['meta_keyword'] = $temp_data[0]->meta_keywords;
					$data['meta_description'] = $temp_data[0]->meta_description;
					return $data;
				   }
				   return $data;
			   }
			   return $data;
		 } 
	 
?>
