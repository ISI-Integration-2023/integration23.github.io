<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php 
include_once('../config.php');

if(isset($_POST['submit'])) {
  if(isset($_POST['adminname'])) {
    if (isset($_POST['pass'])) {
      $_SESSION['adminname'] = $_POST['adminname'];
      $_SESSION['password'] = $_POST['pass'];
      if ($_SESSION['adminname'] == $ADMIN_USER && $_SESSION['password'] == $ADMIN_PASS) {
        header('Location: index.php');
      }

      else {
        header('Location: login.php');
      }
    }
  }
}
?>
        <title>Admin - Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="admin-login">
        <meta name="author" content="subroy13">
        <!-- Custom styles for this template-->
        <link href="./assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <!-- Login Form -->
        <form name="adminlogin" id = "adminlogin" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/formdata">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name = "adminname" id="adminname" class="form-control" placeholder="Admin name" required="required" autofocus="autofocus">
              <label for="adminname">Admin Name</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required="required">
              <label for="pass">Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login">
        </form>
        <!-- Login Form -->

      </div>
    </div>

</div>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/jquery-easing/jquery.easing.min.js"></script>  

</body>

</html>
