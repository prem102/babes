<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title><?=(!empty($title)) ? $title : 'Bebes Direct'; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
        <!-- END META SECTION -->
        <!-- BEGIN MANDATORY STYLE -->
        <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/smartadmin-production-plugins.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/smartadmin-production.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/smartadmin-skins.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/css/smartadmin-rtl.min.css" rel="stylesheet">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>assets/admin/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
        
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/admin/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/admin/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/admin/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/admin/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/admin/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo base_url(); ?>assets/admin/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        
        
    </head>

    <body class="desktop-detected pace-done">

        <?php $this->load->view('themes/admin/header'); ?>
        
        <?php $this->load->view('themes/admin/side-menu'); ?>
	<div id="main" role="main">

		<div class="row">
					<!-- NEW WIDGET START -->
					<article class="col-sm-12 alert-message-base" id="show_alert_message">
			<?php 
				if($this->session->userdata('message_type')){
			?>
						<div class="alert alert-<?=$this->session->userdata('message_type');?> fade in">
							<button data-dismiss="alert" class="close">&Cross;</button>
							<i class="fa-fw fa fa-<?=$this->session->userdata('message_type');?> "></i>
							<strong><?php echo ucfirst($this->session->userdata('message_type'));?></strong>
							<?=$this->session->userdata('message');?>
						</div>
			<?php } ?>
					</article>
					<!-- WIDGET END -->
		</div>
		<?php 
		echo $body;
			if ($this->session->userdata('message_type') != '') {
				$this->session->unset_userdata('message_type');
			}
			if ($this->session->userdata('message') != '') {
				$this->session->unset_userdata('message');
			}
			$this->session->set_userdata('message', '');
			$this->session->set_userdata('message_type', '');
       ?>
        <?php $this->load->view('themes/admin/footer'); ?>
        </div>
        
        <script src="<?php echo base_url(); ?>assets/admin/js/app.config.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/parsley/parsley.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/notification/SmartNotification.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/sparkline/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/select2/select2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/fastclick/fastclick.min.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/admin/js/app.config.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/flot/jquery.flot.cust.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/flot/jquery.flot.resize.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/flot/jquery.flot.time.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
        
        <!-- Full Calendar -->
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/moment/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/app.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/application.js"></script>
        
    </body>

</html>
