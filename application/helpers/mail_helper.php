<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
	* @content string
	* @param  $subject
	* @param  $email_id	
	* @description This function use for send a mail any any body like staff or client
	* @return
	* 
	*/
function sendCustomMail($email_id ,$content,$subject,$templateAlias='new-job-alert')
{			
			
			$CI =& get_instance();
			$CI->load->library('parser');
			$template = loadTemplateByAlias($templateAlias,'en');
			if(!empty($template)){
			$subject=($subject)? ucfirst($subject):ucfirst($template['subject']);
			$html_text =  $CI->parser->parse_string($template['template_text'], array('content' => $content),TRUE);
			$html =  $CI->parser->parse_string($template['template'] , array('content' => $content ),TRUE);
			$config = Array(
				'protocol'	=> $CI->config->item('protocol'),
				'smtp_host'	=> $CI->config->item('smtp_host'),
				'smtp_port'	=> $CI->config->item('smtp_port'),
				'smtp_user'	=> $CI->config->item('smtp_user'), // change it to yours
				'smtp_pass'	=> $CI->config->item('smtp_pass'), // change it to yours
				'mailtype'	=> $CI->config->item('mailtype'),
				'charset'		=> $CI->config->item('charset'),
				'wordwrap'	=> TRUE
			);
       
			$CI->load->library('email');
			$CI->email->initialize($config); 
			$CI->email->set_newline("\r\n");
			$CI->email->from('tisuser@gmail.com');
			//$list = array( $email_id );
			$list = array($email_id);
			$CI->email->to($email_id);
			$CI->email->subject($subject);
			$CI->email->message($html);
			$CI->email->set_alt_message($html_text);
			if($CI->email->send())
			 {
				return "success";
			 }else{
				 return $CI->email->print_debugger();
			 }
			sentMailHistory($template['template_id'],$email_id,$template['user_group_id']);
			return true;
		 }
		
		return false;
	}
	
	
 /**
	* @content string
	* @param  $subject
	* @param  $email_id	
	* @description This function use for send a mail any any body like staff or client
	* @return
	* 
	*/
function sendActivationMail($email_id ,$username,$link,$templateAlias='account-activation')
{			
			$CI =& get_instance();
			$CI->load->library('parser');
			$template = loadTemplateByAlias($templateAlias,'en');
			if(!empty($template)){
			$subject= !empty($template['subject']) ? ucfirst($template['subject']) : 'Account Activation';
			$html_text =  $CI->parser->parse_string($template['template_text'], array('username' => $username,'link'=>$link ),TRUE);
			$html =  $CI->parser->parse_string($template['template'] , array('username' => $username,'link'=>$link ),TRUE);
			$config = Array(
				'protocol'	=> $CI->config->item('protocol'),
				'smtp_host'	=> $CI->config->item('smtp_host'),
				'smtp_port'	=> $CI->config->item('smtp_port'),
				'smtp_user'	=> $CI->config->item('smtp_user'), // change it to yours
				'smtp_pass'	=> $CI->config->item('smtp_pass'), // change it to yours
				'mailtype'	=> $CI->config->item('mailtype'),
				'charset'		=> $CI->config->item('charset'),
				'wordwrap'	=> TRUE
			);
       
			$CI->load->library('email');
			$CI->email->initialize($config); 
			$CI->email->set_newline("\r\n");
			$CI->email->from('tisuser@gmail.com');
			//$list = array( $email_id );
			$list = array( $email_id);
			$CI->email->to($email_id);
			$CI->email->subject($subject);
			$CI->email->message($html);
			$CI->email->set_alt_message($html_text);
			if($CI->email->send())
			 {
				return "success";
			 }else{
				 return $CI->email->print_debugger();
			 }
			sentMailHistory($template['template_id'],$email_id,$template['user_group_id']);
			return true;
		 }
		
		return false;
	}
	
/**
	* @content string
	* @param  $subject
	* @param  $email_id	
	* @description This function use for send a mail any any body like staff or client
	* @return
	* 
	*/
function sendResetPasswordMail($email_id ,$username,$link,$templateAlias='reset-password')
{			
			$CI =& get_instance();
			$CI->load->library('parser');
			$template = loadTemplateByAlias($templateAlias,'en');
			if(!empty($template)){
			$subject= !empty($template['subject']) ? ucfirst($template['subject']) : 'Reset Password';
			$html_text =  $CI->parser->parse_string($template['template_text'], array('username' => $username,'link'=>$link ),TRUE);
			$html =  $CI->parser->parse_string($template['template'] , array('username' => $username,'link'=>$link ),TRUE);
			$config = Array(
				'protocol'	=> $CI->config->item('protocol'),
				'smtp_host'	=> $CI->config->item('smtp_host'),
				'smtp_port'	=> $CI->config->item('smtp_port'),
				'smtp_user'	=> $CI->config->item('smtp_user'), // change it to yours
				'smtp_pass'	=> $CI->config->item('smtp_pass'), // change it to yours
				'mailtype'	=> $CI->config->item('mailtype'),
				'charset'		=> $CI->config->item('charset'),
				'wordwrap'	=> TRUE
			);
       
			$CI->load->library('email');
			$CI->email->initialize($config); 
			$CI->email->set_newline("\r\n");
			$CI->email->from('tisuser@gmail.com');
			//$list = array( $email_id );
			$list = array( $email_id);
			$CI->email->to($email_id);
			$CI->email->subject($subject);
			$CI->email->message($html);
			$CI->email->set_alt_message($html_text);
			if($CI->email->send())
			 {
				return "success";
			 }else{
				 return $CI->email->print_debugger();
			 }
			sentMailHistory($template['template_id'],$email_id,$template['user_group_id']);
			return true;
		 }
		
		return false;
	}
	
/**
* 
* @param undefined $template
* @param undefined $lang
* @description this function use for load the email template by the template name and template language
* @return 
*/
function loadTemplateByAlias($template,$lang=0){
	$result = array();
	if(!empty($template)){
	$CI =& get_instance();
	$CI->db->where('alias' , $template);
	$CI->db->where('status' , '1');
	$CI->db->where('lang_id' , $lang);
	$q = $CI->db->get('babes_email_templates');	
	if($q->row()){
		$row = $q->row();
		$result['template'] = (isset($row->template_content)) ? $row->template_content : '' ;
		$result['template_text'] = (isset($row->template_text)) ? $row->template_text : '' ;
		$result['subject'] = (isset($row->template_subject)) ? $row->template_subject : '';	
		$result['template_id']=$row->id;
		$result['user_group_id']=$row->user_group_id;
	  	}
	}
	return $result;
}
/**
* 
* @param undefined $template_id
* @param undefined $email_id
* 
* @return
*/
function sentMailHistory($template_id=0,$email_id=0,$group_id=null)
{ 		if(!empty($template_id)&&!empty($email_id))
		{$CI =& get_instance();
		$cit=array('template_id'=>$template_id,'email_id'=>$email_id ,'group_id'=>$group_id);
		$CI->db->insert("babes_sent_mail_history",$cit);
		}
}
?>
