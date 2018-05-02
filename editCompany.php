<?php
require('./Views/Template/includedFunctions.php');
confirmLoggedIn();
session_start();
$view = new stdClass();
$view->pageTitle = 'Add New Company';
require_once  './vendor/autoload.php';
$companydb = new JobWizardProject\CompanyTable();
if(isset($_POST['outdatedEsubmit'])){
  $_SESSION['Company_Id'] = $_POST['Company_Id'];
}
$Current_Company = $companydb->fetchCompany($_SESSION['Company_Id']);

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


require_once './Views/editCompany.phtml';
