<?php	
	 class BundleTicketRepo extends Repo
	{

		public function fetchBundleTickets(EventName $eventType) : array
		{
			// converts pdo array to jazzTickets array
			$Bundletickets = [];
			try {
					foreach($this->fetchTickets($eventType) as $row) {
						$Bundletickets[] = new BundleTicket($row['ID'], $row['price'], $row['seats'], $row['title'], $row['description']);
					}
				} catch (Excetpion $error) {
					throw $error;
				}

			return $Bundletickets;
		}

		private function fetchTickets(EventName $event) : array
		{
			// fetches JazzTickets from database
				return $this->pdo->query("SELECT E.ID, E.price, E.seats, B.title, B.description FROM bundle_tickets AS B
												 JOIN event AS E ON E.ID = B.event_id 
												 WHERE E.event_type = '$event' ")->fetchAll(PDO::FETCH_ASSOC);

		}
	}

?>
