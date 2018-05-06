<?php
require_once('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Adding Newly Added Companies';
require_once  './vendor/autoload.php';
$companydb = new jobWizardProject\CompanyTable();

$companydb->pageStart = 0;
$rowCount = ($companydb->pageStart+1)*13;
$companyList = $companydb->fetchNewlyAddedCompanies($companydb->pageStart,$rowCount);


if(isset($_GET['page']))
{

$_SESSION['page'] = $_SESSION['page'] + $rowCount;
$companydb->pageStart  = $_SESSION['page'];
$companyList = $companydb->fetchNewlyAddedCompanies($companydb->pageStart, $rowCount);

}

require_once "./Views/newlyAddedCompanies.phtml";
?>
