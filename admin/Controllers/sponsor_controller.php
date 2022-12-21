<?php
include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/sponsor_model.php');
require_once( $ROOT_PATH.'/DAL/sponsor_dal.php');
require_once($ROOT_PATH.'/Utility/FileUploader.php');
class sponsor_controller
{
    static function DeleteSponsor(){  
        $sponsorid=0;
        $retval = 0;
        if (isset($_REQUEST['sponsorid'])){  $sponsorid = $_REQUEST['sponsorid']; }
        $model = new sponsor_model();
        $model->sponsorid = $sponsorid;

        if($model->sponsorid> 0){
            $filename = null;
            $dalobj = new sponsor_dal(); 
            $list = $dalobj->getDatas(' sponsorid= '.$model->sponsorid);
            $model = reset($list);  //take the first element

            //Delete old image file
            $obj = new FileUploader();
            $obj::Deletefile('/AppData/Sponsors/'.$model->logoimagepath);

            $model->logoimagepath = $filename;
            $retval = $dalobj->deleteDatas($model->sponsorid);   
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function UpdateSponsorImage(){ 
        $sponsorid=0;
        $retval = 0;
        if (isset($_REQUEST['sponsorid'])){  $sponsorid = $_REQUEST['sponsorid']; }
        $model = new sponsor_model();
        $model->sponsorid = $sponsorid;

        if($model->sponsorid> 0){
            $filename = null;
            $dalobj = new sponsor_dal(); 
            $list = $dalobj->getDatas(' sponsorid= '.$model->sponsorid);
            $model = reset($list);  //take the first element
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Sponsors/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                if($filename!=null){
                    //that means successfully new file uploaded. So delete old file
                    $obj::Deletefile('/AppData/Sponsors/'.$model->logoimagepath);

                    $model->logoimagepath = $filename;
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

    static function AddEditSponsor(){
        $sponsorname =null; $sponsorimgname =null;$sponsorid=0;

        $retval = 0;
        if (isset($_REQUEST['sponsorname'])){  $sponsorname = $_REQUEST['sponsorname']; }
        if (isset($_REQUEST['sponsorimgname'])){  $sponsorimgname = $_REQUEST['sponsorimgname']; }
        if (isset($_REQUEST['sponsorid'])){  $sponsorid = $_REQUEST['sponsorid']; }
        $model = new sponsor_model();
        $model->sponsorid = $sponsorid;
        $model->sponsorname = $sponsorname;
        $model->logoimagepath = $sponsorimgname;
        if($model->sponsorid==0){
            $filename = null;
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Sponsors/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                
            }
            $model->logoimagepath = $filename;
            $dalobj = new sponsor_dal(); 
            $retval = $dalobj->insertDatas($model); 
            $dalobj =  null;
        }else{
            $dalobj = new sponsor_dal(); 
            //$oldmodel = reset($dalobj->getDatas(' sponsorid= '.$model->sponsorid));
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
    $retval = sponsor_controller::AddEditSponsor();
    echo("||||". $retval);
}
else if($mode=="updateimage"){
    $retval = sponsor_controller::UpdateSponsorImage(); 
    if($retval>0){
        echo("||||". $retval);
    }
}
else if($mode=="deletesponsor"){
    $retval = sponsor_controller::DeleteSponsor();  
    if($retval>0){
        echo("||||". $retval);
    }
}
?>