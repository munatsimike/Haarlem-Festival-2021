<?php	
	 class VolunteerController
	{
		private VolunteerRepo $repo;
		private VolunteerController $controller;

		public function __construct()
		{
			$this->repo ?? $this->repo = new VolunteerRepo();
		}

		public function storeVolunteer(Volunteer $volunteer) : void
		{
			$this->repo->storeVolunteer($volunteer);
		}

		public function IsUsernamePasswordValid(Volunteer $volunteer) : bool
		{
			return $this->repo->IsUsernamePasswordValid($volunteer);
		}
	
		public static function VolunteerController() : VolunteerController
		{
			return $controller ?? $controller = new VolunteerController();
		}
	}
?>
