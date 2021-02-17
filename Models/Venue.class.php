<?php
abstract class Venue
{

    private string $name;
    private int $seats;
    private string $address;

    public function __construct(string $name, int $seats, string $address = "")
    {
        $this->name = $name;
        $this->seats = $seats;
        $this->address = $address;
    }
}