<?php
header('Content-Type: application/json');
require_once "../Views/Template/includedFunctions.php";
confirmLoggedIn();

require_once '../vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$startUpCompaniesPerIndustry = $API->startUpCompaniesCoordinates($_GET['Industry']);
echo $startUpCompaniesPerIndustry;


?>
