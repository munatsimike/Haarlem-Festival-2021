<?php
class Venue
{
    public string $name;
    public string $address;

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}