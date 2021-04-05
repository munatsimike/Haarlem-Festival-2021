<?php	
	 class VolunteerRepo extends Repo
	{
		// Check if volunteer username exist
		public function isEmailAvailable(Volunteer $volunteer) : bool
		{
			$stmt = $this->pdo->prepare("SELECT email FROM volunteer WHERE email = :email");
			$stmt->execute([':email' => $volunteer->email]);
		    return $stmt->fetchColumn();
		}

		// save new volunteer account
		public function storeVolunteer(Volunteer $volunteer) : void
		{
				$this->pdo->prepare("INSERT INTO volunteer (email, password, employee_type) VALUES (:email, :password, :employee_type)")
						   ->execute(['email' => $volunteer->email, 'password' => $volunteer->password, 'employee_type' => $volunteer->employeeType]);
		}

		public function fetchPasswordEmployeeType(Volunteer $volunteer) : array
		{
			$output = [];

			if ($this->isEmailAvailable($volunteer)) {
				$stmt = $this->pdo->prepare("SELECT password, employee_type FROM volunteer WHERE email = :email");
				$stmt->execute(['email' => "$volunteer->email"]);
				return  $stmt->fetch(PDO::FETCH_ASSOC);
			}

			return $output;
		}

		public function resetVolunteerPassword(Volunteer $volunteer) : void
		{
			$paswordResetRepo = new PasswordResetRepo;
			$this->pdo->prepare("UPDATE volunteer SET password = :password WHERE email = :email")
					  ->execute(['email' => $volunteer->email, "password" => $volunteer->password]);

			try {
				$paswordResetRepo->deletePasswordResetCredentials($volunteer->email);
			} catch (Exception $error) {
				throw $error;
			}
		}	
	}


?>
