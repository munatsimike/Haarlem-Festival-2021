<?php
	include_once '../base.php';

	try {
		$tickets = JazzController::jazzController()->fetchJazzTickets();
	} catch (ConnectionFailedExecption $mesg) {

	}

	$date = $_GET['date'] ?? null;
?>
		<?php startblock('title')?>
		 	<h2>Haarlem Festival Jazz<h2>
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
