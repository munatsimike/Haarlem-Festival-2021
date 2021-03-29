<?php
class Volunteer
{
    public string $username;
    public string $password;
    public string $email;
    public int $phoneNumber;

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $fun='__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $fun), $arguments);
        }
    }

    public function __construct1(string $username)
    {
        $this->username = $username;
    }

    public function __construct2(string $username, string $password)
    {
        $this->__construct1($username);
        $this->password = $password;
    }

    public function __construct4(string $username, string $password, string $email, int $phoneNumber)
    {
        $this->__construct2($username, $password);
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
}