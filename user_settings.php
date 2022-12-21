<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php 
        include_once('./PartialViews/main_head.php');
        require_once( $ROOT_PATH.'/DAL/userdata_dal.php');
        include_once('./config.php'); 
         
        $wherecondition = 'userid = '.$_SESSION['user_userid'];
        $dalobj = new userdata_dal();
        $users = $dalobj->getDatas($wherecondition);
        $user = reset($users);
        ?> 
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

                td {
                        background: #fff;
                        color: #000;
                }
                td.text-primary {
                        color: #ffb300;
                        font-weight: bold;
                }

                .btn.btn-primary {
                        font-weight: bolder;
                }

                .btn.btn-primary:hover {
                        color: #273746;
                        background-color: #fff;
                }
                .card-header.lead {
                        font-family: "Lobster";
                }

        </style>
</head>
<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h2 style="display:flex-inline; margin-right:40px;">Integration</h2>
                </a>
                
                <ul class="navbar-nav mr-auto">
                </ul>
                <div class="my-2 my-lg-0 d-inline-flex" style="align-items: baseline;">
                        <span class="navbar-text font-weight-bold">Welcome <?php echo($_SESSION['user_firstname']); ?></span>
                        <ul class="navbar-nav ml-auto mr-md-3">
                        <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user-circle fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="user_settings.php">Settings</a>
                                        <a class="dropdown-item" href="user_events.php">Registered Events</a>
                                        <a class="dropdown-item" href="javascript:void(0);" id="logout_modal">Logout</a>
                                </div>
                        </li>
                        </ul>
                </div>
                
        </nav>


        <div class="container" style="max-width: 750px">
                <div class="row">
                        <div class="col-md-4" style="height: 400px">
                                <button id = "viewinfoBtn" class="btn btn-primary mt-5 lead text-uppercase rounded" style="width:100%; height:15%; font-family:'Merienda One';" type="button">View Your Personal Details</button>  
                                <button id = "updateinfoBtn" class="btn btn-primary mt-3 lead text-uppercase rounded" style="width:100%; height:15%; font-family:'Merienda One';" type="button">Update Personal Information</button>  
                                <button id = "updatepassBtn" class="btn btn-primary mt-3 lead text-uppercase rounded" style="width:100%; height:15%; font-family:'Merienda One';" type="button">Change your password</button>  
                                <button id = "deleteAccountBtn" class="btn btn-danger mt-3 lead text-uppercase rounded" style="width:100%; height:15%; font-family:'Merienda One';" type="button">Delete your Account</button>  
                        </div>
                        <div class="col-md-8" style="min-height: 400px">
                                <div class="collapse show" id="viewinfo">
                                <div class="card card-login mx-auto my-5 rounded">
                                        <div class="card-header lead" style="background:black;"><p class="lead">Your current Personal details</p></div>
                                        <div class="card-body" style="background: rgba(0,0,80,1);">
                                                <div class="table-responsive">
                                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                <tbody>
                                                                        <tr>
                                                                                <td class="text-primary">First Name</td>
                                                                                <td><?php echo($user->firstname);?></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td class="text-primary">Last Name</td>
                                                                                <td><?php echo($user->lastname);?></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td class="text-primary">Your Date of Birth<br/> (YYYY-MM-DD)</td>
                                                                                <td><?php echo($user->date_of_birth);?></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td class="text-primary">Name of the Institution</td>
                                                                                <td><?php echo($user->institution);?></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td class="text-primary">Your Phone Number</td>
                                                                                <td><?php echo($user->phone);?></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td class="text-primary">Your Email Address</td>
                                                                                <td><?php echo($user->email);?></td>
                                                                        </tr>
                                                                </tbody>
                                                        </table>
                                                </div>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="collapse" id="updateinfo">
                                <div class="card card-login mx-auto my-5 rounded">
                                        <div class="card-header lead" style="background:black;"><p class="lead">Update your Personal details</p></div>
                                        <div class="card-body" style="background: rgba(0,0,80,1);">
                                                <!-- Login Form -->
                                                <form action="#" id = "userupdate_info">
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <input type="hidden" name = "userid1" id="userid1" class="form-control" value = "<?php echo($_SESSION['user_userid']);?>">
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="institution">Name of the Institution</label>
                                                                        <input type="text" name = "institution" id="institution" class="form-control" placeholder="Your Institution's name" autofocus="autofocus" value="<?php echo($user->institution);?>">  
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="phone">Phone / Contact</label>
                                                                        <input type="text" name = "phone" id="phone" class="form-control" placeholder="Your contact number" autofocus="autofocus" value="<?php echo($user->phone);?>"> 
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="email">Email</label>
                                                                        <input type="email" name = "email" id="email" class="form-control" placeholder="Your Email address" autofocus="autofocus" value="<?php echo($user->email);?>">
                                                                        
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="oldpass">Please type your Password to Confirm</label>
                                                                        <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Password">
                                                                        
                                                                </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-block" type="update_info_submit" id="update_info_submit" name="update_info_submit">Update Details</button>
                                                </form>
                                                <!-- Login Form -->
                                        </div>
                                </div>
                                </div>
                                
                                <div class="collapse" id="updatepass">
                                <div class="card card-login mx-auto my-5 rounded">
                                        <div class="card-header lead" style="background:black;"><p class="lead">Create a new password</p></div>
                                        <div class="card-body" style="background: rgba(0,0,80,1);">
                                                <!-- Login Form -->
                                                <form action="#" id = "userupdate_pass">
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <input type="hidden" name = "userid2" id="userid2" class="form-control" value = "<?php echo($_SESSION['user_userid']);?>">
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="oldpass">Please type your old Password to Confirm</label>
                                                                        <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Password">                                                               
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="newpass">Please type your new Password</label>
                                                                        <input type="password" name="newpass" id="newpass" class="form-control" placeholder="Password">                                                               
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="newpass2">Please Retype your new Password to Confirm</label>
                                                                        <input type="password" name="newpass2" id="newpass2" class="form-control" placeholder="Password">                                                               
                                                                </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-block" type="update_pass_submit" id="update_pass_submit" name="update_pass_submit">Update Password</button>
                                                </form>
                                                <!-- Login Form -->
                                        </div>
                                </div>
                                </div>

                                <div class="collapse" id="deleteAccount">
                                <div class="card card-login mx-auto my-5 rounded">
                                        <div class="card-header lead" style="background: rgba(0,0,0,1);" ><p class="lead text-danger">Do you really want to Delete your account?</p></div>
                                        <div class="card-body" style="background: rgba(0,0,80,1);">
                                                <!-- Login Form -->
                                                <form action="#" id = "userdelete_form">
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <input type="hidden" name = "userid" id="userid" class="form-control" value = "<?php echo($_SESSION['user_userid']);?>">
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <div class="form-label-group">
                                                                        <label for="pass">Please type your Password to Confirm</label>
                                                                        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">                                                               
                                                                </div>
                                                        </div>
                                                        <button class="btn btn-primary btn-block" type="delete_account_submit" id="delete_account_submit" name="delete_account_submit">Delete your Account</button>
                                                </form>
                                                <!-- Login Form -->
                                        </div>
                                </div>
                                </div>
                        </div>
                </div>
                <div class="jumbotron mx-5 py-3 mt-5">
                        <p class="lead small text-muted"><em style="color: red;">*</em>To update other details such as your first name, last name or date of birth, please contact the administrative department of Integration, with proper proof of such changes!</p>
                </div>
        </div>


<?php include_once('./PartialViews/main_footer.php'); ?> 

<!-- page level script -->
<script>
        $(document).ready(function(){
                $('#logout_modal').click(function(e) {
                                $.alert({
                                        title: 'Are you sure?',
                                        content: 'Do you really want to log out?',
                                        buttons : {
                                                Yes : function () {
                                                                window.location.replace('user_logout.php');
                                                        },
                                                No : function() {
                                                        }
                                                }
                                        });
                });

                $('#viewinfoBtn').click(function() {
                        $('#viewinfo').addClass("show");
                        $('#updateinfo').removeClass("show");
                        $('#updatepass').removeClass("show");
                        $('#deleteAccount').removeClass("show");
                });

                $('#updateinfoBtn').click(function() {
                        $('#viewinfo').removeClass("show");
                        $('#updateinfo').addClass("show");
                        $('#updatepass').removeClass("show");
                        $('#deleteAccount').removeClass("show");
                }); 

                $('#updatepassBtn').click(function() {
                        $('#viewinfo').removeClass("show");
                        $('#updatepass').addClass("show");
                        $('#updateinfo').removeClass("show");
                        $('#deleteAccount').removeClass("show");
                }); 

                $('#deleteAccountBtn').click(function() {
                        $('#viewinfo').removeClass("show");
                        $('#updatepass').removeClass("show");
                        $('#updateinfo').removeClass("show");
                        $('#deleteAccount').addClass("show");
                });


                var RootPathHost = '<?php echo($HTTP_HOST); ?>';

                // Update Information Form
                $('#userupdate_info').validate({
                        rules: {
                        institution: "required",
                        oldpass: "required",
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
                        institution: "Please enter the name of your institution",
                        phone: "Please enter a valid phone number",
                        email: "Please enter a valid email address",
                        pass: "Please enter a your existing password",
                        pass2: "Please Re-Enter the exact same password",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#update_info_submit').click(function(e) {
                        var ret = $('#userupdate_info').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#userupdate_info");
                                var formData = new FormData(formElement);
                                formData.append("mode", "update");

                                $.ajax({
                                url: RootPathHost+'/Controller/userdata_controller.php',
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
                                                title: 'Updation Successful!',
                                                content: 'You have sucessfully updated your personal informations...',
                                                buttons : {
                                                        OK: function () {
                                                                }
                                                        }
                                                });
                                        }
                                        else {
                                                $.alert({
                                                        title: 'Wrong password!',
                                                        content: 'Looks like you typed your password wrong.',
                                                        buttons : {
                                                                OK: function() {
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
                                                                }
                                                        }
                                        });
                                }
                                });
                        }

                });

                // Update Password Form
                $('#userupdate_pass').validate({
                        rules: {
                        oldpass: "required",
                        newpass: {
                                required: true,
                                minlength: 8
                        },
                        newpass2: {
                                required: true,
                                equalTo: '#newpass'
                        },
                        },
                        // Specify validation error messages
                        messages: {
                        oldpass: "Please enter your existing password",
                        newpass: "Please enter a new password of your choice, at least 8 characters long",
                        newpass2: "Please Re-Enter the new password again",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#update_pass_submit').click(function(e) {
                        var ret = $('#userupdate_pass').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#userupdate_pass");
                                var formData = new FormData(formElement);
                                formData.append("mode", "update");

                                $.ajax({
                                url: RootPathHost+'/Controller/userdata_controller.php',
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
                                                title: 'Updation Successful!',
                                                content: 'You have sucessfully updated your personal informations...',
                                                buttons : {
                                                        OK: function () {
                                                                }
                                                        }
                                                });
                                        }
                                        else {
                                                $.alert({
                                                        title: 'Wrong password!',
                                                        content: 'Looks like you typed your password wrong.',
                                                        buttons : {
                                                                OK: function() {
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
                                                               }
                                                        }
                                        });
                                }
                                });
                        }

                });

                // Delete Account form
                $('#userdelete_form').validate({
                        rules: {
                                pass: "required",
                        },
                        messages: {
                                pass: "Please type your password to continue",
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#delete_account_submit').click(function(e) {
                        var ret = $('#userdelete_form').valid();
                        //console.log(ret);
                        e.preventDefault();
                        if (ret) {
                                var formElement = document.querySelector("#userdelete_form");
                                var formData = new FormData(formElement);
                                formData.append("mode", "delete");

                                $.ajax({
                                url: RootPathHost+'/Controller/userdata_controller.php',
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
                                                title: 'Deletion Successful!',
                                                content: 'You have sucessfully deleted your account. We hope you to sign up again!',
                                                buttons : {
                                                        OK: function () {
                                                                     window.location.replace('user_logout.php');   
                                                                }
                                                        }
                                                });
                                        }
                                        else {
                                                $.alert({
                                                        title: 'Wrong password!',
                                                        content: 'Looks like you typed your password wrong.',
                                                        buttons : {
                                                                OK: function() {
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

