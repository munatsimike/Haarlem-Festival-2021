<?php	
	 class OrderController
	{
		private OrderRepo $orderRepo;
		private OrderItemRepo $orderItemRepo;

		public function __construct()
		{
			$this->orderRepo = new OrderRepo();
			$this->orderItemRepo = new OrderItemRepo();

		}

		public function storeOrder(Order $order) : void
		{
			$this->orderRepo->storeOrder($order);
		}

		public function orderIdExist(OrderNumber $orderId) : bool
		{
			return $this->orderRepo->orderIdExist($orderId);
		}

		public function updateOrderStatus(OrderNumber $orderId, PaymentStatus $status) : void
		{
			$this->orderRepo->updateOrderStatus($orderId, $status);
		}

		public function fetchOrderStatus(OrderNumber $orderId) : PaymentStatus
		{
			return $this->orderRepo->fetchOrderStatus($orderId);
		}

		public function updateNumberOfTickets(OrderNumber $orderId) : void
		{
			$this->orderItemRepo->updateNumberOfTickets($orderId);
		}

		public function fetchOrderItems(OrderNumber $orderId) : array
		{
			return $this->orderItemRepo->fetchOrderItems($orderId);
		}
	}
?>
