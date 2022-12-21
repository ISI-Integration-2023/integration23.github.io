<?php 
include_once('../config.php');
require_once( $ROOT_PATH.'/Model/mathdata_model_offline.php');
//require_once($ROOT_PATH.'/Model/mathdata_model.php');
require_once( $ROOT_PATH.'/DAL/mathdata_dal_offline.php');
//require_once($ROOT_PATH.'/Utility/MailMethods.php');
//require_once($ROOT_PATH.'/Utility/generate_admit.php');

class mathdata_controller_offline {

        

	static function AdmitUser() {
                $date_of_birth = null;
                $contact = null;
                $res = 0;
                
                if (isset($_REQUEST['contact'])){  $contact = $_REQUEST['contact']; }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }
		/*if (isset($_SESSION['contact'])){  $contact = $_SESSION['contact']; }
                
                if (isset($_SESSION['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_SESSION['date_of_birth'])));
                }*/
                $dalobj = new mathdata_dal_offline();
                $sql = "date_of_birth = '".$date_of_birth."' and contact = '".$contact."'";
                $sql = "studentid = (select studentid from offline where GREATEST(GREATEST(levenshtein_ratio('".$contact."', phone1),levenshtein_ratio('".$contact."', phone2)),levenshtein_ratio('".$contact."', email))+2*levenshtein_ratio('".$date_of_birth."', date_of_birth)>250 order by GREATEST(GREATEST(levenshtein_ratio('".$contact."', phone1),levenshtein_ratio('".$contact."', phone2)),levenshtein_ratio('".$contact."', email))+2*levenshtein_ratio('".$cdate_of_birth."', date_of_birth) desc limit 1)";
                $mathdata = $dalobj->getDatasForAdmit($sql);

                if (count($mathdata) < 1) {
                        $res = 0;
                }
                else {
                        $mathdata = reset($mathdata);
                        $class = $mathdata->student_class;
                        //$book = $mathdata->book;
			//$pay = $mathdata->pay;
			session_start();$_SESSION['ide']=$mathdata->studentid;$_SESSION['contact']=$mathdata->contact;$_SESSION['date_of_birth']=$mathdata->date_of_birth;$allow=$mathdata->allow;
				if($allow=='0')
				{$res=1;}else{$res=3;}

                }
                
                return($res);
        }

	static function UpdateUser() {
                $name = null;
                //$lastname = null;
                $date_of_birth = null;
                $institution = null;
                $phone1 = null;
                $phone2 = '0';
                $email = '0';
                $student_class = null;
                $medium = null;
                $exam_zone = null;
                //$book = null;
                //$guard_name = null;
                //$address = null;
		session_start();
                if(isset($_SESSION['ide'])){$studentid=$_SESSION['ide'];}
		else{
			session_destroy();
			header('Location:https://www.isical.ac.in/~integration/math.php');
		}
                $retval = 0;  // everything is okay
                if (isset($_REQUEST['name'])){  $firstname = $_REQUEST['name']; }
                //if (isset($_REQUEST['lastname'])){  $lastname = $_REQUEST['lastname']; }
                if (isset($_REQUEST['institution'])){  $institution = $_REQUEST['institution']; }
                if (isset($_REQUEST['phone1'])){  $phone1 = $_REQUEST['phone1']; }
                if (isset($_REQUEST['phone2'])){  if(!empty($_REQUEST['phone2'])){$phone2 = $_REQUEST['phone2'];} }
                if (isset($_REQUEST['email'])){  if(!empty($_REQUEST['email'])){$email = $_REQUEST['email'];} }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }
                //if (isset($_REQUEST['student_class'])){  $student_class = $_REQUEST['student_class']; }
                if (isset($_REQUEST['medium'])){  $medium = $_REQUEST['medium']; }
                //if (isset($_REQUEST['exam_zone'])){  $exam_zone = $_REQUEST['exam_zone']; }
                //if (isset($_REQUEST['book'])){  $book = $_REQUEST['book']; }
                //if (isset($_REQUEST['guard_name'])){  $guard_name = $_REQUEST['guard_name']; }
                //if (isset($_REQUEST['address'])){  $address = $_REQUEST['address']; }
                

                $user = new mathdata_model_offline();
                $user->studentid = $studentid;
                $user->name = $firstname;
                //$user->lastname = $lastname;
                $user->date_of_birth = $date_of_birth;
                $user->institution = $institution;
                $user->phone1 = $phone1;
                $user->phone2 = $phone2;
                $user->email = $email;
                //$user->student_class = $student_class;
                $user->medium = $medium;
                //$user->exam_zone = $exam_zone;
                //$user->book = $book;
                //$user->guard_name = $guard_name;
                //$user->address = $address;


                $dalobj = new mathdata_dal_offline();
                $retval = $dalobj->UpdateDatasOffline($user);  
                //$_SESSION['allow']='0';
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
/*if (isset($_SESSION['mode']))
{
    if(!empty($_SESSION['mode']))
    {
        $mode = $_SESSION['mode'];
    }
}*/
if ($mode == "admit") {
        $retval = mathdata_controller_offline::AdmitUser();
        echo("||||".$retval);
}
if ($mode == "update") {
        $retval = mathdata_controller_offline::UpdateUser();
        echo("||||".$retval);
}


?>
