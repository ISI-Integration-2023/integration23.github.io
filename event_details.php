<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php include_once('./config.php'); ?>
        <?php include_once('./PartialViews/main_head.php') ?>
        <style>
                #jumbo .text-light, #jumbo .text-primary {
                        text-shadow: 2px 2px 2px black, 5px 5px 10px black;
                }

                hr {
                        box-shadow: 2px 2px 2px black, 5px 5px 10px black;
                }

                #jumbo {
                        margin-bottom: 0.5rem !important;
                }

                #category-title {
                        font-family: 'Abril Fatface';
                        color: #fff;
                        text-shadow: 2px 2px 5px black;
                }

                .event-title {
                        font-weight: bolder;
                        font-family: "Libre Calson Text";
                        text-transform: uppercase;
                }

                @media screen and (min-width: 512px) {
                        #jumbo {
                                margin-bottom: 2rem !important; 
                        }
                }

                .error {
                        color: #ffb300;
                        font-weight: 100;
                        font-size: smaller;
                }


        </style>
</head>
<body>
        <?php 
                include_once('./DAL/eventdata_dal.php');
                $eventObj = new eventdata_dal;
                $eventname = null;
                if (isset($_REQUEST['event'])){
                                        if(!empty($_REQUEST['event'])){
                                                $eventname = $_REQUEST['event'];if($eventname=='SUM-IT'){header('Location: https://www.isical.ac.in/~integration/math.php');}
                                        }
                                }
                $eventdata = $eventObj->getAllwithCategory($eventname);
                $eventdata = $eventdata[0];

                include_once('./DAL/category_dal.php');
                $catObj = new category_dal;
                $catdata = $catObj->getDatas('categoryid = '.$eventdata->catid);
                $catdata = $catdata[0];
        ?>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h2 style="display:flex-inline; margin-right:40px;">Integration</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <div style="display:none !important;" class="my-2 my-lg-0 d-inline-flex" style="align-items: baseline; margin-bottom:1rem !important; color:white;">
                        <?php 
                        $firstname = 'Guest User';
                        if (isset($_SESSION['user_firstname'])){
                                $firstname = $_SESSION['user_firstname'];
                        }
                        ?>
                        <span class="mx-3 navbar-text">Welcome <?php echo($firstname); ?></span>
                        <?php 
                        if ($firstname == 'Guest User') {?>
                                <a class="btn rounded-pill mx-1 nav-btn" href="user_signup.php">SignUp</a>
                                <a class="btn rounded-pill mx-1 nav-btn" href="user_login.php">Login</a>
                        <?php }  else { ?>
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
                        <?php } ?>
                </div>

                </div>
        </nav>
        <!-- Navbar -->
              
        <!-- Jumbotron -->
        <div class="mt-5 jumbotron jumbotron-fluid" id="jumbo"
             style="background-image: url('./AppData/Categories/<?php echo($catdata->imagepath); ?>');
                    background-size: cover;
                    background-position: center center">
        <div class="container text-center">
                <h1 class="display-1" id="category-title"><?php echo($eventdata->catname); ?></h1>
        </div>
        </div>
        <!-- Jumbotron end -->


        <div class="row mb-5 mr-0 ml-0">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                        <img src="./AppData/Events/<?php echo($eventdata->imagepath); ?>" width = "100%" class="mx-auto mb-3 rounded">
                        <button style="display: none !important;" class="btn btn-success my-3 text-uppercase" style="width:100%" id = "paymentBtn" data-toggle="modal" data-target=".payment-modal"> Register </button>
                                <div class="modal fade payment-modal" tabindex="-1" role="dialog" aria-labelledby="Payment Instructions" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                        <h5 class="modal-title">Payment Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                        <ul>
                                                                <li class="m-3"><b>Step 1: Register Yourself: </b>If you have not yet registered for the event, then click at the button below to register for the event.</li>
                                                                <button class="btn btn-success mt-3 mb-3 text-uppercase" style="width:100%" id="registerBtn"> Register Yourself </button>
                                                                <li class="m-3"><b>Step 2: Make Payment:</b> If you have completed step 1 and registered yourself for this event, then you may proceed to make the payment for this event, at the following link.<br/>
                                                                <?php 
                                                                echo("
                                                                <script>
                                                                function getPreFilledDataTS(){
                                                                    return {
                                                                        eventcode:    '".$eventdata->fees."',
                                                                        name:         '".$_SESSION['user_firstname']."',
                                                                        emailid:      '".$_SESSION['user_email']."'
                                                                    }
                                                                }
                                                                </script>
                                                                <center>
                                                                <button onclick='popupWithAutoFill(getPreFilledDataTS());' class='mt-3 btn btn-success btn-block'>Pay Registration Fee Here</button>
                                                                </center>
                                                                <noscript id='tsNoJsMsg'>Javascript on your browser is not enabled.</noscript>
                                                                <script src='https://www.townscript.com/popup-widget/townscript-widget.nocache.js' type='text/javascript'></script>");?>
                                                                
                                                <?php if($eventdata->isactive) {?>
                                                                <li class="m-3"><b>Step 3: Save a copy of Payment Receipt:</b> If you have made payment, please save a copy of your payment receipt. This becomes your entry ticket for participation at the day of the event.</li>
                                                        </ul>
                                                        <br/><br/>
                                                        <h5>THANK YOU VERY MUCH FOR YOUR COOPERATION!</h5>
                                                </div>
                                                <?php } else { ?>
                                                                <li class="m-3"><b>Step 3: Enter your Payment Reference ID:</b> If you have made payment, please save a copy of your payment receipt. Please type in the payment reference ID in the following box for verification of your payment status at our end and click Save Changes. To verify your payment, it might take a day at our end. Once we verify the payment, you should be able to see your payment status to be approved in your registered events section.</li>
                                                        </ul>
                                                        <br/>
                                                        <form name="paymentid-form" id = "paymentid-form" action="#">
                                                                <div class="form-group">
                                                                        <div class="form-label-group">
                                                                                <label for="reg_paymentid">Your Payment Reference ID</label>
                                                                                <input type="text" name = "reg_paymentid" id="reg_paymentid" class="form-control" placeholder="Your Payment Reference ID" autofocus="autofocus">
                                                                        
                                                                        </div>
                                                                </div>
                                                                <input class="btn btn-primary" id="paymentid-btn" type="submit" name="submit" value="Save Changes">
                                                        </form>

                                                        <br/><br/>
                                                        <h5>THANK YOU VERY MUCH FOR YOUR COOPERATION!</h5>
                                                </div>
                                                <?php } ?>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                        </div>
                                </div>
                        <button style="display: none !important;" class="btn btn-success my-3 text-uppercase" style="width:100%" id="revoke-registerBtn"> Revoke Registration </button>
                        
                </div>
                <div class="col-md-7">
                        <h3 class="event-title"><?php echo($eventdata->eventname);?></h3>
                        <hr/>
                        <blockquote class="blockquote">
                                <i class="fa fa-quote-left"></i>
                                <em><?php echo($eventdata->description); ?></em>
                                <i class="fa fa-quote-right"></i>
                        </blockquote>
                      <div class="mt-5">
                                <?php echo($eventdata->cmscontent);?>
                      </div>
                      <div class="mt-5">
                                <b>CONTACTS:</b>
                                <ol>
                                <?php 
                                $headstring = $eventdata->eventhead;
                                $heads = explode(",", $headstring);
                                $len = count($heads);
                                for ($i=0; $i < $len; $i++) { ?>
                                        <li><?php echo($heads[$i]); ?></li>
                                <?php }
                                ?>
                                </ol>
                      </div>
                      
                </div>
                <div class="col-md-1"></div>
        </div>

        <!-- Contacts -->


        <?php include_once('./PartialViews/main_footer.php')?> 

<!-- page level script-->
<script>
        $(document).ready(function(){
                var RootPathHost = '<?php echo($HTTP_HOST); ?>';
                var regUser = false;
                
                <?php 
                if (isset($_SESSION['user_userid'])) { ?>
                        regUser = true;
                <?php } ?>


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

                $('#registerBtn').click(function(e){
                        e.preventDefault();
                        if (regUser) {
                                // Send an ajax request with userid and eventid and make an event registration
                                var formdata = new FormData();
                                formdata.append("reg_eventid", "<?php echo($eventdata->eventid); ?>");
                                formdata.append("reg_userid", "<?php if(isset($_SESSION['user_userid'])){ echo($_SESSION['user_userid']); } else { echo(-1); }?>");
                                formdata.append("mode", "add");

                                $.alert({
                                        title: 'Registration for <?php echo($eventdata->eventname);?>',
                                        content: 'Do you want to register for this event?',
                                        buttons: {
                                                Yes: function () {                        
                                                        $.ajax({
                                                                url: RootPathHost+'/Controller/eventregistration_controller.php',
                                                                enctype: 'multipart/form-data',
                                                                data: formdata,
                                                                processData: false,
                                                                contentType: false,
                                                                type: "POST",
                                                                success: function(data) {
                                                                        var arr = data.split("||||");
                                                                        var retval = arr[arr.length - 1];
                                                                
                                                                        if (parseInt(retval) > 0) {
                                                                                $.alert({
                                                                                title: 'Registration Successful!',
                                                                                content: 'You have sucessfully registered for event <?php echo($eventdata->eventname); ?><br/>Now, please make the appropriate payment to complete your registration.',
                                                                                buttons : {
                                                                                        OK: function () {
                                                                                                // here goes make payment code
                                                                                                },
                                                                                        Pay_Later : function () {
                                                                                                }
                                                                                        }
                                                                                });
                                                                        }
                                                                        else {
                                                                                console.log(arr);
                                                                                $.alert({
                                                                                        title: 'Error in Registration',
                                                                                        content: 'Looks like you have already registered for this event.',
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
                                                },
                                                No: function() {

                                                }
                                        }
                                });
                                
                        } 
                        else 
                        {
                                $.alert({
                                        title: 'Not Signed up yet?',
                                        content: 'Please sign up or login as a user to register for any events',
                                        buttons: {
                                                Login: function() {
                                                        window.location.replace('user_login.php');
                                                },
                                                Sign_Up :  function() {
                                                        window.location.replace('user_signup.php');
                                                },
                                                Cancel : function() {
                                                },
                                        }
                                });
                        };
                });

                $('#revoke-registerBtn').click(function(e){
                        e.preventDefault();
                        if (regUser) {
                                // Send an ajax request with userid and eventid and make an event registration
                                var formdata = new FormData();
                                formdata.append("reg_eventid", "<?php echo($eventdata->eventid); ?>");
                                formdata.append("reg_userid", "<?php if(isset($_SESSION['user_userid'])){ echo($_SESSION['user_userid']); } else { echo(-1); }?>");
                                formdata.append("mode", "delete");

                                $.alert({
                                        title: 'Registration for <?php echo($eventdata->eventname);?>',
                                        content: 'Do you want to revoke your registration for this event?',
                                        buttons: {
                                                Yes: function () {                        
                                                        $.ajax({
                                                                url: RootPathHost+'/Controller/eventregistration_controller.php',
                                                                enctype: 'multipart/form-data',
                                                                data: formdata,
                                                                processData: false,
                                                                contentType: false,
                                                                type: "POST",
                                                                success: function(data) {
                                                                        var arr = data.split("||||");
                                                                        var retval = arr[arr.length - 1];
                                                                        if (parseInt(retval) > 0) {
                                                                                $.alert({
                                                                                title: 'Revoke Registration Successful!',
                                                                                content: 'You have sucessfully unregistered for event <?php echo($eventdata->eventname); ?><br/>Please feel free to mail us any suggestion!',
                                                                                buttons : {
                                                                                        OK: function () {
                                                                                                }
                                                                                        }
                                                                                });
                                                                        }
                                                                        else {
                                                                                console.log(arr);
                                                                                $.alert({
                                                                                        title: 'Error in Revoking your Registration',
                                                                                        content: 'Looks like you have not registered for this event.',
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
                                                },
                                                No: function() {

                                                }
                                        }
                                });
                                
                        } 
                        else 
                        {
                                $.alert({
                                        title: 'Not Signed up yet?',
                                        content: 'Please sign up or login as a user!',
                                        buttons: {
                                                Login: function() {
                                                        window.location.replace('user_login.php');
                                                },
                                                Sign_Up :  function() {
                                                        window.location.replace('user_signup.php');
                                                },
                                                Cancel : function() {
                                                },
                                        }
                                });
                        };
                });

                $('#paymentid-form').validate({
                        rules: {
                                paymentid:"required"
                        },
                        messages: {
                        paymentid: "Please enter your payment reference ID"
                        },
                        submitHandler: function (form) {
                        form.submit();
                        }
                });

                $('#paymentid-btn').click(function(e){
                        if (regUser) {
                                var ret = $('#paymentid-form').valid();
                                //console.log(ret);
                                e.preventDefault();
                                if (ret) {
                                        var formElement = document.querySelector("#paymentid-form");
                                        var formdata = new FormData(formElement);

                                        formdata.append("reg_eventid", "<?php echo($eventdata->eventid); ?>");
                                        formdata.append("reg_userid", "<?php if(isset($_SESSION['user_userid'])){ echo($_SESSION['user_userid']); } else { echo(-1); }?>");
                                        formdata.append("reg_status", "PAID");
                                        formdata.append("mode","update");

                                        //for (var pair of formdata.entries())
                                         //       {
                                         //       console.log(pair[0]+ ', '+ pair[1]); 
                                          //      }

                                        $.ajax({
                                                url: RootPathHost+'/Controller/eventregistration_controller.php',
                                                enctype: 'multipart/form-data',
                                                data: formdata,
                                                processData: false,
                                                contentType: false,
                                                type: "POST",
                                                success: function(data) {
                                                        var arr = data.split("||||");
                                                        var retval = arr[arr.length - 1];
                                                        if (parseInt(retval) > 0) {
                                                                $.alert({
                                                                        title: "Changes Saved",
                                                                        content: "Your payment reference id has been saved successfully. Thank you! Your part of registration is done. Sit back and relax while we verify your payment.",
                                                                        buttons: {
                                                                                OK: function() {}
                                                                        }
                                                                });
                                                        }
                                                        else {
                                                                $.alert({
                                                                        title: "Please Register",
                                                                        content: "Please login to your account, register for the event and then make payment.",
                                                                        buttons: {
                                                                                OK: function() {}
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
                                };
                        } 
                        else 
                        {
                                $.alert({
                                        title: 'Not Signed up yet?',
                                        content: 'Please sign up or login as a user to make payment for any events',
                                        buttons: {
                                                Login: function() {
                                                        window.location.replace('user_login.php');
                                                },
                                                Sign_Up :  function() {
                                                        window.location.replace('user_signup.php');
                                                },
                                                Cancel : function() {
                                                },
                                        }
                                });
                        };
                        
                });

        });

</script>

<!-- page level script-->
        
</body>
</html>
