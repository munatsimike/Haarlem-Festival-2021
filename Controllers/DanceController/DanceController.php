<?php	
	 class DanceController
	{
		private DanceEventRepo $repo;

		public function __construct()
		{
			$this->repo = new DanceEventRepo();
		}

		public function fetchDanceTickets() : array
		{
			try {
				return $this->repo->fetchDanceTickets();

			} catch (Exception $msg) {
				throw $msg;
			}
		}
	}
?>