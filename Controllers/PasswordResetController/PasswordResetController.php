<?php

class PasswordResetController
{
	private PasswordResetRepo $repo;

	public function __construct()
	{
		$this->repo = new PasswordResetRepo();
	}

	public function storeResetPasswordCredentials(PasswordReset $passwordReset) : bool
	{
		try{
			return $this->repo->storeResetPasswordCredentials($passwordReset);

		} catch (Exception $error){
			throw $error;
		}
	}

	public function fetchResetPasswordCredentials($selector) : PasswordReset
	{
		try{
			return $this->repo->fetchResetPasswordCredentials($selector);

		} catch (Exception $error) {
			throw $error;
		}
	}
}