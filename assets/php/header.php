<?php
 require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhammad Ikram Rafi">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | Coding</title>
	<link rel="stylesheet" type="text/css"href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css"/>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap');
		*{
			font-family: 'Maven Pro', sans-serif;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		<!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;Coding</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
    	    <ul class="navbar-nav ml-auto">
    		    <li class="nav-item">
    			    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php")? "active":""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
    		    </li>
                <li class="nav-item">
                  <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php")? "active":""; ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "feedback.php")? "active":""; ?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "notification.php")? "active":""; ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
                </li>
                <li class="nav-item dropdown">
                	<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                		<i class="fas fa-user-cog"></i>&nbsp;Hi! <?= $fname; ?>	
                	</a>
                	<div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i>&nbsp;Setting</a>
                        <a class="dropdown-item" href="assets/php/logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>