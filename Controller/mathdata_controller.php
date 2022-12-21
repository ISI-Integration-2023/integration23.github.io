<?php 
include_once('../config.php');
require_once( $ROOT_PATH.'/Model/mathdata_model.php');
require_once( $ROOT_PATH.'/DAL/mathdata_dal.php');
require_once($ROOT_PATH.'/Utility/MailMethods.php');

class mathdata_controller {

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
if($mode=="register"){
    $retval = mathdata_controller::AddUser();
    echo("||||". $retval);
}
if ($mode == "pay") {
        $retval = mathdata_controller::PayUser();
        echo("||||".$retval);
}


?>
