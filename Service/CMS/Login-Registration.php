<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_POST['form-name'] === FormName::LOGIN) {

       $volunteer = (new Volunteer(trim($_POST['username']), trim($_POST['password'])));
       $result = VolunteerController::VolunteerController()->IsUsernamePasswordValid($volunteer);

       if ($result) {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("Location: ../../Views/CMS/cms.php");
                exit;
            }
            
            if (!isset($_SESSION)) session_start();
            
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $volunteer->username;
            header("Location: ../../Views/CMS/cms.php");

       } else {
           throw new ConnectionFailureException;
       }
    }

    if ($_POST['form-name'] === FormName::REGISTRATION) {
     VolunteerController::VolunteerController()->storeVolunteer(new Volunteer(trim($_POST['username']), password_hash(trim($_POST['password']), PASSWORD_DEFAULT), trim($_POST['email']), intval(trim($_POST['phone']))));
     header("Location: ../../Views/CMS/cms.php");
    }
}