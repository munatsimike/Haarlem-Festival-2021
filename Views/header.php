
<?php 
session_set_cookie_params(0);
session_start();
$link_address = "";
?>
<html>
	<head>
		<?php include 'partials/head.php'?>
		<title>Haarlem festival</title>
	</head>
	<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
	<?php if( ! isset($_SESSION['cartItems'])) {
			$_SESSION['cartItems'] = [];
			$_SESSION['taxRate'] = 0.15;
		} 
		?>
	<ul>
		<li><a href="">EN</a></li>
		<li><a href="<?php echo $link_address;?>#" title="View Cart" id="icart"> <?php echo "<span>".count($_SESSION['cartItems'])."<i class='bi bi-cart4'style='font-size: 1.6rem'></i>";
					?></a></li>
		<li><a href="<?php echo $link_address;?>/Views/dance/dance.php">Dance</a></li>
		<li><a href="<?php echo $link_address;?>/Views/jazz/jazz.php">Jazz</a></li>
		<li><a href="/index.php">Home</a></li>
	</ul>
		<header class="header">
		<!--for background image-->
		<!-- the good header -->
		</header>
