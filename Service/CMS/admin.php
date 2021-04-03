<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";
if (!isset($_SESSION)) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $redirectToPage = "../../Views/CMS/cms.php";

    if (isset($_POST['form-name']) && $_POST['form-name'] === FormName::LOGIN()->getValue()) {
       $volunteer = (new Volunteer(trim($_POST['email']), trim($_POST['password'])));
       try {
            $volunteerController = new VolunteerController($volunteer);
            $validLoginCredentials = $volunteerController->IsUsernamePasswordValid();
       } catch (Exception $error) {
             new ErrorLog($error->getMessage());
            header("Location: $redirectToPage");
       }

       if ($validLoginCredentials) {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("Location: $redirectToPage");
                exit;
            }

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $volunteer->email;
            header("Location: $redirectToPage");

       } else {
           
             $_SESSION['validCredentials'] = false;
             header("Location: $redirectToPage");
       }
    } 
    // new volunteer registration
    if (isset($_POST['form-name']) && $_POST['form-name'] === FormName::REGISTRATION()->getValue()) {
        try {
            $volunteerContorller = new VolunteerController(new Volunteer(trim($_POST['email']), password_hash(trim($_POST['password']), PASSWORD_DEFAULT), trim($_POST['employee-type'])));
            $volunteerContorller->createNewVolunteerAccounnt();
            header("Location: ".$redirectToPage."?registration=true");
        } catch (Exception $error) {
           new ErrorLog($error);
           header("Location: ".$redirectToPage."?registration=true");
        }
    }

    // check if account already exists ajax call
    if (isset($_REQUEST['email'])) {
        $volunteerContorller = new VolunteerController(new Volunteer($_REQUEST['email']));
       die(jason_encode($volunteerContorller->isEmailAvailable()));
    }

} else {
    header("Location: $redirectToPage");
}
