<?php
require_once($ROOT_PATH.'/Model/mathdata_model_offline.php');
//require_once($ROOT_PATH.'/Model/mathdata_model2.php');
require_once($ROOT_PATH.'/DAL/database.php');
class mathdata_dal_offline extends DB 
{
    

    
	function getDatasForAdmit($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM offline where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new mathdata_model_offline(); 
            $obj->studentid =  $row['studentid'];
            $obj->name =  $row['name'];
            //$obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone1 =  $row['phone1'];
            $obj->phone2 =  $row['phone2'];
            $obj->email =  $row['email'];
            $obj->student_class = $row['student_class'];
            $obj->medium = $row['medium'];
            $obj->exam_zone = $row['exam_zone'];
            //$obj->book = $row['book'];
            //$obj->guard_name = $row['guard_name'];
            //$obj->address = $row['address'];
		//$obj->pay = $row['pay'];
		$obj->allow = $row['allow'];
            array_push($array,$obj);
        }
        return $array;
    }

    
	function updateDatasOffline(\mathdata_model_offline $model){
      

        $sql = "UPDATE offline SET 
                name = ".(($model->name==null)?"NULL":"'".addslashes($model->name)."'")." , 
                date_of_birth = ".(($model->date_of_birth==null)?"NULL":"'".addslashes($model->date_of_birth)."'")."  ,
                institution = ".(($model->institution==null)?"NULL":"'".addslashes($model->institution)."'")."  ,
                email = ".(($model->email==null)?"NULL":"'".addslashes($model->email)."'")."  ,
                phone1 = ".(($model->phone1==null)?"NULL":"'".addslashes($model->phone1)."'")."  ,
                phone2 = ".(($model->phone2==null)?"NULL":"'".addslashes($model->phone2)."'")."  ,
                medium = ".(($model->medium==null)?"NULL":"'".addslashes($model->medium)."'")."  ,
		allow = '0' 
                WHERE studentid=".$model->studentid." AND allow = 1" ;   
        

        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->studentid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
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
