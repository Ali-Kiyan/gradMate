<?php

namespace jobWizardProject;
session_start();
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/TableAbstract.php';


class UserTable extends TableAbstract {
  protected $name = 'User';
  protected $primaryKey = 'User_id';
  public function fetchAllUsers() {
    //full all users
    // SELECT * FROM USER AS U INNER JOIN User_Detail AS UD ON U.User_id = UD.User_Id WHERE U.Username = 'Alikiyand@gmail.com' and PASSWORD = 'user1'
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
                return $result = 1;
            }
        }

    }

    //INSERT
    public function insertUser($data){
        // Converting Null value of php to null value of mysql
        $data["Username"] == null ? $data["Username"] = NULL : $data["Username"];
        $data["Password"] == null ? $data["Password"] = NULL : $data["Password"];
        //encrypting pass with BCRYPT algorithm
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO $this->name (Username, Password) VALUES (:Username, :Password); INSERT INTO User_Detail (User_id) Values (LAST_INSERT_ID()) ";
        $results = $this->dbh->prepare($sql);
        $response  = $results->execute(array(
            ':Username' => $data['Username'],
            ':Password' => $data['Password']
        ));
        return $response;
    }

    //EDIT

    public function editUser($data)
    {
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = ""
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
