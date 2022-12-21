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
                .nav-btn {
                        position: absolute;
                        right: 30px;
                        width: 100px;
                }

                #homeBtn {
                        font-weight: bolder;
                }

                #homeBtn:hover {
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
        include_once('./Model/eventdata_model.php');
        include_once('./DAL/eventdata_dal.php');

        $dalObj = new eventdata_dal;
        $sql = 'eventid = '.$_REQUEST['eventid'];
        $eventdata = $dalObj->getDatas($sql);
        if (count($eventdata) < 1) {
            if ($_REQUEST['eventid'] == 99) {
                $eventname = 'math';
            }
            else {
                    $eventname = 'error';
            }            
        } else {
            $eventdata = reset($eventdata);
            $eventname = $eventdata->eventname;
        }
        ?>
        <div class="container">
                <div class="jumbotron-fluid p-5 m-5">
                        <i class="fa fa-5x fa-smile-o d-flex justify-content-center align-middle" aria-hidden="true"></i>
                        <h3 class="mt-3 d-flex justify-content-center">Thank you for being a part of Integration!</h3>
                        <?php 
                            if ($eventname == 'math') { ?>
                                <h5 class="mt-3 d-flex justify-content-center">We shall mail you the admit card to your registered email address once it is available.</h5>        
                         <?php   } 
                         else if ($eventname == 'error') { ?>
                                <script>
                                        window.location.replace('index.php');
                                </script>
                         <?php }
                         else { 
                                if ($eventdata->isactive) { ?>
                                        <h5 class="mt-3 d-flex justify-content-center">You have successfully registered. Please check your email to obtain the payment receipt. Please come with a copy of that payment ticket at the day of the event.</h5>        
                                <?php        }
                                else { ?>
                                        <h5 class="mt-3 d-flex justify-content-center">Please check your email for the payment receipt. To complete the registration process, please go to the event page and enter your payment reference number for verification at our end.</h5>        
                                <?php        }
                                }      
                        ?>
                        <div class="mt-5 d-flex justify-content-center">
                                <a class="btn btn-large btn-success" id="homeBtn" href="index.php">Return to Home Page</a>        
                        </div>
                </div>
        </div>
        
<?php include_once('./PartialViews/main_footer.php')?> 

<!-- page level script -->
<script>
        $(document).ready(function(){
                var RootPathHost = '<?php echo($HTTP_HOST); ?>';


        });

</script>
<!--page level script-->
</body>
</html>