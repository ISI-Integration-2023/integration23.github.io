<?php  

require_once($ROOT_PATH.'/Model/category_model.php');
require_once($ROOT_PATH.'/DAL/database.php');
class category_dal extends DB 
{
    function getAll(){
        $array = array();
        $sql = 'SELECT * FROM category';
        foreach ($this->conn->query($sql) as $row) {
            $obj = new category_model(); 
            $obj->categoryid =  $row['categoryid'];
            $obj->categoryname =  $row['categoryname'];
            $obj->description =  $row['description'];
            $obj->imagepath =  $row['imagepath'];
            $obj->isactive =  $row['isactive'];
            $obj->isevent =  $row['isevent'];
            array_push($array,$obj);
        }
        return $array;
    }

    function getDatas($wherecondition){
        $array = array();
        $sql = 'SELECT * FROM category where '.$wherecondition;
        foreach ($this->conn->query($sql) as $row) {
            $obj = new category_model();
            $obj->categoryid =  $row['categoryid'];
            $obj->categoryname =  $row['categoryname'];
            $obj->description =  $row['description'];
            $obj->imagepath =  $row['imagepath'];
            $obj->isactive =  $row['isactive'];
            $obj->isevent =  $row['isevent'];
            array_push($array,$obj);
        }
        return $array;
    }

    function insertDatas(\category_model $model){

        $sql = "INSERT INTO category(categoryname,description,imagepath,isactive,isevent) 
                SELECT '".addslashes($model->categoryname)."','".addslashes($model->description)."','".addslashes($model->imagepath)."',".(($model->isactive==true)?"1":"0")." , ".(($model->isevent==true)?"1":"0")." from dual  
                WHERE NOT EXISTS (SELECT * FROM `category` 
                      WHERE categoryname='".addslashes($model->categoryname)."') 
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

    function updateDatas(\category_model $model){
        
        $sql = "UPDATE category SET 
                categoryname = ".(($model->categoryname==null)?"NULL":"'".addslashes($model->categoryname)."'")." , 
                description = ".(($model->description==null)?"NULL":"'".addslashes($model->description)."'")."  ,
                imagepath = ".(($model->imagepath==null)?"NULL":"'".addslashes($model->imagepath)."'")." ,
                isactive = ".(($model->isactive==null || $model->isactive==false)?"0":"1")." ,
                isevent = ".(($model->isevent==null || $model->isevent==false)?"0":"1")."

                WHERE categoryid= $model->categoryid" ;  
        
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $model->categoryid ; //  $stmnt->fetch(PDO::FETCH_ASSOC); 
            $this->conn->commit(); 
        }
        catch(Exception $e) {  
            $temp = 0;
            $this->conn->rollback(); 
            echo "Error!: " . $e->getMessage() . "</br>";  
        } 
        return $temp; 
    }

    function deleteDatas($categoryid){
        if(!($categoryid!= 0)){
            return 0;
        }
        $sql = "delete from category WHERE categoryid = $categoryid "; 
        $stmnt = $this->conn->prepare($sql);
        $temp = 0;
        try { 
            $this->conn->beginTransaction(); 
            $stmnt->execute(); 
            $temp = $categoryid ; //  $stmnt->fetch(PDO::FETCH_ASSOC);
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