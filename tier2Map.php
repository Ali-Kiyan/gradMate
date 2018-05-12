<?php
require_once "./Views/Template/includedFunctions.php";
confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Tier 2 Companies';
require_once "./Views/tier2Map.phtml";
?>
