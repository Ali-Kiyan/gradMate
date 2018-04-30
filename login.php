<?php
$view = new stdClass();
$view->pageTitle = 'Login';
require_once './vendor/autoload.php';

if(isset($_POST['Lsubmit']))
{
    $database = new jobWizardProject\UserTable();
    $result = $database->auth($_POST["Username"], $_POST["Password"]);
    if($result)
    {
      (($_SESSION["Is_Admin"])==1?header('location: ./adminDashboard.php'):header('location: ./Dashboard.php'));
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Username/Password is wrong </div>';
    }

}

require_once './Views/login.phtml';
