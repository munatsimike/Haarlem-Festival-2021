<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
	if ( ! isset($_SESSION)) session_start();

	if (Cart::getCartItems() ==  null || Cart::getCartTotal() == 0) {
		header("location: /../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once '../partials/head.php';
			 require_once '../alert.php';
		?>
		<title>checkout form</title>
	</head>
	<header>
		<?php
			if (isset($_GET['error']) && $_GET['error'] === 'error') {
				echo "<script> showAlert('Error ! failed to connect to remote server. Try again or contact support','error');</script>";
			}
		?>
	</header>
	<body >
	  	<div class='container-fluid'>
			<div class="py-2 text-center">
			<div class="progress">
			<div class="progress-bar progress-bar-striped active  progress-bar-animated" role="progressbar"
				aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:70%">
				70%
			</div>
				<img class="Logoright" src="/Img/logo.png" alt="logo"  title ="logo"/>
			</div class="row justify-content-center">
				<h2>Haarlem Festival</h2>
			</div>
			<div class="row justify-content-center">
				<div class ='col-md-5 order-md-1'>
					<div class="row justify-content-center">
						<h2>Your Cart</h2>
					</div>
					<table class="table">
						<thead>
							<tr>
							<th scope="col">Qty</th>
							<th scope="col">Description</th>
							<th scope="col">Price</th>
							<th scope="col">Total</th>
							</tr>
						</thead>

						<?php

						$_SESSION['subtotal'] = Cart::getCartTotal();
						$_SESSION['tax'] = $_SESSION['subtotal'] * $_SESSION['taxRate'];
						$_SESSION['total'] = $_SESSION['tax'] + $_SESSION['subtotal']; 
						
						foreach (Cart::getCartItems() as $item) {
						echo  "<tr>
								<td>$item->quantity</td>
								<td>" . $item->title . "" . $item->description . "</td>
								<td>€ $item->unitPrice</td>
								<td>€". $item->getSubTotal()."</td>
							</tr>";
							}
						?>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>SubTotal</td>
							<td><h6><?php echo "€".$_SESSION['subtotal']?></h6></td>
						</tr>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>Tax 15%</td>
							<td><h6><?php echo "€".$_SESSION['tax']?></h6></td>
						</tr>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>Total</td>
							<td><h6><?php echo "€".$_SESSION['total']?><h6></td>
						</tr>
					</table>
				</div>	
				<div class="col-md-1 order-md-2"></div>
				<div class="customer-details col-md-4 order-md-2 mb-4">
					<div class="row justify-content-center">
					    <h3 class="mb-2 mt-2">Checkout Form</h3>
					</div>
				    <div class="row justify-content-center">
					    <h5 class="mb-2 mt-2">Your Details</h5>
					</div>
					<p>Details provided to this form will appear on the invoice that will be sent to the provided email address</p>
					<form action = "../../Service/createPayment.php" id = "checkout-form" method = "POST">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="firstname">First name</label>
								<input type="text" name = "firstname" class="form-control" id="firstname" placeholder="">
							</div>
							<div class="col-md-6 mb-3">
								<label for="lastname">Last name</label>
								<input type="text" name ="lastname" class="form-control" id="lastname" placeholder="">
							</div>
						</div>

						<div class="mb-3">
							<label for="email">Email</label>
							<input type="email" id="email" name="email"class="form-control" id="email" placeholder="you@example.com">
						</div>

						<div class="mb-3">
							<label for="confirm-email">Confirm Email</label>
							<input type="email" name="confirm_email" id="confirm-email" class="form-control" id="confirm-email" placeholder="you@example.com">
						</div>
						<button class="btn text-white btn-lg btn-block btn-primary" type="submit"><i class="bi bi-credit-card-fill" id="checkoutIcon"></i>Proceed to checkout</button>
						<button onclick ="location.href='../../index.php'" class="btn btn-lg btn-block mb-3 cancel-btn" type="button">Cancel</button>
					</form>
				</div>
			</div>
	</body>
</html>
<script>
$(function() {

	$("#checkout-form").validate({
		// Specify validation rules
		rules: {
			firstname: "required",
			 lastname: "required",

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
			firstname: "Please enter your first name",
			 lastname: "Please enter your last name",

			email: {
				required:"Please enter your email so that we can send you your receipt",
			  	   email: "Invalid email format"
			},
				
			confirm_email: {
						equalTo: "Emails do not match",
					   required: "Please confirm your email address"
			} 
		},

		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}

	});
});
</script>
