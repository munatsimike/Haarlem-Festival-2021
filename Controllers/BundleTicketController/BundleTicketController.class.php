<?php	
	 class BundleTicketController
	{
		private BundleTicketRepo $repo;
		private BundleTicketController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new BundleTicketRepo();
		}

		public function fetchJazzBundleTickets() : array
		{
			try {
				return $this->repo->fetchJazzBundleTickets();

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
