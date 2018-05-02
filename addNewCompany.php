<?php
require('./Views/Template/includedFunctions.php');
confirmAdmin();
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
    $companydb = new JobWizardProject\CompanyTable();
    $respond = $companydb->insertCompany($_POST);
    if($respond)
    {
        redirectTo("./addNewCompany.php");
    }
    else
    {
        $API = new JobWizardProject\ApiCompany();
        $generalInfo = $API->fetchGeneralInfo($_POST['Company_Name']);
        $Current_Company = $API->fetchCompanyInfo($generalInfo);
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }


}



require_once "./Views/addNewCompany.phtml";
?>
