<?php
require('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Add New Location';
require_once  './vendor/autoload.php';

if(isset($_POST['Asubmit']))
{
  $locationHandle =new jobWizardProject\LocationTable();
  $_POST['Longitude'] = (double) $_POST['Longitude'] ;
  $_POST['Latitude'] = (double) $_POST['Latitude'] ;
  $respond = $locationHandle->insertLocation($_POST);
  if($respond)
  {
      redirectTo("./addNewLocation.php");
      $view->result = '<div class="alert alert-success">Successfully Added</div>';
  }
  else
  {
      $view->result = '<div class="alert alert-danger">Please check your input </div>';
  }

}



require_once "./Views/addNewLocation.phtml";
?>
