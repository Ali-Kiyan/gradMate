<?php
require('./Views/Template/includedFunctions.php');
confirmLoggedIn();
session_start();
$view = new stdClass();
$view->pageTitle = 'Edit Location';
require_once  './vendor/autoload.php';
$locationdb = new JobWizardProject\LocationTable();

if(isset($_POST['editLocationSubmit'])){
  $_SESSION['Location_Id'] = $_POST['Location_Id'];
}

$Current_Location = $locationdb->fetchLocation($_SESSION['Location_Id']);

if(isset($_POST['Usubmit']))
{
    $_SESSION['Location_Id'] = $_POST['Location_Id'];
    $respond = $locationdb->editLocation($_POST);
    if($respond)
    {
        redirectTo("./editLocation.php");
        $view->result = '<div class="alert alert-success">Successfully Updated </div>';
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}


require_once './Views/editLocation.phtml';
