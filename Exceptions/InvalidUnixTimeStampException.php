<?php

final class InvalidUnixTimeStampException extends Exception
{
	public static function forOrderNumber(string $timeStamp) : InvalidUnixTimeStampException
    {
        return new self("Invalid order number : {$timeStamp}, order should be a valid unix timestamp");     
    }
}

?>
