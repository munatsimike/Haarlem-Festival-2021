<?php	
	 require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

	 class OrderItemRepo extends Repo
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function storeOrderItems(int $orderNumber, array $orderItems) 
		{	//die(print_r($orderItems));
			try {			
				foreach (unserialize(serialize($orderItems)) as $item) {
				$this->pdo->prepare("INSERT INTO order_item(order_id, event_id, description, quantity, price) VALUES (:orderId,  :eventId, :description, :quantity, :price)")
						->execute(['orderId'=>$orderNumber, 'eventId'=>$item->id, 'description'=>$item->description, 'quantity'=>$item->quantity, 'price'=>$item->unitPrice]);
				}

			} catch (Exception $error) {
				throw $error;
			}
		}

		public function fetchOrderItems(int $orderId) : array
		{
			return $this->pdo->query("SELECT description, quantity, price FROM order_item WHERE order_id = '$orderId'")->fetchAll();
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
