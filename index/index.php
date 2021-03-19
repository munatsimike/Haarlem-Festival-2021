<?php
	include_once 'myAutoLoader.php';
	$jazzTickets = JazzEventController::jazzController()->fetchJazzTickets();
	require_once 'views/header.php';
	
?>
 	<body>
	 	<div class = "card border-1">
		 <div class = " row mt-2 justify-content-center"><h2>Haarlem Festival Jazz<h2></div>
		    <div class = "row justify-content-center m-3">
			<?php
				$evenDates = array_unique(array_map(function($row){
					return $row->date;
				}, $jazzTickets));
				echo "<a href='#' class = 'btn btn-md mr-3 text-white' role='button'>All Tickets</a>";
				foreach($evenDates as $date){
				 	echo "<a href='#' class = 'btn btn-md mr-3 text-white' role='button'>".date('D d M Y', strtotime($date))."</a>";
				}
			 ?>
			</div>
		 	<div class = "row justify-content-center">
			 <div class = "col-7 single-tickets">
		<?php
			echo"<form class= 'ticketForm' action' = 'index.php' method = post>
			<table id ='myTable'>";
			foreach ($jazzTickets as $row) {
					echo "<tr class = 'ticket'>
							<td width='20%'>
								$row->artist <br>".
								date('D d M Y', strtotime($row->date)).' | '.$row->start.' - '.$row->end."<br>".
								$row->venue.
							"</td>
							<td width= '2%' class = 'price'>
								€ $row->price
							</td>
							<td width='4%'>
								<section>
									<div class='value-button' id='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
									<input type='number' class ='quantity' id='number' value='1' size='4' class ='quantity' />
										 Seats: $row->seats
									<div class='value-button' id='increase' onclick='increaseValue()' value='Increase Value'></div>
								</section>
								<input id ='add-to-cart-btn' type='submit' value='Add to Cart' name = 'cart-btn'>
							</td>
						</tr>";
			}
				echo"</table>
				</form>";
		?>
		</div>
		<div class = "col-3 ml-4">
		 <div class = "row justify-content-center mt-2">
		  	<h4>Jazz TimeTable</h4>
		 </div>
		 <div class = "row">
		 
		 </div>
			<div class = "row pl-5">
				<?php
				foreach($evenDates as $date) {
					echo "<h5>".date('D d M Y', strtotime($date))."</h5>";
					foreach($jazzTickets as $row) {
						if ($date === $row->date) {
					echo "<p class = 'timetablerow'>$row->start - $row->end $row->artist</p>";
						}
					}
				}
				?>
		</div>
		</div>
		</div>
		</div>
 	</body>
</html>
<script>
  $(function(){
	  $('.quantity').change(function(){
	  	const qty = $(this).val();
	  	$(this).val(Math.max(1, qty));
	  });
  });
</script>
