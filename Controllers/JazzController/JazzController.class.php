<?php	
	 class JazzController
	{
		private JazzRepo $repo;
		public function __construct()
		{	
			$this->repo = new JazzRepo();
		}

		public function fetchJazzTickets() : array
		{
			try {
				return $this->repo->fetchJazzTickets();
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}
	}
?>
