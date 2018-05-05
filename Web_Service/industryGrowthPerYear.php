<?php
header('Content-Type: application/json');
require_once "../Views/Template/includedFunctions.php";
// confirmAdmin();

require_once '../vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$industerisPerYear = $API->industryGrowthPerYear($_POST["Industry"]);
echo $industerisPerYear;


?>
