<?php	
	 class BundleTicketController
	{
		private BundleTicketRepo $repo;
		private EventName $eventType;

		public function __construct(EventName $eventType)
		{
			$this->repo = new BundleTicketRepo();
			$this->eventType= $eventType;
		}

		public function fetchBundleTickets() : array
		{
			try {
				return $this->repo->fetchBundleTickets($this->eventType);
			} catch (Exception $msg) {
				throw $msg;
			}
		}
	}
?>
