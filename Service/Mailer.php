<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer
{
   private const SENDER  = "hfestival21@gmail.com";
   private const PASSWORD = 'pnvwpmyzrznrlsjo';

   private string $recipient;
   private string $subject;
   private string $message;

   function __construct(string $recipient, string $subject, string $message) 
   {
      $this->recipient = $recipient;
      $this->subject = $subject;
      $this->message = $message;
   }

   public function sendEmail(string $file="", string $fileName="", string $extension="") 
   {
      $mail = new PHPMailer(TRUE);

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
      $mail->addAddress($this->recipient);
      $mail->Subject = $this->subject;
      $mail->Body = $this->message;
      $mail->IsHTML(true);  

      if ($file !== "") {
         $mail->AddStringAttachment($file,  $fileName.'.'.$extension);
      }

      $mail->send();
   }
}

