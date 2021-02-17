<?php
class Transaction
{
    public $cartItems = [];
    public Customer $customer;

    public function __construct(array $cartItems, Customer $customer)
    {
        $this->cartItems = $cartItems;
        $this->customer = $customer;
    }
}