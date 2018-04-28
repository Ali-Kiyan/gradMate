<?php
namespace jobWizardProject;
class User {
  protected $User_id, $First_Name, $Last_Name, $username, $email, $password, $add1, $add2, $phone, $postcode, $dob, $degree;
  public function __construct($dbrow) {
    $this->User_id = $dbrow['User_id'];
    $this->First_Name = $dbrow['First_Name'];
    $this->Last_Name = $dbrow['Last_Name'];
    $this->username = $dbrow['username'];
    $this->email = $dbrow['email'];
    $this->password = $dbrow['password'];
    $this->add1 = $dbrow['add1'];
    $this->add2 = $dbrow['add2'];
    $this->phone = $dbrow['phone'];
    $this->postcode = $dbrow['postcode'];
    $this->dob = $dbrow['dob'];
    $this->degree = $dbrow['degree'];
}
  //accessors
  public function getUserId() { return $this->User_id;}
  public function getFirstName() { return $this->First_Name;}
  public function getLastName() { return $this->Last_Name;}
  public function getUsername() { return $this->username;}
  public function getEmail() { return $this->email;}
  public function getPassword() { return $this->password;}
  public function getAdd1() { return $this->add1;}
  public function getAdd2() { return $this->add2;}
  public function getPhone() {return $this->phone;}
  public function getPostcode() {return $this->postcode;}
  public function getDOB() {return $this->dob;}
  public function getDegree() {return $this->degree;}

}
