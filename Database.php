<?php

    // namespace jobWizardProject;

    //Singleton Design Pattern

    class Database {
      protected static $instance = null;
      protected $dbh;
      public static function getInstance() {
         $host = "localhost";
         $dbname = "jobWizard";
         $username = "root";
         $password = "root";
        /* checking if the db object exists if not $instance get created */
        if(self::$instance === null)
        {
         self::$instance = new self($host, $dbname, $username, $password);
        }
        return self::$instance;
      }
      //  construct for preventing the object to be created from outside
      private function __construct($host, $database, $username, $password){
        $this->dbh = new \PDO("mysql:host=$host;dbname=$database", $username, $password);

      }
      public function getDbh(){
      // return the database handler to be used later
        return $this->dbh;
      }
      public function __destruct(){
      // Destroys database handler when it is no longer needed
        $this->dbh = null;
      }
    }
