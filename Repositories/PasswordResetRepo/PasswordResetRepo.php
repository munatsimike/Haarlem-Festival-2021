<?php

class PasswordResetRepo extends Repo 
{
	public function storeResetPasswordCredentials(PasswordReset $passwordReset) 
	{
		$stm = $this->pdo->prepare("INSERT INTO password_reset (email,token,selector,expiry_date) VALUES (:email, :token, :selector, :expiryDate)");
			         $stm->execute(['email'=> $passwordReset->email, 'token' => $passwordReset->token, 'selector'=>$passwordReset->selector, 'expiryDate'=>$passwordReset->tokenExpiryDate]);
	}

	public function fetchResetPasswordCredentials($selector) : PasswordReset
	{
		$stm = $this->pdo->prepare("SELECT email, token, selector, expiry_date FROM password_reset WHERE selector = :selector");
		    		 $stm->execute([':selector' => "$selector"]);
			 $row =  $stm->fetch(PDO::FETCH_ASSOC);
			
			 if (! $row) {
				throw new PasswordResetCredentialsNotFound();
			 }
			 
			return new PasswordReset($row['email'], $row['token'], $row['selector'], $row['expiry_date']);
	}
	
	public function deletePasswordResetCredentials(string $email) : void
	{
		$this->pdo->prepare("DELETE FROM password_reset WHERE email=:email")
			 	  ->execute(["email" => $email]);
	}

}