<?php
require_once($ROOT_PATH.'/Model/team_member_model.php');
require_once($ROOT_PATH.'/DAL/database.php');

class team_member_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM team_member';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new team_member_model(); 
            $obj->memberid =  $row['memberid'];
            $obj->name =  $row['name'];
            $obj->phone =  $row['phone'];
            $obj->email =  $row['email'];
            $obj->fblink =  $row['fblink'];
            $obj->imagepath =  $row['imagepath'];
            $obj->catid =  $row['catid'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getAllwithCategory($catid = 0) {
        $array = array();
        $sql = 'SELECT tm.memberid, tm.name, tm.phone, tm.email, tm.fblink, tm.imagepath, cat.categoryname, tm.isactive 
                FROM team_member as tm
                INNER JOIN category as cat
                ON ( tm.catid = cat.categoryid )';
        if ($catid > 0) {
            $sql.= 'WHERE cat.categoryid = '.$catid;
        }
        foreach ($this->conn->query($sql) as $row) {
            $obj = new team_member_model();
            $obj->memberid = $row['memberid']; 
            $obj->name =  $row['name'];
            $obj->phone =  $row['phone'];
            $obj->email =  $row['email'];
            $obj->fblink =  $row['fblink'];
            $obj->imagepath =  $row['imagepath'];
            $obj->catname =  $row['categoryname'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM team_member where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new team_member_model();
            $obj->memberid =  $row['memberid'];
            $obj->name =  $row['name'];
            $obj->phone =  $row['phone'];
            $obj->email =  $row['email'];
            $obj->fblink =  $row['fblink'];
            $obj->imagepath =  $row['imagepath'];
            $obj->catid =  $row['catid'];
            $obj->isactive =  $row['isactive'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\team_member_model $model){

        $sql = "INSERT INTO team_member(name,phone,email,fblink,imagepath,catid,isactive) 
                SELECT '".addslashes($model->name)."','".addslashes($model->phone)."','".addslashes($model->email)."','".addslashes($model->fblink)."','".addslashes($model->imagepath)."',$model->catid, ".(($model->isactive==true)?"1":"0")." from dual 
               
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

    function updateDatas(\team_member_model $model){
        
        $sql = "UPDATE team_member SET 
                name = ".(($model->name==null)?"NULL":"'".addslashes($model->name)."'")." , 
                phone = ".(($model->phone==null)?"NULL":"'".addslashes($model->phone)."'")."  ,
                fblink = ".(($model->fblink==null)?"NULL":"'".addslashes($model->fblink)."'")."  ,
                email = ".(($model->email==null)?"NULL":"'".addslashes($model->email)."'")."  ,
                imagepath = ".(($model->imagepath==null)?"NULL":"'".addslashes($model->imagepath)."'")." ,
                catid = ".(($model->catid==null || $model->catid==false)?"0":"$model->catid")."  ,
                isactive = ".(($model->isactive==null || $model->isactive==false)?"0":"1")." 
               
                WHERE memberid= $model->memberid" ;   
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->memberid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($memberid){
        if(!($memberid!= 0)){ 
            return 0;
        }
        $sql = "delete from team_member WHERE memberid = $memberid ";  
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $memberid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
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