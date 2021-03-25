<?php	
	 class TransactionRepo
	{
		private PDO $pdo;
		private CustomerRepo $customerRepo;
		private JazzRepo $jazzRepo;

		public function __construct()
		{
			$this->pdo = Connection::DBConnection();
			$this->customerRepo = new CustomerRepo();
			$this->jazzRepo = new JazzRepo();
		}

		public function storeTransaction(Transaction $transaction) : int
		{	// get customer id;
			$customerId = $this->customerRepo->createCustomerId(); 
		
			//$this->pdo->query("INSERT INTO transaction (customerId) VALUES ($customerId)");
			//$transactionId = intval($this->pdo->lastInsertId());
			

			//foreach ($transaction->cartItems as $item) {
			//$this->pdo->prepare("INSERT INTO transaction(quantity, ticketId, transactionId) VALUES (:quantity, :ticketId, :transactionId)")
				//	 ->execute(['quantity'=>$item->quantity, 'ticketId'=>$item->id, 'transactionId'=>$transactionId]);

			 // $this->jazzRepo->updateNumberOfSeats($item->id, $item->quantity);
			//}

			return $customerId;
		}
	}

?>
