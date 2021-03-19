<?php
	include_once 'Views\base.php';

	try {
		$tickets = JazzEventController::jazzController()->fetchJazzTickets();
	} catch (ConnectionFailExecption $mesg) {

	}

	$date = $_GET['date'] ?? null;
?>
		<?php startblock('title')?>
		 	<h2>Festival Jazz<h2>
		<?php endblock('title') ?>

		<?php startblock('main') ?>
			<div class = "row justify-content-center m-3">
				<?php EventOption::displayEventDates($tickets)?>
			</div>
			<div class = "row justify-content-center">
				<div class = "col-7 single-tickets">
					<?php EventOption::displayTickets(isset($date) ? EventOption::filterTickets($tickets, $date) : $tickets);?>
				</div>
			<div class = "timeTable col-3 ml-4">
				<div class = "row justify-content-center mt-3 ">
					<h4>Promo Tickets 80% Off</h4>
				</div>
				<div class = "row p-3">
				  	<?php //EventOption::displayMultipleEventTickets()?>
				</div>
				<hr size = "30" noshade> 
					<div class = "row justify-content-center mt-3">
						<h4>Jazz Time Table</h4>
					</div>
					<div class = "row pl-4" >
						<?php EventOption::displayTimeTable($tickets);?>
					</div>
				</div>
			</div>
		<?php endblock('main') ?>
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
			
			$cartItem = JSON.stringify({'id':$id});
			$action = 'deleteCartItem';
			$row.hide();
			
		 }

		 // add item to cart
		 if ($(this).attr('name') === 'cart-btn') {
			const $row = $(this).closest('tr');
			const $description = $.trim($row.find('.description').text());
			const $price = $.trim($row.find('.price').text()).substr(1);
			const $id = $.trim($row.find('.id').val());
			const $quantity = $.trim($row.find('.quantity').val());

			$cartItem = JSON.stringify({'id':$id, 'description':$description, 'quantity':$quantity,  'price':$price});
			$action = 'addToCart';
		 }
		
		$.ajax({
				type : 'post',
				url : 'Controllers/CartController/CartController.php?action='+$action,
				data : {'cartItem': $cartItem},
			}).done(function () {
				location.reload();
			}).fail(function (jqXHR, textStatus, errorMessage) {
				alert('Failed to add item to cart');
			})
        });
	  });
</script>
