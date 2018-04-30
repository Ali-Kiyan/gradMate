<?php
namespace jobWizardProject;
class User {
  protected $User_id, $First_Name, $Last_Name, $Username, $Email, $Password, $Add1, $Add2, $Phone, $Postcode, $DOB, $Degree_Id, $Photo_Path, $Is_Admin;
  public function __construct($dbrow) {
    $this->User_id = $dbrow['User_id'];
    $this->First_Name = $dbrow['First_Name'];
    $this->Last_Name = $dbrow['Last_Name'];
    $this->Username = $dbrow['Username'];
    $this->Email = $dbrow['Email'];
    $this->Password = $dbrow['Password'];
    $this->Add1 = $dbrow['Address_Line1'];
    $this->Add2 = $dbrow['Address_Line2'];
    $this->Phone = $dbrow['Phone'];
    $this->Postcode = $dbrow['Postcode'];
    $this->DOB = $dbrow['DOB'];
    $this->Degree_Id = $dbrow['Degree_Id'];
    $this->Photo_Path = $dbrow['Photo_Path'];
    $this->Is_Admin = $dbrow['Is_Admin'];
}
  //accessors
  public function getUserId() { return $this->User_id;}
  public function getFirstName() { return $this->First_Name;}
  public function getLastName() { return $this->Last_Name;}
  public function getUsername() { return $this->Username;}
  public function getEmail() { return $this->Email;}
  public function getPassword() { return $this->Password;}
  public function getAdd1() { return $this->Add1;}
  public function getAdd2() { return $this->Add2;}
  public function getPhone() {return $this->Phone;}
  public function getPostcode() {return $this->Postcode;}
  public function getDOB() {return $this->DOB;}
  public function getDegree() {return $this->Degree_Id;}
  public function getPhotoPath() {return $this->Photo_Path;}
  public function ifAdmin() {return $this->Is_Admin;}

  public function getAll(){
    foreach ($this as $row){
      return $row;
    }
  }
}
