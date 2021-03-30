<?php	
	 class VolunteerRepo extends EventRepo
	{
		// Check if volunteer username exist
		public function usernameExist(string $username) : bool
		{
			$stmt = $this->pdo->prepare("SELECT username FROM volunteer WHERE username = :username");
			$stmt->execute([':username' => $username]);
		    $result = $stmt->fetch();
			if (! $result ) {

				return false;
			}

			return true;
		}

		// save new volunteer
		public function storeVolunteer(Volunteer $volunteer) : void
		{
			try {
				$this->pdo->prepare("INSERT INTO volunteer (username, password, email, status, phone) VALUES (:username, :password, :email, :status, :phone)")
						->execute(['username' => $volunteer->username, 'password' => $volunteer->password, 'email' => $volunteer->email, 'status' => 'active', 'phone' => $volunteer->phoneNumber]);
			} catch (PDOException $e) {
				throw $e;
			}
		}

		public function IsUsernamePasswordValid(Volunteer $volunteer) : bool
		{
			if ($this->usernameExist($volunteer->username)) {
				$stmt = $this->pdo->prepare("SELECT password FROM volunteer WHERE username = :username");
				$stmt->execute(['username' => "$volunteer->username"]);
				$hashed_password = $stmt->fetchColumn();

				if (password_verify($volunteer->password, $hashed_password)) {
					return true;
				}
			}

			return false;
		}
	}

?>
