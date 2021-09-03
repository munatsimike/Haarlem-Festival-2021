<?php

final class InvalidEnumException extends Exception
{
	public static function forPaymentStatus(string $status) : InvalidEnumException
    {
        return new self("Invald payment status {$status}");     
    }
}

?>
