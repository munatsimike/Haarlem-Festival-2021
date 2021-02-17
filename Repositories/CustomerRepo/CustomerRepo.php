<?php
class CustomerRepo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::DBConnection();
    }

    public function storeCustomer(Customer $customer) : int
    {    
        // check if customer exists
        $stmt = $this->pdo->prepare('SELECT id FROM customer WHERE email=:email');
        $stmt->bindParam('email', $customer->email);
        $stmt->execute();
        $customerId = $stmt->fetch(PDO::FETCH_CLASSTYPE);
    
        if ( is_bool($customerId)) {  
            // insert new customer                      
            $this->pdo->prepare('INSERT INTO customer (first_name, last_name, email, address) VALUES (:firstName, :lastName, :email)')
                        ->execute(['firstName'=>"$customer->firstName", 'lastName'=>"$customer->lastName", 'email'=>"$customer->email"]);
                $customerId = $this->pdo->lastInsertId();
        } else {
            $customerId = $customerId[0];
        }

        return $customerId;
    }

}

?>