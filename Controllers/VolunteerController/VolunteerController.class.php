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
			try {
				$this->repo->storeVolunteer($volunteer);
			} catch (PDOException $errorMsg) {
				throw $errorMsg;
			}
		}

		public function IsUsernamePasswordValid(Volunteer $volunteer) : bool
		{
			try {
				return $this->repo->IsUsernamePasswordValid($volunteer);
			} catch (PDOException $errorMsg) {
				throw $errorMsg;
			}
		}
	
		public static function VolunteerController() : VolunteerController
		{
			return $controller ?? $controller = new VolunteerController();
		}
	}
?>
