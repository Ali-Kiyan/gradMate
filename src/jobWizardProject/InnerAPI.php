<?php

namespace jobWizardProject;
session_start();
require_once __DIR__ . '/Company.php';
require_once __DIR__ . '/TableAbstract.php';
require_once __DIR__ . '../../../Views/Template/includedFunctions.php';

class InnerAPI extends TableAbstract {

    protected $name = 'company';
    protected $primaryKey = 'Company_Id';
    protected $locationData = 'Location_Detail';
    protected $LocationForeignKey = 'Location_Id';
    protected $numOfCompany, $county, $query, $result, $companyData = array();

    public function companiesPerCounty(){
      $sql = "SELECT COUNT(DISTINCT Company_Name) AS Companies, County FROM $this->name WHERE County != ' ' GROUP BY County HAVING COUNT(Company_Name)>0";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      while($row = $results->fetch()){
        $result[] = $row;
      }
      for($i=0;$i<sizeof($result);$i++){
        unset($result[$i][0]);
        unset($result[$i][1]);
        settype($result[$i]['Companies'] , int);
      }
      return json_encode($result);
    }

    public function CompaniesPerCordinate($inputData){
      $companyData = json_decode($inputData, true);
      for($i=0; $i<sizeof($companyData);$i++){
        $numOfCompany[$i] = $companyData[$i]["Companies"];
        $county[$i] = $companyData[$i]['County'];
        $query[$i] = "SELECT Location, Latitude, Longitude from Location_Detail where Location != 'Unknown' AND Location LIKE '". trim($county[$i]) ."%' limit 1";
      }

      for($j=0;$j<sizeof($companyData);$j++){
        $results = $this->dbh->prepare($query[$j]);
        $results->execute();
        $result[$j] = $results->fetch();
        unset($result[$j][0]);
        unset($result[$j][1]);
        unset($result[$j][2]);
        if($result[$j]['Latitude'] != 0 && $result[$j]['Longitude'] != 0){
          $result[$j]['Latitude']=(double)$result[$j]['Latitude'];
          $result[$j]['Longitude']=(double)$result[$j]['Longitude'];
          $result[$j]['numOfCompany']=(double)$numOfCompany[$j];
        }
        $result[$j]['Location'] = trim($companyData[$j]['County']);
        $CompaniesPerCordinate = json_encode($result);
      }
        return $CompaniesPerCordinate;
    }


    public function industryPerCounty($county){
        $sql = "SELECT COUNT(Industry) AS numOfCompany, Industry FROM $this->name WHERE County != ' ' AND Industry != ' ' AND County = '". $county . "' GROUP BY Industry";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        while($row = $results->fetch()){
          $result[] = $row;
        }
        for($i=0;$i<sizeof($result);$i++){
          // settype($result[$i]['numOfCompany'] , int);
          unset($result[$i][0]);
          unset($result[$i][1]);
        }
        return json_encode($result);
    }



    public function industryGrowthPerYear($industry){
        $sql = "SELECT COUNT($this->primaryKey) AS numOfCompany, YEAR(Date_Added) AS Year FROM $this->name WHERE Industry = '". $industry ."' AND YEAR(Date_Added) != '0' GROUP BY YEAR(Date_Added)";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        while($row = $results->fetch()){
          $result[] = $row;
        }
        for($i=0;$i<sizeof($result);$i++){
          settype($result[$i]['numOfCompany'] , int);
          unset($result[$i][0]);
          unset($result[$i][1]);
        }
        return json_encode($result);


    }

    public function AllIndustries(){
      $sql = "SELECT DISTINCT Industry FROM Company";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      while($row = $results->fetch()){
        $result[] = $row;
      }
              for($i=0;$i<sizeof($result);$i++){
                unset($result[$i][0]);
              }
      return $result;
    }




    public function companiesPerIndustryCoordinates($industry){
        $sql = "SELECT COUNT(Company_Id) AS numOfCompany, $this->locationData.Longitude, $this->locationData.Latitude FROM $this->name INNER JOIN $this->locationData ON $this->locationData.Location = $this->name.County WHERE Industry = '" . $industry . "' GROUP BY County";
        $results = $this->dbh->prepare($sql);
        $results->execute();
        while($row = $results->fetch()){
          $result[] = $row;
        }

        for($i=0;$i<sizeof($result);$i++){
          settype($result[$i]['numOfCompany'] , int);
          unset($result[$i][0]);
          unset($result[$i][1]);
          unset($result[$i][2]);
        }
        return json_encode($result);
    }
    public function stableCompaniesCoordinates($industry){
      $sql = "SELECT $this->locationData.Longitude, $this->locationData.Latitude, COUNT($this->primaryKey) AS numOfCompany FROM $this->name INNER JOIN $this->locationData ON  $this->locationData.Location = $this->name.County WHERE YEAR(NOW()) - YEAR(Date_Added) > 3 AND Date_Added != '0000-00-00' AND County != '' AND Industry ='".
      $industry . "' GROUP BY County;";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      while($row = $results->fetch()){
        $result[] = $row;
      }
      for($i=0;$i<sizeof($result);$i++){
        settype($result[$i]['numOfCompany'] , int);
        unset($result[$i][0]);
        unset($result[$i][1]);
        unset($result[$i][2]);
      }
      return json_encode($result);
    }


    public function startUpCompaniesCoordinates($industry){
      $sql = "SELECT $this->locationData.Longitude, $this->locationData.Latitude, COUNT($this->primaryKey) AS numOfCompany FROM $this->name INNER JOIN $this->locationData ON  $this->locationData.Location = $this->name.County WHERE YEAR(NOW()) - YEAR(Date_Added) < 2 AND Date_Added != '0000-00-00' AND County != '' AND Industry ='".
      $industry . "' GROUP BY County;";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      while($row = $results->fetch()){
        $result[] = $row;
      }
      for($i=0;$i<sizeof($result);$i++){
        settype($result[$i]['numOfCompany'] , int);
        unset($result[$i][0]);
        unset($result[$i][1]);
        unset($result[$i][2]);
      }
      return json_encode($result);
    }

}
