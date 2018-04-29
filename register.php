<?php
$view = new stdClass();
$view->pageTitle = 'Sign Up';
require_once './vendor/autoload.php';

if(isset($_POST['Rsubmit']))
{

    $handle = new jobWizardProject\UserTable();

    $response = $handle->insertUser($_POST);

     if(!$response)
     {
         $view->result = '<div class="alert alert-danger">Please check you input </div>';
     }
     else
     {
         $view->result = '<div class="alert alert-success">You are successfully added to the database, log in !</div>';
     }

}


require_once  './Views/register.phtml';
