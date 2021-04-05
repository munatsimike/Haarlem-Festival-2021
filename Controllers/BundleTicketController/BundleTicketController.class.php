<?php	
	 class BundleTicketController
	{
		private BundleTicketRepo $repo;

		public function __construct()
		{ 	try{
				$this->repo = new BundleTicketRepo();
			}catch(Exception $e){
				
			}
		}

		//fetches all bundle tickets for the given event type
		public function fetchBundleTickets(EventName $eventType) : array
		{
			try {
				return $this->repo->fetchBundleTickets($eventType);
			} catch (Exception $msg) {
				throw $msg;
			}
		}
	}
?>
