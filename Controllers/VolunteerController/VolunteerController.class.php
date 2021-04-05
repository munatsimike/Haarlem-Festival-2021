<?php	
	 class VolunteerController
	{
		private VolunteerRepo $repo;

		public function __construct()
		{
			$this->repo = new VolunteerRepo();
		}

		public function createNewVolunteerAccounnt(Volunteer $volunteer) : void
		{
			try {
				$this->repo->storeVolunteer($volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}

		public function fetchPasswordEmployeeType(Volunteer $volunteer) : array
		{
			try {
				return $this->repo->fetchPasswordEmployeeType($volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}

		public function isEmailAvailable(Volunteer $volunteer) : bool
		{
			try {
				return $this->repo->isEmailAvailable($volunteer);
			} catch (Exception $errorMsg) {
				throw $errorMsg;
			}
		}

		public function resetVolunteerPassword(Volunteer $volunteer) : void
		{
			try{
				 $this->repo->resetVolunteerPassword($volunteer);
	
			} catch (Exception $error){
				throw $error;
			}
		}
	}
?>
