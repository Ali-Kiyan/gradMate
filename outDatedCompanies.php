<?php
// require('./Views/Template/includedFunctions.php');
// confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Deleting Outdated Companies';
require_once  './vendor/autoload.php';
$companydb = new JobWizardProject\CompanyTable();

$pageStart = 0;
$rowCount = ($pageStart+1)*10;
$companyList = $companydb->fetchOutdatedCompanies($pageStart,$rowCount);

if(isset($_POST['Dsubmit']))
{
    $respond = $companydb->deleteCompany($_POST['Company_Id']);
    if($respond)
    {
        redirectTo("./outDatedCompanies.php");
        $view->result = '<div class="alert alert-success">Successfully Updated </div>';
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}

require_once "./Views/outDatedCompanies.phtml"

?>
