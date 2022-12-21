<?php 
include_once('../config.php');
require_once( $ROOT_PATH.'/Model/mathdata_model.php');
require_once($ROOT_PATH.'/Model/mathdata_model2.php');
require_once( $ROOT_PATH.'/DAL/mathdata_dal.php');
require_once($ROOT_PATH.'/Utility/MailMethods.php');
//require_once($ROOT_PATH.'/Utility/generate_admit.php');

class mathdata_controller2 {

        static function AddUser() {
                $firstname = null;
                $lastname = null;
                $date_of_birth = null;
                $institution = null;
                $phone1 = null;
                $phone2 = null;
                $email = null;
                $student_class = null;
                $medium = null;
                $exam_zone = null;
                $book = null;
                $guard_name = null;
                $address = null;
                
                $retval = 0;  // everything is okay
                if (isset($_REQUEST['firstname'])){  $firstname = $_REQUEST['firstname']; }
                if (isset($_REQUEST['lastname'])){  $lastname = $_REQUEST['lastname']; }
                if (isset($_REQUEST['institution'])){  $institution = $_REQUEST['institution']; }
                if (isset($_REQUEST['phone1'])){  $phone1 = $_REQUEST['phone1']; }
                if (isset($_REQUEST['phone2'])){  $phone2 = $_REQUEST['phone2']; }
                if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }
                if (isset($_REQUEST['student_class'])){  $student_class = $_REQUEST['student_class']; }
                if (isset($_REQUEST['medium'])){  $medium = $_REQUEST['medium']; }
                if (isset($_REQUEST['exam_zone'])){  $exam_zone = $_REQUEST['exam_zone']; }
                if (isset($_REQUEST['book'])){  $book = $_REQUEST['book']; }
                if (isset($_REQUEST['guard_name'])){  $guard_name = $_REQUEST['guard_name']; }
                if (isset($_REQUEST['address'])){  $address = $_REQUEST['address']; }
                

                $user = new mathdata_model();
                $user->studentid = 0;
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                $user->date_of_birth = $date_of_birth;
                $user->institution = $institution;
                $user->phone1 = $phone1;
                $user->phone2 = $phone2;
                $user->email = $email;
                $user->student_class = $student_class;
                $user->medium = $medium;
                $user->exam_zone = $exam_zone;
                $user->book = $book;
                $user->guard_name = $guard_name;
                $user->address = $address;


                $dalobj = new mathdata_dal();
                $retval = $dalobj->insertDatas($user);  
                /*$dalobj = null;
 
                
                if ((int)$retval > 0) {
                        $mailobj = new MailMethods();
                        $mailsubject = 'Registration for SUM-IT '.date("Y", strtotime('+6 months')).' is Successful'; 
                        $mailcontent = 'Congratulations! You have successfully registered for the exam SUM-IT '.date("Y", strtotime('+6 months')).', as a part of Integration, the annual Techno-Cultural-Sports festival of the students of Indian Statistical Institute, Kolkata. Thank you for being a part of Integration!<br/><br/> If you have not registered for this exam, then please contact the administrators.';
                        $content = $mailobj::GetBasicTemplateContent($mailcontent);
                        $response = $mailobj::SendEmail($email,
                                                "sum.it.integration@gmail.com",
                                                $mailsubject,
                                                $content);
                } */
                
                return $retval;
        }

        static function PayUser() {
                $date_of_birth = null;
                $email = null;
                $res = 0;
                
                if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }

                $dalobj = new mathdata_dal();
                $sql = "date_of_birth = '".$date_of_birth."' and email = '".$email."'";
                $mathdata = $dalobj->getDatas($sql);

                if (count($mathdata) < 1) {
                        $res = 0;
                }
                else {
                        $mathdata = reset($mathdata);
                        $class = $mathdata->student_class;
                        $book = $mathdata->book;

                        if ($class == '9' && $book == 'No') {
                                $res = 1;               // this is situation 1
                        }
                        else if ($class == '9' && $book == 'Yes') {
                                $res = 2;
                        }
                        else if ($class == '11' && $book == 'No') {
                                $res = 3;
                        }
                        else if ($class == '11' && $book == 'Yes') {
                                $res = 4;
                        }
                }
                
                return($res);
        }


	static function AdmitUser() {
                $date_of_birth = null;
                $email = null;
                $res = 0;
                
                if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }
		/*if (isset($_SESSION['email'])){  $email = $_SESSION['email']; }
                
                if (isset($_SESSION['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_SESSION['date_of_birth'])));
                }*/
                $dalobj = new mathdata_dal();
                $sql = "date_of_birth = '".$date_of_birth."' and email = '".$email."'";
                $mathdata = $dalobj->getDatasForAdmit($sql);

                if (count($mathdata) < 1) {
                        $res = 0;
                }
                else {
                        $mathdata = reset($mathdata);
                        $class = $mathdata->student_class;
                        $book = $mathdata->book;
			$pay = $mathdata->pay;
			if($pay == "1"){
			session_start();$_SESSION['id']=$mathdata->studentid;$_SESSION['email']=$mathdata->email;$_SESSION['date_of_birth']=$mathdata->date_of_birth;$_SESSION['pay']=$pay;$allow=$mathdata->allow;
				if($allow=='0')
				{$res=1;}else{$res=3;}
			}else{
				$res = 2;
			}

                }
                
                return($res);
        }

	static function UpdateUser() {
                $firstname = null;
                $lastname = null;
                $date_of_birth = null;
                $institution = null;
                $phone1 = null;
                $phone2 = null;
                $email = null;
                $student_class = null;
                $medium = null;
                $exam_zone = null;
                $book = null;
                $guard_name = null;
                $address = null;
		session_start();
                if(isset($_SESSION['id'])){$studentid=$_SESSION['id'];}
		else{
			session_destroy();
			header('Location:https://www.isical.ac.in/~integration/math.php');
		}
                $retval = 0;  // everything is okay
                if (isset($_REQUEST['firstname'])){  $firstname = $_REQUEST['firstname']; }
                if (isset($_REQUEST['lastname'])){  $lastname = $_REQUEST['lastname']; }
                if (isset($_REQUEST['institution'])){  $institution = $_REQUEST['institution']; }
                //if (isset($_REQUEST['phone1'])){  $phone1 = $_REQUEST['phone1']; }
                if (isset($_REQUEST['phone2'])){  $phone2 = $_REQUEST['phone2']; }
                //if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                
                /*if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }*/
                //if (isset($_REQUEST['student_class'])){  $student_class = $_REQUEST['student_class']; }
                if (isset($_REQUEST['medium'])){  $medium = $_REQUEST['medium']; }
                //if (isset($_REQUEST['exam_zone'])){  $exam_zone = $_REQUEST['exam_zone']; }
                //if (isset($_REQUEST['book'])){  $book = $_REQUEST['book']; }
                //if (isset($_REQUEST['guard_name'])){  $guard_name = $_REQUEST['guard_name']; }
                //if (isset($_REQUEST['address'])){  $address = $_REQUEST['address']; }
                

                $user = new mathdata_model();
                $user->studentid = $studentid;
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                //$user->date_of_birth = $date_of_birth;
                $user->institution = $institution;
                //$user->phone1 = $phone1;
                $user->phone2 = $phone2;
                //$user->email = $email;
                //$user->student_class = $student_class;
                $user->medium = $medium;
                //$user->exam_zone = $exam_zone;
                //$user->book = $book;
                //$user->guard_name = $guard_name;
                //$user->address = $address;


                $dalobj = new mathdata_dal();
                $retval = $dalobj->UpdateDatasSumit($user);  
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
if($mode=="register"){
    $retval = mathdata_controller2::AddUser();
    echo("||||". $retval);
}
if ($mode == "pay") {
        $retval = mathdata_controller2::PayUser();
        echo("||||".$retval);
}
if ($mode == "admit") {
        $retval = mathdata_controller2::AdmitUser();
        echo("||||".$retval);
}
if ($mode == "update") {
        $retval = mathdata_controller2::UpdateUser();
        echo("||||".$retval);
}


?>
