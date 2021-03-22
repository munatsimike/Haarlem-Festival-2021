<?php

class CartItem
{
    public int $id = 0;
    public float $unitPrice = 0;
    public string $title = '';
    public int  $quantity = 0;
    public float $subTotal = 0;

    public function __construct(int $id, string $title, int $quantity, float $unitPrice)
    {
        $this->id = $id;
        $this->unitPrice = $unitPrice;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->subTotal = $quantity * $unitPrice;
    }
}