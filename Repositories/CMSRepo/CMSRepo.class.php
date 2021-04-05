<?php	
	 class CMSRepo extends Repo
	{

		public function fetchEvents() : array
		{
			// converts pdo array to jazzTickets array
			$result = $this->fetchTickets();
            $events = [];
            foreach($result as $row){
                $events[] = $this->createEvent($row);
            }
            return $events;
		}

		private function fetchTickets() : array
		{
			// fetches all events from database excluding bundles
            if ($this->pdo instanceof PDO) {
                return $this->pdo->query("	SELECT E.ID, E.price, E.date, TIME_FORMAT(E.start, '%H:%i') AS start, TIME_FORMAT(E.end,'%H:%i')AS end, E.seats, E.event_type, V.venue, V.address FROM event AS E 
                                            JOIN venue AS V ON V.venue = E.venue_id
                                            LEFT OUTER JOIN bundle_tickets AS B ON E.ID = B.event_id
                                            ORDER BY E.ID")->fetchAll(PDO::FETCH_ASSOC);
            }
			throw ConnectionFailureException::database();
		}

        private function createEvent($row) : Ticket
		{
            
			// converts pdo array to DanceTickets array
			if($row['event_type'] == EventName::JAZZ){
                return $this->fetchJazzTicket($row);
            }
            elseif($row['event_type'] == EventName::DANCE){
                return $this->fetchDanceTicket($row);
            }
            throw new Exception("ticket not found");
		}

        private function fetchDanceTicket($row) : DanceTicket
		{
			// fetches all events from database
            if ($this->pdo instanceof PDO) {
                
                $stmt = $this->pdo->prepare("	SELECT D.session FROM event AS E 
                                                JOIN dance_ticket as D ON E.ID = D.event_id
                                                WHERE E.ID = :id");
                $stmt->bindParam(':id', $row['ID'], PDO::PARAM_INT);
                $stmt->execute();
                $session = $stmt->fetch();
                $djs = $this->fetchTicketDJs($row['ID']);
				$venue = new Venue($row['venue'], $row['address']);
				return new DanceTicket($row['ID'], $row['price'], $row['date'], $row['start'], $row['end'], $venue, $row['seats'], $session['session'], $djs);
            }
			throw ConnectionFailureException::database();
		}

        private function fetchTicketDJs(int $id) : array
		{
			// fetches djs of given ticket from database
			if ($this->pdo instanceof PDO) {
				$stmt = $this->pdo->prepare("	SELECT dj.name FROM dj_dance AS DD
												JOIN dj ON DD.DJ_id = dj.ID
												WHERE DD.dance_id = :id");
				$stmt->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_COLUMN);
			}
			throw ConnectionFailureException::database();
		}

        private function fetchJazzTicket($row) : JazzTicket
		{
			// fetches all events from database
            if ($this->pdo instanceof PDO) {
                $stmt = $this->pdo->prepare("	SELECT J.artist FROM event AS E 
                                                JOIN jazz_ticket as J ON E.ID = J.event_id
                                                WHERE E.ID = :id");
                $stmt->bindParam(':id', $row['ID'], PDO::PARAM_INT);
                $stmt->execute();
                $artist = $stmt->fetch();
                $venue = new Venue($row['venue'], $row['address']);
                return new JazzTicket($row['ID'], $row['price'], $row['date'], $row['start'], $row['end'], $venue, $row['seats'], $artist['artist']);

            }
			throw ConnectionFailureException::database();
		}
	}

?>