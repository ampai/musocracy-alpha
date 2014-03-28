<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Musocracy collaborative playlist service">
    <meta name="author" content="Musocracy Team">

    <title>Musocracy Alpha</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap311/bootstrap.min.css"); ?>">
    <!-- <link href="css/bootstrap.css" rel="stylesheet"> -->

    <!-- Custom CSS and FontAwesome -->
    <!-- Photo Credits
		Awesome Speaker Background: Billy Alexander - http://www.sxc.hu/profile/ba1969 

     -->
    <link href="<?php echo base_url("css/stylish-portfolio.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">

    <!-- Jquery - Loaded early -->
    <script src="http://code.jquery.com/jquery.js"></script>
	</head>

	<body>
		

	 <!-- Side Menu -->
    <a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="fa fa-bars"></i></a>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">Menu
            </li>
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li><a href="<?php echo site_url("auth/login"); ?>">Login</a></li>
           
        </ul>
    </div>
    <!-- /Side Menu -->