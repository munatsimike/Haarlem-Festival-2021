<?php
	include_once '../base.php';

	$bundleTicketController = new BundleTicketController();
	$danceController = new DanceController();

	try {
		$tickets = $danceController->fetchDanceTickets();
		$bundleTickets = $bundleTicketController->fetchBundleTickets(EventName::DANCE());
	} catch (ConnectionFailedException | Exception $error) {
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
				<?php EventOption::displayEventDates($tickets,"dance.php")?>
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

					<a class="twitter-timeline" data-lang="en" data-height="2100" href="https://twitter.com/tiesto?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor">Tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
		<?php endblock('main') ?>