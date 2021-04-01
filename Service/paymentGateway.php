<?php
if ( ! isset($_SESSION)) session_start();
require_once '../Views/myAutoLoader.php';
require_once ("mollie/vendor/autoload.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_SESSION['customer'] = new Customer(trim($_POST['firstName']), trim($_POST['lastName']), trim($_POST['email']));
try{
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8"); // key from the slides
    $amount =  number_format($_SESSION['total'], 2);
    $payment = $mollie->payments->create([
            "amount" => [
            "currency" => "EUR",
            "value" => "$amount"
        ],
        "description" => "Haarlem Festival Payment",
        "redirectUrl" => "http://localhost/Views/paymentViews/payment-confirmation.php?payment=success",
    ]);
     header("Location: " . $payment->getCheckoutUrl(), true, 303);
} catch (Exception $msg) {
            $_SESSION['paymentError'] = $msg;
            header("location: ../Views/paymentViews/checkout-form.php");
    }
}
    ?>