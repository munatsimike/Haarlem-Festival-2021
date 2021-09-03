<?php	
	 class DanceEventRepo extends Repo
	{

		public function fetchDanceTickets() : array
		{
			// fetches DanceTickets from database
			if ($this->pdo instanceof PDO) {
				return $this->createDanceTickets( $this->pdo->query("	SELECT E.ID, E.price, E.date, TIME_FORMAT(E.start, '%H:%i') AS start, TIME_FORMAT(E.end,'%H:%i')AS end, E.seats, V.venue, V.address, D.session FROM dance_ticket AS D 
																		JOIN event AS E ON E.ID = D.event_id
																		JOIN venue AS V ON V.venue = E.venue_id
																		ORDER BY E.date,start")->fetchAll(PDO::FETCH_ASSOC));
			}
			throw ConnectionFailureException::database();
		}

		private function fetchTicketDJs(int $id) : array
		{
			// fetches djs of given ticket from database
			if ($this->pdo instanceof PDO) {
				$stmt = $this->pdo->prepare("	SELECT dj.name FROM dj_dance AS DD
												JOIN dj ON DD.DJ_id = dj.ID
												WHERE DD.dance_id = :id
												ORDER BY dj.ID");
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_COLUMN);
			}
			throw ConnectionFailureException::database();
		}

		private function createDanceTickets(array $assocList) : array
		{
			// converts pdo array to DanceTickets array
			$tickets = [];
			foreach($assocList as $key=>$row){
				$djs = $this->fetchTicketDJs($row['ID']);
				$venue = new Venue($row['venue'], $row['address']);
				$tickets[] = new DanceTicket($row['ID'], $row['price'], $row['date'], $row['start'], $row['end'], $venue, $row['seats'], $row['session'], $djs);
			}
			return $tickets;
		}
	}

?>