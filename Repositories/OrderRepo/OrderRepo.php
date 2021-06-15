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
        $orderNumber = $order->orderNumber->getValue();

        $this->pdo->query("INSERT INTO order_table (ID, status) VALUES ('$orderNumber','$status')");
        $this->orderItemRepo->storeOrderItems($order->orderNumber, $order->orderItems);
    }

    public function updateOrderStatus(OrderNumber $orderId, PaymentStatus $status) : void
    {   
        $paymentStatus = (string) $status;
        $orderNum = $orderId->getValue();
        $this->pdo->query("UPDATE order_table SET status = '$paymentStatus' WHERE ID =$orderNum");
    }

    public function orderIdExist(OrderNumber $orderId) : bool
    {
        $orderNum = $orderId->getValue();
        $stmt = $this->pdo->prepare("SELECT status FROM order_table WHERE ID = :id");
			         $stmt->execute([':id' => $orderNum]);
       
        return $stmt->fetchColumn();
     }

     public function fetchOrderStatus(OrderNumber $orderId) : PaymentStatus
     {
         $orderNum = $orderId->getValue();
         $stmt = $this->pdo->prepare("SELECT status FROM order_table WHERE ID = :id");
                 $stmt->execute([':id' => $orderNum]);
        
         return PaymentStatus::fromString($stmt->fetchColumn());
    }
}
