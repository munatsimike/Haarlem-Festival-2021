<?php	
	 class BundleTicketController
	{
		private BundleTicketRepo $repo;
		private BundleTicketController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new BundleTicketRepo();
		}

	 	//use with EventType enum
		//fetches all bundle tickets for the given event type
		public function fetchBundleTickets($eventType) : array
		{
			try {
				return $this->repo->fetchBundleTickets($eventType);

			} catch (ConnectionFailureException $msg) {
					
			}
		}

		public function updateNumberOfSeats(int $id, int $quantity) 
		{
			return $this->repo->updateNumberOfSeats($id, $quantity);
		}

		public static function bundleTicketController() : BundleTicketController
		{
			return $controller ?? $controller = new BundleTicketController();
		}
	}
?>
