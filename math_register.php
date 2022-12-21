<?php 
header('Location: https://www.isical.ac.in/~integration/under_closed.html');
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php include_once('./PartialViews/main_head.php') ?>
        <?php include_once('./config.php'); ?>
        <style>
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

        <div class="container" style="max-width:600px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;">
                                <p style="font-family: 'Lobster';">Register for <span style="font-family: 'Abril Fatface';">SUM-IT Exam</span></p>
                                
                        </div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form action="#" id = "math-register">
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name = "firstname" id="firstname" class="form-control" value = "<?php echo($userdata->firstname);?>" placeholder="Your First name" autofocus="autofocus">
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name = "lastname" id="lastname" class="form-control" value = "<?php echo($userdata->lastname);?>" placeholder="Your last name" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" name = "date_of_birth" id="date_of_birth" class="form-control" value = "<?php echo($userdata->date_of_birth);?>" placeholder="Your Date of Birth" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="institution">Name of the Institution</label>
                                <input type="text" name = "institution" id="institution" class="form-control" value = "<?php echo($userdata->institution);?>" placeholder="Your Institution's name" autofocus="autofocus">
                                
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="phone1">Phone / Contact</label>
                                <input type="text" name = "phone1" id="phone1" class="form-control" value = "<?php echo($userdata->phone);?>" placeholder="Your contact number" autofocus="autofocus"> 
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="phone2">Alternative Phone</label>
                                <input type="text" name = "phone2" id="phone2" class="form-control" placeholder="Your contact number" autofocus="autofocus"> 
                        </div>
                </div>
                
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="email">Email</label>
                                <input type="email" name = "email" id="email" class="form-control" value = "<?php echo($userdata->email);?>" placeholder="Your Email address" autofocus="autofocus">
                                
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="student_class">Select Category</label>
                                <select class="form-control" id="student_class" name="student_class" autofocus="autofocus">
                                        <option disabled selected>Choose...</option>
                                        <option value="9">Class IX</option>
                                        <option value="11"> Class XI</option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="medium">Preferred Medium</label>
                                <select class="form-control" id="medium" name="medium" autofocus="autofocus">
                                        <option disabled selected>Choose...</option>
                                        <option value="English">English</option>
                                        <option value="Bengali"> Bengali </option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="exam_zone">Preferred Exam Zone</label>
                                <select class="form-control" id="exam_zone" name="exam_zone" autofocus="autofocus">
                                        <option disabled selected>Choose...</option>
                                        <option value="Kolkata-N">Kolkata (North)</option>
                                        <option value="Kolkata-C">Kolkata (Central)</option>
                                        <option value="Kolkata-S">Kolkata (South)</option>
                                        <option value="Durgapur">Durgapur</option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="book">Do you want Mathlab Book?</label>
                                <select class="form-control" id="book" name="book" autofocus="autofocus">
                                        <option disabled selected>Choose...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No"> No </option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                                <label for="guard_name">Guardian's Name</label>
                                <input type="text" name = "guard_name" id="guard_name" class="form-control" placeholder="Name of the Guardian of the student" autofocus="autofocus">                                
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                                <label for="address">Your Postal Address</label>
                                <textarea name = "address" id="address" class="form-control" placeholder="Address of the student" autofocus="autofocus"></textarea>                     
                        </div>
                </div>


                
                
                <input class="btn btn-primary btn-block" type="submit" id="register" name="submit" value="Register for the Exam">
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

                $('#math-register').validate({
                        rules: {
                        firstname: "required",
                        lastname: "required",
                        institution: "required",
                        date_of_birth: {
                                required: true
                        },
                        phone1: {
                                required: true,
                                digits: true,
                                minlength: 8,
                                maxlength: 12
                        },
                        phone2: {
                                required: true,
                                digits: true,
                                minlength: 8,
                                maxlength: 12
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        student_class: "required",
                        medium: "required",
                        book: "required",
                        exam_zone: "required",
                        guard_name: "required",
                        address: "required"
                        },
                        // Specify validation error messages
                        messages: {
                        firstname: "Please enter Your First Name",
                        lastname: "Please enter Your last Name",
                        institution: "Please enter the name of your institution",
                        date_of_birth: "Please enter your correct date of birth",
                        phone1: "Please enter a valid phone number",
                        phone2: "Please enter a valid phone number",
                        email: "Please enter a valid email address",
                        student_class: "Please enter the class of the student",
                        medium: "Please enter the preferred medium",
                        book: "Please enter whether you want the problem primer",
                        exam_zone: "Please enter the preferred exam zone",
                        guard_name: "Please enter the name of the guardian of the student",
                        address: "Please enter the postal address of the student"
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#register').click(function(e) {
                        var ret = $('#math-register').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#math-register");
                                var formData = new FormData(formElement);
                                formData.append("mode", "register");

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
                                                $.alert({
                                                title: 'Congrats!',
                                                content: 'You have sucessfully registered for the exam! Thank you! Please proceed to payment now.',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/math_payment.php');
                                                                },
							Pay_Later : function() {}

                                                        }
                                                });
                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Looks like you have already registered for the exam. Please proceed to payment now.',
                                                        buttons : {
                                                        	OK: function () {
                                                                        window.location.replace(RootPathHost+'/math_payment.php');
                                                                },
								Pay_Later : function() {}

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
                                                                        window.location.replace(RootPathHost+'/math_register.php');
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

