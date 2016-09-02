<?php  $this->load->view('frontend/top');
		$this->load->view('frontend/header');
		$static_content=getStaticPageContent('privacy&policy');
echo '<div class="container">'.$static_content['fullpage-content'].'</div>';
	$this->load->view('frontend/footer');
	$this->load->view('frontend/bottom');
?>
