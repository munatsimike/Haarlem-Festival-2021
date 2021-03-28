<?php
require_once 'partials/AddToCart.class.php';

class EventOption
{
	public static function displayTickets(array $tickets) : void
	{
		echo"<form class= 'ticketForm' action ='' method = 'POST'>
				<table class ='ticketsTable'>";
					foreach ($tickets as $row) {
						echo "<tr class='ticket'>
								<td class='ticketImage' width = '6%'>
								</td>
								<input type ='hidden' class ='id'  value = '$row->ID'>
								<td width='14%' class = 'title'>
								" . $row->getTitle() . " <br>".
									date('D d M Y', strtotime($row->date)).' | '."<i class='bi-alarm' style='color:#cc6011'></i>"." ".$row->start.' - '.$row->end."<br>".
									' '.$row->venue->name.
								"</td>
								<td width= '2%' class='price'>
								€ $row->price
								</td>";
								 AddToCart::addToCart($row);
							 "</tr>";
						}
				echo"</table>
		</form>";
	}

	public static function filterTickets(array $tickets, string $filterOption) : array
    {
        return array_filter($tickets, function($row) use ($filterOption){
            if ($row->date === $filterOption)
                return $row;
        });
    }

	public static function displayEventDates(array $tickets) : void
	{
		echo "<a href='jazz.php' class = 'btn btn-md mr-3 event-date' role='button'>All Tickets</a>";
		foreach (self::eventDates($tickets) as $date) {
			echo "<a href='jazz.php?date=$date' class = 'btn btn-md mr-3 event-date' role='button'>".date('D d M Y', strtotime($date))."</a>";
		}
	}

	public static function displayMultipleEventTickets() {
		$tickets = [ 
			['id'=>56, 'price'=>85, 'seats'=>200, 'title'=>'3 Day Pass', 'description'=>'Access to all shows'],
			['id'=>67, 'price'=>35, 'seats'=>150, 'title'=>'One Day Pass','description'=>'Access to all shows for a single day']
		];
		foreach ($tickets as $row) {
			echo "<form class= 'ticketForm' action = '' method = 'POST'>
					<table class = 'ticketsTable' style='width:100%'>
						<tr class ='ticket'>
							<input type ='hidden' class ='id'  value =". $row['id'].">
							<td>".$row['title']. "<br>".
							$row['description']."</td>";
							$row['price'].
							"</td>";
							AddToCart::addToCart($row);
						"</tr>";
				}
					echo "</table>
	 			 </form>";
	}

	public static function displayTimeTable(array $tickets) : void
	{
		foreach (self::eventDates($tickets) as $date) {
			echo "<h5 class = 'dateHeading'>".date('D d M Y', strtotime($date))."</h5>";
			foreach ($tickets as $row) {
				if ($date === $row->date) {
			echo "<p class = 'timetablerow'>" . $row->getTitle(). ": $row->start - $row->end <br> " . $row->venue->name . "</p>";
				}
			}
		}
	}

	private static function eventDates(array $tickets) : array
	{
		return array_unique(array_map(function($row) {
			return $row->date;
		}, $tickets));

	}
}
?>