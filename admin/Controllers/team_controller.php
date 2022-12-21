<?php
include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/team_member_model.php');
require_once( $ROOT_PATH.'/DAL/team_member_dal.php');
require_once($ROOT_PATH.'/Utility/FileUploader.php');
class team_member_controller
{
    static function DeleteMember(){  
        $memberid=0;
        $retval = 0;
        if (isset($_REQUEST['memberid'])){  $memberid = $_REQUEST['memberid']; }
        $model = new team_member_model();
        $model->memberid = $memberid;

        if($model->memberid> 0){
            $filename = null;
            $dalobj = new team_member_dal(); 
            $list = $dalobj->getDatas(' memberid= '.$model->memberid);
            $model = reset($list);  //take the first element

            //Delete old image file
            $obj = new FileUploader();
            $obj::Deletefile('/AppData/Team/'.$model->imagepath);

            $model->imagepath = $filename;
            $retval = $dalobj->deleteDatas($model->memberid);   
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function UpdateMemberImage(){ 
        $memberid=0;
        $retval = 0;
        if (isset($_REQUEST['memberid'])){  $memberid = $_REQUEST['memberid']; }
        $model = new team_member_model();
        $model->memberid = $memberid;

        if($model->memberid> 0){
            $filename = null;
            $dalobj = new team_member_dal(); 
            $list = $dalobj->getDatas(' memberid= '.$model->memberid);
            $model = reset($list);  //take the first element
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Team/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                if($filename!=null){
                    //that means successfully new file uploaded. So delete old file
                    $obj::Deletefile('/AppData/Team/'.$model->imagepath);

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

    static function AddEditMember(){
        $memberid = 0;
        $catid = 0;
        $name = null; $phone = null; $email = null; $fblink = null; 
        $imagepath = null; $isactive = true;

        $retval = 0;
        if (isset($_REQUEST['memberid'])){  $memberid = $_REQUEST['memberid']; }
        if (isset($_REQUEST['catid'])){  $catid = $_REQUEST['catid']; }
        if (isset($_REQUEST['name'])){  $name = $_REQUEST['name']; }
        if (isset($_REQUEST['phone'])){  $phone = $_REQUEST['phone']; }
        if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
        if (isset($_REQUEST['fblink'])){  $fblink = $_REQUEST['fblink']; }
        if (isset($_REQUEST['imagepath'])){  $imagepath = $_REQUEST['imagepath']; }
        if (isset($_REQUEST['isactive'])){  $isactive = true; } else {$isactive = false;}
        

        $model = new team_member_model();
        $model->memberid = $memberid;
        $model->name = $name;
        $model->phone = $phone;
        $model->email = $email;
        $model->isactive = $isactive;
        $model->catid = $catid;
        $model->fblink = $fblink;
        $model->imagepath = $imagepath;

        if($model->memberid==0){
            $filename = null;
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Team/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
            }
            $model->imagepath = $filename;
            $dalobj = new team_member_dal(); 
            $retval = $dalobj->insertDatas($model); 
            $dalobj =  null;
        }else{
            $dalobj = new team_member_dal(); 
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
    $retval = team_member_controller::AddEditMember();
    echo("||||". $retval);
}
else if($mode=="updateimage"){
    $retval = team_member_controller::UpdateMemberImage(); 
    if($retval>0){
        echo("||||". $retval);
    }
}
else if($mode=="deletemember"){
    $retval = team_member_controller::DeleteMember();  
    if($retval>0){
        echo("||||". $retval);
    }
}
?>