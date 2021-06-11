<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Views/myAutoLoader.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Service/fpdf/fpdf.php';

  abstract class PdfHandler {
  
    public function emailPdfDocument(fpdf $pdf, string $subject, string $message, $emailAddress)
    {
        try {
        // email receipt to the customer
          $mailer = new Mailer($emailAddress, $subject, $message);
          $mailer->sendEmail($pdf->Output("", "S"), 'Receipt', 'pdf');
        } catch (phpmailerException $e) {
            new ErrorLog($e->errorMessage());
        }
    }

      public function displayPdfDocument(fpdf $pdf) 
      {
        $pdf->Output();
      }
}
  
 ?>
 


 