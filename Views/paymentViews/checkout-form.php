<?php
	require '../../myAutoLoader.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once '../partials/head.php'?>
		<title>payment</title>
	</head>
	<body >
	  	<div class='container-fluid'>
			<div class="py-2 text-center">
			<div class="progress">
			<div class="progress-bar progress-bar-striped active" role="progressbar"
				aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:70%">
				70%
			</div>
			</div class="row justify-content-center">
				<h2>Checkout Form</h2>
			</div>
			<div class="row justify-content-center">
				<div class ='col-md-5 order-md-3'>
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
						$tax = Cart::getCartTotal() * $_SESSION['taxRate'];
						$total = $tax + Cart::getCartTotal();
						$_SESSION['total'] = $total;
						$_SESSION['tax'] = $tax;
						foreach (Cart::getCartItems() as $item) {
						echo  "<tr>
								<td>$item->quantity</td>
								<td>$item->description</td>
								<td>€ $item->unitPrice</td>
								<td>€ $item->subTotal</td>
							</tr>";
							}
						?>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>SubTotal</td>
							<td><h6><?php echo "€".(Cart::getCartTotal())?></h6></td>
						</tr>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>Tax 15%</td>
							<td><h6><?php echo "€".$tax?></h6></td>
						</tr>

						<tr class='no-bottom-border'>
							<td colspan ='2'></td>
							<td>Total</td>
							<td><h6><?php echo "€".$total?><h6></td>
						</tr>
					</table>
				</div>	
				<div class="col-md-1 order-md-2"></div>
				<div class="customer-details col-md-4 order-md-1 mb-4">
				    <div class="row justify-content-center">
					    <h4 class="mb-2 mt-2">Customer Details</h4>
					</div>
					<p>Details provided to this form will appear on the invoice that will be sent to the provided email address</p>
					<form action = "checkout.php" id = "checkout-form" method = "POST">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="firstName">First name</label>
								<input type="text" name = "firstName" class="form-control" id="firstName" placeholder="" value="">
							</div>
							<div class="col-md-6 mb-3">
								<label for="lastName">Last name</label>
								<input type="text" name ="lastName" class="form-control" id="lastName" placeholder="" value="">
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
						<button class="btn text-white btn-lg btn-block checkout-btn" type="submit">Continue to checkout</button>
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
			firstName: "required",
			lastName: "required",
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
				firstName: "Please enter your first name",
				lastName: "Please enter your last name",
				confirm_email: "Emails do not match"
		},

		// Make sure the form is submitted to the destination defined
		submitHandler: function(form) {
		form.submit();
		}

	});
});
</script>
