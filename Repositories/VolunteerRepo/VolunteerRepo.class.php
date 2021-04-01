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

		// save new volunteer
		public function storeVolunteer(Volunteer $volunteer) : void
		{
				$this->pdo->prepare("INSERT INTO volunteer (email, password, employee_type) VALUES (:email, :password, :employee_type)")
						   ->execute(['email' => $volunteer->email, 'password' => $volunteer->password, 'employee_type' => $volunteer->employeeType]);
		}

		public function IsUsernamePasswordValid(Volunteer $volunteer) : bool
		{
			if ($this->isEmailAvailable($volunteer)) {
				$stmt = $this->pdo->prepare("SELECT password FROM volunteer WHERE email = :email");
				$stmt->execute(['email' => "$volunteer->email"]);
				$hashed_password = $stmt->fetchColumn();

				return password_verify($volunteer->password, $hashed_password);
			}

			return false;
		}
	}

?>
