<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $redirectToPage = "../../Views/CMS/cms.php";
      $passwordResetController = new PasswordResetController();
      $volunteerController = new VolunteerController();

     if (isset($_POST['email'])) {
       $email = $_POST['email'];
       //
       // check if email exist
       if ( ! $volunteerController->isEmailAvailable(new Volunteer($email))) {
        header("location: $redirectToPage?emailExist=false"); 
       }

       $tokenExpiryDate = date('Y-m-d H:i:s', strtotime('now +1 hour'));
       // generate tokens
       $selector = bin2hex(random_bytes(8)); 
       $token = random_bytes(32);

      // generate tokens;
      //$selector = bin2hex(md5(time(). mt_rand(1,1000)));
      //$token =    md5(time(). mt_rand(1,1000000));
      try {
         $passwordResetController->storeResetPasswordCredentials(new PasswordReset($email, password_hash($token, PASSWORD_DEFAULT), $selector, $tokenExpiryDate ));
         $passwordResetLink = "http://localhost/Views/CMS/new-password-form.php?selector=$selector&token=".bin2hex($token);
         $recipient = $email;

         $subject = 'Password reset link';
         $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
         $message .= 'If you did not make this request, you can ignore this email</p>';
         $message .= sprintf('<a href="%s">%s</a></p>', $passwordResetLink, $passwordResetLink);

         $mailer = new Mailer($email, $subject, $message);
         //send link
         $mailer->sendEmail(); 
      } catch (Exception $error) {
          new ErrorLog($error->getMessage());
          header("location: $redirectToPage?linkSent=false"); 

      }
  } 
      /// reset passord- get token and selector;
     if (isset($_GET['token']) && isset($_GET['selector'])) {
         
        try {
            $passwordReset = $passwordResetController->fetchResetPasswordCredentials($_GET['selector']);
            //convert token to binary;
              $tokenBin = hex2bin($_GET['token']);
            //verify token
            if (password_verify($tokenBin, $passwordReset->token) && $passwordReset->tokenExpiryDate > date('Y-m-d H:i:s')) {
              
              $volunteerController->resetVolunteerPassword(new Volunteer($passwordReset->email, password_hash($_POST['new-password'], PASSWORD_DEFAULT)));
          }
        } catch (PasswordResetCredentialsNotFound) {
          header("location: $redirectToPage?tokenFound=false"); 

        }
  }
}

