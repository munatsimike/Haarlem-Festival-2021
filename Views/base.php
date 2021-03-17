<?php
	include 'ti.php';
	include_once 'myAutoLoader.php';
	require_once 'header.php';
?>
	<body>
		<div class = "card border-0">
			<div class = " row mt-2 justify-content-center">
				<?php startblock('title')?>
				<?php endblock()?>
			</div>
			<?php emptyblock('main')?>
		</div>
		<div>
			<?php include 'Views/cart/view-cart-items.php'?>
		</div>
		<div id='footer' class = "mt-4">
			<?php startblock('footer') ;
				include_once 'footer.php'
			?>
			<?php endblock()?>
		</div>
	</body>
</html>

