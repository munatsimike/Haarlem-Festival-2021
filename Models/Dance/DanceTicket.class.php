<?php	
	 class DanceTicket extends Ticket
	{
		public string $session = '';
		public array $djs = [];

		public function __construct(int $id, float $price , string $date, string $start, string $end, Venue $venue, string $seats, string $session, array $djs)
		{
			parent::__construct($id, $price , $date, $start, $end, $venue, $seats);
			$this->session = $session;
			$this->djs = $djs;
		}

		public function getTitle() : string
		{
			$title = "";
			foreach ($this->djs as $key->$dj) {
				if($key>0){ $title .= " / "; }
				$title .= $dj['name'];
			}  
			return $title . " | " . $this->session;
		}
	}		
?>