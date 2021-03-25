<?php
class Transaction
{
    public $cartItems = [];

    public function __construct(array $cartItems)
    {
        $this->cartItems = $cartItems;
    }
}