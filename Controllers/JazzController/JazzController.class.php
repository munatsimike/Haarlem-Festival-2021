<?php	
	 class JazzController
	{
		private JazzRepo $repo;
		public function __construct()
		{	
			try{
				$this->repo = new JazzRepo();
			}catch(Exception $e){
			}
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
