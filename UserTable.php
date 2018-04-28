<?php

namespace travelMateProject;
session_start();
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/TableAbstract.php';


class UserTable extends TableAbstract {
  protected $name = 'User';
  protected $primaryKey = 'User_id';
  public function fetchAllUsers() {
    $results = $this->fetchAll();

    $userArray = array();
    while($row = $results->fetch()) {
      $userArray[] = new User($row);
    }
    return $userArray;
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
                $_SESSION["First_Name"] = $row["First_Name"];
                return $result = 1;
            }
        }

    }

    //INSERT
    public function insertUser($data){
        // Converting Null value of php to null value of mysql
        $data["First_Name"] == null ? $data["First_Name"] = NULL : $data["First_Name"];
        $data["Last_Name"] == null ? $data["Last_Name"] = NULL : $data["Last_Name"];
        $data["Username"] == null ? $data["Username"] = NULL : $data["Username"];
        $data["Password"] == null ? $data["Password"] = NULL : $data["Password"];
        //encrypting pass with BCRYPT algorithm
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO $this->name (First_Name, Last_Name,Username, Password) VALUES (:First_Name, :Last_Name, :Username, :Password)";
        $results = $this->dbh->prepare($sql);
        $response  = $results->execute(array(
            ':First_Name' => $data["First_Name"],
            ':Last_Name' => $data['Last_Name'],
            ':Username' => $data['Username'],
            ':Password' => $data['Password']
        ));
        return $response;
    }


    //EDIT

    public function editUser($data)
    {
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = "UPDATE  $this->name SET  First_Name = :First_Name, Last_Name = :Last_Name, Username = :Username, Password = :Password
        WHERE User_id= :User_id";
        $result = $this->dbh->prepare($sql);
        $params = array(
            ':User_id' => $_SESSION['User_id'],
            ':First_Name' => $data['First_Name'],
            ':Last_Name' => $data['Last_Name'],
            ':Username' => $data['Username'],
            ':Password' => $data['Password']
        );
        $response = $result->execute($params);
        return $response;

    }
    //DELETE USER


    public function delete($data)
    {
        $sql = 'DELETE FROM' . $this->name . 'WHERE' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(':id' => $data['User_id']);
        $results = $this->dbh->prepare($sql);
        $response = $results->execute($params);
        return $response;
    }


}
