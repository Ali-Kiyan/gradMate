<?php
require_once  "./Views/template/includedFunctions.php";
confirmLoggedIn ();
$view = new stdClass();
$view->pageTitle = 'User Profile';
require_once  './vendor/autoload.php';

$userdb = new JobWizardProject\UserTable();
$Current_User = $userdb->fetchUserInfo($_SESSION['User_id']);
var_dump($Current_User);
// var_dump($Current_User->getFirstName());
if(isset($_POST['Usubmit']))
{
    $userdb = new jobWizardProject\UserTable();
    $_SESSION["First_Name"] = $_POST["First_Name"];
    $_SESSION["Username"] = $_POST["Username"];
    $_SESSION["Password"] = $_POST["Password"];


    $respond = $userdb->editUser($_POST);

    if($respond)
    {
        redirect_to("./UserProfile.php");
        $view->result = '<div class="alert alert-success">Successfully Updated </div>';
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}


require_once './Views/userprofile.phtml';
