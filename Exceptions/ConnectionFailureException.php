<?php

final class ConnectionFailedException extends Exception
{
	public static function database() : ConnectionFailedException
    {
        return new self("Connection to the database has failed, please contact the system admin");     
    }
}

?>
