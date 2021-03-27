<?php	
	 class VolunteerRepo
	{
		private PDO $pdo;

		public function __construct()
		{ 
			//gets database connection instance from Connection class
			try{
				$this->pdo = Connection::DBConnection();
			} catch (ConnectionFailureException $errorMsg) {}
		}
		
		// Check if volunteer exist
		public function usernameExist(string $username) : bool
		{
			$result = $this->prepare("SELECT username FROM volunteer WHERE username = :username")
			->execute([':username' => $username]);

			if (count($result) > 0) {

				return true;
			}
			
			return false;
		}

		// save new volunteer
		public function storeVolunteer(Volunteer $volunteer) : void
		{
			
			if ($this->pdo instanceof PDO) {
				$this->pdo->prepare("INSERT INTO volunteer (username, password, email, status, phone) VALUES (:username, :password, :email, :status, :phone)")
				->execute([':username' => $volunteer->username, ':password' => $volunteer->password, ':email' => $volunteer->password, ':status' => 'active', ':phone' => $volunteer->phone]);
			}

			throw ConnectionFailureException::database();
		}
	}

?>
