<?php
class CustomerRepo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::DBConnection();
    }

    public function createCustomerId() : int
    {               
            $this->pdo->query('INSERT INTO customer (ID) VALUES (DEFAULT)');
            return  $this->pdo->lastInsertId();
    }
}

?>