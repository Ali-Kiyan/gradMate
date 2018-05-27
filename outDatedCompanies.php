<?php
require('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Deleting Outdated Companies';
require_once  './vendor/autoload.php';
$companydb = new jobWizardProject\CompanyTable();

$companydb->pageStart = 0;
$rowCount = ($pageStart+1)*12;
$companyList = $companydb->fetchOutdatedCompanies($companydb->pageStart,$rowCount);

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


if(isset($_GET['page']))
{

$_SESSION['page'] = $_SESSION['page'] + $rowCount;
$companydb->pageStart  = $_SESSION['page'];
$companyList = $companydb->fetchOutdatedCompanies($companydb->pageStart, $rowCount);
if(empty($companyList)){
$_SESSION['page'] = 0;
}
}




require_once "./Views/outDatedCompanies.phtml"

?>
