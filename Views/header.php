
<?php 
session_set_cookie_params(0);
session_start();
$link_address = "";
?>
<html>
	<head>
		<?php
		 include 'partials/head.php';
		 require_once 'alert.php';
		?>

		<title>Haarlem festival</title>
	</head>
	<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
	<?php if( ! isset($_SESSION['cartItems'])) {
			$_SESSION['cartItems'] = [];
			$_SESSION['taxRate'] = 0.15;
		} 
		?>
		<nav id="nav">
			<ul>
				<li><a href="#">EN</a></li>
				<li data-target='#cart-modal' data-toggle = 'modal' ><a href=#> <?php echo "<span>".count($_SESSION['cartItems'])."<i class='bi bi-cart4' id='cart-icon'></i>";
							?></a></li>
				<li><a href="<?php echo $link_address;?>/Views/dance/dance.php">Dance</a></li>
				<li><a href="<?php echo $link_address;?>/Views/jazz/jazz.php">Jazz</a></li>
				<li><a href="/index.php">Home</a></li>
			</ul>
				<header class="header">
				<!--for background image-->
				<!-- the good header -->
				</header>
		</nav>
