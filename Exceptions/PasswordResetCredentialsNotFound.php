<?php

final class PasswordResetCredentialsNotFound extends Exception
{
	public static function getMessaget() : PasswordResetCredentialsNotFound
    {
        return new self("No details  found matching the token you provied. plaase send another reset link");
    }
}

?>
