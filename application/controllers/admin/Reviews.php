<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reviews extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/Review_model');
        $this->load->model('admin/User_auth_model');
        if (!$this->User_auth_model->loggedIn()) {
            redirect('admin/auth/login', 'refresh');
        }
        $user_info =$this->User_auth_model->loggedInUser();
        $this->user_id  = $user_info->id;
        $userPermissions = getUserPermission($this->user_id);
        $this->permission = array_key_exists(6,$userPermissions);
        if(empty($this->permission)){
			setMessage('You are not Authorized to this page!','danger');
			redirect('admin/dashboard');
		}
		$this->permissionValue = $userPermissions[5];
        $this->lang->load('auth');
        $this->PageTitle = 'Review Management';
        $this->limit = 10;
    }

	
    /**
     * @Function		-: index()
     * @Description		-: This function used for display Clients Reviews
     * @Created on		-: 04-08-2016
     * @Param			-: No Parameter
     * 
     */ 
	public function index($offset = 0){
        $data = array(
            'title' => 'Clients  Reviews',
            'list_heading' => 'Clients  Reviews',
            'breadcrum' => '<li><a href="'.base_url('admin/reviews/').'">Clients Reviews</a></li>',
        );
		try{
			$postData = $this->input->post();
			$postData = removeExtraspace($postData);
			if(!empty($postData)){
				$clients	= (!empty($postData['client'])) ? $postData['client'] : '';
				$staff		= (!empty($postData['staff'])) ? $postData['staff'] : '';
				$approve	= (!empty($postData['approve'])) ? $postData['approve'] : '';
				if($clients){
					$this->session->set_userdata('client',$clients);
				}
				if($staff){
					$this->session->set_userdata('staff',$staff);
				}
				$this->session->set_userdata('approve',$approve);
			}
			if($this->input->post('reset')){
				$this->session->unset_userdata('client');
				$this->session->unset_userdata('staff');
				$this->session->unset_userdata('approve');
			}
			//****** Serach form value in session ******//
			$client		=  $this->session->userdata('client');
			$staff		=  $this->session->userdata('staff');
			$approve	=  $this->session->userdata('approve');
			$data['searchClient'] = $client; $data['searchStaff'] = $staff;$data['searchApprove'] = $approve;
			//****** Serach form value in session ******//
			$totalRow=$this->Review_model->getAllReviews($client,$staff,$approve,NULL);
			$config = array();
			$data['totalRecords'] = $totalRow;
			$data['limit'] = $this->limit;
			$config["base_url"] = base_url('admin/reviews/index');
			$config["total_rows"] = $totalRow;
			$config["per_page"] = $this->limit;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] = $totalRow;
			$config['cur_tag_open'] = '<li class="table-red paginate_button active" ><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="paginate_button" >';
			$config['num_tag_close'] = '</li>';
			$config['full_tag_open'] = '<li class="paginate_button">';
			$config['full_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="paginate_button next">';
			$config['prev_tag_open'] = '<li class="paginate_button previous">';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_close'] = '</li>';
			$config['num_tag_open'] = '<li class="paginate_button" >';
			$config['num_tag_close'] = '</li>';
			$config['last_tag_close'] = '<li class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$this->pagination->initialize($config);
			if($offset > 1){
				$page = ($offset - 1) * $this->limit;
			}
			else{
				 $page = $offset;
			}
			$data['recordsFrom'] = $page;
			$str_links = $this->pagination->create_links();
			$data["links"] = $str_links;
			$page = (empty($page)) ? 'A' : $page;
			$results = $this->Review_model->getAllReviews($client,$staff,$approve,$page);
			$data['reviews'] = $results;
			$this->template->load('admin/base', 'admin/reviews/index', $data);
		}catch(Exception	$ex){
			log_message('error',' Unable to listing of clients reviews '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: removeReview()
	 * @Description		-: This function used for remove client review basis on review id
	 * @Param			-: No Parameter
	 * @Created on		-: 05-08-2016
	 */ 
	public function removeReview(){
		try{
			$returnArray = array();
			$msg = "";
			$status = "No";
			$reviewId = $this->input->post('reviewId');
			if(is_numeric($reviewId)){
				$remove = $this->Review_model->where('id',$reviewId)->delete();
				if($remove){
					$msg = "Client review successfully removed";
					$status = "Yes";
				}
			}else{
					$msg = "Client review id not valid";
					$status = "No";
			}
			$returnArray['msg'] = $msg; $returnArray['status'] = $status;
			echo json_encode($returnArray);die;
		}catch(Exception	$ex){
			log_message('error','Unable to remove client review '.$ex->getMessage());
		}
	}
	
	/**
	 * @Function		-: manageReviewApproval()
	 * @Description		-: This function used for managed client review approval
	 * @Param			-: No Parameter
	 * @Created on		-: 05-08-2016
	 * @Return			-: array()
	 */ 
	public function manageReviewApproval(){
		try{
			$returnArray = array();
			$msg = "";
			$stt = "No";
			$reviewId = $this->input->post('reviewId');
			$status = $this->input->post('status');
			if(is_numeric($reviewId)){
				$update = $this->Review_model->where('id',$reviewId)->update(array('approval'=>$status));
				if($update){
					if($status==1){
						$msg = "Client review successfully published";
					}else{
						$msg = "Client review successfully unpublished";
					}
					$stt = "Yes";
				}
			}else{
					$msg = "Client review id not valid";
					$stt = "No";
			}
			$returnArray['msg'] = $msg; $returnArray['status'] = $stt;
			echo json_encode($returnArray);die;
		}catch(Exception	$ex){
			log_message('error','Unable to manage client review approval '.$ex->getMessage());
		}
		
	}

}
