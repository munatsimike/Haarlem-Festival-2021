<?php
class CustomerRepo extends EventRepo
{
    public function createCustomerId() : int
    {               
            $this->pdo->query('INSERT INTO customer (ID) VALUES (DEFAULT)');
            return  $this->pdo->lastInsertId();
    }
}
