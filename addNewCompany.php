<?php
require_once('./Views/Template/includedFunctions.php');
confirmAdmin();
$view = new stdClass();
$view->pageTitle = 'Add New Company';
require_once  './vendor/autoload.php';
//
if(isset($_POST['Asubmit'])){
  $API = new jobWizardProject\ApiCompany();
  $generalInfo = $API->fetchGeneralInfo($_POST['Company_Name']);
  $Current_Company = $API->fetchCompanyInfo($generalInfo);
}


      $locationHandle = new jobWizardProject\LocationTable();
      $locations = $locationHandle->fetchLocations(0,1000000);
      if(isset($_POST['Isubmit']))
      {
          settype($_POST['Location_Id'], int);
          $companydb = new jobWizardProject\CompanyTable();
          $respond = $companydb->insertCompany($_POST);
          if($respond)
          {

              redirectTo("./newlyAddedCompanies.php");
          }
          else
          {
              $API = new jobWizardProject\ApiCompany();
              $generalInfo = $API->fetchGeneralInfo($_POST['Company_Name']);
              $Current_Company = $API->fetchCompanyInfo($generalInfo);
              $view->result = '<div class="alert alert-danger">Please check your input </div>';
          }
        }



require_once "./Views/addNewCompany.phtml";
?>
