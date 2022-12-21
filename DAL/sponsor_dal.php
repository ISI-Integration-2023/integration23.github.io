<?php
require_once( $ROOT_PATH.'/Model/sponsor_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class sponsor_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM sponsor';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new sponsor_model(); 
            $obj->sponsorid =  $row['sponsorid'];
            $obj->sponsorname =  $row['sponsorname'];
            $obj->logoimagepath =  $row['logoimagepath'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM sponsor where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new sponsor_model();
            $obj->sponsorid =  $row['sponsorid'];
            $obj->sponsorname =  $row['sponsorname'];
            $obj->logoimagepath =  $row['logoimagepath'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\sponsor_model $model){

        $sql = "INSERT INTO sponsor(sponsorname,logoimagepath) 
                SELECT '".addslashes($model->sponsorname)."','".addslashes($model->logoimagepath)."' from dual 
                WHERE NOT EXISTS (SELECT * FROM `sponsor` 
                      WHERE sponsorname='".addslashes($model->sponsorname)."') 
                LIMIT 1 
                ";
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;

        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $this->conn->lastInsertId() ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function updateDatas(\sponsor_model $model){

        $sql = "UPDATE sponsor SET 
                sponsorname = ".(($model->sponsorname==null)?"NULL":"'".addslashes($model->sponsorname)."'")." ,
                logoimagepath = ".(($model->logoimagepath==null)?"NULL":"'".addslashes($model->logoimagepath)."'")."  
                WHERE sponsorid= $model->sponsorid" ; 
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->sponsorid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($sponsorid){
        if(!($sponsorid!= 0)){
            return 0;
        }
        $sql = "delete from sponsor WHERE sponsorid = $sponsorid "; 
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $sponsorid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

}