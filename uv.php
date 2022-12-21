<?php 
ob_start();
session_start(); 
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

        /*if(isset($_SESSION['user_userid'])) {
                $userid = $_SESSION['user_userid'];
                $dalObj = new userdata_dal;
                $query = 'userid = '.$userid;
                $userdata = $dalObj->getDatas($query);
                $userdata = reset($userdata);        
        } else {
                $userdata = new userdata_model;
        }*/
        ?>

        <div class="container" style="max-width:500px">
                <div class="card card-login mx-auto my-5 rounded">
                        <div class="card-header lead" style="background:black;">
                        <p style="font-family: 'Lobster';">Download admit for <span style="font-family: 'Abril Fatface';">SUM-IT Exam</span></p>
                        <p style="font-family: 'Abril Fatface';">(For offline registrations only)</p>
                        </div>
                        <div class="card-body" style="background: rgba(0,0,80,1);">
        <!-- Login Form -->
                <form name="math_adm" id = "math_adm" action="#">
                <div class="form-group">
                        <div class="form-label-group">
                                 <label for="email">Registered Email Address/ Mobile Number</label>
                                <input type="text" name = "contact" id="contact" class="form-control" placeholder="Email Address or Mobile Number" autofocus="autofocus">
                               
                        </div>
                </div>
                <div class="form-group">
                        <div class="form-label-group">
                                <label for="date_of_birth">Date Of Birth</label>
                                <input type="date" name = "date_of_birth" id="date_of_birth" class="form-control" value = "<?php echo($userdata->date_of_birth);?>" placeholder="Your Date of Birth" autofocus="autofocus">
                                
                        </div>
                </div>


                <input class="btn btn-primary btn-block" id="adm_btn" type="submit" name="submit" value="Proceed to Download">
                </form>
        <!-- Login Form -->
                        </div>
                </div>
        </div>
<?php include_once('./PartialViews/main_footer.php')?> 

<!-- page level script -->
<script>
	var variable=0;
        $(document).ready(function(){
                var RootPathHost = '<?php echo($HTTP_HOST); ?>';

                $('#math_adm').validate({
                        rules: {
                        date_of_birth: {
                                required: true
                        },
                        contact: {
                                required: true
                                //email: true
                        }
                        },
                        // Specify validation error messages
                        messages: {
                        date_of_birth: "Please enter your correct date of birth",
                        contact: "Please enter email address or mobile number",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#adm_btn').click(function(e) {
                        var ret = $('#math_adm').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#math_adm");
                                var formData = new FormData(formElement);
                                formData.append("mode", "admit");
				console.log(formData);//////////////
                                $.ajax({
                                url: RootPathHost+'/Controller/mathdata_controller3.php',
                                enctype: 'multipart/form-data',
                                data: formData,
                                processData: false,
                                contentType: false,
                                type: "POST",
                                success: function(data) {
                                        var arr = data.split("||||");variable=data;
                                        var retval = arr[arr.length - 1];
                                        
                                        if (parseInt(retval) > 0) {
						if(parseInt(retval)==1){
							window.location.replace(RootPathHost+'/generate_admit_offline.php');
							//console.log(retval);console.log(arr);
						}else if(parseInt(retval)==3){
							window.location.replace(RootPathHost+'/yz.php');
						}else{
							$.alert({
                                                        title: 'Error',
                                                        content: 'Looks like there is a technical problem. Please contact the organizers!',
                                                        buttons : {
                                                        	OK:function () {
                                                                        window.location.replace(RootPathHost+'/math.php');
                                                                }
                                                        }
                                                });
						}
                                        } else {
                                                $.alert({
                                                        title: 'Error',
                                                        content: 'Looks like you have not registered for the exam. Please click ok to register for the exam first. If you have already made the payment, please wait one day after making the payment and try again. If the problem still persists, contact the organizers.',
                                                        buttons : {
                                                        OK: function () {
                                                                window.location.replace(RootPathHost+'/math_register.php');
								//window.location.replace(RootPathHost+'/Utility/mathdata_controller2.php');
                                                                },
                                                        }
                                                });
                                        }

                                },
                                error: function(data) {
                                        $.alert({
                                                title: 'Error',
                                                content: 'Looks like there is a technical problem. Please contact the oranizers!',
                                                buttons : {
                                                        OK: function () {
                                                                        window.location.replace(RootPathHost+'/math.php');
									//window.location.replace(RootPathHost+'/Controller/mathdata_controller2.php');
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
