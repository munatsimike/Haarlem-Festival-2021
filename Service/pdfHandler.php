
<?php
require_once '../Views/myAutoLoader.php';

    $cartItems = Cart::getCartItems();
if ($cartItems !== null && isset($_GET['status']) && $_GET['status'] = "paid") {
    $customer = $_SESSION['customer'];
    $orderId = 23;

  } else {
  header("location: ../../index.php");
}
  $orderController = new OrderController();
  $orderController->fetchOrderItems($orderId);
  $pdfInvoiceHandler = new PdfInvoiceHandler($cartItems, $orderId, $customer);
  $pdfInvoice = $pdfInvoiceHandler->createPdfInvoice();
  
  $pdfInvoiceHandler->displayPdfDocument($pdfInvoice);

  session_unset();

 ?>
 


 