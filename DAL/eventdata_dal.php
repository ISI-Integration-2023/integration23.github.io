<?php
require_once($ROOT_PATH.'/Model/eventdata_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class eventdata_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM eventdata';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new eventdata_model(); 
            $obj->eventid =  $row['eventid'];
            $obj->eventname =  $row['eventname'];
            $obj->catid =  $row['catid'];
            $obj->description =  $row['description'];
            $obj->timevenue =  $row['timevenue'];
            $obj->cmscontent =  $row['cmscontent'];
            $obj->imagepath =  $row['imagepath'];
            $obj->eventhead =  $row['eventhead'];
            $obj->fees =  $row['fees'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getAllwithCategory($eventname = null){
        $array = array();
        $sql = 'SELECT ev.eventid, ev.eventname, ev.description, ev.timevenue, ev.cmscontent, ev.imagepath, 
                ev.eventhead, ev.fees, ev.isactive, cat.categoryid, cat.categoryname
                FROM eventdata as ev
                INNER JOIN category as cat
                ON (ev.catid = cat.categoryid)' ;
        if (isset($eventname)) {
            $sql .= 'WHERE ev.eventname = "'.$eventname.'"';
        }
        foreach ($this->conn->query($sql) as $row) {
            $obj = new eventdata_model(); 
            $obj->eventid =  $row['eventid'];
            $obj->eventname =  $row['eventname'];
            $obj->catid =  $row['categoryid'];
            $obj->catname = $row['categoryname'];
            $obj->description =  $row['description'];
            $obj->timevenue =  $row['timevenue'];
            $obj->cmscontent =  $row['cmscontent'];
            $obj->imagepath =  $row['imagepath'];
            $obj->eventhead =  $row['eventhead'];
            $obj->fees =  $row['fees'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }
 
    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM eventdata where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new eventdata_model();
            $obj->eventid =  $row['eventid'];
            $obj->eventname =  $row['eventname'];
            $obj->catid =  $row['catid'];
            $obj->description =  $row['description'];
            $obj->timevenue =  $row['timevenue'];
            $obj->cmscontent =  $row['cmscontent'];
            $obj->imagepath =  $row['imagepath'];
            $obj->eventhead =  $row['eventhead'];
            $obj->fees =  $row['fees'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\eventdata_model $model){

        $sql = "INSERT INTO eventdata(eventname,catid,description,timevenue,cmscontent,imagepath,eventhead,fees,isactive) 
                SELECT '".addslashes($model->eventname)."',$model->catid,'".addslashes($model->description)."','$model->timevenue','".addslashes($model->cmscontent)."','".addslashes($model->imagepath)."','".addslashes($model->eventhead)."','".addslashes($model->fees)."', ".(($model->isactive==true)?"1":"0")." from dual 
                WHERE NOT EXISTS (SELECT * FROM `eventdata` 
                      WHERE eventname='".addslashes($model->eventname)."')  
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

    function updateDatas(\eventdata_model $model){
        
        $sql = "UPDATE eventdata SET 
                `eventname` = ".(($model->eventname==null)?"NULL":"'".addslashes($model->eventname)."'")." , 
                `catid` = $model->catid". " ,
                `description` = ".(($model->description==null)?"NULL":"'".addslashes($model->description)."'")."  ,
                `timevenue` = ".(($model->timevenue==null)?"NULL":"'$model->timevenue'")."  ,
                `cmscontent` = ".(($model->cmscontent==null)?"NULL":"'".addslashes($model->cmscontent)."'")."  ,
                `imagepath` = ".(($model->imagepath==null)?"NULL":"'".addslashes($model->imagepath)."'")." ,
                `eventhead` = ".(($model->eventhead==null)?"NULL":"'".addslashes($model->eventhead)."'")." ,
                `fees` = ".(($model->fees==null)?"NULL":"'".addslashes($model->fees)."'")." ,
                `isactive` = ".(($model->isactive==null || $model->isactive==false)?"0":"1")." 
               

                WHERE eventid= $model->eventid" ;   
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->eventid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($eventid){
        if(!($eventid!= 0)){
            return 0;
        }
        $sql = "delete from eventdata WHERE eventid = $eventid "; 
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $eventid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
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