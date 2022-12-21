<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php include_once('./PartialViews/main_head.php') ?>
        
        <!-- Custom Style sheets for this page -->
        <link rel="stylesheet" href="./assets/css/main.css?v=<?php echo(rand());?>">
        <link rel="stylesheet" href="./assets/nivo-slider/nivo-slider.css?v=<?php echo(rand());?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="./assets/nivo-slider/nivo-slider-theme.css?v=<?php echo(rand());?>" type="text/css" media="screen" />
</head>
<body>
        <div id="preloader"></div>
        
        <div> <!-- container type div-->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
                <a class="navbar-brand d-flex" style="align-items:baseline;" href="index.php">
                        <img src="./AppData/Images/Integration_logo.png" width="30px" style="display:flex-inline; margin-right:15px;">
                        <h3 style="display:flex-inline; margin-right:40px;">Integration</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                        <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#events">Events</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#showdowns">Showdowns</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#team">Our Team</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#sponsors">Our Partners</a>
                </li>
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
        
        <!-- Nivo Slider Carousels -->
        <section id="home">
                <div class="slider-wrapper">
                        <div id="slider" class="nivoSlider" style="max-height: 90vh;">
                                <?php
                                $dir = "./AppData/Images/carousels/";
                                // Open a directory, and read its contents
                                if (is_dir($dir)){
                                        if ($dh = opendir($dir)){
                                                while (($file = readdir($dh)) !== false){
                                                        $path_info = pathinfo($file);
                                                        if ($path_info['extension'] == 'jpg') {
                                                        ?>
                                                                <img src="./AppData/Images/carousels/<?php echo($file); ?>" 
                                                                data-thumb="./AppData/Images/carousels/<?php echo($file); ?>" alt="" title=""
                                                                class = "slider-images" />
                                                        <?php } }
                                                }
                                }  ?>
                        </div>
                </div>
                <div class="slider-content lg-viewer">
                        <div class="row text-center">
                                <div class="col-md-8 mx-auto">
                                        <h1 class="display-2 main-heading">INTEGRATION <?php echo date("Y", strtotime('+6 months')); ?></h1>
                                        <h3 class="mt-5 main-heading" style="font-family: 'Merienda'; ">
                                                The Annual Techno Cultural Sports Festival of the students of Indian Statistical Institute, Kolkata
                                        </h3>
                                        <div class="d-flex justify-content-center">
                                                <a href="#about" class="btn btn-primary rounded-pill btn-type-1">See More About Us</a>
                                                <a href="#events" class="btn btn-primary rounded-pill btn-type-2">See Our Hosted Events</a>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="slider-content sm-viewer">
                        <div class="row text-center">
                                <div class="col-md-8">
                                        <h1 class="display-2 main-heading">Integration <?php echo date("Y", strtotime('+6 months')); ?></h1>  
                                </div>
                        </div>
                </div>
        </section>
        

        <!-- ISI and Integration -->
        <section id="about">
                <div id="about-container">
                        <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4" id="about-title">
                                        <h5 class="card-title display-3 about-heading">ISI &</h5>
                                        <h5 class="card-title display-3 about-heading">Integration</h5>
                                        <hr id="about-heading-rule"/>
                                </div>
                                <div class="col-md-6 text-justify full-overview">
                                        <p>
                                                The Indian Statistical Institute, alongside being internationally reputed for its research, 
                                                                teaching and training programmes, produce students who are pretty much active in cultural, technological and athletic 
                                                                ways other than being among the best students in the nation, academically. 
                                                                INTEGRATION, the annual techno-cultural-sports fest of the students of ISI has been a platform since years, 
                                                                where students of other institutions from all over the nation interact with students of ISI through numerous events 
                                                                and competitions with attractive prizes, judged by honorary VIP judges like Sandip Ray. 
                                        </p>
                                        <p>
                                                Eminent personalities namely, Dr. Pranab Mukherjee, Arun Shourey, Harsha Bhogle, Sourav Ganguly, Anupam Kher, 
                                                                Rita Bhimani were present on the same platform here, making it impossible to avoid headline in newspapers and 
                                                                media and helping INTEGRATION pose as one of the most decorated events in Kolkata in recent times. 
                                                                Over the course of the year, INTEGRATION has attracted mass, truly diverse in nature. 
                                                                Starting as a small scale fest, the difference sort of aura of INTEGRATION helped it reach the position of one 
                                                                of the biggest fests the nation has ever seen.
                                                        </p>
                                </div>
                                <div class="col-md-1"></div>        
                        </div>
                </div>
        </section>

        <hr/>
        <!-- Integration Event Lists -->
        <section id="events">
	<!-- Quick links -->
<div id="accordion" class="container mb-3 p-5">
                <h3 class="text-center text-primary" style="padding-bottom: 1rem; font-family: 'Lexend', sans-serif; color: #fff !important;"> Quick Links to Events</h3>
                <?php 
                include_once('./DAL/category_dal.php');
                $catobj = new category_dal;
                $cdata = $catobj->getAll();
                include_once('./DAL/eventdata_dal.php');
                $eventObj = new eventdata_dal;
                $eventData = $eventObj->getAll();                                                
                foreach ($cdata as $cat) { 
                        if ($cat->isevent) { ?>
                        <div class="card">
                                <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                        <button class="btn btn-block btn-info collapsed" data-toggle="collapse" data-target="#cat-<?php echo($cat->categoryid);?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo($cat->categoryname); ?>
                                        </button>
                                </h5>
                                </div>

                                <div id="cat-<?php echo($cat->categoryid);?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body d-flex flex-wrap">
                                        <?php 
                                                foreach ($eventData as $eventitem) {  
                                                        if ($eventitem->catid == $cat->categoryid) { ?>
                                                                <a href="./event_details.php?event=<?php echo($eventitem->eventname) ?>" class="btn event-btn my-2 mx-auto"><?php echo($eventitem->eventname); ?></a>                                                                
                                        <?php } } ?>
                               
                                        </div>
                                </div>
                        </div>
                
                <?php } }
                ?>
        </div>


                <div class="card">
                        <h1 class="display-3 text-center card-title section-heading mt-5">List of Our Hosted Events</h1>
                        <div class="card-body pt-0">
                                <div class="eventScroller mt-3">
                                <?php 
                                include_once('./DAL/eventdata_dal.php');
                                $eventObj = new eventdata_dal;
                                $eventData = $eventObj->getAll();

                                foreach ($eventData as $eventitem) {  ?>
                                        <div class="eventScroller-cell">
                                                <div class="card mr-3 ml-3">
                                                        <img src="./AppData/Events/<?php echo($eventitem->imagepath); ?>" class="card-img-top" alt="<?php echo($eventitem->eventname);?>">
                                                        <div class="card-body">
                                                        <h5 class="card-title event-title"><?php echo($eventitem->eventname); ?></h5>
                                                        <p class="card-text event-description"><?php echo($eventitem->description); ?></p>
                                                        <a href="./event_details.php?event=<?php echo($eventitem->eventname) ?>" class="btn event-btn" data-target="_blank">Learn More</a>
                                                        </div>
                                                        <div class="card-footer"><p class="text-white"><b>Date & Time: </b><?php echo($eventitem->timevenue);?></p></div>
                                                </div>
                                        </div>
                                <?php } ?>
                                </div>
                        
                        </div>
                        <div class="card-footer text-muted">
                        </div>
                </div>

                <div class="container text-center mt-3" style = "background: ghostwhite; border: 5px solid black; border-radius: 50%;">
                <img src="./AppData/Images/sum-it-logo.png" class="mt-5" style="width:25rem;">
                        <!--Grid row-->
                        <div class="row d-flex justify-content-center mb-4">

                                <!--Grid column-->
                                <div class="col-md-8 text-light">
                                        <!-- Description -->
                                        <p>
                                        <span style="font-family: 'Abril Fatface'; ">SUM - IT</span> is the perfect platform for all students who are passionate for Mathematics. The pivotal purpose of this programme is to take mathematics beyond standard textbooks by inspiring innovative and non-routine mathematical thinking among students and improving their conceptual understanding.
                                        </p>
                                        <div class="wrapper">
                                        <a class="math-link before after" href="./math.php" target="_blank">Click here to explore more...</a>
                                        </div>
                                </div>
                                <!--Grid column-->
                        
                        </div> <!--Grid row-->
                </div>
        
        </section>


        <hr/>
        <!-- showdowns -->
        <section id="showdowns">
                <div class="card">
                        <h1 class="display-3 text-center card-title section-heading mt-5">Our Grand Showdown Nights</h1>
                        <div class="card-body">
                                <?php 
                                        include_once('./DAL/showdown_dal.php');
                                        $showdownobj = new showdown_dal;
                                        $showdownData = $showdownobj->getAll();
                                
                                        $iseven = true;
                                foreach ($showdownData as $showdownitem) {
                                        if ($iseven) {
                                ?>
                                <div class="row mt-3 pr-0 pl-0 mr-0 ml-0">
                                        <div class="col-md-4">
                                                <img src="./AppData/Showdowns/<?php echo($showdownitem->posterimagepath)?>" 
                                                alt="Showdown Image" class = "wow slideInLeft" 
                                                width="100%">
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-6 wow slideInRight">
                                                <h3 class="display-4 mt-4 showdown-title"><?php echo($showdownitem->showdownname); ?></h3>
                                                <p class="text-muted" style="font-size: 17px;"><?php echo($showdownitem->description); ?></p>
                                                <h5 class="mt-3" style="font-style: italic;"><b>Time & Venue:</b></h5>
                                                <h5 class="mb-4"><?php echo($showdownitem->timevenue); ?></h5>
                                                
                                        </div>
                                        <div class="col-md-1"></div>
                                </div>
                                <hr/>
                                <?php 
                                        $iseven = false;       } 
                                else { ?>   <!-- the bracket for if -->
                                <div class="row mt-3 py-5 px-0 mx-0" style="background:#555;">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5 wow slideInLeft">
                                                <h3 class="display-4 mt-4 showdown-title"><?php echo($showdownitem->showdownname); ?></h3>
                                                <p class="text-white" style="font-size: 17px;"><?php echo($showdownitem->description); ?></p>
                                                <h5 class="mt-3" style="font-style: italic;"><b>Time & Venue:</b></h5>
                                                <h5 class="mb-4"><?php echo($showdownitem->timevenue); ?></h5>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4 wow slideInRight">
                                                <img src="./AppData/Showdowns/<?php echo($showdownitem->posterimagepath)?>" 
                                                alt="Showdown Image" width="100%">
                                        </div>
                                </div>
                                <hr/>
                                <?php 
                                        $iseven = true;         } 
                                } ?>
                        </div>
                        <div class="card-footer"></div>
                </div>
                
        </section>

        <hr/>
        <section id="team">
                <h1 class="display-3 text-center section-heading mt-5">Our Team</h1>
                <div class="accordion lg-viewer" id="accordionExample">
                <?php 
                        include_once('./DAL/category_dal.php');
                        $catobj = new category_dal;
                        $cdata = $catobj->getAll();
                        include_once('./DAL/team_member_dal.php');
                        $teamObj = new team_member_dal;

                        $catdata = array();
                        foreach ($cdata as $citem) {
                                if ($citem->isactive) {
                                        array_push($catdata, $citem);
                                }
                        }

                        $len = count($catdata);
                        for ($i = 0; $i < $len; $i+= 2) {
                ?>
                        <?php $cat = $catdata[$i]; ?>
                        <div class="card">
                                <div class="row">
                                        <div class="col-md-6 m-auto">
                                                <div class="card-header" id="headingOne">
                                                        <button class="btn rounded-pill" type="button" data-toggle="collapse" 
                                                                                data-target="#category-<?php echo($cat->categoryid);?>" 
                                                                                aria-expanded="true" aria-controls="collapseOne"
                                                                                style = "background: grey;
                                                                                background-image: url('./AppData/Categories/<?php echo($cat->imagepath); ?>');
                                                                                height: 150px; background-position: center;">
                                                                        <h2 class = "text-uppercase text-monospace">
                                                                        <?php 
                                                                        $heading = $cat->categoryname;
                                                                        if ($cat->isevent) {
                                                                                $heading .= " HEAD";
                                                                        }
                                                                        echo($heading);
                                                                        ?>
                                                                        </h2>
                                                                        <p class="lead"><b><?php echo($cat->description); ?></b></p>
                                                        </button>
                                                </div>
                                        </div>
                                        
                                        <?php if ($i + 1 < $len) { 
                                                $cat = $catdata[$i+1]; ?>
                                                <div class="col-md-6 m-auto">
                                                        <div class="card-header" id="headingOne">
                                                        <button class="btn rounded-pill" type="button" data-toggle="collapse" 
                                                                                data-target="#category-<?php echo($cat->categoryid);?>" 
                                                                                aria-expanded="true" aria-controls="collapseOne"
                                                                                style = "background: grey;
                                                                                background-image: url('./AppData/Categories/<?php echo($cat->imagepath); ?>');
                                                                                height: 150px; background-position: center; ">
                                                                        <h2 class = "text-uppercase text-monospace">
                                                                        <?php 
                                                                        $heading = $cat->categoryname;
                                                                        if ($cat->isevent) {
                                                                                $heading .= " HEAD";
                                                                        }
                                                                        echo($heading);
                                                                        ?>
                                                                        </h2>
                                                                        <p class="lead"><b><?php echo($cat->description); ?></b></p>
                                                        </button>
                                                        </div>
                                                </div>             
                                        <?php } ?>
                                </div>
                                <?php $cat = $catdata[$i]; ?>
                                <div id="category-<?php echo($cat->categoryid);?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="card-deck">
                                                                        <?php  
                                                                        $teamData = $teamObj->getAllwithCategory($cat->categoryid);
                                                                        foreach ($teamData as $member) { 
                                                                                if ($member->isactive) { ?>
                                                                        <div class="card text-white mt-3 mb-3">
                                                                                <img src="./AppData/Team/<?php echo($member->imagepath); ?>" alt="<?php echo($member->name)?>" class="card-img" width="100%" height="250px">
                                                                                <div class="card-img-overlay">
                                                                                        <h5 class="lead" style="font-weight:500;"><?php echo($member->name);?></h5>
                                                                                        <p><i class="fa fa-phone"></i> <?php echo($member->phone);?></p>
                                                                                        <p><i class="fa fa-envelope"></i> <?php echo($member->email);?></p>
                                                                                        <a href="<?php echo($member->fblink);?>"><i class="fa fa-facebook-f"></i> Facebook Profile</a>
                                                                                </div>
                                                                        </div>
                                                                        <?php } }
                                                                        ?>
                                                                </div>
                                                        </div>
                                </div>        
                                <?php if ($i + 1 < $len) { 
                                       $cat = $catdata[$i+1]; ?>
                                        <div id="category-<?php echo($cat->categoryid);?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                                <div class="card-deck">
                                                                        <?php  
                                                                        $teamData = $teamObj->getAllwithCategory($cat->categoryid);
                                                                        foreach ($teamData as $member) { 
                                                                                if ($member->isactive) { ?>
                                                                        <div class="card text-white mt-3 mb-3">
                                                                                <img src="./AppData/Team/<?php echo($member->imagepath); ?>" alt="<?php echo($member->name)?>" class="card-img" width="100%" height="250px">
                                                                                <div class="card-img-overlay">
                                                                                        <h5 class="lead"  style="font-weight:500;"><?php echo($member->name);?></h5>
                                                                                        <p><i class="fa fa-phone"></i> <?php echo($member->phone);?></p>
                                                                                        <p><i class="fa fa-envelope"></i> <?php echo($member->email);?></p>
                                                                                        <a href="<?php echo($member->fblink);?>"><i class="fa fa-facebook-f"></i> Facebook Profile</a>
                                                                                </div>
                                                                        </div>
                                                                        <?php } }
                                                                        ?>
                                                                </div>
                                                        </div>
                                        </div>
                                <?php } ?>
                                                
                        </div>
                        
                <?php } ?>
                </div>

                <div class="accordion sm-viewer" id="accordionExample1">
                <?php 
                        include_once('./DAL/category_dal.php');
                        $catobj = new category_dal;
                        $cdata = $catobj->getAll();
                        include_once('./DAL/team_member_dal.php');
                        $teamObj = new team_member_dal;

                        $catdata = array();
                        foreach ($cdata as $citem) {
                                if ($citem->isactive) {
                                        array_push($catdata, $citem);
                                }
                        }

                        $len = count($catdata);
                        for ($i = 0; $i < $len; $i++) {
                ?>
                        <?php $cat = $catdata[$i]; ?>
                        <div class="card">
                                <div class="card-header" id="headingOne">
                                                        <button class="btn rounded-pill" type="button" data-toggle="collapse" 
                                                                                data-target="#category-<?php echo($cat->categoryid);?>" 
                                                                                aria-expanded="true" aria-controls="collapseOne"
                                                                                style = "background: grey;
                                                                                background-image: url('./AppData/Categories/<?php echo($cat->imagepath); ?>');
                                                                                height: 150px; background-position: center; ">
                                                                        <h2 class = "text-uppercase text-monospace">
                                                                        <?php 
                                                                        $heading = $cat->categoryname;
                                                                        if ($cat->isevent) {
                                                                                $heading .= " HEAD";
                                                                        }
                                                                        echo($heading);
                                                                        ?>
                                                                        </h2>
                                                                        <p class="lead"><b><?php echo($cat->description); ?></b></p>
                                                        </button>
                                </div>
                                <div id="category-<?php echo($cat->categoryid);?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample1">
                                                        <div class="card-body">
                                                                <div class="card-deck">
                                                                        <?php  
                                                                        $teamData = $teamObj->getAllwithCategory($cat->categoryid);
                                                                        foreach ($teamData as $member) { 
                                                                                if ($member->isactive) { ?>
                                                                        <div class="card text-white mt-3 mb-3">
                                                                                <img src="./AppData/Team/<?php echo($member->imagepath); ?>" alt="<?php echo($member->name)?>" class="card-img" width="100%" height="250px">
                                                                                <div class="card-img-overlay">
                                                                                        <h5 class="lead" style="font-weight:500;"><?php echo($member->name);?></h5>
                                                                                        <p><i class="fa fa-phone"></i> <?php echo($member->phone);?></p>
                                                                                        <p><i class="fa fa-envelope"></i> <?php echo($member->email);?></p>
                                                                                        <a href="<?php echo($member->fblink);?>"><i class="fa fa-facebook-f"></i> Facebook Profile</a>
                                                                                </div>
                                                                        </div>
                                                                        <?php } }
                                                                        ?>
                                                                </div>
                                                        </div>
                                </div>                        
                        </div>
                        
                <?php } ?>
                </div>
                <div class="mx-auto text-white mt-3" 
                        style="width: 80%; 
                                font-family: 'Abril Fanface'; 
                                text-shadow: 2px 2px 5px black;
                                font-style: italic;">
                        <h3>&</h3>
                        <h3>All the students, Research Scholars and Teachers whose endless support makes it possible...</h3>
                </div>
        </section>

        <hr/>
        <!-- sponsors section -->
        <section id="sponsors">
                <div class="card">
                        <h1 class="display-3 text-center card-title section-heading mt-5">Our Valuable Sponsors</h1>
                        <div class="card-body">
                                <div class="row">
                                        <div class="col-md-8 mt-5 sponsorScroller mb-5 mx-auto">
                                                <?php 
                                                        include_once('./DAL/sponsor_dal.php');
                                                        $sposorobj = new sponsor_dal;
                                                        $sponsordata = $sposorobj->getAll();
                                                        foreach ($sponsordata as $sponsoritem) {  ?>
                                                                <div class="sponsorScroller-cell ml-3 mr-3" style="min-width:100px;min-height:100px;">
                                                                        <img src="./AppData/Sponsors/<?php echo($sponsoritem->logoimagepath); ?>" 
                                                                        alt="<?php echo($sponsoritem->sponsorname); ?>" height="100px"
                                                                        style = "background: white">
                                                                </div>
                                                <?php   }
                                                ?>
                                        </div>
                                </div>        
                        </div>
                </div>
        </section>

        </div>   <!-- Container fluid div -->
        
        <a class="scroll-to-top rounded" href="#home">
                <i class="fa fa-angle-up fa-2x"></i>
        </a>

        <?php include_once('./PartialViews/main_footer.php')?>
        <script type="text/javascript" src="./assets/nivo-slider/jquery.nivo.slider.js"></script>
        <!-- page level scripts -->
        <script>
               
             
                $(document).ready(function(){
                        $(this).scrollTop(0);
                        
                        //nivo-slider Initialize
                        $('#slider').nivoSlider({ 
                                effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown' 
                                slices: 15,                       // For slice animations 
                                boxCols: 8,                       // For box animations 
                                boxRows: 4,                       // For box animations 
                                animSpeed: 500,                   // Slide transition speed 
                                pauseTime: 4000,                  // How long each slide will show 
                                startSlide: 0,                    // Set starting Slide (0 index) 
                                directionNav: false,               // Next & Prev navigation 
                                controlNav: true,                 // 1,2,3... navigation 
                                controlNavThumbs: false,          // Use thumbnails for Control Nav 
                                pauseOnHover: false,               // Stop animation while hovering 
                                manualAdvance: false,             // Force manual transitions 
                                prevText: '',                 // Prev directionNav text 
                                nextText: '',                 // Next directionNav text 
                                randomStart: false,               // Start on a random slide 
                                beforeChange: function(){},       // Triggers before a slide transition 
                                afterChange: function(){},        // Triggers after a slide transition 
                                slideshowEnd: function(){},       // Triggers after all slides have been shown 
                                lastSlide: function(){},          // Triggers when last slide is shown 
                                afterLoad: function(){}           // Triggers when slider has loaded 
                        });

                        var sliderHeight = $('#slider').height();
                        $('.nivo-controlNav').css({
                                'background': 'rgba(0, 0, 0, 0.5)',
                                'height': '50px',
                                'top': (sliderHeight),
                                'left': '0',
                                'position': 'absolute',
                                'right': '0',
                                'z-index': '8'
                        });

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

                        setTimeout(() => {
                                //=================Settimeout Start ===============================
                                             var $eventscarousel = $('#events .eventScroller');
                                             //https://flickity.metafizzy.co/events.html   Documentation
                                             $eventscarousel.on( 'ready.flickity', function() {
                                                             console.log(' eventscarouselFlickity ready');
                                                             var height = $('#events .flickity-viewport').height();
                                                            $('#events .eventScroller-cell') && $('#events .eventScroller-cell').height(height); 
                                                            console.log("Events Height set : "+height);
                                            });
                                            $('#sponsors .sponsorScroller').flickity({
                                                                                // options
                                                                                cellAlign: 'left',
                                                                                wrapAround: true,
                                                                                autoPlay: 1000,
                                                                                pageDots: false,
                                                                                setGallerySize: true,
                                                                                pauseAutoPlayOnHover: false,
                                                                                prevNextButtons: false,
                                                                                groupCells: false
                                                                       });
                                            $eventscarousel.flickity({
                                                    // options
                                                    cellAlign: 'left',
                                                    wrapAround: true,
                                                    autoPlay: 3000,
                                                    pageDots: true,
                                                    setGallerySize: true,
                                                    pauseAutoPlayOnHover: false
                                                    });
                          //=================Settimeout end ===============================
                        }, 2000);

                        $(document).on("scroll", function() {
                                var scrollDistance = $(this).scrollTop();
                                var screen_size = $(window).innerHeight();
                                if (scrollDistance > screen_size-50) {
                                        $(".scroll-to-top").fadeIn();
                                        $('.navbar').css({
                                                "background": "black",
                                                "padding-bottom": "0",
                                        });
                                        $('.nav-btn').css({
                                                'font-weight': 'bolder',
                                                'color': '#273746',
                                                'background-color': 'aqua'
                                        });

                                } else {
                                        $(".scroll-to-top").fadeOut();
                                        $('.navbar').css({
                                                "background": "rgba(0, 0, 0, 0.7)",
                                                "padding-bottom": "0",
                                        });
                                        $('.nav-btn').css({
                                                'font-weight': 'bolder',
                                                'color': 'white',
                                                'background-color': 'black'
                                        });
                                }
                        });

                });
        </script>        
</body>
</html>

