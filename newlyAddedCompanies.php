<?php
// require('./Views/Template/includedFunctions.php');
// confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Adding Newly Added Companies';
require_once  './vendor/autoload.php';
$companydb = new JobWizardProject\CompanyTable();

$pageStart = 0;
$rowCount = ($pageStart+1)*10;
$companyList = $companydb->fetchNewlyAddedCompanies($pageStart,$rowCount);

require_once "./Views/newlyAddedCompanies.phtml";
?>
