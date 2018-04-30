<?php
require_once "./Views/template/includedFunctions.php";
$view = new stdClass();
$view->pageTitle = 'Users';
require_once './vendor/autoload.php';
$database = new jobWizardProject\UserTable();
$view->userList = $database->fetchAllUsersInfo();
if(isset($_POST['Dsubmit'])){
  $database = new jobWizardProject\UserTable();

$respond = $database->delete($_POST['User_id']);
if($respond){
  redirectTo("./Users.php");
}
else{
  $view->result = '<div class="alert alert-danger"> Please Check your input</div>';
}


}


require_once  './Views/Users.phtml';
