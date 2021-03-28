<?php	
	 class VolunteerController
	{
		private VolunteerRepo $repo;
		private VolunteerController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new VolunteerRepo();
		}

		public function storeVolunteer(Volunteer $volunteer)
		{
			$this->repo->storeVolunteer($volunteer);
		}
	
		public static function VolunteerController() : VolunteerController
		{
			return $controller ?? $controller = new VolunteerController();
		}
	}
?>
