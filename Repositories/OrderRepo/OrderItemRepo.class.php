<?php	
	 require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

	 class OrderItemRepo extends Repo
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function storeOrderItems(int $orderNumber, array $orderItems) 
		{	
			try {			
				foreach (unserialize(serialize($orderItems)) as $item) {
				$this->pdo->prepare("INSERT INTO order_item(order_id, event_id, quantity) VALUES (:orderId, :eventId, :quantity)")
						->execute(['orderId'=>$orderNumber, 'eventId'=>$item->id, 'quantity'=>$item->quantity]);
				}

			} catch (Exception $error) {
				throw $error;
			}
		}

		// update number of seats after every successfuly transaction
		public function updateNumberOfTickets(int $orderId) : void
		{
			$data = $this->pdo->query("SELECT event_id, quantity FROM order_item WHERE order_id = '$orderId'")->fetchAll();
		
			foreach($data as $row) {
				$this->pdo->prepare("UPDATE event SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$row['event_id'], 'quantity'=>$row['quantity']]);
			}
		}
	}

?>
