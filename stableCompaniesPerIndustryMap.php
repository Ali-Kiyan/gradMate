<?php
require_once "./Views/Template/includedFunctions.php";
confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Stable Companies Per Industry';
require_once './vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$industries = $API->AllIndustries();
require_once "./Views/stableCompaniesPerIndustryMap.phtml";
?>
