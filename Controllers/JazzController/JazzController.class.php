<?php	
	 class JazzController
	{
		private JazzRepo $repo;
		private JazzEventController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new JazzRepo();
		}

		public function fetchJazzTickets() : array
		{
			try {
				return $this->repo->fetchJazzTickets();

			} catch (ConnectionFailureException $msg) {
					
			}
		}

		public function updateNumberOfSeats(int $id, int $quantity) 
		{
			return $this->repo->updateNumberOfSeats($id, $quantity);
		}

		public static function jazzController() : JazzController
		{
			return $controller ?? $controller = new JazzController();
		}
	}
?>
