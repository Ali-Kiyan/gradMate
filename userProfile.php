<?php
require_once "./Views/Template/includedFunctions.php";
// confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'User Profile';
require_once  './vendor/autoload.php';

// $userdb = new JobWizardProject\UserTable();
// $Current_User = $userdb->fetchUserInfo($_SESSION['User_id']);
// if(isset($_POST['Usubmit']))
// {
//     $userdb = new jobWizardProject\UserTable();
//     $_SESSION["Username"] = $_POST["Username"];
//     $_SESSION["Password"] = $_POST["Password"];
//     $respond = $userdb->editUser($_POST);
//
//     if($respond)
//     {
//         redirectTo("./userProfile.php");
//         $view->result = '<div class="alert alert-success">Successfully Updated </div>';
//     }
//     else
//     {
//         $view->result = '<div class="alert alert-danger">Please check your input </div>';
//     }
//
// }


require_once './Views/userProfile.phtml';
