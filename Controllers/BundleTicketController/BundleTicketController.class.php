<?php	
	 class BundleTicketController
	{
		private BundleTicketRepo $repo;

		public function __construct()
		{
			$this->repo = new BundleTicketRepo();
		}

		//fetches all bundle tickets for the given event type
		public function fetchBundleTickets($eventType) : array
		{
			try {
				return $this->repo->fetchBundleTickets($eventType);
			} catch (Exception $msg) {
				throw $msg;
			}
		}
	}
?>
