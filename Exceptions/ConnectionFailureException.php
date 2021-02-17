<?php

final class ConnectionFailureException extends Exception
{
	public static function database() : ConnectionFailureException
    {
        return new self("Connection to the database has failed, please contact the system admin");
    }
}

?>
