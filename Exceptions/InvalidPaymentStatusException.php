<?php

final class InvalidPaymentStatusException extends Exception
{
	public static function forValue(string $status) : InvalidPaymentStatusException
    {
        return new self("Invald payment status {$status}");     
    }
}

?>
