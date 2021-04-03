<?php	
	 class JazzRepo extends Repo
	{
		public function fetchJazzTickets() : array
		{
			// fetches JazzTickets from database
			if ($this->pdo instanceof PDO) {
				return $this->createJazzTickets( $this->pdo->query("SELECT E.ID, E.price, E.date, TIME_FORMAT(E.start, '%H:%i') AS start, TIME_FORMAT(E.end,'%H:%i')AS end, artist, E.seats, V.venue, V.address FROM jazz_ticket AS J 
												JOIN event AS E ON E.ID = J.event_id
												JOIN venue AS V ON V.venue = E.venue_id
												ORDER BY date,start")->fetchAll(PDO::FETCH_ASSOC));
			}
			throw ConnectionFailureException::database();
		}

		private function createJazzTickets(array $assocList) : array
		{
			// converts pdo array to jazzTickets array
			$tickets = [];
			foreach($assocList as $row){
				$venue = new Venue($row['venue'], $row['address']);
				$tickets[] = new JazzTicket($row['ID'], $row['price'], $row['date'], $row['start'], $row['end'], $venue, $row['seats'], $row['artist']);
			}
			
			return $tickets;
		}
	}

?>
