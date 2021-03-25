<?php	
	 class DanceController
	{
		private DanceEventRepo $repo;
		private DanceController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new DanceEventRepo();
		}

		public function fetchDanceTickets() : array
		{
			try {
				return $this->repo->fetchDanceTickets();

			} catch (ConnectionFailureException $msg) {
					
			}
		}

		public function updateNumberOfSeats(int $id, int $quantity) 
		{
			return $this->repo->updateNumberOfSeats($id, $quantity);
		}

		public static function danceController() : DanceController
		{
			return $controller ?? $controller = new DanceController();
		}
	}
?>