<?php	
	 class TransactionRepo extends Repo
	{
		private CustomerRepo $customerRepo;
		private JazzRepo $jazzRepo;

		public function __construct()
		{
			parent::__construct();
			$this->customerRepo = new CustomerRepo();
			$this->jazzRepo = new JazzRepo();
		}

		public function storeTransaction(Transaction $transaction) : int
		{	
			try {
				// get customer id;
					$customerId = $this->customerRepo->createCustomerId(); 
			
				foreach ($transaction->cartItems as $item) {
				$this->pdo->prepare("INSERT INTO transaction(customer_Id, event_Id, quantity) VALUES (:customerId, :eventId, :quantity)")
						->execute(['customerId'=>$customerId, 'eventId'=>$item->id, 'quantity'=>$item->quantity]);

				$this->jazzRepo->updateNumberOfSeats($item->id, $item->quantity);
				}

			} catch (Exception $error) {
				throw $error;
			}
			
			return $customerId;
		}
	}

?>
