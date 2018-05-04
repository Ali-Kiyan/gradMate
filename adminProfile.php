<?php
require('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Admin Profile';
require_once  './vendor/autoload.php';

$userdb = new JobWizardProject\UserTable();
$Current_User = $userdb->fetchUser($_SESSION['User_id']);
if(isset($_POST['Usubmit']))
{
    $_SESSION["Username"] = $_POST["Username"];
    $_SESSION["Password"] = $_POST["Password"];
    $respond = $userdb->editAdmin($_POST);
    if($respond)
    {
        redirectTo("./adminProfile.php");
        $view->result = '<div class="alert alert-success">Successfully Updated </div>';
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}


require_once './Views/adminProfile.phtml';
