<?php
// require('./Views/Template/includedFunctions.php');
// confirmLoggedIn();
session_start();
$view = new stdClass();
$view->pageTitle = 'Add New Company';
require_once  './vendor/autoload.php';
$_SESSION['Company_Id'] = 29240;
$companydb = new JobWizardProject\CompanyTable();
$Current_Company = $companydb->fetchCompany($_SESSION['Company_Id']);

if(isset($_POST['Isubmit']))
{
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
