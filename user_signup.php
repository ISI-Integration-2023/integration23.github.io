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

                #signup {
                        font-weight: bolder;
                }

                #signup:hover {
                        color: #273746;
                        background-color: #fff;
                }
        
        
        </style>

</head>
<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h3 style="display:flex-inline; margin-right:40px;">Integration</h3>
                </a>
                <div class="form-inline">
                        <a class="btn nav-btn rounded-pill" href="user_login.php">Login</a>
                </div>
        </nav>

        <div class="container" style="max-width:600px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;"><span style="font-family: 'Lobster';">Sign Up and be a part of Integration</span></div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form action="#" id = "usersignup">
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name = "firstname" id="firstname" class="form-control" placeholder="Your First name" autofocus="autofocus">
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name = "lastname" id="lastname" class="form-control" placeholder="Your last name" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" name = "date_of_birth" id="date_of_birth" class="form-control" placeholder="Your Date of Birth" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="institution">Name of the Institution</label>
                                <input type="text" name = "institution" id="institution" class="form-control" placeholder="Your Institution's name" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="phone">Phone / Contact</label>
                                <input type="text" name = "phone" id="phone" class="form-control" placeholder="Your contact number" autofocus="autofocus"> 
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="email">Email</label>
                                <input type="email" name = "email" id="email" class="form-control" placeholder="Your Email address" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="pass2">Please Type your password again to Confirm</label>
                                <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Password">
                                
                        </div>
                </div>
                <input class="btn btn-primary btn-block" type="submit" id="signup" name="submit" value="Sign Up">
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

                $('#usersignup').validate({
                        rules: {
                        firstname: "required",
                        lastname: "required",
                        institution: "required",
                        date_of_birth: {
                                required: true
                        },
                        pass: {
                                required: true,
                                minlength: 8
                        },
                        pass2: {
                                required: true,
                                equalTo: '#pass'
                        },
                        phone: {
                                required: true,
                                digits: true,
                                minlength: 8,
                                maxlength: 12
                        },
                        email: {
                                required: true,
                                email: true
                        }
                        },
                        // Specify validation error messages
                        messages: {
                        firstname: "Please enter Your First Name",
                        lastname: "Please enter Your last Name",
                        institution: "Please enter the name of your institution",
                        date_of_birth: "Please enter your date of birth",
                        phone: "Please enter a valid phone number",
                        email: "Please enter a valid email address",
                        pass: "Please enter a password of your choice, at least 8 characters long",
                        pass2: "Please Re-Enter the exact same password",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#signup').click(function(e) {
                        var ret = $('#usersignup').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#usersignup");
                                var formData = new FormData(formElement);
                                formData.append("mode", "signup");

                                $.ajax({
                                url: 'https://www.isical.ac.in/~integration/Controller/userdata_controller.php',
                                enctype: 'multipart/form-data',
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: "POST",
                                success: function(data) {
                                        var arr = data.split("||||");
                                        var retval = arr[arr.length - 1];
                                        
                                        if (parseInt(retval) > 0) {
                                                $.alert({
                                                title: 'Congrats!',
                                                content: 'You have sucessfully signed up! Thank you! Click OK to proceed to login page.',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/user_login.php');
                                                                }
                                                        }
                                                });
                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Looks like you have already signed up as a user. Please proceed to login page.',
                                                        buttons : {
                                                        OK: function () {
                                                                window.location.replace(RootPathHost+'/user_login.php');
                                                                },
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

