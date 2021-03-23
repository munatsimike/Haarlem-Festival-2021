<?php
session_start();
require '../../myAutoLoader.php';
require_once ("../../Service/mollie/vendor/autoload.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_SESSION['customer'] = new Customer(trim($_POST['firstName']), trim($_POST['lastName']), trim($_POST['email']));

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8"); // key from the slides
    $amount =  number_format($_SESSION['total'], 2);
    $payment = $mollie->payments->create([
            "amount" => [
            "currency" => "EUR",
            "value" => "$amount"
        ],
        "description" => "Haarlem Festival Payment",
        "redirectUrl" => "http://localhost/Views/paymentViews/pdfInvoice.php",
    ]);

        try {
            header("Location: " . $payment->getCheckoutUrl(), true, 303);

        } catch (ApiException $msg) {
            header("location: checkout-form.php");
    }

}
    ?>