<?php
require_once "Enum.php";
use MyCLabs\Enum\Enum;

 class PaymentStatus extends Enum
{
    private const OPEN = "open";
    private const PAID = "paid";
    private const FAILED = "failed";
    private const CANCELED = "cancelled";
    private const EXPIRED = "expired";

    public static function fromString (string $value) : self
    {
        if (self::isValid($value)) {
            return new self($value);
        }
        
        throw InvalidPaymentStatusException::forValue($value);
    }
}

?>
