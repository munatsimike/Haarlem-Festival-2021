<?php
if ( ! isset($_SESSION)) session_start();
require_once '../Views/myAutoLoader.php';
require_once ("mollie/vendor/autoload.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_SESSION['customer'] = new Customer(trim($_POST['firstname']), trim($_POST['lastname']), trim($_POST['email']));
try{

    $orderId = time();
    
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8"); // key from the slides
    $amount =  number_format($_SESSION['total'], 2);
    $payment = $mollie->payments->create([
            "amount" => [
            "currency" => "EUR",
            "value" => "$amount"
        ],

        "description" => "Haarlem Festival Payment",
        "redirectUrl" => "http://localhost/Views/paymentViews/payment-confirmation.php?orderId=$orderId",
         "webhookUrl" => "https://bf1da04b40b7.ngrok.io/Service/webhook.php",
           "metadata" => [
           "order_id" => $orderId,
        ],
    ]);
    
     header("Location: " . $payment->getCheckoutUrl(), true, 303);
    } catch (Exception $msg) {
            new ErrorLog($msg->getMessage());
            header("location: ../Views/paymentViews/checkout-form.php?error=error");
    }
}
    ?>