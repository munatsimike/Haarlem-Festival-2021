<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
if (!isset($_SESSION)) session_start();

// Check if the user is logged in, if not then redirect to index page
if ( ! isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../index.php");
    exit;
}

?>
<html>
	<head>
		<?php include '../partials/head.php'?>
		<title>Haarlem festival CMS</title>
	</head>
	<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
	<ul>
		<li><a href="#" data-target="#logoutModal" data-toggle = "modal" > <?php echo"Logout"." "."<i class='bi bi-box-arrow-right' style='font-size: 1.6rem'></i>";?></a></li>
		<li><a href="#"> <?php echo "<span>".$_SESSION['username']." "."<i class='bi bi-person-circle' style='font-size: 1.6rem'></i>";?></a></li>
		<li><a href="#"  data-target="#registration" data-toggle = "modal" >Add Volunteer</a></li>
	</ul>
		<header class="header">
		<!--for background image-->
		<!-- the good header -->
		</header>
	<body>
		<?php 
		require_once "logoutModal.php"; 
		require_once "registration.php";
		?>
	</body>
</html>
