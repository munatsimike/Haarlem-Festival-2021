<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";
if (!isset($_SESSION)) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $redirectToPage = "../../Views/CMS/cms.php";

    if (isset($_POST['form-name']) && $_POST['form-name'] === FormName::LOGIN()->getValue()) {
       $volunteer = (new Volunteer(trim($_POST['email']), trim($_POST['password'])));
       try {
            $result = VolunteerController::VolunteerController()->IsUsernamePasswordValid($volunteer);
       } catch (Exception $errorMsg) {
            $_SESSION['validCredentials'] = $errorMsg;
            header("Location: $redirectToPage");
       }

       if ($result) {
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                header("Location: $redirectToPage");
                exit;
            }

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $volunteer->username;
            header("Location: $redirectToPage");

       } else {
           
             $_SESSION['validCredentials'] = false;
             header("Location: $redirectToPage");
       }
    } 
    
    if (isset($_POST['form-name']) && $_POST['form-name'] === FormName::REGISTRATION()->getValue()) {
        try {
            VolunteerController::VolunteerController()->storeVolunteer(new Volunteer(trim($_POST['email']), password_hash(trim($_POST['password']), PASSWORD_DEFAULT), trim($_POST['employee-type'])));
            $_SESSION['registration'] = true;
        } catch (PDOException $msg) {
            $_SESSION['registration'] = $msg;
        } finally {
            header("Location: $redirectToPage");
        }
    }

    if (isset($_REQUEST['email'])) {
       $isEmailAvailable = VolunteerController::VolunteerController()->isEmailAvailable(new Volunteer($_REQUEST['email']));
       die(json_encode($isEmailAvailable));
    }

} else {
    header("Location: $redirectToPage");
}
