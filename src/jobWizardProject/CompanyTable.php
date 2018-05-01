<?php

namespace jobWizardProject;
// session_start();
require_once __DIR__ . '/Company.php';
require_once __DIR__ . '/TableAbstract.php';
require_once "./Views/Template/includedFunctions.php";

class CompanyTable extends TableAbstract {
  
    protected $name = 'Company';
    protected $primaryKey = 'Company_Id';
    protected $LocationForeignKey = 'Location_Id';
    protected $UpdatedCompanies = 'UpdatedCompanies';

    // FETCHING ALL COMPANIES
    public function fetchAllCompanies() {
      $results = $this->fetchAll();
      $companyArray = array();
      while($row = $results->fetch()) {
        $companyArray[] = new Company($row);
      }
      return $companyArray;
    }

    // FETCHING OUTDATED COMPANY BY COMPARING EXISTING COMPANY LIST AND NEWLY ADDED LIST

    public function fetchOutdatedCompanies()
    {
      $sql = "SELECT U.Company_Name FROM $this->UpdatedCompanies AS U LEFT JOIN $this->name AS C ON U.Company_Name = C.Company_Name WHERE C.Company_Name IS NULL LIMIT 20";
      $results = $this->dbh->prepare($sql);
      $results->execute();
      $companyArray = array();
      while($row = $results->fetch()) {
        $companyArray[] = new Company($row);
      }
      return $companyArray;
    }

    // FETCHING NEWLLY ADDED COMPANY BY COMPARING EXISTING COMPANY LIST AND NEWLY ADDED LIST

    public function fetchNewlyAddedCompanies($key)
    {
      $sql = "SELECT U.Company_Name FROM $this->UpdatedCompanies AS U LEFT JOIN $this->name AS C ON U.Company_Name = C.Company_Name WHERE C.Company_Name IS NULL LIMIT 20";
      $results = $this->dbh->prepare($sql);
      $companyArray = array();
      while($row = $results->fetch()) {
        $companyArray[] = new Company($row);
      }
      return $companyArray;
    }

    // FETCHING A COMPANY
    public function fetchCompany($key){
        $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(':id' => $key);
        $results = $this->dbh->prepare($sql);
        $results->execute($params);
        $company = new Company($results->fetch());
        return $company;
    }


    // INSERT COMPANY
    public function insertCompany($data)
    {
        // Converting Null value of php to null value of mysql
        $data["Company_Name"] == null ? $data["Company_Name"] = NULL : $data["Company_Name"];
        // extra security check in the backend
        if($data["Company_Name"] == NULL || $data["Company_Name"] == "")
        return false;
        $sql = "INSERT INTO $this->name (Company_Name, Company_Website, Town, County, Main_Tier, Subtier, Industry, Date_Added, Location_Id) VALUES (:Company_Name, :Company_Website, Town, County, Main_Tier, Subtier, Industry, Date_Added, Location_Id);";
        $results = $this->dbh->prepare($sql);
        $params = array(
          ':Company_Name' => $data['Company_Name'],
          ':Company_Website' => $data['Company_Website'],
          ':Town' => $data['Town'],
          ':County' => $data['County'],
          ':Main_Tier' => $data['Main_Tier'],
          ':Subtier' => $data['Subtier'],
          ':Industry' => $data['Industry'],
          ':Date_Added' => $data['Date_Added'],
          ':Location_Id' => $data['Location_Id']
        );
        $response  = $results->execute($params);
        return $response;
    }



    //DELETE Company


    public function deleteCompany($key)
    {
        $sql = "DELETE FROM $this->name WHERE $this->primaryKey = :Company_Id";
        $params = array(':Company_Id' => $key);
        $results = $this->dbh->prepare($sql);
        $response = $results->execute($params);
        return $response;

    }


}
