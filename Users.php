<?php
$view = new stdClass();
$view->pageTitle = 'Users';
require_once './vendor/autoload.php';
$database = new jobWizardProject\UserTable();
$view->userList = $database->fetchAllUsersInfo();



require_once  './Views/Users.phtml';
