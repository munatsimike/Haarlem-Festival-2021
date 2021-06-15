<?php
if ( ! isset($_SESSION)) session_start();
require_once '../Views/myAutoLoader.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['total'])) {
    $_SESSION['customer'] = new Customer(trim($_POST['firstname']), trim($_POST['lastname']), trim($_POST['email']));
    $customer = serialize($_SESSION['customer']);
    $amount =  number_format($_SESSION['total'], 2);

    $orderNumGenerator = OrderNumberGenerator::getInstance();    
    $orderNumber = $orderNumGenerator->generateOrderNumber();
    $intOrderNum = $orderNumber->getValue();

try{
    require "initializeMollie.php";
    $payment = $mollie->payments->create([
              "amount" => [
            "currency" => "EUR",
               "value" => "$amount"
        ],

        "description" => "Haarlem Festival Order : {$intOrderNum}",
        "redirectUrl" => "http://localhost/Views/paymentViews/payment-confirmation.php?orderId=$intOrderNum",
         "webhookUrl" => "https://d23528e12489.ngrok.io/Service/webhook.php",
           "metadata" => [
           "order_id" => $intOrderNum, 
            'customer'=> $customer
        ],
    ]);
    
     $status = PaymentStatus::fromString($payment->status);
     $order = new Order($orderNumber, Cart::getCartItems(), $status);
     $orderController = new OrderController();
     $orderController->storeOrder($order);
      /*
     * Send the customer off to complete the payment.
     * This request should always be a GET, thus we enforce 303 http response code
     */
     header("Location: " . $payment->getCheckoutUrl(), true, 303);

    }catch (InvalidPaymentStatusException $status) {
            echo InvalidPaymentStatusException::forValue($status);
    }
}
    ?>