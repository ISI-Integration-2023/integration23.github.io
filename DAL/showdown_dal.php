<?php
require_once($ROOT_PATH.'/Model/showdown_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class showdown_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM showdown';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new showdown_model(); 
            $obj->showdownid =  $row['showdownid'];
            $obj->showdownname = $row['showdownname'];
            $obj->description =  $row['description'];
            $obj->timevenue = $row['timevenue'];
            $obj->posterimagepath =  $row['posterimagepath'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM showdown where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new showdown_model();
            $obj->showdownid =  $row['showdownid'];
            $obj->showdownname = $row['showdownname'];
            $obj->description =  $row['description'];
            $obj->timevenue = $row['timevenue'];
            $obj->posterimagepath =  $row['posterimagepath'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\showdown_model $model){

        $sql = "INSERT INTO showdown(showdownname,description,timevenue,posterimagepath) 
                SELECT '".addslashes($model->showdownname)."','".addslashes($model->description)."','".addslashes($model->timevenue)."','".addslashes($model->posterimagepath)."' from dual            
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

    function updateDatas(\showdown_model $model){
        
        $sql =  "UPDATE showdown SET
                 showdownname = '".addslashes($model->showdownname)."'". " ,                 
                 description = '".addslashes($model->description)."'". " ,
                 timevenue = '".addslashes($model->timevenue)."'". " ,
                 posterimagepath = '".addslashes($model->posterimagepath)."'". " 
                WHERE showdownid= $model->showdownid" ;    
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->userregid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($showdownid){
        if(!($showdownid!= 0)){
            return 0;
        }
        $sql = "delete from showdown WHERE showdownid = $showdownid "; 
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $showdownid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
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