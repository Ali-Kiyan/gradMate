<?php
$view = new stdClass();
$view->pageTitle = 'Database';
require_once './vendor/autoload.php';
$database = new jobWizardProject\UserTable();
$view->userList = $database->fetchAllUsers();
var_dump($view->userList);
