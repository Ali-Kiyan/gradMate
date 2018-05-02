<?php

namespace jobWizardProject;
session_start();
require_once __DIR__ . '/Location.php';
require_once __DIR__ . '/TableAbstract.php';
// require_once "./Views/Template/includedFunctions.php";

class LocationTable extends TableAbstract {

    protected $name = 'LocationDetail';
    protected $primaryKey = 'Location_Id';

    // FETCHING Locations
    public function fetchLocations($start,$count) {
      $sql = "SELECT * FROM $this->name LIMIT $start,$count";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      $locationArray = array();
      while($row = $results->fetch()) {
        $locationArray[] = new Location($row);
      }
      return $locationArray;
    }

    //
    // // INSERT COMPANY
    // public function insertCompany($data)
    // {
    //     // Converting Null value of php to null value of mysql
    //     $data["Company_Name"] == null ? $data["Company_Name"] = NULL : $data["Company_Name"];
    //     // extra security check in the backend
    //     if($data["Company_Name"] == NULL || $data["Company_Name"] == "")
    //     return false;
    //     $sql = "INSERT INTO $this->name (Company_Name, Company_Website, Town, County, Main_Tier, Subtier, Industry, Date_Added, Location_Id) VALUES (:Company_Name, :Company_Website, :Town, :County, :Main_Tier, :Subtier, :Industry, :Date_Added, :Location_Id);";
    //     $result = $this->dbh->prepare($sql);
    //
    //     $params = array(
    //       ':Company_Name' => $data['Company_Name'],
    //       ':Company_Website' => $data['Company_Website'],
    //       ':Town' => $data['Town'],
    //       ':County' => $data['County'],
    //       ':Main_Tier' => $data['Main_Tier'],
    //       ':Subtier' => $data['Subtier'],
    //       ':Industry' => $data['Industry'],
    //       ':Date_Added' => $data['Date_Added'],
    //       ':Location_Id' =>  $data['Location_Id']
    //     );
    //     $response  = $result->execute($params);
    //     return $response;
    // }
    //
    //
    // //DELETE Company
    //
    //
    // public function deleteCompany($key)
    // {
    //     $sql = "DELETE FROM $this->name WHERE $this->primaryKey = :Company_Id";
    //     $params = array(':Company_Id' => $key);
    //     $results = $this->dbh->prepare($sql);
    //     $response = $results->execute($params);
    //     return $response;
    //
    // }


}
