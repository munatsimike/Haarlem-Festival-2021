
<?php
session_start();
require_once '../myAutoLoader.php';

  $pdfHandler = new PdfHandler();

  $pdfHandler->createPdfInvoice();
  $pdfHandler->sendPdfInvoice();
  $pdfHandler->displayPdfInvoice();

  session_unset();
 ?>
 


 