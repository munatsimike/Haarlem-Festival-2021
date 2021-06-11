<?php

class OrderNumberGenerator extends NumberGenerator
{
    private OrderController $orderController;
    private int $orderNum;

    public function __construct()
    {
        $this->orderController = new OrderController();
    }

    public function generateOrderNumber() : int
    {
        do {
            $this->orderNum = $this->generateNum();
        } while ($this->orderController->orderIdExist($this->orderNum));

        return $this->orderNum;
    }
}