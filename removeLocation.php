<?php
require('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Removing Locations';
require_once  './vendor/autoload.php';
$locationdb = new JobWizardProject\LocationTable();
$pageStart = 0;
$rowCount = ($pageStart+1)*10;
$locationList = $locationdb->fetchLocations($pageStart,$rowCount);

if(isset($_POST['Dsubmit']))
{

    $respond = $locationdb->deleteLocation($_POST['Location_Id']);
    if($respond)
    {
        redirectTo("./removeLocation.php");
    }
    else
    {
        $view->result = '<div class="alert alert-danger">Please check your input </div>';
    }

}
require_once "./Views/removeLocation.phtml";
?>
