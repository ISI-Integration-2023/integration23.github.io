<?php

include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/showdown_model.php');
require_once( $ROOT_PATH.'/DAL/showdown_dal.php');
require_once($ROOT_PATH.'/Utility/FileUploader.php');
class showdown_controller
{
    static function Deleteshowdown(){  
        $showdownid=0;
        $retval = 0;
        if (isset($_REQUEST['showdownid'])){  $showdownid = $_REQUEST['showdownid']; }
        $model = new showdown_model();
        $model->showdownid = $showdownid;

        if($model->showdownid> 0){
            $filename = null;
            $dalobj = new showdown_dal(); 
            $list = $dalobj->getDatas(' showdownid= '.$model->showdownid);
            $model = reset($list); //Take the first element

            //Delete old image file
            $obj = new FileUploader();
            $obj::Deletefile('/AppData/Showdowns/'.$model->posterimagepath); 
            $model->posterimagepath = $filename; 
            $retval = $dalobj->deleteDatas($model->showdownid);   
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function UpdateshowdownImage(){ 
        $showdownid=0;
        $retval = 0;
        if (isset($_REQUEST['showdownid'])){  $showdownid = $_REQUEST['showdownid']; }
        $model = new showdown_model();
        $model->showdownid = $showdownid;

        if($model->showdownid > 0){
            $filename = null;
            $dalobj = new showdown_dal(); 
            $list = $dalobj->getDatas(' showdownid= '.$model->showdownid);
            $model = reset($list);  //take the first element
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Showdowns/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                if($filename!=null){
                    //that means successfully new file uploaded. So delete old file
                    $obj::Deletefile('/AppData/Showdowns/'.$model->posterimagepath);

                    $model->posterimagepath = $filename; 
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

    static function AddEditshowdown(){
        $showdownid=0; 
        $showdownname =null; 
        $showdownimgname =null;
        $description=null; 
        $timevenue = null;
        
        $retval = 0;
        if (isset($_REQUEST['showdownid'])){  $showdownid = $_REQUEST['showdownid']; }
        if (isset($_REQUEST['showdownname'])){  $showdownname = $_REQUEST['showdownname']; }
        if (isset($_REQUEST['description'])){  $description = $_REQUEST['description']; }
        if (isset($_REQUEST['timevenue'])){  $timevenue = $_REQUEST['timevenue']; } 
        if (isset($_REQUEST['showdownimgname'])){  $showdownimgname = $_REQUEST['showdownimgname']; }


        $model = new showdown_model();
        $model->showdownid = $showdownid;
        $model->showdownname = $showdownname;
        $model->description = $description; 
        $model->timevenue = $timevenue;
        $model->posterimagepath = $showdownimgname;


        if($model->showdownid==0){
            $filename = null;
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Showdowns/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                
            }
            $model->posterimagepath = $filename; 
            $dalobj = new showdown_dal(); 
            $retval = $dalobj->insertDatas($model); 
            $dalobj =  null;
        }else{
            $dalobj = new showdown_dal(); 
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
    $retval = showdown_controller::AddEditshowdown();
    echo("||||". $retval);
}
else if($mode=="updateimage"){
    $retval = showdown_controller::UpdateshowdownImage(); 
    if($retval>0){
        echo("||||". $retval);
    }
}
else if($mode=="deleteshowdown"){
    $retval = showdown_controller::Deleteshowdown();  
    if($retval>0){
        echo("||||". $retval);
    }
}
?>