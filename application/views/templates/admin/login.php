<!DOCTYPE html>
<html lang="en" id="extr-page">
    <head>
        <title><?php echo $title; ?></title>
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
        <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/admin/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url(); ?>assets/admin/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    </head>

    <body class=" desktop-detected pace-done">

        <?php $this->load->view('themes/admin/login_header'); ?>

        <?php echo $body; ?>
        <?php $this->load->view('themes/admin/login_footer'); ?>

        <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/jquery-validate/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/app.config.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/app.min.js"></script>

    </body>

</html>
