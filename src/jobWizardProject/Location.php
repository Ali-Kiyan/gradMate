<?php
namespace jobWizardProject;
class Location {
  protected $Location_Id, $Location, $Latitude, $Longitude;
  public function __construct($dbrow) {
    $this->Location_Id = $dbrow['Location_Id'];
    $this->Location = $dbrow['Location'];
    $this->Latitude = $dbrow['Latitude'];
    $this->Longitude = $dbrow['Longitude'];
}
  //accessors
  public function getLocationId() { return $this->Location_Id;}
  public function getLocationName() { return $this->Location;}
  public function getLocationLatitude() { return $this->Latitude;}
  public function getLocationLongitude() { return $this->Longitude;}
}
