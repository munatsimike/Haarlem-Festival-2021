<?php
       if ( ! isset($_SESSION)) session_start();
       require_once '../Views/myAutoLoader.php';
try {
        /*
        * Initialize the Mollie API library with API key.
        *
        */
        require "initializeMollie.php";
        
        /*
        * Retrieve the payment's current state.
        */
        $payment = $mollie->payments->get($_POST["id"]);
        $orderId = $payment->metadata->order_id;
        $orderController = new OrderController();

        /*
        * Update order in the database.
        */
        $orderController->updateOrderStatus($orderId, PaymentStatus::fromString($payment->status));

    if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
        $orderController->updateNumberOfTickets($orderId);
    } 

} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}