<?php	
	 class BundleTicketRepo
	{
		private PDO $pdo;

		public function __construct()
		{ 
			//gets database connection instance from Connection class
			try{
				$this->pdo = Connection::DBConnection();
			} catch (ConnectionFailureException $errorMsg) {}
		}

		public function fetchJazzBundleTickets() : array
		{
			// converts pdo array to jazzTickets array
			$Bundletickets = [];
			foreach($this->fetchBundleTickets(EventName::JAZZ) as $row) {
				$Bundletickets[] = new BundleTicket($row['ID'], $row['price'], $row['seats'], $row['title']);
			}

			return $Bundletickets;
		}

		private function fetchBundleTickets(string $event) : array
		{
			// fetches JazzTickets from database
			if ($this->pdo instanceof PDO) {
				return $this->pdo->query("SELECT E.ID, E.price, E.seats, B.title FROM bundle_tickets AS B
												 JOIN event AS E ON E.ID = B.event_id 
												 WHERE E.event_type = '$event' ")->fetchAll(PDO::FETCH_ASSOC);
			}

			throw ConnectionFailureException::database();
		}

		public function updateNumberOfSeats(int $ticketId , int $quantity) : void
		{
				$this->pdo->prepare("UPDATE event SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$ticketId, 'quantity'=>$quantity]);
		}
	}

?>