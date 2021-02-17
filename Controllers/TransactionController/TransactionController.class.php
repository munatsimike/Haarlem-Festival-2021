<?php	
	 class TransactionController
	{
		public TransactionRepo $repo;

		public function __construct()
		{
			$this->repo ?? $this->repo = new TransactionRepo();
		}

		public function storeTransaction(Transaction $transaction) : int
		{
			return $this->repo->storeTransaction($transaction);
		}
	}
?>
