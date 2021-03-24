<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Service/PHPMailer/src/Exception.php';
require '../../Service/PHPMailer/src/PHPMailer.php';
require '../../Service/PHPMailer/src/SMTP.php';

class ReceiptSender
{
   private const SENDER  = "hfestival21@gmail.com";
   private const PASSWORD = 'pnvwpmyzrznrlsjo';

   private $recipientEmail;
   private $recipientName;
   private $file;

   function __construct(string $recipientEmail, string $recipientName, string $file) 
   {
      $this->recipientEmail = $recipientEmail;
      $this->recipientName = $recipientName;
      $this->file = $file;
   }

   public function sendReceipt() {

         $mail = new PHPMailer(TRUE);

         try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = self::SENDER;
            
            /* App password. */
            $mail->Password = self::PASSWORD;
         
            // sender
            $mail->setFrom(self::SENDER, 'Haarlem Festival Team');
            // recipient
            $mail->addAddress($this->recipientEmail, $this->recipientName);
            $mail->Subject = 'Haarmel Festival Receipt';
            $mail->Body = 'Dear'.$this->recipientName.'Please find attached an invoice for [insert amount]';
            $mail->AddStringAttachment($this->file, 'Haarlem Festival Receipt.pdf');

            // send invoice
             $mail->send();

         }
         catch (Exception $e)
         {
            /* PHPMailer exception. */
            echo $e->errorMessage();
         }
         catch (\Exception $e)
         {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            echo $e->getMessage();
         }
   }
}

