<?php	
	 class DanceTicket extends Ticket
	{
		public string $session;
		public array $djs = [];

		public function __construct(int $id, float $price , string $date, string $start, string $end, Venue $venue, string $seats, string $session, array $djs)
		{
			parent::__construct(getTitle(), $id, $price , $date, $start, $end, $venue, $seats);
		}

		public function getTitle() : string
		{
			$title = "";
			foreach ($djs as $key->$dj) {
				if($key>0){ $title .= " / "; }
				$title .= $dj;
			}  
			return $title . " | " . $session;
		}
	}		
?>