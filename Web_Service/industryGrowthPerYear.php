<?php
header('Content-Type: application/json');
require_once "../Views/Template/includedFunctions.php";
// confirmAdmin();

require_once '../vendor/autoload.php';
$companies = new jobWizardProject\InnerAPI();
$companiesPerCounty = $companies->industryGrowthPerYear('IT');
echo $companiesPerCounty;

//industeries
// $indstries = $companies->AllIndustries();
// for($i=0;$i<sizeof($indstries);$i++){
//   echo $indstries[$i]["Industry"];
// }


?>
