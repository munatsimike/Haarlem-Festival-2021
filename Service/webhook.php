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
        $orderId = new OrderNumber(strval($payment->metadata->order_id));
        $orderController = new OrderController();

        /*
        * Update order in the database.
        */
        $orderController->updateOrderStatus($orderId, PaymentStatus::fromString($payment->status));

    if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
        $orderController->updateNumberOfTickets($orderId);

        // email pdf invoice
        $customer = unserialize($payment->metadata->customer);
        $pdfInvoiceHandler = new PdfInvoiceHandler($orderController->fetchOrderItems($orderId), $orderId, $customer);
        $pdfInvoice = $pdfInvoiceHandler->createPdfInvoice();

        $subject = "Haarlem Festival Invoice";
        $message = "Dear ". (string)$customer." Please find attached your haarlem festival invoice, Thank you for your purchase";
        $pdfInvoiceHandler->emailPdfDocument($pdfInvoice, $subject, $message, $customer->email);
    } 

    http_response_code(200);
    
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}