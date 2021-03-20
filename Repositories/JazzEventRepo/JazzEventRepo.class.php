<?php	
	 class JazzEventRepo
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
			if ($this->pdo instanceof PDO) {
				return $this->pdo->query("	SELECT E.ID, E.price, E.date, E.start, E.end, artist, E.seats FROM jazz_ticket AS J 
											INNER JOIN event AS E ON E.ID = J.event_id")
					   ->fetchAll(PDO::FETCH_CLASS, 'JazzTicket');
			}

			throw ConnectionFailureException::database();
		}

		public function updateNumberOfSeats(int $ticketId , int $quantity) : void
		{
				$this->pdo->prepare("UPDATE jazz_ticket SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$ticketId, 'quantity'=>$quantity]);
		}
	}

?>
