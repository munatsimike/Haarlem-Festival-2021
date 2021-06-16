<?php

class OrderNumber
{
    private string $timeStamp;
    function __construct(string $timeStamp)
    {
        if (Validator::isValidUnixTimeStamp($timeStamp)) {
            $this->timeStamp = $timeStamp;
        } else {
            throw InvalidUnixTimeStampException::forOrderNumber($timeStamp);
        }
    }

    public function getValue() : int
    {
        return (int)$this->timeStamp;
    }
}