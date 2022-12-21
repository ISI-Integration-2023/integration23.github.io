<?php 
include_once('../config.php');
require_once( $ROOT_PATH.'/Model/userdata_model.php');
require_once( $ROOT_PATH.'/DAL/userdata_dal.php');


function UserLogin() {
        $userid = 0;
        $firstname = null;
        $lastname = null;
        $date_of_birth = null;
        $institution = null;
        $phone = null;
        $email = null;
        $_password = null;
        $isactive = true;

        $retval = 0;    // no user

        if (isset($_REQUEST['email'])) {$email = $_REQUEST['email']; }
        if (isset($_REQUEST['pass'])) {$_password = $_REQUEST['pass']; }

        $wherecondition = "email='".addslashes($email)."'";

        $dalobj = new userdata_dal();
        $users = $dalobj->getDatas($wherecondition);

        $nUser = count($users);

        if ($nUser > 0) {
                $user = reset($users);
                if (password_verify($_password, $user->_password)) {
                        session_start();
                        $_SESSION['user_userid'] = $user->userid;
                        $_SESSION['user_firstname'] = $user->firstname;
                        $_SESSION['user_email'] = $user->email;
                        
                        $retval = 1;    // you have logged in
                }
                else {
                        $retval = -1; // password not matched
                }
        }
        return $retval;
}
?>

<?php 
$retval = UserLogin();
echo("||||".$retval);
?>