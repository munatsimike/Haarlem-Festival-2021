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
		
			foreach ($transaction->cartItems as $item) {
			$this->pdo->prepare("INSERT INTO transaction(customer_Id, event_Id, quantity) VALUES (:customerId, :eventId, :quantity)")
					 ->execute(['customerId'=>$customerId, 'eventId'=>$item->id, 'quantity'=>$item->quantity]);

			  $this->jazzRepo->updateNumberOfSeats($item->id, $item->quantity);
			}

			return $customerId;
		}
	}

?>
