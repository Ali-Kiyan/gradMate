<?php
require_once './vendor/autoload.php';
$API = new jobWizardProject\InnerAPI();
$industries = $API->AllIndustries();
require_once "./Views/industryMap.phtml";
?>
