<?php
require_once "Enum.php";
use MyCLabs\Enum\Enum;

 class PaymentStatus extends Enum
{
    private const OPEN = "open";
    private const PAID = "paid";
    private const FAILED = "failed";
    private const CANCELED = "canceled";
    private const EXPIRED = "expired";
    private const PENDING = "pending";

    public static function fromString (string $value) : self
    {
        if (self::isValid($value)) {
            return new self($value);
        }
        
        throw InvalidPaymentStatusException::forValue($value);
    }
}

?>
