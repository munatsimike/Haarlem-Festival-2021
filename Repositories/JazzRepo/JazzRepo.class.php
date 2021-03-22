<?php	
	 class JazzRepo
	{
		private PDO $pdo;

		public function __construct()
		{ 
			try{
				$this->pdo = Connection::DBConnection();
			} catch (ConnectionFailureException $errorMsg) {}
		}

		public function fetchJazzTickets() : array
		{
			// get all jazz tickets by joining jazz, venue and event table
			if ($this->pdo instanceof PDO) {
				return $this->pdo->query("	SELECT E.ID, E.price, E.date, E.start, E.end, artist, E.seats, V.venue, V.address FROM jazz_ticket AS J 
											JOIN event AS E ON E.ID = J.event_id
											JOIN venue AS V ON V.venue = E.venue_id
											ORDER BY date,start")
					   ->fetchAll(PDO::FETCH_CLASS, 'JazzTicket');
			}
			
			throw ConnectionFailureException::database();
		}

		public function updateNumberOfSeats(int $ticketId , int $quantity) : void
		{		// subtract number of purchased seats from ticket quantity
				$this->pdo->prepare("UPDATE jazz_ticket SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$ticketId, 'quantity'=>$quantity]);
		}
	}

?>
