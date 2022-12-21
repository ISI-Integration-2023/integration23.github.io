<?php
require_once($ROOT_PATH.'/Model/userdata_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class userdata_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM userdata';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new userdata_model(); 
            $obj->userid =  $row['userid'];
            $obj->firstname =  $row['firstname'];
            $obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone =  $row['phone'];
            $obj->email =  $row['email'];
            $obj->_password =  $row['_password'];
            $obj->updatedatetime =  $row['updatedatetime'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM userdata where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new userdata_model();
            $obj->userid =  $row['userid'];
            $obj->firstname =  $row['firstname'];
            $obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone =  $row['phone'];
            $obj->email =  $row['email'];
            $obj->_password =  $row['_password'];
            $obj->updatedatetime =  $row['updatedatetime'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\userdata_model $model){

        $sql = "INSERT INTO userdata(firstname,lastname,date_of_birth,institution,phone,email,_password,isactive) 
                SELECT '".addslashes($model->firstname)."','".addslashes($model->lastname)."','".addslashes($model->date_of_birth)."','".addslashes($model->institution)."','".addslashes($model->phone)."','".addslashes($model->email)."','".addslashes($model->_password)."', ".(($model->isactive==true)?"1":"0")." from dual 
                WHERE NOT EXISTS (SELECT * FROM `userdata` 
                      WHERE email='$model->email')  
                LIMIT 1 
                ";
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;

        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $this->conn->lastInsertId() ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
            //if($temp>0){
            //   $regno='IN'.date("Y").str_pad($temp, 6, '0', STR_PAD_LEFT);
            //   $sql = "UPDATE userdata SET regno = '$regno' where userid = $temp;
            //    ";
            //   $stmnt = $this->conn->prepare($sql);
            //   $stmnt->execute(); 
            // }

            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function updateDatas(\userdata_model $model){
      

        $sql = "UPDATE userdata SET 
                firstname = ".(($model->firstname==null)?"NULL":"'".addslashes($model->firstname)."'")." , 
                lastname = ".(($model->lastname==null)?"NULL":"'".addslashes($model->lastname)."'")."  ,
                date_of_birth = ".(($model->date_of_birth==null)?"NULL":"'".addslashes($model->date_of_birth)."'")."  ,
                institution = ".(($model->institution==null)?"NULL":"'".addslashes($model->institution)."'")."  ,
                phone = ".(($model->phone==null)?"NULL":"'".addslashes($model->phone)."'")."  ,
                email = ".(($model->email==null)?"NULL":"'".addslashes($model->email)."'")."  ,
                _password = ".(($model->_password==null)?"NULL":"'".addslashes($model->_password)."'")." ,
                isactive = ".(($model->isactive==null || $model->isactive==false)?"0":"1")." 
               
                WHERE userid= $model->userid" ;   
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->userid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($userid){
        if(!($userid!= 0)){ 
            return 0;
        }
        $sql = "delete from userdata WHERE userid = $userid ";  
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $userid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
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