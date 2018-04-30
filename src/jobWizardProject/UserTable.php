<?php

namespace jobWizardProject;
session_start();
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/TableAbstract.php';


class UserTable extends TableAbstract {
  protected $name = 'User';
  protected $primaryKey = 'User_id';
  protected $detail = 'User_Detail';





  public function fetchAllUsers() {
    $results = $this->fetchAll();
    $userArray = array();
    while($row = $results->fetch()) {
      $userArray[] = new User($row);
    }
    return $userArray;
  }

  public function fetchAllUsersInfo()
  {
    $sql = "SELECT * FROM $this->name AS U Left JOIN $this->detail AS UD ON U.$this->primaryKey = UD.$this->primaryKey";
    $results = $this->dbh->prepare($sql);
    $results->execute();
    $userArray = array();
    while($row = $results->fetch()) {
      $userArray[] = new User($row);
    }
    return $userArray;
  }
  public function fetchUser($key){
      $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
      $params = array(':id' => $key);
      $results = $this->dbh->prepare($sql);
      $results->execute($params);
      $user = new User($results->fetch());
      return $user;
  }



  public function fetchUserInfo($key)
  {
    $sql = "SELECT * FROM $this->name AS U INNER JOIN $this->detail AS UD ON U.$this->primaryKey = UD.$this->primaryKey WHERE U.$this->primaryKey = $key limit 1";
    $results = $this->dbh->prepare($sql);
    $results->execute();
    $user = new User($results->fetch());
    return $user;
  }




    //AUTH
    public function auth($Username, $Password)
    {
        $results = $this->fetchAll();

        while($row = $results->fetch())
        {
            if($row["Username"] == $Username && password_verify($Password, $row["Password"]))
            {
                $_SESSION["Username"] = $row["Username"];
                $_SESSION["Password"] = $row["Password"];
                $_SESSION["User_id"] = $row["User_id"];
                $_SESSION["Is_Admin"] = $row["Is_Admin"];
                return $result = 1;
            }
        }

    }

    //INSERT
    public function insertUser($data)
    {
        // Converting Null value of php to null value of mysql
        // extra security check in the backend
        $data["Username"] == null ? $data["Username"] = NULL : $data["Username"];
        if($data["Password"] == NULL || $data["Password"] == "")
        return false;

        //encrypting pass with BCRYPT algorithm
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO $this->name (Username, Password, Is_Admin) VALUES (:Username, :Password, 0); INSERT INTO User_Detail (User_id,Email) Values (LAST_INSERT_ID(), :Email) ";
        $results = $this->dbh->prepare($sql);
        $response  = $results->execute(array(
            ':Username' => $data['Username'],
            ':Password' => $data['Password'],
            ':Email' => $data['Email']
        ));
        return $response;
    }


    //INSERT ADMIN
    public function insertAdmin($data){
      $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
      $sql = "INSERT INTO $this->name (Username, Password, Is_Admin) VALUES (:Username,:Password, 1);";
      $results = $this->dbh->prepare($sql);
      $response  = $results->execute(array(
          ':Username' => $data['Username'],
          ':Password' => $data['Password']
      ));
      return $response;
    }



    //EDIT USER

    public function editUser($data)
    {
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);

        $sql = "UPDATE  $this->name as U inner join $this->detail as UD  SET  First_Name = :First_Name, Last_Name = :Last_Name, Email = :Email, Username = :Username, Password = :Password, Address_Line1 = :Address_Line1, Address_Line2 = :Address_Line2, Phone = :Phone, PostCode = :Postcode, DOB = :DOB,
        Degree = :Degree WHERE U.User_id= :User_id and UD.User_id= :User_id ";
        $result = $this->dbh->prepare($sql);
        $params = array(
            ':User_id' => $_SESSION['User_id'],
            ':Username' => $data['Username'],
            ':Password' => $data['Password'],
            ':First_Name' => $data['First_Name'],
            ':Last_Name' => $data['Last_Name'],
            ':Email' => $data['Email'],
            ':Address_Line1' => $data['Address_Line1'],
            ':Address_Line2' => $data['Address_Line2'],
            ':Phone' => $data['Phone'],
            ':Postcode' => $data["Postcode"],
            ':DOB' => $data['DOB'],
            ':Degree' => $data['Degree']
        );
        $response = $result->execute($params);
        return $response;

    }

    // EDIT ADMIN

        public function editAdmin($data)
        {
          $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);

          $sql = "UPDATE  $this->name SET Username = :Username, Password = :Password
          WHERE User_id= :User_id";
          $result = $this->dbh->prepare($sql);
          $params = array(
              ':User_id' => $_SESSION['User_id'],
              ':Username' => $data['Username'],
              ':Password' => $data['Password']
          );
          $response = $result->execute($params);
          return $response;

        }




    //DELETE USER


    public function delete($key)
    {
        $sql = "DELETE FROM $this->name WHERE $this->primaryKey = :User_id";
        $params = array(':User_id' => $key);
        $results = $this->dbh->prepare($sql);
        $response = $results->execute($params);
        return $response;
    }


}
