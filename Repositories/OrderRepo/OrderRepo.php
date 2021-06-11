<?php

class OrderRepo extends Repo
{
    private OrderItemRepo $orderItemRepo;

    function __construct()
    {
        parent::__construct();
        $this->orderItemRepo = new OrderItemRepo();
    }

    public function storeOrder(Order $order) : void
    {    
        $status = (string)$order->status;
        $orderNumber = $order->orderNumber;

        $this->pdo->query("INSERT INTO order_table (ID, status) VALUES ('$orderNumber','$status')");
        $this->orderItemRepo->storeOrderItems($orderNumber, $order->orderItems);
    }

    public function updateOrderStatus(int $orderId, PaymentStatus $status) : void
    {   
        $paymentStatus = (string) $status;
        $this->pdo->query("UPDATE order_table SET status = '$paymentStatus' WHERE ID =$orderId");
    }

    public function orderIdExist(int $orderId) : bool
    {
        $stmt = $this->pdo->prepare("SELECT status FROM order_table WHERE ID = :id");
			         $stmt->execute([':id' => $orderId]);
       
        return $stmt->fetchColumn();
     }

     public function fetchOrderStatus( int $orderId) : PaymentStatus
     {
         $stmt = $this->pdo->prepare("SELECT status FROM order_table WHERE ID = :id");
                 $stmt->execute([':id' => $orderId]);
        
         return PaymentStatus::fromString($stmt->fetchColumn());
    }
}
