<?php 
ob_start();
session_start(); 
?>

<?php 
header('Location: index.php');
?>

<!DOCTYPE html>
<html>
<head>
        <?php include_once('./PartialViews/main_head.php') ?>
        <?php include_once('./config.php'); ?>
        <style>
                html {
                        background: #000;
                }
                body {
                        background-image: url('./AppData/Images/about_cover.jpg');
                        background-blend-mode: overlay;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                }
                .error {
                        color: #ffb300;
                        font-weight: 100;
                        font-size: smaller;
                }

                .nav-btn {
                        position: absolute;
                        right: 30px;
                        width: 100px;
                }

                #loginBtn {
                        font-weight: bolder;
                }

                #loginBtn:hover {
                        color: #273746;
                        background-color: #fff;
                }
        
        </style>
        <script>
                $(document).ready(function(){
                       // $('.page-footer').addClass('fixed-bottom');
                });        
        </script>
</head>
<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h3 style="display:flex-inline; margin-right:40px;">Integration</h3>
                </a>
                <div class="form-inline">
                        <a class="btn nav-btn rounded-pill" href="user_signup.php">Signup</a>
                </div>
        </nav>

        <div class="container" style="max-width:500px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;"><span style="font-family: 'Lobster';">Login to your account of Integration</span></div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form name="userlogin" id = "userlogin" action="#">
                <div class="form-group">
                        <div class="form-label-group">
                                 <label for="email">Your Registered Email Address</label>
                                <input type="text" name = "email" id="email" class="form-control" placeholder="Email Address" autofocus="autofocus">
                               
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                                
                        </div>
                </div>
                <input class="btn btn-primary btn-block" id="loginBtn" type="submit" name="submit" value="Login">
                </form>
        <!-- Login Form -->
                        </div>
                </div>
        </div>
<?php include_once('./PartialViews/main_footer.php')?> 

<!-- page level script -->
<script>
        $(document).ready(function(){
                var RootPathHost = '<?php echo($HTTP_HOST); ?>';

                $('#userlogin').validate({
                        rules: {
                        email: "required",
                        pass: "required",
                        },
                        // Specify validation error messages
                        messages: {
                        email: "Please enter your registered email address",
                        pass: "Please enter your password",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#loginBtn').click(function(e) {
                        var ret = $('#userlogin').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#userlogin");
                                var formData = new FormData(formElement);
                                
                                $.ajax({
                                url: 'https://www.isical.ac.in/~integration/Controller/userlogin_controller.php',
                                enctype: 'multipart/form-data',
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: "POST",
                                success: function(data) {
                                        var arr = data.split("||||");
                                        var retval = arr[arr.length - 1];
                                        console.log(retval);
                                        if (parseInt(retval) > 0) {
                                                $.alert({
                                                title: 'Logged In',
                                                content: 'You have sucessfully logged in to your account. Click OK to continue.',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/index.php');
                                                                }
                                                        }
                                                });
                                        } else if (parseInt(retval) == -1) {
                                                $.alert({
                                                        title: 'Password Mismatched',
                                                        content: 'Looks like you typed your password wrong. Please try again!',
                                                        buttons : {
                                                        OK: function () {
                                                                },
                                                        }
                                                });
                                        } else if (parseInt(retval) == 0){
                                                $.alert({
                                                        title: 'Not Signed Up Yet?',
                                                        content: 'Looks like you have not signed up as an user. Click Sign Up or proceed as an Guest user!',
                                                        buttons : {
                                                        SignUp: function () {
                                                                window.location.replace(RootPathHost+'/user_signup.php');
                                                                },
                                                        Proceed_As_Guest: function() {
                                                                window.location.replace(RootPathHost+'/index.php');
                                                                }
                                                        }
                                                });
                                        }
                                        else {
                                                $.alert({
                                                title: 'Error',
                                                content: 'Looks like there is a technical problem. Please try again later!',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/index.php');
                                                                }
                                                        }
                                                });
                                        }


                                        },
                                error: function(data) {
                                        $.alert({
                                                title: 'Error',
                                                content: 'Looks like there is a technical problem. Please try again later!',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/index.php');
                                                                }
                                                        }
                                        });
                                        }
                                });
                        }

                });
        });

</script>
<!--page level script-->
</body>
</html>
