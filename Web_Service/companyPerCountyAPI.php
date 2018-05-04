<?php

require_once "../Views/Template/includedFunctions.php";
// confirmAdmin();

require_once '../vendor/autoload.php';
$companies = new jobWizardProject\InnerAPI();
$x = $companies->companiesPerCounty();
$y = $companies->CompaniesPerCordinate($x);
echo $y;

?>
