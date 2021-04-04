<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";
if (!isset($_SESSION)) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $redirectToPage = "../../Views/CMS/cms.php";

    if (isset($_POST['form-name']) && $_POST['form-name'] === FormName::LOGIN()->getValue()) {
        $volunteer = (new Volunteer(trim($_POST['email'])));
        try {
                $volunteerController = new VolunteerController($volunteer);
                $fetchedData = $volunteerController->fetchPasswordEmployeeType();
        } catch (Exception $error) {
                new ErrorLog($error->getMessage());
                header("Location: $redirectToPage");
       }

       // check if password is valid
       if (password_verify(trim($_POST['password']), $fetchedData['password'])) {
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $volunteer->email;
            $_SESSION["employeeType"] = $fetchedData["employee_type"];
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
           header("Location: ".$redirectToPage."?registration=false");
        }
    }

    // check if account already exist ajax call
    if (isset($_REQUEST['email'])) {
        $volunteerContorller = new VolunteerController(new Volunteer($_REQUEST['email']));
       die(json_encode($volunteerContorller->isEmailAvailable()));
    }

} else {
    header("Location: $redirectToPage");
}
