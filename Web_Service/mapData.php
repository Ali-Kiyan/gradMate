<?php

require_once "../Views/Template/includedFunctions.php";
confirmLoggedIn();

require_once '../vendor/autoload.php';
$companies = new jobWizardProject\InnerAPI();
$companiesPerCounty = $companies->companiesPerCounty();
$CompaniesPerCordinate = $companies->CompaniesPerCordinate($companiesPerCounty);
echo $CompaniesPerCordinate;

?>
