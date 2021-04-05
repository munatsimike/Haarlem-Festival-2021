<?php
	include_once '../base.php';

	$bundleTicketController = new BundleTicketController();
	$jazzController = new JazzController();

	try {
		$tickets = $jazzController->fetchJazzTickets();
		$bundleTickets = $bundleTicketController->fetchBundleTickets(EventName::JAZZ());
	} catch (Exception $error) {
		new ErrorLog($error->getMessage());
		echo "<script> showAlert('Error ! failed to connect to remote server. Try again or contact support','error');</script>";
		return;
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

				<div class = "col-4 ml-4">
					<div class = "timeTable row justify-content-center mt-3 ">
						<p><h3>Promo Tickets</h3></p>
					<div class = "row p-4">
						<?php EventOption::displayMultipleEventTickets($bundleTickets)?>
					</div>
				</div>

					<hr size = "30" noshade> 
					<div class = "row justify-content-center mt-3">
						<h4>Jazz Time Table</h4>
					</div>

					<div class = "row pl-3 " >
						<?php EventOption::displayTimeTable($tickets);?>
					</div>

					<hr size = "30" noshade> 
					<div class = "row justify-content-center mt-3">
						<h4>You may also like</h4>
					</div>

					<div class = "row justify-content-center" >
						<div class = "col-11">
						<a href = "../dance/dance.php"><h4 class = "otherEventsH4">Dance</h4></a>
						<article class="article1">
							<div class = "eventImg">
								<a href = "../dance/dance.php" class = "otherEventsLink"><img src="../../Img/d22.jpg" alt="product 1"  title ="image of dance"/></a>
							</div>
						</article>
						</div>

						<div class = "col-11">
						<a href= "#"><h4 class = "otherEventsH4">Food</h4></a>
						<article class="article1">
							<div class = "eventImg">
								<a href= "#" class = "otherEventsLink" ><img src="../../Img/food.jpg" alt="product 1"  title ="image of food"/></a>
							</div>
						</article>
						</div>

						<div class = "col-11">
						<a href = "#"><h4 class = "otherEventsH4">Historic Tour</h4></a>	
						<article class="article1">
							<div class = "eventImg">
							<a href = "#"class = "otherEventsLink" ><img src="../../Img/h.jpg" alt="product 1"  title ="image of Grote Markte"/></a>							</div>
						</article>
						</div>

					</div>
				</div>
			</div>
		<?php endblock('main') ?>
