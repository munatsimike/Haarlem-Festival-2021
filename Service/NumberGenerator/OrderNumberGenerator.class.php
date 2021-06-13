<?php

class OrderNumberGenerator extends NumberGenerator
{
    private OrderController $orderController;
    private static $instance = null;
    private int $orderNum;

    private function __construct()
    {
        $this->orderController = new OrderController();
    }

    public static function getInstance()
    {
        if ( ! self::$instance) {
            self::$instance = new OrderNumberGenerator();

            return self::$instance;
        }
    }

    public function generateOrderNumber() : int
    {
        do {
            $this->orderNum = $this->generateNum();
        } while ($this->orderController->orderIdExist($this->orderNum));

        return $this->orderNum;
    }
}