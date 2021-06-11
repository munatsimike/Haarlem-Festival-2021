<?php

class Order
{
    public PaymentStatus $status;
    public iterable $orderItems;
    public int $orderNumber;

    function __construct(int $orderNumber, iterable $orderItems, PaymentStatus $status)
    {
       $this->orderNumber = $orderNumber;
       $this->status = $status;
       $this->orderItems = $orderItems;
    }
}