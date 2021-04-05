<?php	
	 class CMSController
	{
		private CMSRepo $repo;

		public function __construct()
		{
			$this->repo = new CMSRepo();
		}

		public function fetchEvents() : array
		{
			try {
				return $this->repo->fetchEvents();

			} catch (Exception $msg) {
				throw $msg;
			}
		}
	}
?>