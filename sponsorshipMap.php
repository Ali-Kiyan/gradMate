<?php
require_once "./Views/Template/includedFunctions.php";
confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Sponsoring Companies';
require_once "./Views/SponsorshipMap.phtml";
?>
