<?php
// require('./Views/Template/includedFunctions.php');
// confirmLoggedIn();
session_start();
$view = new stdClass();
$view->pageTitle = 'Add New Company';
require_once  './vendor/autoload.php';

if(isset($_POST['Asubmit'])){
  $API = new JobWizardProject\ApiCompany();
  $generalInfo = $API->fetchGeneralInfo($_POST['Company_Name']);
  $Current_Company = $API->fetchCompanyInfo($generalInfo);
}


if(isset($_POST['Isubmit']))
{

    $_SESSION['Company_Id'] = $_POST['Company_Id'];
    $respond = $companydb->editCompany($_POST);
    if($respond)
    {
        redirectTo("./editCompany.php");
        $view->result = '<div class="alert alert-success">Successfully Updated </div>';
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}



require_once "./Views/addNewCompany.phtml";
?>
