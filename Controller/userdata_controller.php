<?php 
include_once('../config.php');
require_once( $ROOT_PATH.'/Model/userdata_model.php');
require_once( $ROOT_PATH.'/DAL/userdata_dal.php');
require_once($ROOT_PATH.'/Utility/MailMethods.php');

class userdata_controller {

        static function AddUser() {
                $firstname = null;
                $lastname = null;
                $date_of_birth = null;
                $institution = null;
                $phone = null;
                $email = null;
                $_password = null;
                $isactive = true;

                $retval = 0;  // everything is okay
                if (isset($_REQUEST['firstname'])){  $firstname = $_REQUEST['firstname']; }
                if (isset($_REQUEST['lastname'])){  $lastname = $_REQUEST['lastname']; }
                if (isset($_REQUEST['institution'])){  $institution = $_REQUEST['institution']; }
                if (isset($_REQUEST['phone'])){  $phone = $_REQUEST['phone']; }
                if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                
                if (isset($_REQUEST['date_of_birth'])) {
                        $date_of_birth = date('Y-m-d',strtotime(htmlentities($_REQUEST['date_of_birth'])));
                }
                if (isset($_REQUEST['pass'])) { 
                        $raw_password = $_REQUEST['pass'];
                        $_password = password_hash($raw_password, PASSWORD_DEFAULT);
                }

                $user = new userdata_model();
                $user->userid = 0;
                $user->firstname = $firstname;
                $user->lastname = $lastname;
                $user->date_of_birth = $date_of_birth;
                $user->institution = $institution;
                $user->phone = $phone;
                $user->email = $email;
                $user->_password = $_password;
                $user->isactive = $isactive;

                $dalobj = new userdata_dal();
                $retval = $dalobj->insertDatas($user);  
                /*$dalobj = null;
 
                
                if ((int)$retval > 0) {
                        // need to send an mail with raw_password
                        $mailobj = new MailMethods();
                        $mailsubject = 'Registration for Integration '.date("Y", strtotime('+6 months')).' is Successful'; 
                        $mailcontent = 'Congratulations! You have successfully registered as a part of Integration '.date("Y", strtotime('+6 months')).', the annual Techno-Cultural-Sports festival of the students of Indian Statistical Institute, Kolkata.<br/>Your username: '.$email.'<br/>Your password: '.$raw_password.'<br/> Please use this details to log in to our website and register for various events. Please save this mail for any future reference. Thank you for being a part of Integration!<br/><br/> If you have not registered for Integration, then please contact the administrators.';
                        $content = $mailobj::GetBasicTemplateContent($mailcontent);
                        $response = $mailobj::SendEmail($email,
                                                "integration.isi@gmail.com",
                                                $mailsubject,
                                                $content);
                } */
                
                return $retval;
        }

        static function EditUser() {
                $userid = 0;
                $firstname = null;
                $lastname = null;
                $date_of_birth = null;
                $institution = null;
                $phone = null;
                $email = null;
                $_password = null;
                $isactive = true;

                $changepassword = false;

                $retval = 0;  // everything is okay
                if (isset($_REQUEST['userid1'])){  $userid = $_REQUEST['userid1']; }
                if (isset($_REQUEST['userid2'])){  $userid = $_REQUEST['userid2']; }
                if (isset($_REQUEST['institution'])){  $institution = $_REQUEST['institution']; }
                if (isset($_REQUEST['phone'])){  $phone = $_REQUEST['phone']; }
                if (isset($_REQUEST['email'])){  $email = $_REQUEST['email']; }
                if (isset($_REQUEST['oldpass'])) { 
                        $old_password = $_REQUEST['oldpass'];
                }
                if (isset($_REQUEST['newpass'])) {  
                        $new_password = $_REQUEST['newpass'];
                        $changepassword = true; 
                }
                else {
                        $new_password = $_REQUEST['oldpass']; // new password is same as old password
                }
                
                $user = new userdata_model();
                $wherecondition = 'userid = '.$userid;
                $dalobj = new userdata_dal();
                $users = $dalobj->getDatas($wherecondition);
                $user = reset($users);

                if (password_verify($old_password, $user->_password)) {
                        $user->institution = $institution;
                        $user->phone = $phone;
                        $user->email = $email;
                        $_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $user->_password = $_password;
                        $retval = $dalobj->updateDatas($user);  // you have updated successfully 
                }
                else {
                        $retval = -1; // password not matched
                }

                /* if ($changepassword) {
                        // need to send an mail with raw_password
                        $mailobj = new MailMethods();
                        $mailsubject = 'Your Password for Integration '.date("Y", strtotime('+6 months')).' Account has been changed'; 
                        $mailcontent = 'You have successfully changed your password for your account of Integration '.date("Y", strtotime('+6 months')).', the annual Techno-Cultural-Sports festival of the students of Indian Statistical Institute, Kolkata.<br/>Your username: '.$email.'<br/>Your password: '.$raw_password.'<br/> Please use this details to log in to our website and register for various events. Thank you for being a part of Integration!<br/><br/> If you have not changed your password for Integration account, then please contact the administrators.';
                        $content = $mailobj::GetBasicTemplateContent($mailcontent);
                        $response = $mailobj::SendEmail($email,
                                                "integration.isi@gmail.com",
                                                $mailsubject,
                                                $content);
                } */
                
                return $retval;
        }

        static function DeleteUser() {
                $userid=0;
                $retval = 0;
                $_password = null; 

                if (isset($_REQUEST['userid'])){  $userid = $_REQUEST['userid']; }
                if (isset($_REQUEST['pass'])) {
                        $_password = $_REQUEST['pass'];        
                }
        
                $user = new userdata_model();
                $wherecondition = 'userid = '.$userid;
                $dalobj = new userdata_dal();
                $users = $dalobj->getDatas($wherecondition);
                $user = reset($users);

                if (password_verify($old_password, $user->_password)) {
                        if($user->userid> 0){
                        $retval = $dalobj->deleteDatas($model->userid);   
                        $dalobj =  null;
                }
                }
                else {
                        $retval = -1;
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
if($mode=="signup"){
    $retval = userdata_controller::AddUser();
    echo("||||". $retval);
}
else if($mode=="update"){
    $retval = userdata_controller::EditUser(); 
    echo("||||". $retval);
}
else if($mode=="delete"){
    $retval = userdata_controller::DeleteUser();  
    echo("||||". $retval);
}
?>
