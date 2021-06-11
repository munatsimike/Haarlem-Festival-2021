
<?php
require_once '../Views/myAutoLoader.php';

    $cartItems = Cart::getCartItems();
if ($cartItems !== null && isset($_GET['status']) && $_GET['status'] = "paid") {
    $customer = $_SESSION['customer'];

  } else {
  header("location: ../../index.php");
}
  $pdfInvoiceHandler = new PdfInvoiceHandler($cartItems, 23, $customer);
  $pdfInvoice = $pdfInvoiceHandler->createPdfInvoice();

 // email pdf invoice
 $subject = "Haarlem Festival Invoice";
 $message = "Dear ". (string)$customer." Please find attached your haarlem festival invoice, Thank you for your purchase";
 $pdfInvoiceHandler->emailPdfDocument($pdfInvoice, $subject, $message, $customer->email);

  $pdfInvoiceHandler->displayPdfDocument($pdfInvoice);

  session_unset();

 ?>
 


 