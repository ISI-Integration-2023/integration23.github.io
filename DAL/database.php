<?php

class DB {
  public $pdo = null;
  public $stmt = null;
  public $conn = null; 

  function __construct(){
    try {
        $servername = "dbserver-16.isical.ac.in";
        $username = "integration";
        $password = "integration2019";
        $dbname = "db_integration";

        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $ex) { die($ex->getMessage()); }
  }

  function __destruct(){
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
    //if ($this->conn!==null) { $this->conn = null; } 
  }

  function ExecuteNonQuery($sql){

      $stmnt = $this->conn->prepare($sql);
      $temp = 0;
      try { 
          $this->conn->beginTransaction(); 
          $stmnt->execute(); 
          $this->conn->commit(); 
          $temp = $stmnt->rowCount(); 
      }
      catch(Exception $e) {  
          $this->conn->rollback(); 
          $temp = 0;
          echo "Error!: " . $e->getMessage() . "</br>";  
      } 
      return $temp; 
  }

  function ExecuteQuery($sql){
      $array = array();

      $sth = $this->conn->prepare($sql);
      $sth->execute();
      $array = $sth->fetchAll(\PDO::FETCH_ASSOC);
      //$array = $this->conn->query($sql);
      //foreach ($this->conn->query($sql) as $row) {
      //    array_push($array,$row);
      //}
      return $array;
  }

  /*
  function select($sql, $cond=null){
    $result = false;
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($cond);
      $result = $this->stmt->fetchAll();
    } catch (Exception $ex) { die($ex->getMessage()); }
    $this->stmt = null;
    return $result;
  }
  */

}
?>