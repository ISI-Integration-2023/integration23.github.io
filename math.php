<?php 
ob_start();
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php include_once('./PartialViews/main_head.php') ?>
        
        <!-- Custom Style sheets for this page -->
        <link rel="stylesheet" href="./assets/css/mathstyle.css?v=<?php echo(rand());?>"> 
      
</head>

<body>

    <div class="pb-5">  <!-- container type div -->
        <!-- Navbar
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
                        <a class="nav-link" href="#about">About Sum-it</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#program">Program Itinerary</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#application">Application</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#contacts">Contact Us</a>
                </li>
                </ul>
                <div class="my-2 my-lg-0 d-inline-flex" style="align-items: baseline; margin-bottom:1rem !important; color:white;">
                        <?php 
                        $firstname = 'Guest User';
                        if (isset($_SESSION['user_firstname'])){
                                $firstname = $_SESSION['user_firstname'];
                        }
                        ?>
                        <span class="mx-3 navbar-text">Welcome <?php echo($firstname); ?></span>
                        <?php 
                        if ($firstname != 'Guest User') {?>
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

         Navbar -->
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
                        <a class="nav-link" href="#about">About Sum-it</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#program">Program Itinerary</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#application">Application</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#contacts">Contact Us</a>
                </li>
                </ul>
                <div style="display: none !important;" class="my-2 my-lg-0 d-inline-flex" style="align-items: baseline; margin-bottom:1rem !important; color:white;">
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
       


        <section id="home">
            <div class="jumbotron pb-3 mb-5" id = "mainjumbo">
                    <img style="display:inline;" src="./AppData/Images/sum-it-logo.png" class="sum-it-logo" style="width:30rem;">
			<div style="display: inline; position: relative; top: 75px;">                    
				<p class="lead" style="display:inline;" >Powered by ... </p>
		    		<img src="./AppData/Images/oxford_logo.jpg" style="display:inline;" width = "150px">
			</div>


                    <p class="lead">The perfect platform to show your mathematical potential and dive into the Mathematics beyond standard textbooks.</p>

                    <div style="width: 60%">
                    <p>Mathematics consists in proving the most obvious thing in the least obvious way.</p>
                    <p style="text-align: right"> &mdash; <em>George Polya</em> </p>
                    </div>
            </div>

                <div class="jumbotron container text-justify text-primary bg-white rounded">
                	<!--<p class="lead">Admit cards are available now.
                		<ul><li>Candidates who have registered <b>online</b> may download admit cards from <a href="http://www.isical.ac.in/~integration/online.php">this link.</a></li></ul>
                		<ul><li>Candidates who have registered <b>offline</b> may download admit cards from <a href="http://www.isical.ac.in/~integration/offline.php">this link.</a></li></ul>
                	</p><br/>
                        <!--<p class="lead">Please click <a href="math_register.php">here</a> to register for SUM-IT 2020.</p><br/>-->
                        <!--<p class="lead">Please click <a href="math_payment.php">here</a> to complete payment for SUM-IT 2020 if you have successfully registered.</p><br/>-->
                       <!-- <p class="lead">We have been flooded with requests for last minute registrations. For those, who have not yet registered for appearing in SUM-IT 2020, provisions for <strong>on-spot registration</strong> will be open at the examination centers. The participant should reach one of the following venues by 9:00 a.m. (for class XI) or 1:00 p.m. (for class IX) along with a photo identity proof and the registration fee (Rs.220): 
                        <ul><li>Kolkata(South): Ramakrishna Mission Residential College, Narendrapur KMA Main Road, Narendrapur, Kolkata-700103</li>
                        <li>Kolkata(North): Ramkrishna Mission Shilpapitha, Ramkrishna Mission Road, Jatindas Nagar, Belghoria, Kolkata-700056</li>
                        <li>Durgapur: DAV Model School, JM Sengupta Road, B-zone, Durgapur-713205</li>
                        </ul>
                        </p><br/>-->

			<p class="lead">
				The list of selected participants for the camp programme is given in the following links:
			<ul>
				<li><a href="./sumit-results/SUM-IT 2020 Class 9.pdf" target="_blank"> CLASS IX </a></li>
				<li><a href="./sumit-results/SUM-IT 2020 Class 11.pdf" target="_blank"> CLASS XI </a></li>
						
			</ul>
			</p>
                        <p class="lead">Please click on the following links to make payment for "MATH-LAB" :
			<ul><li><a href="http://www.townscript.com/e/mathlab-for-class-ix/booking">For Class IX</a></li><li><a href="http://www.townscript.com/e/mathlab-for-class-xi/booking">For Class XI</a></li></ul></p><br/>
			<p class="lead">Following are links of set of questions which may be considered as a sample set for the written test. The pattern, although, will not necessarily remain same in the examination.
			<ul><li><a href="./AppData/IX-sample.pdf" target=_blank>For Class IX</a></li><li><a href="./AppData/XI-sample.pdf" target=_blank>For Class XI</a></li></ul></p>
                </div>
        </section>
        
        <section id="about">
                <h1 class="display-3 text-center section-heading mt-3 mb-5">About <img src="./AppData/Images/sum-it-logo.png" class="sum-it-logo" style="display: flex-inline; width: 15rem;"></h1>
            <div class="home-content container">
                <p>Integration, the annual techno-cultural-sports fest organized by the students of <a href="http://www.isical.ac.in" target="_blank">Indian Statistical Institute, Kolkata<a>, is organizing the SUM-IT during 19th January, 2020 to first week of February. The aim of this programme is to increase interest and create awareness about Mathematics among school students. This programme also offers the students to assess themselves with respect to their contemporaries throughout the state.</p>
                <p>SUM-IT is the perfect platform for all students who are passionate for Mathematics. The pivotal purpose of this programme is to take mathematics beyond standard textbooks by inspiring innovative and non-routine mathematical thinking among students and improving their conceptual understanding. In the past, similar mathematical competition has attracted the best minds from all over West Bengal and beyond, who have faced the best mathematical challenges and emerged with flying colours.</p>

                <p>The students appearing in SUM-IT 2020 will get the unique opportunity to procure a limited edition “MathLab” published by Integration, Indian Statistical Institute against a fixed donation of Rs. 190. The non-routine content of the book will help the talented students in learning mathematics through problem solving. The book is expected to be available from 3rd week of December onwards.</p>
                
                <p style="color: red; font-weight: bold, text-align:center;">Disclaimer: </p> 
                <ul>
                    <li>Indian Statistical Institute does not have any role in organizing the examination. This is entirely organized by the students of the Indian Statistical Institute, Kolkata as a major part of their annual fest, Integration.</li>
                    <li>SUM-IT is NOT, in any way, associated with any conduct of class for preparation of SUM-IT, wherever it might take place.</li>
                </ul>
            
            </div>   
        </section>
        
        <section id="program">
            <!--Program-->
            <h1 class="display-3 text-center section-heading mt-5">Program Itinerary</h1>
            <div class="container">
                    <p>The programme consists of a written examination and a camp. The examination is held in two categories, one for class IX and the other for class XI. Students from each category are selected for the math camp based on their performance in the written test. The camp consists of interactive sessions with mathematicians, ISI faculties and scholars from other universities, along with a few exercises. Based on the performance in the camp, the top few students from each category are rewarded.</p>
                        <ol>
                            <li>
                                <h4>Level I</h4>
                                <p>A written examination is held in various cities in India, specifically, Kolkata, Durgapur separately for classes IX and XI. The corresponding papers consist of two sections. Section I has multiple choice questions (MCQ) and Section II has subjective problems. The applicants are given two and a half hours to solve the paper. Based on their composite scores in the MCQ and subjective sections, students securing marks above a certain cut-off qualify for the SUM-IT Camp. The list of candidates selected in the written examination shall be uploaded in this webpage only.</p>
                            </li>
                            <li>
                                <h4>Level II</h4>
                                <p>The selected candidates are required to attend a two day camp. This camp features lectures from mathematicians, ISI faculties, renowned scholars from other universities, and other experts from various fields of Mathematics and Statistics. These lectures are based on interesting topics related to mathematics, thereby providing enthusiasts with lots of food for thought. Throughout the camp, quizzes are held periodically to judge the skills and problem-solving potential of the students. Based on their performance in the camp, the top few students are rewarded.</p>
                            </li>
                        </ol>
            
            </div>
            <!--Program-->                
        </section>


        <section id="application">
        <h1 class="display-3 text-center section-heading mt-5">Application Details</h1>
        <div class="container">
            <h3>General Guidelines:</h3>
            <ol>
                <li> The qualifying round consists of a written programme which will be held on 19th January, 2020 across various centres of West Bengal.</li>
                <li> The programme has been designed for two groups, for students currently studying in class IX and class XI. Interested and meritorious students from class VIII and class X can also participate in the programme for class IX and class XI, respectively.</li>
                <li> The registration can be done either in online mode or offline mode:</li>
                <ul>
                <li> For online registration, click <a href="math_register.php">here.</a></li>
                <li> For offline mode of registration, the forms, along with the entry fee will be collected from the Principal/ Headmaster/ Headmistress of the school.</li>
                </ul>
                <li> The registration fee is Rs. 220/- for both the classes, payable at the time of submission of the form.</li>
                <li> The admit cards for each participant will be sent to the email address provided at the time of registration. One can also download the admit card from the website mentioned above. The admit cards will be available from 12th January, 2020.</li>
                <li> On the day of the written round, each student must produce his/her School ID, Entry Ticket (and Payment Confirmation Ticket, for online registration only) as a proof of identification.</li>
                <li> Students scoring above a cut-off mark in the written test for each category will be selected for the orientation camp to be held on first week of February tentatively . </li>
                <li> The camp will be conducted by a group consisting of ISI faculties, and past INMO awardees. </li>
                <li> Based on the performance in the camp, the top few students from each category will be rewarded with one-time cash scholarships while all the other participants will receive medals, certificates and other prizes.</li>

            </ol>

            <br/>
            <!--<p class="lead">Please click <a href="math_register.php">here</a> to register for SUM-IT 2020.</p>-->
            <!--<br/>
            <p class="lead">Please click <a href="math_payment.php">here</a> to make payment for SUM-IT 2020 if you have successfully registered.</p><br/>-->
	    <p class="lead">Please click on the following links to make payment for "MATH-LAB" :
			<ul><li><a href="http://www.townscript.com/e/mathlab-for-class-ix/booking">For Class IX</a></li><li><a href="http://www.townscript.com/e/mathlab-for-class-xi/booking">For Class XI</a></li></ul></p>
	   <br/>
	    <p class="lead">Following are links of set of questions which may be considered as a sample set for the written test. The pattern, although, will not necessarily remain same in the examination.
			<ul><li><a href="./AppData/IX-sample.pdf" target=_blank>For Class IX</a></li><li><a href="./AppData/XI-sample.pdf" target=_blank>For Class XI</a></li></ul></p>
        </div>
            
        </section>

        <section id = "contacts">
            <h1 class="display-3 text-center section-heading mt-5">Contact Us</h1>
            <div class="container">
                <strong>Email:</strong>
                <ul>
                    <li>sum.it.integration@gmail.com</li>
                    <li>isi.integration@gmail.com</li>
                </ul>

                <strong>Phone:</strong>
                <ul>
                    <li>Mr. Abhinandan Dalal : +91 9477442995</li>
                    <li>Mr. Sayak Chatterjee: +91 9051403244</li>
                    <li>Mr. Somak Laha: +91 8910397604</li>
                </ul>
            </div>
        </section>

    </div>      <!-- container type div -->

    <a class="scroll-to-top rounded" href="#home">
                <i class="fa fa-angle-up fa-2x"></i>
    </a>

    <?php include_once('./PartialViews/main_footer.php')?>
    
    <!-- page level scripts -->
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
        
            $(document).on("scroll", function() {
                                var scrollDistance = $(this).scrollTop();
                                var screen_size = $(window).innerHeight();
                                if (scrollDistance > screen_size-100) {
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
