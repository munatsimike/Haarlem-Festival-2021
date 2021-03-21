<?php
abstract class Venue
{

    private string $name;
    private string $address;

    public function __construct(string $name, string $address = "")
    {
        $this->name = $name;
        $this->address = $address;
    }
}