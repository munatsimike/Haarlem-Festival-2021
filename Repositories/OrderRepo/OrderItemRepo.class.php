<?php	
	 require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';

	 class OrderItemRepo extends Repo
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function storeOrderItems(OrderNumber $orderNum, array $orderItems) 
		{	
			$orderNumber = $orderNum->getValue();
			try {			
				foreach (unserialize(serialize($orderItems)) as $item) {
				$this->pdo->prepare("INSERT INTO order_item(order_id, event_id, description, quantity, price) VALUES (:orderId,  :eventId, :description, :quantity, :price)")
						->execute(['orderId'=>$orderNumber, 'eventId'=>$item->id, 'description'=>$item->description, 'quantity'=>$item->quantity, 'price'=>$item->unitPrice]);
				}

			} catch (Exception $error) {
				throw $error;
			}
		}

		public function fetchOrderItems(OrderNumber $orderId) : array
		{
			$orderNum = $orderId->getValue();
			return $this->pdo->query("SELECT description, quantity, price FROM order_item WHERE order_id = '$orderNum'")->fetchAll();
		}

		// update number of seats after every successfuly transaction
		public function updateNumberOfTickets(OrderNumber $orderId) : void
		{
			$orderNum = $orderId->getValue();
			$data = $this->pdo->query("SELECT event_id, quantity FROM order_item WHERE order_id = '$orderNum'")->fetchAll();

			foreach($data as $row) {
				$this->pdo->prepare("UPDATE event SET seats = (seats - :quantity) WHERE id = :id")
				      	  ->execute(['id'=>$row['event_id'], 'quantity'=>$row['quantity']]);
			}
		}
	}

?>
