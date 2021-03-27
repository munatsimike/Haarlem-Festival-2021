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
			<?php 
				include 'cart/view-cart-items.php';
				include 'login/login-registration.php';
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
	
	  // check for valid quantity. greater than 0 and less than available seats
	  $('.quantity').change(function() {
		const $row = $(this).closest('tr');
		const $seats = $row.find('.seats').text();
	  	const $qty = $(this).val();

		if ($qty > $seats) {
			$(this).val($seats);
			alert("not enough tickets available");
		}
		
		if ($qty <= 0) {
			$(this).val(1);
		}
		
	  });

	  $('.add-to-cart-btn, .trash').click(function ($event) {
		const $row = $(this).closest('tr');
		const $id = $.trim($row.find('.id').val());

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

			$var = JSON.stringify({'id':$id, 'title':$title, 'quantity':$quantity,  'price':$price});
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

		// show cart ,loginmodal or login
	$('#icart, #login, .footer').click(function($event){
		 $event.preventDefault();

		 if ($(this).attr('id') ==='login') {
			$('#login-registration').modal('show');
		 } else if ($(this).attr('class') === 'footer') {
			$('#login').toggle();
		 } else {
			$('#cartModal').modal('show');
		 }

	  });

		// validate login and registration
		$("#registration").validate({
		// Specify validation rules
		rules: {
			userName: "required",
			password: "required",
			phone: "required",

			email: {
				required: true,
				email: true
			},

			confirm_email: {
				required: true,
				equalTo: "#email"
			},
		},
		// Specify validation error messages
		messages: {
				userName: "Please enter your first name",
				password: "Please enter your last name",
				phone: "Emails do not match"
		},

		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}

	});

	  });
</script>

