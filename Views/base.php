<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

	include 'ti.php';
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
			<?php include 'view-cart-items.php'?>
		</div>
		<div id='footer' class = "mt-4">
			<?php startblock('footer') ;
				include_once 'footer.php'
			?>
			<?php endblock()?>
		</div>
	</body>
</html>
<script>
  $(function(){

	// show cart modal
	$('#icart').click(function(event){
		 event.preventDefault();
		$('#cartModal').modal('show');
	  });

	  // check for valid quantity. greater than 0 and less than available seats
	  $('.quantity').change(function(){
		const $row = $(this).closest('tr');
		const seats = $row.find('.seats').text();
	  	const qty = $(this).val();

		if (qty > seats) {
			$(this).val(seats);
		}
		
		if (qty <= 0) {
			$(this).val(1);
		}
		
	  });

	  $('.add-to-cart-btn, .trash').click(function (event){

		//delete an item
		 if ($(this).attr('name') === 'trash') {
			const $row = $(this).closest('tr');
			const $id = $.trim($row.find('.id').text());
			
			$var = JSON.stringify({'id':$id});
			$action = 'deleteCartItem';
			$row.hide();
			$error = "Failed to remove item from cart";
		 }

		 // add item to cart
		 if ($(this).attr('name') === 'cart-btn') {
			const $row = $(this).closest('tr');
			const $description = $.trim($row.find('.description').text());
			const $price = $.trim($row.find('.price').text()).substr(1);
			const $id = $.trim($row.find('.id').val());
			const $quantity = $.trim($row.find('.quantity').val());

			$var = JSON.stringify({'id':$id, 'description':$description, 'quantity':$quantity,  'price':$price});
			$action = 'addToCart';
			$error = "Failed to add item to cart";
		 }
		
		$url = 
		$.ajax({
				type : 'post',
				url : '/Controllers/CartController/CartController.php?action='+$action,
				data : {'var': $var},
			}).done(function () {
				//alert(http_response_code);
				location.reload();
			}).fail(function (jqXHR, textStatus, errorMessage) {
				alert($error);
			})
        });
	  });
</script>

