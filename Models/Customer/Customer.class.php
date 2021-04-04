<?php

 class Customer
{
    public string $firstName;
    public string $lastName;
    public string $email;

    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName =  $lastName;
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->CapitalizeFirstLetter($this->firstName)." ". $this->CapitalizeFirstLetter($this->lastName);
    }

    public function CapitalizeFirstLetter(string $str)
    {
        return ucfirst(strtolower($str));

    }
}