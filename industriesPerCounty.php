<?php
require_once "./Views/Template/includedFunctions.php";
confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Industries Per County';
require_once "./Views/industriesPerCounty.phtml";
?>
