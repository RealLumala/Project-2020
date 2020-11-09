<?php 
    if(isset($_SESSION['username'])){        
        echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=views/dashboard.php' />"; 
    }
    include_once('./api_controller/db_connection.php'); 
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>e-intelligence</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <!-- Fonts -->
        <!-- Lato -->
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/css/ionicons.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/css/owl.carousel.css">
        <link rel="stylesheet" href="css/css/animate.css">
        <link rel="stylesheet" href="css/css/main.css">
        <!-- Responsive Stylesheet -->
        <link rel="stylesheet" href="css/css/responsive.css">
    </head>
    <body id="body">
    	<div id="preloader">
    		<div class="book">
    		  <div class="book__page"></div>
    		  <div class="book__page"></div>
    		  <div class="book__page"></div>
    		</div>
    	</div>
	    <!-- 
	    Header start
	    ==================== -->
	    <div class="navbar-default navbar-fixed-top" id="navigation">
	        <div class="container">
	            <!-- Brand and toggle get grouped for better mobile display -->
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
                        <a class="navbar-brand" href="index.php">
                        <img class="logo-1" src="css/images/logo.png" alt="LOGO">
	                    <img class="logo-2" src="css/images/logo-2.png" alt="LOGO">
	                </a>
	            </div>

	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <nav class="collapse navbar-collapse" id="navbar">
	                <ul class="nav navbar-nav navbar-right" id="top-nav">
	                    <li><a href="#ranking">University Ranking</a></li>
                            <li><a href="sign_in.php?login=">Login</a></li>
                            <li><a href="sign_up.php">Create Account</a></li>
	                </ul>
	            </nav><!-- /.navbar-collapse -->
	        </div><!-- /.container-fluid -->
	    </div>