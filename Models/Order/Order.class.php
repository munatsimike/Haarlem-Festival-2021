<?php

class Order
{
    public PaymentStatus $status;
    public array $orderItems;
    public OrderNumber $orderNumber;

    function __construct(OrderNumber $orderNumber, array $orderItems, PaymentStatus $status)
    {
       $this->orderNumber = $orderNumber;
       $this->status = $status;
       $this->orderItems = $orderItems;
    }

}