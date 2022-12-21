<?php

include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/category_model.php');
require_once( $ROOT_PATH.'/DAL/category_dal.php');
require_once($ROOT_PATH.'/Utility/FileUploader.php');
class category_controller
{
    static function Deletecategory(){  
        $categoryid=0;
        $retval = 0;
        if (isset($_REQUEST['categoryid'])){  $categoryid = $_REQUEST['categoryid']; }
        $model = new category_model();
        $model->categoryid = $categoryid;

        if($model->categoryid> 0){
            $filename = null;
            $dalobj = new category_dal(); 
            $list = $dalobj->getDatas(' categoryid= '.$model->categoryid);
            $model = reset($list); //Take the first element

            //Delete old image file
            $obj = new FileUploader();
            $obj::Deletefile('/AppData/Categories/'.$model->imagepath); 
            $model->imagepath = $filename; 
            $retval = $dalobj->deleteDatas($model->categoryid);   
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function UpdatecategoryImage(){ 
        $categoryid=0;
        $retval = 0;
        if (isset($_REQUEST['categoryid'])){  $categoryid = $_REQUEST['categoryid']; }
        $model = new category_model();
        $model->categoryid = $categoryid;

        if($model->categoryid > 0){
            $filename = null;
            $dalobj = new category_dal(); 
            $list = $dalobj->getDatas(' categoryid= '.$model->categoryid);
            $model = reset($list);  //take the first element
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Categories/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                if($filename!=null){
                    //that means successfully new file uploaded. So delete old file
                    $obj::Deletefile('/AppData/Categories/'.$model->imagepath);

                    $model->imagepath = $filename; 
                    $retval = $dalobj->updateDatas($model);   
                } 
            }
            else{
                echo "Sorry, there was an error. Image file get Zero size.";
                $retval = -1;
            }
           
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function AddEditcategory(){
        $categoryname =null; $categoryimgname =null;$description=null; $categoryid=0; $isactive = true; $isevent = false; 

        $retval = 0;
        if (isset($_REQUEST['categoryname'])){  $categoryname = $_REQUEST['categoryname']; }
        if (isset($_REQUEST['description'])){  $description = $_REQUEST['description']; } 
        if (isset($_REQUEST['categoryimgname'])){  $categoryimgname = $_REQUEST['categoryimgname']; }
        if (isset($_REQUEST['categoryid'])){  $categoryid = $_REQUEST['categoryid']; }

        if (isset($_REQUEST['isactive'])){  $isactive = true; } else {$isactive = false;}
        if (isset($_REQUEST['isevent'])){  $isevent = true; } else {$isevent = false;}        


        $model = new category_model();
        $model->categoryid = $categoryid;
        $model->categoryname = $categoryname;
        $model->description = $description; 
        $model->isactive = $isactive;
        $model->isevent = $isevent; 
        $model->imagepath = $categoryimgname;

        if($model->categoryid==0){
            $filename = null;
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Categories/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                
            }
            $model->imagepath = $filename; 
            $dalobj = new category_dal(); 
            $retval = $dalobj->insertDatas($model); 
            $dalobj =  null;
        }else{
            $dalobj = new category_dal(); 
            //$oldmodel = reset($dalobj->getDatas(' categoryid= '.$model->categoryid));
           // $model->logoimagepath = $oldmodel->logoimagepath;
            $retval = $dalobj->updateDatas($model);  
            $dalobj =  null;
        }
        return $retval;
    }

}
?>
<?php
$mode="";
if (isset($_REQUEST['mode']))
{
    if(!empty($_REQUEST['mode']))
    {
        $mode = $_REQUEST['mode'];
    }
}
if($mode=="addedit"){
    $retval = category_controller::AddEditcategory();
    echo("||||". $retval);
}
else if($mode=="updateimage"){
    $retval = category_controller::UpdatecategoryImage(); 
    if($retval>0){
        echo("||||". $retval);
    }
}
else if($mode=="deletecategory"){
    $retval = category_controller::Deletecategory();  
    if($retval>0){
        echo("||||". $retval);
    }
}
?>