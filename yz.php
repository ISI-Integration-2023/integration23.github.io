<?php 
//ob_start();
session_start();
if(!isset($_SESSION['ide'])){header('Location: https://www.isical.ac.in/~integration/generate_admit.php');}
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
        include_once('./DAL/mathdata_dal_offline.php');
        include_once('./Model/mathdata_model_offline.php');
        //include_once('./Model/mathdata_model.php');
//echo 1111;
        if(isset($_SESSION['ide'])) {
                $id = $_SESSION['ide'];//echo $id;echo $_SESSION['pay'];
                $dalObj = new mathdata_dal_offline();        	//echo 12345;
                $query = 'studentid = '.$id;
                $userdata = $dalObj->getDatasForAdmit($query);
                $userdata = reset($userdata);        
        } else {
	header('Location: https://www.isical.ac.in/~integration/generate_admit_offline.php');
	//$userdata = new userdata_model;
        }
        //echo 2222;
        ?>

        <div class="container" style="max-width:600px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;">
                                <p style="font-family: 'Lobster';">Verify registration for <span style="font-family: 'Abril Fatface';">SUM-IT Exam</span></p>
                                <p style="font-family: 'Abril Fatface';">(For offline registrations only)</p>
                                
                        </div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form action="#" id = "math-update">
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="firstname">Name</label>
                                <input type="text" name = "name" id="name" class="form-control" value = "<?php echo($userdata->name);?>" placeholder="Your name" autofocus="autofocus">
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
                                <input type="text" name = "phone1" id="phone1" class="form-control" value = "<?php echo($userdata->phone1);?>" placeholder="Your contact number" autofocus="autofocus"> 
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="phone2">Alternative Phone</label>
                                <input type="text" name = "phone2" id="phone2" class="form-control" placeholder="Your contact number" autofocus="autofocus" value = "<?php echo($userdata->phone2);?>"> 
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
                        <label for="student_class">Select Category (Cannot be modified)</label>
                                <select  class="form-control" id="student_class" name="student_class" autofocus="autofocus">
                                        <!--option disabled selected>Choose...</option>
                                        <option value="9">Class IX</option>
                                        <option value="11"> Class XI</option-->
					<option selected value="<?php echo ($userdata->student_class=='9')?'Class IX':'Class XI';?>"><?php echo ($userdata->student_class=='9')?'Class IX':'Class XI';?></option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="medium">Preferred Medium</label>
                                <select class="form-control" id="medium" name="medium" autofocus="autofocus">
                                        <!--<option disabled>Choose...</option>-->
					<option disabled <?php echo($userdata->medium=='Choose...')?'Selected':'';?>" value="Choose...">Choose...</option>
                                        <option <?php echo($userdata->medium=='English')?'Selected':'';?> value="English">English</option>
                                        <option <?php echo($userdata->medium=='Bengali')?'Selected':'';?> value="Bengali"> Bengali </option>
                                </select>
                        </div>
                </div>

                <div class="form-group">
                        <div class="form-label-group">
                        <label for="exam_zone">Preferred Exam Zone (Cannot be modified)</label>
                                <select class="form-control" id="exam_zone" name="exam_zone" autofocus="autofocus">
                                        <!--option disabled selected>Choose...</option>
                                        <option value="Kolkata-N">Kolkata (North)</option>
                                        <option value="Kolkata-C">Kolkata (Central)</option>
                                        <option value="Kolkata-S">Kolkata (South)</option>
                                        <option value="Durgapur">Durgapur</option-->
					<option selected value="<?php echo $userdata->exam_zone;?>"><?php echo $userdata->exam_zone;?></option>
                                </select>
                        </div>
                </div>

                <!--div class="form-group">
                        <div class="form-label-group">
                        <label for="book">Do you want Mathlab Book?</label>
                                <select class="form-control" id="book" name="book" autofocus="autofocus">
                                        <option disabled selected>Choose...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No"> No </option>
                                </select>
                        </div>
                </div-->

                <!--div class="form-group">
                        <div class="form-label-group">
                                <label for="guard_name">Guardian's Name</label>
                                <input type="text" name = "guard_name" id="guard_name" class="form-control" placeholder="Name of the Guardian of the student" autofocus="autofocus">                                
                        </div>
                </div-->

                <!--div class="form-group">
                        <div class="form-label-group">
                                <label for="address">Your Postal Address</label>
                                <textarea name = "address" id="address" class="form-control" placeholder="Address of the student" autofocus="autofocus"></textarea>                     
                        </div>
                </div-->


                
                
                <input class="btn btn-primary btn-block" type="submit" id="update" name="submit" value="Update and Proceed">
                </form>
        <!-- Login Form -->
                        </div>
                </div>
        </div>
<?php include_once('./PartialViews/main_footer.php')?> 

<!-- page level script -->
<script>
$.alert({
	title: 'Attention!',
	content: 'Please check all the details and do all necessary modifications.\nHowever, you cannot change your class and zone. To modify these fields, please contact the organizers.',
	buttons:{
		OK:function(){
			
		}
	}
});
</script>
<script>
        $(document).ready(function(){
                var RootPathHost = '<?php echo($HTTP_HOST); ?>';

                $('#math-update').validate({
                        rules: {
                        name: "required",
                        institution: "required",
                        date_of_birth: {
                                required: true
                        },
                        phone1: {
                                required: true,
                                digits: true,
                                minlength: 6,
                                maxlength: 12
                        },
                        phone2: {
                                required: true,
                                digits: true,
                                minlength: 6,
                                maxlength: 12
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        student_class: "required",
                        medium: "required",
                        //book: "required",
                        exam_zone: "required",
                        //guard_name: "required",
                        //address: "required"
                        },
                        // Specify validation error messages
                        messages: {
                        name: "Please enter Your First Name",
                        institution: "Please enter the name of your institution",
                        date_of_birth: "Please enter your correct date of birth",
                        phone1: "Please enter a valid phone number",
                        phone2: "Please enter a valid phone number",
                        email: "Please enter a valid email address",
                        student_class: "Please enter the class of the student",
                        medium: "Please enter the preferred medium",
                        //book: "Please enter whether you want the problem primer",
                        exam_zone: "Please enter the preferred exam zone",
                        //guard_name: "Please enter the name of the guardian of the student",
                        //address: "Please enter the postal address of the student"
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#update').click(function(e) {
                        var ret = $('#math-update').valid();
                        //console.log(ret);
                        e.preventDefault();
			$.alert({
				title:'Attention!',
				content:'You cannot change details after this submission. Do you want to submit now?',
				buttons:{
					YES:function(){
					if (ret) {
                                		var formElement = document.querySelector("#math-update");
                                		var formData = new FormData(formElement);
                                		formData.append("mode", "update");

                                		$.ajax({
                                			url: RootPathHost+'/Controller/mathdata_controller3.php',
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
                                	                		title: 'Thank You!',
                                	                		content: 'You have sucessfully verified your registration! Please proceed to download admit card now.',
                                	                		buttons : {
                                	                        	PROCEED: function () {
                                                                        	window.location.replace(RootPathHost+'/generate_admit_offline.php');
                                                                		}
                                                        		}
                                                });
                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Something is wrong! Please try again after a while.',
                                                        buttons : {

                                                        	OK: function () {
                                                                        window.location.replace(RootPathHost+'/math.php');
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
                                                                        window.location.replace(RootPathHost+'/math.php');
                                                                }
                                                        }
                                        });

                                }
                                });
						}},
					NO:function(){}
				}
			});
			});
			});
                        /*if (ret) {
                                var formElement = document.querySelector("#math-update");
                                var formData = new FormData(formElement);
                                formData.append("mode", "update");

                                $.ajax({
                                url: RootPathHost+'/Controller/mathdata_controller2.php',
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
                                                title: 'Thank You!',
                                                content: 'You have sucessfully verified your registration! Please proceed to download admit card now.',
                                                buttons : {
                                                        PROCEED: function () {
                                                                        window.location.replace(RootPathHost+'/generate_admit.php');
                                                                },

                                                        }
                                                });
                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Something is wrong! Please try again after a while.',
                                                        buttons : {
                                                        	OK: function () {
                                                                        window.location.replace(RootPathHost+'/math.php');
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
                                                                        window.location.replace(RootPathHost+'/math_register.php');
                                                                }
                                                        }
                                        });
                                }
                                });
                        }

                });*/
        //});

</script>
<!--page level script-->
</body>
</html>

