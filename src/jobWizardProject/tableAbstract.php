<?php
// this file provide general methods that can be used to access data from any database table
namespace jobWizardProject;
require_once __DIR__ . '/Database.php';

abstract class TableAbstract
{
    protected $name;
    protected $primaryKey = 'id', $dbh, $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->dbh = $this->db->getDbh();
    }


    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->name;
        $results = $this->dbh->prepare($sql);
        $results->execute();
        return $results;

    }
    public function fetchByPrimaryKey($key){
        $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(':id' => $key);
        $results = $this->dbh->prepare($sql);
        $results->execute($params);
        return $results->fetch();
    }



    public function fetchRecord($key){
        $sql= 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(':id' => $key);
        $results = $this->dbh->prepare($sql);
        $results->execute($params);
        return $results->fetch();
    }
    public function deleteRecord($key){
        $sql = "DELETE FROM " . $this->name . " WHERE " . $this->primaryKey . " = :id LIMIT 1";
        $params = array(':id' => $key);
        $results = $this->dbh->prepare($sql);
        $response = $results->execute($params);
        return $response;
    }




}
