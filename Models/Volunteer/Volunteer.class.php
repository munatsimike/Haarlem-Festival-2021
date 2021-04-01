<?php
class Volunteer
{
    public string $employeeType;
    public string $password;
    public string $email;

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $fun='__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $fun), $arguments);
        }
    }

    public function __construct1(string $email)
    {
        $this->email = $email;
    }

    public function __construct2(string $email, string $password)
    {
        $this->__construct1($email);
        $this->password = $password;
    }

    public function __construct3(string $email, string $password, string $employeeType)
    {
        $this->__construct2($email, $password);
        $this->employeeType = $employeeType;
    }
}