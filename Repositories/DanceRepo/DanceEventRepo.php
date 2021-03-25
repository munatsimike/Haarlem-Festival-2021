<?php	
	 class DanceEventRepo
	{
		private PDO $pdo;

		public function __construct()
		{ 
			//gets database connection instance from Connection class
			try{
				$this->pdo = Connection::DBConnection();
			} catch (ConnectionFailureException $errorMsg) {}
		}

		public function fetchDanceTickets() : array
		{
			// fetches DanceTickets from database
			if ($this->pdo instanceof PDO) {
				return $this->createDanceTickets( $this->pdo->query("	SELECT E.ID, E.price, E.date, E.start, E.end, E.seats, V.venue, V.address, D.session FROM dance_ticket AS D 
																		JOIN event AS E ON E.ID = D.event_id
																		JOIN venue AS V ON V.venue = E.venue_id
																		ORDER BY date,start")->fetchAll(PDO::FETCH_ASSOC));
			}
			throw ConnectionFailureException::database();
		}

		public function fetchDJs($id) : array
		{
			// fetches djs of given ticket from database
			if ($this->pdo instanceof PDO) {
				return $this->pdo->query("	SELECT dj.name FROM dance_ticket AS D 
											JOIN dj_dance AS DD ON DD.dance_id = D.ID
											JOIN dj ON DD.DJ_id = dj.ID
											WHERE D.ID = $id
											ORDER BY dj.ID")->fetchAll(PDO::FETCH_BOTH);
			}
			throw ConnectionFailureException::database();
		}

		private function createDanceTickets(array $assocList) : array
		{
			// converts pdo array to DanceTickets array
			$tickets = [];
			foreach($assocList as $row){
				$djs = $this->fetchDJs($row['ID']);
				$venue = new Venue($row['venue'], $row['address']);
				$tickets[] = new DanceTicket($row['ID'], $row['price'], $row['date'], $row['start'], $row['end'], $venue, $row['seats'], $row['session'], $djs);
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