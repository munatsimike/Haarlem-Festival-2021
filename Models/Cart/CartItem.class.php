<?php

class CartItem
{
    public int $id = 0;
    public float $unitPrice = 0;
    public string $title = '';
    public string $description = '';
    public int  $quantity = 0;
    public int  $seats = 0;

    public function __construct(int $id, string $description, int $quantity, float $unitPrice, int $seats)
    {
        $this->id = $id;
        $this->unitPrice = $unitPrice;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->seats = $seats;
    }

    public function getSubTotal() : float{
        return $this->quantity * $this->unitPrice;
    }
}