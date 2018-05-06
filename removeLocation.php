<?php
require_once "./Views/Template/includedFunctions.php";
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Removing Locations';
require_once  './vendor/autoload.php';
$locationdb = new JobWizardProject\LocationTable();
// $rowCount = ($locationdb->pageStart+1)*10;
// $locationList = $locationdb->fetchLocations($locationdb->pageStart, $rowCount);
//
// if(isset($_POST['Dsubmit']))
// {
//
//     $respond = $locationdb->deleteLocation($_POST['Location_Id']);
//     if($respond)
//     {
//         redirectTo("./removeLocation.php");
//     }
//     else
//     {
//         $view->result = '<div class="alert alert-danger">Please check your input </div>';
//     }
//
// }
//
// if(isset($_GET['page']))
// {
//
// $_SESSION['page'] = $_SESSION['page'] + $rowCount;
// $locationdb->pageStart  = $_SESSION['page'];
// $locationList = $locationdb->fetchLocations($locationdb->pageStart, $rowCount);
//
// }



require_once "./Views/removeLocation.phtml";
?>
