<?php
namespace jobWizardProject;
require_once __DIR__ . '/Location.php';
require_once __DIR__ . '/tableAbstract.php';
require_once __DIR__ . '../../../Views/Template/includedFunctions.php';


class LocationTable extends tableAbstract {

    protected $name = 'Location_Detail';
    protected $primaryKey = 'Location_Id';
    public $pageStart = 0;




    // FETCHING A Location
    public function fetchLocation($key){
        $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(':id' => $key);
        $results = $this->dbh->prepare($sql);
        $results->execute($params);
        $location = new Location($results->fetch());
        return $location;
    }




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

    //EDIT LOCATION

    public function editLocation($data)
    {

        // typecast
        $data['Location_Id'] = (int) $data['Location_Id'];
        $data['Latitude'] = (double) $data['Latitude'] ;
        $data['Longitude'] = (double) $data['Longitude'];

        $sql = "UPDATE  $this->name SET Location = :Location, Latitude= :Latitide, Longitude = :Longitude WHERE $this->name.Location_Id = :Location_Id";
        $result = $this->dbh->prepare($sql);
        $params = array(
            ':Location_Id' => $data['Location_Id'],
            ':Location' => $data['Location_Name'],
            ':Latitide' => $data['Latitude'],
            ':Longitude' => $data['Longitude']
        );

        $response = $result->execute($params);
        return $response;

    }


    // INSERT Location
    public function insertLocation($data)
    {
        // Converting Null value of php to null value of mysql
        $data["Location_Name"] == null ? $data["Location_Name"] = NULL : $data["Location_Name"];
        // extra security check in the backend
        if($data["Location_Name"] == NULL || $data["Location_Name"] == "")
        return false;
        $sql = "INSERT INTO $this->name (Location, Longitude, Latitude) VALUES (:Location_Name, :Longitude, :Latitude);";
        $result = $this->dbh->prepare($sql);

        $params = array(
          ':Location_Name' => $data['Location_Name'],
          ':Longitude' => $data['Longitude'],
          ':Latitude' => $data['Latitude']
        );
        $response  = $result->execute($params);
        return $response;
    }


    //DELETE Location


    public function deleteLocation($key)
    {
        $sql = "DELETE FROM $this->name WHERE $this->primaryKey = :Location_Id";
        $params = array(':Location_Id' => $key);
        $results = $this->dbh->prepare($sql);
        $response = $results->execute($params);
        return $response;

    }


}
