<?php
require_once($ROOT_PATH.'/Model/eventregistration_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class eventregistration_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM eventregistration';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new eventregistration_model(); 
            $obj->userregid =  $row['userregid'];
            $obj->eventid =  $row['eventid'];
            $obj->userid =  $row['userid'];
            $obj->paymentid =  $row['paymentid'];
            $obj->status = $row['status_code'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM eventregistration where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new eventregistration_model();
            $obj->userregid =  $row['userregid'];
            $obj->eventid =  $row['eventid'];
            $obj->userid =  $row['userid'];
            $obj->paymentid =  $row['paymentid'];
            $obj->status = $row['status_code'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\eventregistration_model $model){

        $sql = "INSERT INTO eventregistration(eventid,userid,paymentid,status_code) 
                SELECT ".$model->eventid.",".$model->userid.",NULL,'".$model->status."' from dual 
                WHERE NOT EXISTS 
                (SELECT * FROM eventregistration WHERE userid=$model->userid and  eventid=$model->eventid  )  
                LIMIT 1";
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

    function updateDatas(\eventregistration_model $model){
        
        $sql =  "UPDATE eventregistration SET                
                 eventid = ".$model->eventid." ,
                 userid = ".$model->userid." ,
                 paymentid = '".addslashes($model->paymentid)."' , 
                 status_code = '".addslashes($model->status).
                "' WHERE userregid = ".$model->userregid ;   


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

    function deleteDatas($userregid){
        if(!($userregid!= 0)){
            return 0;
        }
        $sql = "delete from eventregistration WHERE userregid = $userregid "; 
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $userregid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function getUserEvents($userid) {
        $array = array();
        $sql = 'select er.userregid , ev.eventname , er.paymentid , ev.timevenue, ev.eventhead, er.status_code from `eventregistration`  er
                inner join `eventdata`  ev on ( er.eventid = ev.eventid )
                where er.userid ='.$userid;

        foreach ($this->conn->query($sql) as $row) {
            $obj = new stdclass;
            $obj->userregid =  $row['userregid'];
            $obj->eventname =  $row['eventname'];
            $obj->timevenue =  $row['timevenue'];
            $obj->eventhead =  $row['eventhead'];
            $obj->paymentid = $row['paymentid'];
            $obj->status = $row['status_code'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getEventUsers($eventid) {
        $array = array();
        $sql = 'select er.userregid , ur.firstname, ur.lastname, ur.phone, ur.email, ur.institution, er.paymentid, er.status_code
                from `eventregistration`  er
                inner join `userdata`  ur on ( er.userid = ur.userid )
                where er.eventid ='.$eventid;

        foreach ($this->conn->query($sql) as $row) {
            $obj = new stdclass;
            $obj->userregid =  $row['userregid'];
            $obj->userfirstname =  $row['firstname'];
            $obj->userlastname =  $row['lastname'];
            $obj->userphone =  $row['phone'];
            $obj->useremail =  $row['email'];
            $obj->userinstitution =  $row['institution'];
            $obj->paymentid =  $row['paymentid'];
            $obj->status = $row['status_code'];
            
            array_push($array,$obj);
        }
        return $array;   
    }

}










