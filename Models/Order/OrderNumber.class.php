<?php

class OrderNumber
{
    private string $timeStamp;
    private OrderNumberGenerator $orderNumGenerator;

    function __construct(string $timeStamp)
    {
        $this->orderNumGenerator =  OrderNumberGenerator::getInstance();
        if ($this->orderNumGenerator->isValidUnixTimeStamp($timeStamp)) {
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