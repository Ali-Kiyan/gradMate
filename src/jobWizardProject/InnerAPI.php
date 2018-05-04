<?php

namespace jobWizardProject;
session_start();
require_once __DIR__ . '/Company.php';
require_once __DIR__ . '/TableAbstract.php';

require_once __DIR__ . '../../../Views/Template/includedFunctions.php';

class InnerAPI extends TableAbstract {

    protected $name = 'Company';
    protected $primaryKey = 'Company_Id';
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

    //
    //
    //
    //
    //
    //
    // // FETCHING ALL COMPANIES
    // public function fetchAllCompanies() {
    //   $results = $this->fetchAll();
    //   $companyArray = array();
    //   while($row = $results->fetch()) {
    //     $companyArray[] = new Company($row);
    //   }
    //   return $companyArray;
    // }
    //
    // // FETCHING OUTDATED COMPANY BY COMPARING EXISTING COMPANY LIST AND NEWLY ADDED LIST
    //
    // public function fetchOutdatedCompanies($start,$count)
    // {
    //   $sql = "SELECT $this->name.Company_Name,$this->name.Company_Id FROM $this->name LEFT JOIN $this->newList on $this->name.Company_Name = $this->newList.Company_Name WHERE $this->newList.Company_Name IS NULL AND $this->name.Company_Name != '' LIMIT $start,$count";
    //   $results = $this->dbh->prepare($sql);
    //   $results->execute();
    //   $companyArray = array();
    //   while($row = $results->fetch()) {
    //     $companyArray[] = new Company($row);
    //   }
    //   return $companyArray;
    // }
    //
    // // FETCHING NEWLLY ADDED COMPANY BY COMPARING EXISTING COMPANY LIST AND NEWLY ADDED LIST
    //
    // public function fetchNewlyAddedCompanies($start,$count)
    // {
    //   $sql = "SELECT U.Company_Name FROM $this->newList AS U LEFT JOIN $this->name AS C ON U.Company_Name = C.Company_Name WHERE C.Company_Name IS NULL LIMIT $start,$count";
    //   $results = $this->dbh->prepare($sql);
    //   $results->execute();
    //   $companyArray = array();
    //   while($row = $results->fetch()) {
    //     $companyArray[] = new Company($row);
    //   }
    //   return $companyArray;
    // }
    //
    // // FETCHING A COMPANY
    // public function fetchCompany($key){
    //     $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
    //     $params = array(':id' => $key);
    //     $results = $this->dbh->prepare($sql);
    //     $results->execute($params);
    //     $company = new Company($results->fetch());
    //     return $company;
    // }
    //
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
    //
    // //EDIT COMPANY
    //
    // public function editCompany($data)
    // {
    //
    //     $sql = "UPDATE  $this->name SET Company_Name = :Company_Name, Company_Website = :Company_Website, Town = :Town, County = :County, Main_Tier = :Main_Tier, Subtier = :Subtier, Industry =
    //     :Industry, Date_Added = :Date_Added, Location_Id = :Location_Id WHERE $this->name.Company_Id = :Company_Id";
    //     $result = $this->dbh->prepare($sql);
    //     $params = array(
    //         ':Company_Id' => $_SESSION['Company_Id'],
    //         ':Company_Name' => $data['Company_Name'],
    //         ':Company_Website' => $data['Company_Website'],
    //         ':Town' => $data['Town'],
    //         ':County' => $data['County'],
    //         ':Main_Tier' => $data['Main_Tier'],
    //         ':Subtier' => $data['Subtier'],
    //         ':Industry' => $data['Industry'],
    //         ':Date_Added' => $data['Date_Added'],
    //         ':Location_Id' => $data['Location_Id']
    //     );
    //     $response = $result->execute($params);
    //     return $response;
    //
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
