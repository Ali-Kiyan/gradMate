<?php
require_once "./Views/Template/includedFunctions.php";
confirmLoggedIn();
$view = new stdClass();
$view->pageTitle = 'Industry In Counties';
require_once "./Views/industriesInCounties.phtml"
?>
