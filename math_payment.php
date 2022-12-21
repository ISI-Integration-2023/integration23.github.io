<?php 
ob_start();
session_start(); 
header('Location: https://www.isical.ac.in/~integration/under_closed.html');
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
                        background-image: url('./AppData/Images/math-cover.jpg');
                        background-blend-mode: overlay;
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

</head>
<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h3 style="display:flex-inline; margin-right:40px;">Integration</h3>
                </a>
                
        </nav>

        <?php 
        include_once('./Model/userdata_model.php');
        include_once('./DAL/userdata_dal.php');

        if(isset($_SESSION['user_userid'])) {
                $userid = $_SESSION['user_userid'];
                $dalObj = new userdata_dal;
                $query = 'userid = '.$userid;
                $userdata = $dalObj->getDatas($query);
                $userdata = reset($userdata);        
        } else {
                $userdata = new userdata_model;
        }
        ?>

        <div class="container" style="max-width:500px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;">
                        <p style="font-family: 'Lobster';">Pay Registration Fees for <span style="font-family: 'Abril Fatface';">SUM-IT Exam</span></p>
                        </div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form name="math_pay" id = "math_pay" action="#">
                <div class="form-group">
                        <div class="form-label-group">
                                 <label for="email">Your Registered Email Address</label>
                                <input type="text" name = "email" id="email" class="form-control" value = "<?php echo($userdata->email);?>" placeholder="Email Address" autofocus="autofocus">
                               
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" name = "date_of_birth" id="date_of_birth" class="form-control" value = "<?php echo($userdata->date_of_birth);?>" placeholder="Your Date of Birth" autofocus="autofocus">
                                
                        </div>
                </div>


                <input class="btn btn-primary btn-block" id="pay_btn" type="submit" name="submit" value="Proceed to Pay">
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

                $('#math_pay').validate({
                        rules: {
                        date_of_birth: {
                                required: true
                        },
                        email: {
                                required: true,
                                email: true
                        }
                        },
                        // Specify validation error messages
                        messages: {
                        date_of_birth: "Please enter your correct date of birth",
                        email: "Please enter a valid email address",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#pay_btn').click(function(e) {
                        var ret = $('#math_pay').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#math_pay");
                                var formData = new FormData(formElement);
                                formData.append("mode", "pay");

                                $.ajax({
                                url: RootPathHost+'/Controller/mathdata_controller.php',
                                enctype: 'multipart/form-data',
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: "POST",
                                success: function(data) {
                                        var arr = data.split("||||");
                                        var retval = arr[arr.length - 1];
                                        
                                        if (parseInt(retval) > 0) {
                                            if (parseInt(retval) == 1) {
                                                window.location.replace('https://www.townscript.com/e/sumit-2020-class-ix-registration/booking');
                                            }
                                            else if (parseInt(retval) == 2) {
                                                window.location.replace('https://www.townscript.com/e/sumit-2020-class-ix-registration-book/booking');
                                            }
                                            else if (parseInt(retval) == 3) {
                                                window.location.replace('https://www.townscript.com/e/sumit-2020-class-xi-registration/booking');
                                            }
                                            else if (parseInt(retval) == 4) {
                                                window.location.replace('https://www.townscript.com/e/sumit-2020-class-xi-registration-book/booking');
                                            }

                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Looks like you have not registered for the exam. Please click ok to register for the exam first.',
                                                        buttons : {
                                                        OK: function () {
                                                                window.location.replace(RootPathHost+'/math_register.php');
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
                                                                        window.location.replace(RootPathHost+'/math_payment.php');
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
