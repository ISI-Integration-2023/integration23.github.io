<?php
include_once('common_controller_header.php');
require_once( $ROOT_PATH.'/Model/eventdata_model.php');
require_once( $ROOT_PATH.'/DAL/eventdata_dal.php');
require_once($ROOT_PATH.'/Utility/FileUploader.php');
class eventdata_controller
{
    static function DeleteEvent(){  
        $eventid=0;
        $retval = 0;
        if (isset($_REQUEST['eventid'])){  $eventid = $_REQUEST['eventid']; }
        $model = new eventdata_model();
        $model->eventid = $eventid;

        if($model->eventid> 0){
            $filename = null;
            $dalobj = new eventdata_dal(); 
            $list = $dalobj->getDatas(' eventid= '.$model->eventid);
            $model = reset($list);  //take the first element

            //Delete old image file
            $obj = new FileUploader();
            $obj::Deletefile('/AppData/Events/'.$model->imagepath);

            $model->imagepath = $filename;
            $retval = $dalobj->deleteDatas($model->eventid);   
            $dalobj =  null;
        }else{
            $retval = -1;
        }
        return $retval;
    }

    static function UpdateEventImage(){ 
        $eventid=0;
        $retval = 0;
        if (isset($_REQUEST['eventid'])){  $eventid = $_REQUEST['eventid']; }
        $model = new eventdata_model();
        $model->eventid = $eventid;

        if($model->eventid> 0){
            $filename = null;
            $dalobj = new eventdata_dal(); 
            $list = $dalobj->getDatas(' eventid= '.$model->eventid);
            $model = reset($list);  //take the first element
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Events/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
                if($filename!=null){
                    //that means successfully new file uploaded. So delete old file
                    $obj::Deletefile('/AppData/Events/'.$model->imagepath);

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

    static function AddEditEvent(){
        $eventid = 0;
        $catid = 0;
        $eventname = null;  
        $description  = null;
        $timevenue  = null;
        $cmscontent  = null;
        $eventhead  = null;
        $fees = 0;
        $imagepath = null; 
        $isactive = true;

        $retval = 0;
        if (isset($_REQUEST['eventid'])){  $eventid = $_REQUEST['eventid']; }
        if (isset($_REQUEST['catid'])){  $catid = $_REQUEST['catid']; }
        if (isset($_REQUEST['eventname'])){  $eventname = $_REQUEST['eventname']; }
        if (isset($_REQUEST['description'])){  $description = $_REQUEST['description']; }
        if (isset($_REQUEST['timevenue'])){  $timevenue = $_REQUEST['timevenue']; }
        if (isset($_REQUEST['cmscontent'])){  $cmscontent = $_REQUEST['cmscontent']; }
        if (isset($_REQUEST['eventhead'])){  $eventhead = $_REQUEST['eventhead']; }
        if (isset($_REQUEST['fees'])){  $fees = $_REQUEST['fees']; }
        if (isset($_REQUEST['imagepath'])){  $imagepath = $_REQUEST['imagepath']; }
        if (isset($_REQUEST['isactive'])){  $isactive = true; } else {$isactive = false;}
        
        

        $model = new eventdata_model();
        $model->eventid = $eventid;
        $model->catid = $catid;
        $model->eventname = $eventname;
        $model->eventhead = $eventhead;
        $model->description = $description;
        $model->timevenue = $timevenue;
        $model->cmscontent = $cmscontent;
        $model->fees = $fees;
        $model->isactive = $isactive;
        $model->imagepath = $imagepath;

        if($model->eventid==0){
            $filename = null;
            
            if($_FILES['imgFile']['size'] > 0) {
                $obj = new FileUploader();
                $filename = $obj::UploadFile('imgFile','/AppData/Events/');
                if($filename=="-10"){echo "Sorry, there was an error uploading your file."; $filename=null;}
                else if($filename=="-4"){echo "Sorry, your file was not uploaded."; $filename=null;}
                else if($filename=="-3"){echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; $filename=null;}
                else if($filename=="-2"){echo "Sorry, your file is too large."; $filename=null;}
                else if($filename=="-1"){echo "Sorry, file already exists."; $filename=null;}
            }
            $model->imagepath = $filename;
            $dalobj = new eventdata_dal(); 
            $retval = $dalobj->insertDatas($model); 
            $dalobj =  null;
        } else{
            $dalobj = new eventdata_dal(); 
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
    $retval = eventdata_controller::AddEditEvent();
    echo("||||". $retval);
}
else if($mode=="updateimage"){
    $retval = eventdata_controller::UpdateEventImage(); 
    if($retval>0){
        echo("||||". $retval);
    }
}
else if($mode=="deleteevent"){
    $retval = eventdata_controller::DeleteEvent();  
    if($retval>0){
        echo("||||". $retval);
    }
}
?>