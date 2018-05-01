<?php
namespace jobWizardProject;
class Company {
  protected $Company_id, $Company_Name, $Company_Website, $Town, $County, $Main_Tier, $Subtier, $Industry, $Date_Added, $Location_Id;
  public function __construct($dbrow) {
    $this->Company_id = $dbrow['Company_id'];
    $this->Company_Name = $dbrow['Company_Name'];
    $this->Company_Website = $dbrow['Company_Website'];
    $this->Town = $dbrow['Town'];
    $this->County = $dbrow['County'];
    $this->Main_Tier = $dbrow['Main_Tier'];
    $this->Subtier = $dbrow['Subtier'];
    $this->Industry = $dbrow['Industry'];
    $this->Date_Added = $dbrow['Date_Added'];
    $this->Location_Id = $dbrow['Location_Id'];
}
  //accessors
  public function getCompanyId() { return $this->Company_id;}
  public function getCompanyName() { return $this->Company_Name;}
  public function getCompanyWebsite() { return $this->Company_Website;}
  public function getCompanyTown() { return $this->Town;}
  public function getCompanyCounty() { return $this->County;}
  public function getCompanyMainTier() { return $this->Main_Tier;}
  public function getCompanySubtier() { return $this->Subtier;}
  public function getCompanyIndustry() { return $this->Industry;}
  public function getCompanyDate() {return $this->Date_Added;}
  public function getCompanyLocationId() {return $this->Location_Id;}
  public function getAll(){
    foreach ($this as $row){
      return $row;
    }
  }
}
