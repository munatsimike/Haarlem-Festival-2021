<?php

class OrderNumberGenerator extends AGenerator
{
    private OrderController $orderController;
    private static $instance = null;
    private OrderNumber $orderNum;

    private function __construct()
    {
        $this->orderController = new OrderController();
    }

    public static function getInstance() : OrderNumberGenerator
    {
        if ( ! self::$instance) {
            self::$instance = new OrderNumberGenerator();
            return self::$instance;
        }

        return self::$instance;
    }

    public function generateOrderNumber() : OrderNumber
    {
        do {
            $this->orderNum = new OrderNumber($this->generateUnixTimeStamp());
        } while ($this->orderController->orderIdExist($this->orderNum));
        return $this->orderNum;
    }
}