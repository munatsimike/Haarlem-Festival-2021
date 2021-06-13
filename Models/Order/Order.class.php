<?php

class Order
{
    public PaymentStatus $status;
    public array $orderItems;
    public int $orderNumber;

    function __construct(int $orderNumber, array $orderItems, PaymentStatus $status)
    {
       $this->orderNumber = $orderNumber;
       $this->status = $status;
       $this->orderItems = $orderItems;
    }
}