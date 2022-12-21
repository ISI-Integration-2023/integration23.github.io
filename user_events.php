<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php 
        include_once('./config.php');
        include_once('./PartialViews/main_head.php');
        require_once('./Model/eventregistration_model.php');
        require_once('./DAL/eventregistration_dal.php');
        ?>
        
</head>

<body>

<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h2 style="display:flex-inline; margin-right:40px;">Integration</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="my-2 my-lg-0 d-inline-flex" style="align-items: baseline;">
                        <?php 
                        $firstname = 'Guest User';
                        if (isset($_SESSION['user_firstname'])){
                                $firstname = $_SESSION['user_firstname'];
                        }
                        ?>
                        <span class="navbar-text font-weight-bold">Welcome <?php echo($firstname); ?></span>
                        <?php 
                        if ($firstname == 'Guest User') {?>
                                <a class="btn btn-<?php echo($settings['navbar-btn']);?> text-light mx-3" href="user_signup.php">Signup</a>
                                <a class="btn btn-<?php echo($settings['navbar-btn']);?> text-light mx-3" href="user_login.php">Login</a>
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

<div class="container-fluid" style="min-height:80vh;">
        <h2 class = "pt-5 ml-5 text-white" style="font-family: 'Abril Fatface';">Welcome <?php echo($firstname); ?>,</h2>
        <h3 class="mb-5 ml-5 text-white" style="font-family: 'Abril Fatface';">here you go with your registered events...</h3>
        <?php 
                $nEvents = 0;
                if (isset($_SESSION['user_userid'])) {
                        $userid = $_SESSION['user_userid'];
                        $eventRegDal = new eventregistration_dal;
                        
                        $eventRegArr = $eventRegDal->getUserEvents($userid);
                        $nEvents = count($eventRegArr);

                        //var_dump($eventRegArr);
                }
        ?>
        
        <?php if ($nEvents > 0) { ?>
                <div class="card bg-white">
                        <div class="card-header text-dark" style="background: #000; color:#fff !important; font-family:'Lobster';">
                                List of Events You have Registered for...
                        </div>
                        <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                                                        cellspacing="0">
                                                <thead class="text-primary font-weight-bold">
                                                <tr>
                                                        <td>Registration ID</td>
                                                        <td>Event Name</td>
                                                        <td>Payment Reference ID</td>
                                                        <td>Approval Status</td>
                                                        <td>Date & Time</td>
                                                        <td>Person to Contact</td>               
                                                </tr>
                                                </thead>
                                                <tbody style="color: black;">
                                                        <?php foreach ($eventRegArr as $eventReg) { ?>
                                                                <tr>
                                                                        <td><?php echo($eventReg->userregid);?></td>
                                                                        <td><?php echo($eventReg->eventname);?></td>
                                                                        <td><?php echo($eventReg->paymentid); ?></td>
                                                                        <td><?php echo($eventReg->status);?>
                                                                                <?php if ($eventReg->status == "PENDING") { ?>
                                                                                      <br/>Please make the payment <a href="./event_details.php?event=<?php echo($eventReg->eventname);?>">here</a>
                                                                                      <br/>Ignore if already paid. 
                                                                                      <br/><b>Note that for Offline event, please come with Payment Receipt.
                                                                                      <br/>For Online event, please enter your Payment Receipt ID for verification in the above link.</b>
                                                                                <?php }; ?>
                                                                        </td>
                                                                        <td><?php echo($eventReg->timevenue);?></td>
                                                                        <td>
                                                                                <?php echo(explode(',',$eventReg->eventhead)[0]); ?>
                                                                        </td>
                                                                </tr>
                                                        <?php } ?>
                                                </tbody>
                                        </table>
                                </div>
                        </div>
                        <!-- dynamic section end -->
                        <div class="card-footer small text-muted">Thank you for your participation!</div>
                </div>
        <?php } 
        else { ?>
                <div class="jumbotron-fluid p-5">
                        <i class="fa fa-5x fa-frown-o d-flex justify-content-center align-middle" aria-hidden="true"></i>
                        <h3 class="mt-3 d-flex justify-content-center">Looks like you are not registered for any event!</h3>
                        <div class="mt-5 d-flex justify-content-center">
                                <a class="btn btn-secondary" href="index.php">Return to Home Page</a>        
                        </div>
                </div>
        <?php } ?>

</div>
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

        });
        
</script>

<?php include_once('./PartialViews/main_footer.php')?> 
</body>
</html>