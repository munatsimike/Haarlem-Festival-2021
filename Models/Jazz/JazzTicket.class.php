<?php	
	 class JazzTicket extends Ticket
	{
		private string $artist;
		
		public function __construct(int $id, float $price , string $date, string $start, string $end, Venue $venue, string $seats, string $artist)
		{
			parent::__construct($id, $price , $date, $start, $end, $venue, $seats);
			$this->artist = $artist;
		}

		public function getTitle() : string
		{
			return $this->artist;
		}
	}		
?>
