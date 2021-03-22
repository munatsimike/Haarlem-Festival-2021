<?php	
	 class DanceTicket extends Ticket
	{
		public string $session;
		public string $djs = [];

		public function __construct(int $id, float $price , string $date, string $start, string $end, string $venue, string $seats)
		{
			parent::__construct(getTitle(), $id, $price , $date, $start, $end, $venue, $seats);
			string $this->artist = $artist;
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