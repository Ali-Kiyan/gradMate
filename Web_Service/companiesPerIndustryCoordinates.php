<?php
header('Content-Type: application/json');
require_once "../Views/Template/includedFunctions.php";
// confirmAdmin();

require_once '../vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$companiesPerIndustryCoordinates = $API->companiesPerIndustryCoordinates($_GET['Industry']);
echo $companiesPerIndustryCoordinates;

?>
