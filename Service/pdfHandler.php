
<?php
if ( ! isset($_SESSION)) session_start();
require_once '../Views/myAutoLoader.php';

if (! isset($_GET['id']) || ! isset($_SESSION['customer'])) {
    header("location: ../../index.php");
  } 
  
  $orderId = $_GET['id'];
  $orderController = new OrderController();
  $pdfInvoiceHandler = new PdfInvoiceHandler($orderController->fetchOrderItems($orderId), $orderId, unserialize(serialize($_SESSION['customer'])));
  $pdfInvoice = $pdfInvoiceHandler->createPdfInvoice();
  $pdfInvoiceHandler->displayPdfDocument($pdfInvoice);

  session_unset();

 ?>
 