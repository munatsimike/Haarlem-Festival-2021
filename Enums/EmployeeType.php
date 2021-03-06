<?php
require_once "Enum.php";
use MyCLabs\Enum\Enum;

 Final class EmployeeType extends Enum
{
    private const REGULAR = "regular";
    private const ADMIN = "admin";

    public static function fromString (string $value) : self
    {
        if (self::isValid($value)) {
            return new self($value);
        }

        throw EmployeeTypeNotFound::forValue($value);
    }
}

?>
