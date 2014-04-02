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
    <link href="<?php echo base_url("css/main.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">

    <!-- Jquery, UI, BS - Loaded early to ensure smoothness -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="<?php echo base_url("js/bootstrap311/bootstrap.min.js"); ?>"></script>

	</head>

	<body>
		

	 <!-- Side Menu -->
    <a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="fa fa-bars"></i></a>
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">Menu </li>
            <li><a href="<?php echo site_url(); ?>">Home</a></li>

            <!-- Log in / Log Out -->
                <?php 
                    //  user is already signed in: show Logout (auth/logout)
                    // user not already signed in: show Login  (auth/login)
                $auth_action_href = '';
                $auth_action_text = '';
                if ($this->tank_auth->is_logged_in()) {
                    $auth_action_href = site_url('auth/logout');
                    $auth_action_text = 'Logout';
                }else{

                    $auth_action_href = site_url('auth/login');
                    $auth_action_text = 'Login';
                }

                 ?>
            <li><a href=<?php echo $auth_action_href; ?>> <?php echo $auth_action_text;  ?></a></li>
             <!-- ! Log in / Log Out -->

             <!-- Link to Dashboard -->
            <li><a href="<?php echo site_url("event/dashboard") ?>">Dashboard</a></li>



            <!-- On-going event 
                example:

                    In Event: 
                    EventName [Leave | Home]
                        Members: Bob   [options: message | see info | etc]
                                 Sue   [options: message | see info | etc]
                                 Tom   [options: message | see info | etc]
                                 Sally [options: message | see info | etc]


            -->
        </ul>
    </div>
    <!-- /Side Menu -->