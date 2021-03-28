<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/Views/myAutoloader.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/Service/Login-Registration/Login-Registration.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_POST['form-name'] === 'registration') {
    VolunteerController::VolunteerController()->storeVolunteer(new Volunteer($_POST['username'], $_POST['password'], $_POST['email'], intval($_POST['phone'])));
    //VolunteerController::VolunteerController()->storeVolunteer(new Volunteer('munatsimike', 'rukudzo', 'munatsimike@gmail.com',intval("0774163923")));

    }
}