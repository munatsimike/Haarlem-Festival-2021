<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

	include 'ti.php';
	require_once 'header.php';
	// display login error 
	if (isset($_SESSION['validCredentials'])) {
		if ( $_SESSION['validCredentials'] === false) {
			echo "<script> showAlert('Error ! Login failed invalid credentials','error');</script>";
		} else {
			// send exception error to email
			error_log($_SESSION['validCredentials'], 1, "hfestival21@gmail.com");
			echo "<script> showAlert('Error ! Internal server error If the problem persist contact support','error');</script>";
		}
		unset($_SESSION['validCredentials']);
	}
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
			<?php 
				include 'cart/view-cart-items.php';
				include 'CMS/login-modal.php';
			?>
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
	
	// highlight active page on the nav menu
	$('#nav li a').each(function () {
			path = $(this).prop('href');
            if (path == window.location.href && path.substr(-1) != "#") {
                $(this).addClass('active');
            }
        });

	  // check for valid quantity. greater than 0 and less than available seats
	  $('.quantity').change(function() {
		const $row = $(this).closest('tr');
		const $seats = parseInt($row.find('.seats').text());
	  	const $qty = $(this).val();

		if ($qty > $seats) {
			$(this).val($seats);
			alert("not enough tickets available");
		} 
		else if ($qty <= 0) {
			$(this).val(1);
		}
		
	  });

	  $('.add-to-cart-btn, .trash, .cartQuantity').click(function ($event) {
		const $row = $(this).closest('tr');
		const $id = $.trim($row.find('.id').val());

		//change quantity
		 if ($(this).attr('name') === 'cartQuantity') {
			
			const $qty = $.trim($row.find('.cartQuantity').val());
			const $cartId = $.trim($row.find('.cartId').val());
			$action = 'updateItemQuantity';
			$error = "something went wrong";
			$var = JSON.stringify({'cartId':$cartId, 'quantity':$qty});
		 }

		//delete an item
		 if ($(this).attr('name') === 'trash') {
			
			$var = JSON.stringify({'id':$id});
			$action = 'deleteCartItem';
			$row.hide();
			$error = "Failed to remove item from cart";
		 }

		 // add item to cart
		 if ($(this).attr('name') === 'cart-btn') {
			const $title = $.trim($row.find('.title').text());
			const $price = $.trim($row.find('.price').text()).substr(1);
			const $quantity = $.trim($row.find('.quantity').val());
			const $seats = parseInt($.trim($row.find('.seats').text()));

			$var = JSON.stringify({'id':$id, 'title':$title, 'quantity':$quantity,  'price':$price, 'seats':$seats});
			$action = 'addToCart';
			$error = "Failed to add item to cart";
		 }
		
		$.ajax({
				type : 'post',
				url : '/Controllers/CartController/CartController.php?action='+$action,
				data : {'var': $var},
			}).done(function (response) {
				data = JSON.parse(response);
				if (data.action === 'addToCart') {
					location.reload();
				} else {
					$('#price').text(data.total);
				}
			}).fail(function (jqXHR, textStatus, errorMessage) {
				alert($error);
			})
        });

		//refreshes page on cart close
		$('#cart-modal').on('hidden.bs.modal', function (e) {
			location.reload();
		})
		// show cart ,login or login
	$('.footer').click(function($event){
		 $event.preventDefault();

	    if ($(this).attr('class') === 'footer') {
			$('#login-icon').toggle();
		 }
	  });

		// validate login and registration
		$("#login").validate({
		// Specify validation rules
		rules: {
			email: {
				required: true,
				email: true
			},
			password: "required"
		},
		// Specify validation error messages
		messages: {
				email: {
					email: "Enter a valid email",
					require: "Enter your email"
				},

				password: "Enter your password"
		},

		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}

	});

	  });
</script>

