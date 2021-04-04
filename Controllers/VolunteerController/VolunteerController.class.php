<?php	
	 class VolunteerController
	{
		private VolunteerRepo $repo;
		private Volunteer $volunteer;

		public function __construct(Volunteer $volunteer)
		{
			$this->repo = new VolunteerRepo();
			$this->volunteer = $volunteer;
		}

		public function createNewVolunteerAccounnt() : void
		{
			try {
				$this->repo->storeVolunteer($this->volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}

		public function fetchPasswordEmployeeType() : array
		{
			try {
				return $this->repo->fetchPasswordEmployeeType($this->volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}

		public function isEmailAvailable() : bool
		{
			try {
				return $this->repo->isEmailAvailable($this->volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}
	}
?>
