<?php
require_once './vendor/autoload.php';

$API = new jobWizardProject\InnerAPI();
$industries = $API->AllIndustries();
// for($i=0;$i<sizeof($indstries);$i++){
//   echo $indstries[$i]["Industry"];
// }
require_once "./Views/industryPerYear.phtml";
?>
