<?php	
	 class BundleTicket extends Ticket
	{
		private string $title;

		public function __construct(int $id, float $price , string $seats, string $title)
		{
			parent::__construct3($id, $price, $seats);
			$this->title = $title;
		}

		public function getTitle()
		{
			return $this->title;
		}
	}
?>
