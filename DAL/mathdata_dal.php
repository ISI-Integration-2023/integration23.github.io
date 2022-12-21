<?php
require_once($ROOT_PATH.'/Model/mathdata_model.php');
require_once($ROOT_PATH.'/Model/mathdata_model2.php');
require_once($ROOT_PATH.'/DAL/database.php');
class mathdata_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM mathdata';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new mathdata_model(); 
            $obj->studentid =  $row['studentid'];
            $obj->firstname =  $row['firstname'];
            $obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone1 =  $row['phone1'];
            $obj->phone2 =  $row['phone2'];
            $obj->email =  $row['email'];
            $obj->student_class = $row['student_class'];
            $obj->medium = $row['medium'];
            $obj->exam_zone = $row['exam_zone'];
            $obj->book = $row['book'];
            $obj->guard_name = $row['guard_name'];
            $obj->address = $row['address'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM mathdata where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new mathdata_model(); 
            $obj->studentid =  $row['studentid'];
            $obj->firstname =  $row['firstname'];
            $obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone1 =  $row['phone1'];
            $obj->phone2 =  $row['phone2'];
            $obj->email =  $row['email'];
            $obj->student_class = $row['student_class'];
            $obj->medium = $row['medium'];
            $obj->exam_zone = $row['exam_zone'];
            $obj->book = $row['book'];
            $obj->guard_name = $row['guard_name'];
            $obj->address = $row['address'];
            array_push($array,$obj);
        }
        return $array;
    }

	function getDatasForAdmit($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM sumit where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new mathdata_model_admit(); 
            $obj->studentid =  $row['studentid'];
            $obj->firstname =  $row['firstname'];
            $obj->lastname =  $row['lastname'];
            $obj->date_of_birth = $row['date_of_birth'];
            $obj->institution = $row['institution'];
            $obj->phone1 =  $row['phone1'];
            $obj->phone2 =  $row['phone2'];
            $obj->email =  $row['email'];
            $obj->student_class = $row['student_class'];
            $obj->medium = $row['medium'];
            $obj->exam_zone = $row['exam_zone'];
            $obj->book = $row['book'];
            $obj->guard_name = $row['guard_name'];
            $obj->address = $row['address'];
		$obj->pay = $row['pay'];
		$obj->allow = $row['allow'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\mathdata_model $model){

        $sql = "INSERT INTO mathdata(firstname,lastname,date_of_birth,institution,phone1,phone2,email,student_class,medium,exam_zone,book,guard_name,address) 
                SELECT '".addslashes($model->firstname)."',
                '".addslashes($model->lastname)."',
                '".addslashes($model->date_of_birth)."',
                '".addslashes($model->institution)."',
                '".addslashes($model->phone1)."',
                '".addslashes($model->phone2)."',
                '".addslashes($model->email)."',
                '".addslashes($model->student_class)."',
                '".addslashes($model->medium)."',
                '".addslashes($model->exam_zone)."',
                '".addslashes($model->book)."',
                '".addslashes($model->guard_name)."',
                '".addslashes($model->address)."' from dual 
                WHERE NOT EXISTS (SELECT * FROM `mathdata` 
                      WHERE email='$model->email')  
                LIMIT 1 
                ";
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;

        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $this->conn->lastInsertId() ;
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function updateDatas(\mathdata_model $model){
      

        $sql = "UPDATE mathdata SET 
                firstname = ".(($model->firstname==null)?"NULL":"'".addslashes($model->firstname)."'")." , 
                lastname = ".(($model->lastname==null)?"NULL":"'".addslashes($model->lastname)."'")."  ,
                date_of_birth = ".(($model->date_of_birth==null)?"NULL":"'".addslashes($model->date_of_birth)."'")."  ,
                institution = ".(($model->institution==null)?"NULL":"'".addslashes($model->institution)."'")."  ,
                phone1 = ".(($model->phone1==null)?"NULL":"'".addslashes($model->phone1)."'")."  ,
                phone2 = ".(($model->phone2==null)?"NULL":"'".addslashes($model->phone2)."'")."  ,
                email = ".(($model->email==null)?"NULL":"'".addslashes($model->email)."'")."  ,
                student_class = ".(($model->student_class==null)?"NULL":"'".addslashes($model->student_class)."'")."  ,
                medium = ".(($model->medium==null)?"NULL":"'".addslashes($model->medium)."'")."  ,
                exam_zone = ".(($model->exam_zone==null)?"NULL":"'".addslashes($model->exam_zone)."'")."  ,
                book = ".(($model->book==null)?"NULL":"'".addslashes($model->book)."'")."  ,
                guard_name = ".(($model->guard_name==null)?"NULL":"'".addslashes($model->guard_name)."'")."  ,
                address = ".(($model->address==null)?"NULL":"'".addslashes($model->address)."'")."
                WHERE studentid= $model->studentid" ;   
        

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

	function updateDatasSumit(\mathdata_model $model){
      

        $sql = "UPDATE sumit SET 
                firstname = ".(($model->firstname==null)?"NULL":"'".addslashes($model->firstname)."'")." , 
                lastname = ".(($model->lastname==null)?"NULL":"'".addslashes($model->lastname)."'")."  ,
                institution = ".(($model->institution==null)?"NULL":"'".addslashes($model->institution)."'")."  ,
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

    function deleteDatas($studentid){
        if(!($studentid!= 0)){ 
            return 0;
        }
        $sql = "delete from mathdata WHERE studentid = $studentid ";  
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
