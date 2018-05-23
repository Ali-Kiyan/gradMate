<?php
header('Content-Type: application/json');
require_once "../Views/Template/includedFunctions.php";
confirmLoggedIn();

require_once '../vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$stableCompaniesPerIndustry = $API->stableCompaniesCoordinates($_GET['Industry']);
echo $stableCompaniesPerIndustry;


?>
