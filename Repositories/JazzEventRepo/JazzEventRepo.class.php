<?php	
	 class JazzEventRepo
	{
		private PDO $pdo;

		public function __construct()
		{ 
			//gets database connection instance from Connection class
			try{
				$this->pdo = Connection::DBConnection();
			} catch (ConnectionFailureException $errorMsg) {}
		}

		public function fetchJazzTickets() : array
		{
			// fetches JazzTickets from database
			if ($this->pdo instanceof PDO) {
				return createJazzTickets
				(
					$this->pdo->query("	SELECT E.ID, E.price, E.date, E.start, E.end, artist, E.seats, V.venue, V.address FROM jazz_ticket AS J 
										JOIN event AS E ON E.ID = J.event_id
										JOIN venue AS V ON V.venue = E.venue_id
										ORDER BY date,start")
										->fetchAll(PDO::FETCH_ASSOC)
				);
			}
			throw ConnectionFailureException::database();
		}

		private function createJazzTickets(array $assocList) : array
		{
			// converts pdo assocciation objects to jazzTickets
			$tickets = [];
			foreach($assocList as $row){
				$venue = new Venue($row['V.venue'], $row['V.address']);
				$tickets[] = new JazzTicket($row['E.ID'], $row['E.price'], $row['E.date'], $row['E.start'], $row['E.end'], $venue, $row['E.seats'], $row['artist']);
			}
			return $tickets;
		}

		public function updateNumberOfSeats(int $ticketId , int $quantity) : void
		{
				$this->pdo->prepare("UPDATE event SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$ticketId, 'quantity'=>$quantity]);
		}
	}

?>
