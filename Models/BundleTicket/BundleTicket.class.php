<?php	
	 class BundleTicket extends Ticket
	{
		private string $title;
		private string $description;

		public function __construct(int $id, float $price , string $title, string $description)
		{
			parent::__construct3($id, $price, 100);
			$this->title = $title;
			$this->description = $description;
		}

		public function getTitle()
		{
			return $this->title;
		}

		public function getDescription()
		{
			return $this->description;
		}
	}
?>
