<?php
	include_once '../base.php';

	$bundleTicketController = new BundleTicketController(EventName::DANCE());
	$danceController = new DanceController();

	try {
		$tickets = $danceController->fetchDanceTickets();
		$bundleTickets = $bundleTicketController->fetchBundleTickets();
	} catch (Exception $error) {
		new ErrorLog($error->getMessage());
		echo "<script> showAlert('Error ! failed to connect to remote server. Try again or contact support','error');</script>";
		return;
	}


	$date = $_GET['date'] ?? null;
?>
		<?php startblock('title')?>
		 	<h2>Haarlem Festival Dance<h2>
		<?php endblock('title') ?>

		<?php startblock('main') ?>
			<div class = "row justify-content-center m-3">
				<?php EventOption::displayEventDates($tickets)?>
			</div>
			<div class = "row justify-content-center">
				<div class = "col-7 single-tickets">
					<?php EventOption::displayTickets(isset($date) ? EventOption::filterTickets($tickets, $date) : $tickets);?>
				</div>

				<div class = "col-4 ml-4">
					<div class = "timeTable row justify-content-center mt-3 ">
						<h4>Promo Tickets</h4>
						<div class = "row p-4">
						<?php EventOption::displayMultipleEventTickets($bundleTickets)?>
					</div>
					
					</div>
					<hr size = "30" noshade> 
					<div class = "row justify-content-center mt-3">
						<h4>Dance Time Table</h4>
					</div>

					<div class = "row pl-3" >
						<?php EventOption::displayTimeTable($tickets);?>
					</div>
				</div>
			</div>
		<?php endblock('main') ?>