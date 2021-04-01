<?php
class CustomerRepo extends Repo
{
    public function createCustomerId() : int
    {               
            $this->pdo->query('INSERT INTO customer (ID) VALUES (DEFAULT)');
            return  $this->pdo->lastInsertId();
    }
}
