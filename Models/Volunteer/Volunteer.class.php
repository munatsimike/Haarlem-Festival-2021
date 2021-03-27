<?php
class Volunteer
{
    public string $username;
    public string $password;
    public string $email;
    public int $phoneNumber;

    public function __construct(string $username, string $password, string $email, int $phoneNumber)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
}