<?php

namespace jobWizardProject;

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

  public function fetchAllUsersInfo(){
    $sql = "SELECT * FROM $this->name AS U INNER JOIN $this->detail AS UD ON U.$this->primaryKey = UD.$this->primaryKey";
    $results = $this->dbh->prepare($sql);
    $results->execute();
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
                $_SESSION["User_id"] = $row["Is_Admin"];
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
        $sql = "INSERT INTO $this->name (Username, Password, Is_Admin) VALUES (:Username, :Password, :Is_Admin); INSERT INTO User_Detail (User_id) Values (LAST_INSERT_ID()) ";
        $results = $this->dbh->prepare($sql);
        $response  = $results->execute(array(
            ':Username' => $data['Username'],
            ':Password' => $data['Password'],
            ':Is_Admin' => $data['Is_Admin']
        ));
        return $response;
    }

    //EDIT

    public function editUser($data)
    {
        $data['Password'] = password_hash($data['Password'], PASSWORD_BCRYPT);
        $sql = "";
        /* update query UPDATE User AS U INNER JOIN User_Detail AS UD ON U.User_id = UD.User_Id SET First_name='Ali',Last_Name='Kiyan',Username= 'Ali',Password='123',email='Alikiyand@gmail.com',Address_Line1="Bolton", Address_Line2='Greater Manchester', Postcode='M53HK', DOB='1992-8-3', Degree_Id=1, phone=123 where U.Username="Ali" and U.Password = "123" */



        $sql =         "UPDATE $this->name AS U INNER JOIN User_Detail AS UD ON U.User_Id = UD.User_Id SET First_name = :First_Name, Last_Name = :Last_Name, Username = "
                      . ":Username, Password = :Password, Email= :Email, Address_Line1= :Address_Line1, Address_Line2 = :Address_Line2, Postcode = :Postcode, DOB = :DOB,"
                      . "Degree_Id = :Degree_Id, Phone = :Phone WHERE $this->primaryKey = :User_id LIMIT 1";
        $result = $this->dbh->prepare($sql);
        $params = array(
            ':User_id' => $_SESSION['User_id'],
            ':First_Name' => $data['First_Name'],
            ':Last_Name' => $data['Last_Name'],
            ':Username' => $data['Username'],
            ':Password' => $data['Password'],
            ':Email' => $data['Email'],
            ':Address_Line1' => $data['Address_line1'],
            ':Address_Line2' => $data['Address_Line2'],
            ':Postcode' => $data['Postcode'],
            ':DOB' => $data['DOB'],
            ':Degree_Id' => $data['Degree_Id'],
            ':Phone' => $data['Phone']
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
