-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2019 at 04:56 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `integrationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(500) NOT NULL,
  `description` longtext DEFAULT NULL,
  `imagepath` varchar(1000) DEFAULT NULL,
  `isactive` bit(1) DEFAULT b'1',
  `isevent` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`, `description`, `imagepath`, `isactive`, `isevent`) VALUES
(1, 'Joint Secretary', 'The main planners of the Integration.', '5cd8f95ab5d11_fest_cover.jpg', b'1', b'0'),
(2, 'Treasurer', 'The backbone of money circulation in Integration.', '5cd8f9b56eab5_treasure-cover.jpg', b'1', b'0'),
(3, 'Sponsorship', 'The bridge between funding and advertisements.', '5cd8fa1991589_sponsor-cover.jpg', b'1', b'0'),
(4, 'Web Design', 'We make the website.', '5cd8fa738166b_web-cover.jpg', b'1', b'0'),
(5, 'Cultural Chapter', 'The main people of cultural chapter of Integration.', '5cd8fb03e8604_culture-cover.jpg', b'1', b'1'),
(6, 'Tech Chapter', 'The main people of Tech Chapter in Integration.', '5cd8fb5894a94_tech-cover.png', b'1', b'1'),
(8, 'Sports Chapter', 'The main people of Sports Chapter in Integration', '5cd8fedb873d1_pexels-photo-413195.jpeg', b'1', b'1'),
(9, 'MTRP', 'The mathematical competition heads.', '5cd8fff6e4ece_mtrp-cover.jpg', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `eventdata`
--

CREATE TABLE `eventdata` (
  `eventid` int(11) NOT NULL,
  `eventname` varchar(500) NOT NULL,
  `catid` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `timevenue` text DEFAULT NULL,
  `cmscontent` longtext DEFAULT NULL,
  `imagepath` varchar(1000) DEFAULT NULL,
  `eventhead` text DEFAULT NULL,
  `fees` text NOT NULL,
  `isactive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventdata`
--

INSERT INTO `eventdata` (`eventid`, `eventname`, `catid`, `description`, `timevenue`, `cmscontent`, `imagepath`, `eventhead`, `fees`, `isactive`) VALUES
(2, 'Nikkana (Solo Dance)', 5, 'Your body is an instrument that you play to the symphony of dance. This Solo-Dance event has provided year-after-year a stage for the amalgam of Indian and Western Dance categories, where top 20 participants will out-perform each other in Indian/Western Category to lose themselves to this symphony of Dance.', 'To be updated', '<p><strong>Registration Fees:</strong></p>\r\n\r\n<ul>\r\n	<li>â‚¹100 for Team size 1.</li>\r\n	<li>â‚¹150 for Team size 2</li>\r\n</ul>\r\n\r\n<p><strong>Prize Money</strong>&nbsp;worth â‚¹5000.</p>\r\n\r\n<p><strong>General Rules:</strong>&nbsp;These are the rules for western / easter solo both...</p>\r\n\r\n<ol>\r\n	<li>Team size is either 1 or 2.</li>\r\n	<li>Participants must reach registration desk at least 30 minutes before the scheduled time of the event.(i.e. within 8:30 am)</li>\r\n	<li>Each participant must bring school or college id-card in order to register for this event.</li>\r\n	<li>No props will be provided from us. Participants are requested not to use any prop or act which may cause harm to themselves or anyone present in the auditorium.</li>\r\n	<li>Each team (of size 1 or 2) will be allotted MAX 3 minutes to perform.</li>\r\n	<li>Fusion Dance is allowed.</li>\r\n	<li>Vulgarity of any kind would lead to instant disqualification from the event. Hence, if the participant feels that the outfit / performance can be deemed as vulgar, it is strongly advised to consult the organizers before putting it on stage. The decision of the organizer will be final in case of any disputes arising due to this reason.</li>\r\n	<li>The stage must be cleared of all props after every performance by the participant within 2 minute.</li>\r\n	<li>A team will be alloted maximum 5 minutes within which they have to perform and clear all props, violation of which will be resulted into deducting marks and even disqualification from the competition.</li>\r\n	<li>Participants more than 14 yrs will be allowed to participate. (Age as on 31st Jan 2019)</li>\r\n</ol>\r\n', '5cdd4ae0e9ac2_girl-dancing-silhouette-2.jpg', 'To be updated', 'https://www.google.com', b'1'),
(3, 'Jhankar (Group Dance)', 5, 'This group-dance event portrays the Human Clockwork of art and precision, where the best Dance Groups across the terrain will Integrate to gear up to become a dance machine. These teams will compete in Indian/Western Category of group dance events.', 'To be updated', '<p><strong>Registration Fees:</strong>&nbsp;â‚¹250 per team.</p>\r\n\r\n<p><strong>Prize money</strong>&nbsp;worth â‚¹6000.</p>\r\n\r\n<p><strong>General Rules:</strong></p>\r\n\r\n<ol>\r\n	<li>Team size is 3-12.</li>\r\n	<li>Participants must reach registration desk at least 30 minutes before the scheduled time of the event.</li>\r\n	<li>Each participant must bring college id-card in order to register for this event.</li>\r\n	<li>No props will be provided from us participants are requested not to use any prop or act which may cause harm to themselves or anyone present in the auditorium.</li>\r\n	<li>Each team will be allotted 5-6 minutes to perform.</li>\r\n	<li>Fusion Dance is allowed.</li>\r\n	<li>Vulgarity of any kind would lead to instant disqualification from the event. Hence, if the participant feels that the outfit / performance can be deemed as vulgar, it is strongly advised to consult the organizers before putting it on stage. The decision of the organizer will be final in case of any disputes arising due to this reason.</li>\r\n	<li>The stage must be cleared of all props after every performance by the participants within 2 minutes.</li>\r\n	<li>A team will be alloted maximum 8 minutes within which they have to perform and clear all props, violation of which will be resulted into deducting marks and even disqualification from the competition.</li>\r\n</ol>\r\n', '5cdd4d500a2dd_IMG_5826.JPG', 'To be updated', 'https://www.google.com', b'1'),
(4, 'Tech Quiz', 6, 'Science and technology is unanimously hailed as the most evolved form of human interest. In Tech Quiz it helps if you are acquainted with the cornerstones in it\'s diverse and long trail. One of the most popular events of Integration, Tech Quiz tests not only your tech trivia but also gives you ample scope to exercise your grey cells. With great prizes at stake, it\'s definitely an event you don\'t want to miss.', '11 P.M., 20th February, 2020; ISI, Kolkata', '', '5cdd4e4604243_questionMark_blue_red.jpg', 'To be updated', 'https://www.google.com', b'1'),
(5, 'CODE-IT', 5, 'CODE-IT is the coding competition of the INTEGRATION. Code-IT is powered by TEOCO Corporation, our event partner for this. HackerEarth is the programming partner for the event.', '9 PM - 12 AM, 16 February, 2020', '<p><strong>Event Schedule:</strong>&nbsp;16-Jan-2016, 9 pm - 12 am</p>\r\n\r\n<p><strong>Platform:</strong>&nbsp;HackerEarth.</p>\r\n\r\n<p>The contest is free for everyone and you can participate from home.</p>\r\n\r\n<p><strong>Event Description, Eligibility and Cash Prizes:</strong></p>\r\n\r\n<ul>\r\n	<li>This is a 3 hour online coding contest consisting of about 5-6 questions.</li>\r\n	<li>This will be an individual coding contest. Participants should register on HackerEarth before competing if they already don&#39;t have a HackerEarth account.</li>\r\n	<li>Only Indians by nationality are eligible for the prizes.</li>\r\n	<li>Top three securing position will get the prize if they are eligible.</li>\r\n	<li>Cash prizes are : Rs 1500 for 1st position, Rs 1000 for 2nd position and Rs 500 for 3rd position.</li>\r\n	<li>To recieve prize one has to produce one valid government issued identity card (or institution identity card in case of student) of their own.</li>\r\n</ul>\r\n\r\n<p><strong>General Rules:</strong></p>\r\n\r\n<ol>\r\n	<li>The organisers reserve the rights to change any or all of the above rules as they deem fit. Change in rules, if any will be highlighted on the website and notified to the registered participants.</li>\r\n	<li>Note that at any point of time, the latest information will be that which is on the website.</li>\r\n	<li>Plagiarism is strictly prohibited. If found then the individuals will be disqualified from the event.</li>\r\n</ol>\r\n', '5cdd4f5ece8d8_pexels-photo-51415.jpeg', 'To be updated', 'https://www.google.com', b'0'),
(6, 'PUBG Mobile', 5, 'Indian Statistical Institute, Kolkata presents an online platform to team up with your friends and compete against the world in PUBG Mobile, the game that needs no introduction.', 'Today', '<p><strong>TOURNAMENT FORMAT</strong></p>\r\n\r\n<ul>\r\n	<li>ALL MATCHES WOULD BE TPP, ASIA, ERANGEL, SQUAD format.</li>\r\n	<li>The tournament will be conducted in two stages - Prelims and Finals. Depending on the number of participating teams a set number of top teams will qualify to the final rounds and the others will be eliminated.</li>\r\n	<li>Every team can register at max for 3 games. The best performance amongst the two games will be considered. Incase a team goes to the finals both times then the team with most kills amongst the top team to not make into the finals of the two groups will qualify into the finals. Eg: Say 10 teams are selected for the finals from each group and 1 team has been selected in two groups(Group 1 and Group 2) then between the 11th team in group 1 and 11th team in group 2 the team with more kills will qualify.</li>\r\n</ul>\r\n\r\n<p><strong>PAYMENT PROCEDURE:</strong></p>\r\n\r\n<p><strong>Per person Entry Fee :</strong>Rs. 100 per game(Max 3 games)</p>\r\n\r\n<ol>\r\n	<li><strong>STEP 1:</strong>To register please pay the required amount to\r\n\r\n	<ul>\r\n		<li><strong>Via PayTM:</strong>&nbsp;8017168465</li>\r\n		<li><strong>Via UPI:</strong>&nbsp;8017168465@upi</li>\r\n		<li><strong>Account Number:</strong>551611610000001</li>\r\n		<li><strong>IFSC code-</strong>BKID0005516</li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>STEP 2:</strong>After the payment is done send a whatsapp message to (8017168465,9903235656)[BOTH] with your in-game name and the transaction id of your payment along with the payment mode.</li>\r\n	<li><strong>Step 3:</strong>Once you have sent the whatsapp message we will add you to a whatsapp group of our event. The room id and password will be shared via this whatsapp group on the day of the tournament.</li>\r\n</ol>\r\n\r\n<p>The number of group matches will depend on the number of participating teams.There will be a final round where top few teams(This will also depend on the number of participating members) from each group who will fight it out for the Prize Pool Money! Stay tuned for more updates!</p>\r\n', '5cdd500dd0568_PUBG-Mobile.jpg', 'Ayush-8017168465, Diganta-9903235656, Arpan - 8910412867', 'https://www.google.com', b'1'),
(7, 'Mathgeek', 5, 'Mathgeek is an online innovative mathematical competition, giving you opportunity to show off your talent of solving mathematical riddles. Prize worth Rs. 2,000 is waiting for you to win!', '26th January, 2019 12:00 P.M. to 27th January, 2019 12:00 P.M.', '<p><strong>Rules:</strong></p>\r\n\r\n<ol>\r\n	<li>It is an online event. So, you are recommended to use a computer rather than mobile devices.</li>\r\n	<li>There are 9 rounds.</li>\r\n	<li>Each round has 3 unlocking puzzles which helps to go from one round to another.</li>\r\n	<li>Questions will be such that not much professional knowledge of mathematics is required (upto +2 and some undergrad things) so that everybody will be on same page.</li>\r\n	<li>It is open to all age groups.</li>\r\n	<li><strong>Entry Fees:</strong>&nbsp;50 Rs. per head, which must be paid at the time of registration.</li>\r\n	<li>Prize money worth Rs. 2,000</li>\r\n	<li>The event will be held on 26th January, 2019 12:00 p.m. to 27th January, 2019 12:00 p.m.</li>\r\n	<li>The last date for registering for the event is 25th January, 2019 12:00 p.m.</li>\r\n</ol>\r\n\r\n<p><strong>The organisers reserve the right to change any of the rules, timings and other details such as prize money at any point of time. In case of any dispute, the decision of the organisers is final.</strong></p>\r\n', '5cdd50fda93e2_mathgeek_cover.jpg', 'Deep Ghoshal - 8906723662, Aditya Ghosh - 9163658233, Anirban Nath - 9051227133', 'https://www.google.com', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `eventregistration`
--

CREATE TABLE `eventregistration` (
  `userregid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `paymentid` varchar(50) DEFAULT NULL,
  `status_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventregistration`
--

INSERT INTO `eventregistration` (`userregid`, `eventid`, `userid`, `paymentid`, `status_code`) VALUES
(3, 5, 5, 'ISI201392', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `mathdata`
--

CREATE TABLE `mathdata` (
  `studentid` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(500) NOT NULL,
  `institution` varchar(500) NOT NULL,
  `student_class` varchar(10) NOT NULL,
  `medium` varchar(50) NOT NULL,
  `exam_zone` varchar(500) NOT NULL,
  `book` varchar(50) NOT NULL,
  `guard_name` varchar(500) NOT NULL,
  `address` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mathdata`
--

INSERT INTO `mathdata` (`studentid`, `firstname`, `lastname`, `phone1`, `phone2`, `date_of_birth`, `email`, `institution`, `student_class`, `medium`, `exam_zone`, `book`, `guard_name`, `address`) VALUES
(1, 'Subhrajyoty', 'Roy', '8013976355', '8902715511', '1998-06-13', 'roysubhra1998@gmail.com', 'Indian Statistical Institute, Kolkata', '9', 'Bengali', '', 'Yes', 'Swapan Kumar Roy', 'House No 36/969, 15th Lane, Swami Vivekananda Road, Birati');

-- --------------------------------------------------------

--
-- Table structure for table `showdown`
--

CREATE TABLE `showdown` (
  `showdownid` int(11) NOT NULL,
  `showdownname` varchar(500) NOT NULL,
  `description` longtext DEFAULT NULL,
  `timevenue` text DEFAULT NULL,
  `posterimagepath` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showdown`
--

INSERT INTO `showdown` (`showdownid`, `showdownname`, `description`, `timevenue`, `posterimagepath`) VALUES
(1, 'Monali Thakur Live', 'The stage is all set to light up the night. Get your grooves on as we dance till the end of night. Integration 2019 in association with Eminence group of entertainment presents the Bollywood sensation Ms. Monali Thakur as our star performer for the final showdown on 3rd Feb 2019 from 6 pm onwards! We welcome you to be a part of this remarkable night and witness the heart throbbing performances.', '3rd February, 2019; 6:00 P.M.; Hostel Ground, ISI, Kolkata', '5cd901a5e2c27_monali_thakur.jpg'),
(2, 'Nalayak The Band Live', 'The stage is all set to rock up the night. Integration 2019 presents Nalayak the Band - the 4 piece indie rock band from Chandigarh, for the showdown! We welcome you to be a part of this remarkable night and witness their explosive live acts and pumping music.', '1st February, 2019; 7:00 P.M.; Amrapali Ground, ISI, Kolkata', '5cd9024e8499a_nalayak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `sponsorid` int(11) NOT NULL,
  `sponsorname` varchar(500) NOT NULL,
  `logoimagepath` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`sponsorid`, `sponsorname`, `logoimagepath`) VALUES
(1, 'Allahabad Bank', '5cd9691ca8270_allahabad-bank-personal-loan.jpg'),
(2, 'CocaCola', '5cd9694dabe87_cocacola_logo_PNG5.png'),
(3, 'CodeChef', '5cd96967af861_codechef.png'),
(4, 'HP', '5cdcd9472f487_hp-logo.png'),
(5, 'IBM', '5cdcd95d6dade_IBM-logo-black-880x660.png'),
(6, 'ITC Limited', '5cdcd97591019_ITC_Limited.png'),
(7, 'LIC', '5cdcda8210ec6_lic-logo..png'),
(8, 'UBI', '5cdcdaa61e984_ubi-logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `memberid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fblink` varchar(1000) DEFAULT NULL,
  `imagepath` text DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `isactive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`memberid`, `name`, `phone`, `email`, `fblink`, `imagepath`, `catid`, `isactive`) VALUES
(1, 'Sayantan Basu', '7980605492', 'sayantanndp12@gmail.com', 'https://www.facebook.com/sayantan.bal', '5cd969d2d0ff4_sayantan da.jpg', 1, b'1'),
(2, 'Arpan Kumar', '8145560256', 'arpank05@gmail.com', 'https://www.facebook.com/arpankumar.8072', '5cd96a26eb4f3_arpan kumar.jpg', 2, b'1'),
(3, 'Riddhi Ghoshal', '9475959975', 'postboxriddhi@gmail.com', 'https://www.facebook.com/riddhi.ghosal97', '5cd96a9288c6d_riddhi.jpg', 5, b'1'),
(4, 'Soumakanti Pan', '9163135060', 'soumyakanti8051@gmail.com', 'https://www.facebook.com/imSPan18', '5cd96afb23e57_Pan.jpg', 8, b'1'),
(5, 'Subhrajyoty Roy', '8902715511', 'subhrajyotyroy@gmail.com', 'https://www.facebook.com/roy.sherlock.zer0', '5cd96b48869c9_Subhrajyoty.jpg', 4, b'1'),
(6, 'Monitirtha Dey', '9874706728', 'monitirthadey3@gmail.com', 'https://www.facebook.com/monitirtha.dey.3', '5cd96b9555320_monitirtha.jpg', 3, b'1'),
(7, 'Soham Bonnerjee', '8240378256', 'sohambonnerjee01@gmail.com', 'https://www.facebook.com/soham.bonnerjee.1', '5cd96be52c1b2_soham.jpg', 6, b'1'),
(8, 'Dibyendu Saha', '8697503818', 'dibyendu.0399@gmail.com', 'https://www.facebook.com/dibyendu.saha.775', '5cd96c32448a2_dibyendu.jpeg', 9, b'1'),
(9, 'Arghya Chakraborty', '8250845520', 'arghyachakraborty01.isical@gmail.com', 'https://www.facebook.com/arghya.chakraborty.965', '5cde3ba2a3d13_arghya.jpg', 1, b'0'),
(10, 'Rounak Ray', '9051124171', 'rounakray23@gmail.com', 'https://www.facebook.com/rijumaths23', '5cde3bf161b20_rounak da.jpg', 2, b'1'),
(11, 'Anwesha Chakravarti', '8335894888', 'anweshanu12@gmail.com', 'https://www.facebook.com/anweshaac', '5cde3c4c100dc_anwesha di.jpg', 3, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `date_of_birth` date NOT NULL,
  `institution` varchar(500) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `_password` varchar(500) NOT NULL,
  `updatedatetime` datetime NOT NULL DEFAULT current_timestamp(),
  `isactive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`userid`, `firstname`, `lastname`, `date_of_birth`, `institution`, `phone`, `email`, `_password`, `updatedatetime`, `isactive`) VALUES
(5, 'Subhrajyoty', 'Roy', '1998-06-13', 'Indian Statistical Institute, Kolkata', '8013976355', 'roysubhra1998@gmail.com', '$2y$10$L7Qt50auvp1whNrTqupN8eRYqmXu.ACgfKBmx1i8ZQX0ZE.d.2V6m', '2019-07-14 10:55:44', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `eventdata`
--
ALTER TABLE `eventdata`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `eventregistration`
--
ALTER TABLE `eventregistration`
  ADD PRIMARY KEY (`userregid`),
  ADD KEY `eventid` (`eventid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `mathdata`
--
ALTER TABLE `mathdata`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `showdown`
--
ALTER TABLE `showdown`
  ADD PRIMARY KEY (`showdownid`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`sponsorid`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`memberid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `eventdata`
--
ALTER TABLE `eventdata`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eventregistration`
--
ALTER TABLE `eventregistration`
  MODIFY `userregid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mathdata`
--
ALTER TABLE `mathdata`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showdown`
--
ALTER TABLE `showdown`
  MODIFY `showdownid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `sponsorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventdata`
--
ALTER TABLE `eventdata`
  ADD CONSTRAINT `eventdata_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `category` (`categoryid`);

--
-- Constraints for table `eventregistration`
--
ALTER TABLE `eventregistration`
  ADD CONSTRAINT `eventregistration_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `eventdata` (`eventid`),
  ADD CONSTRAINT `eventregistration_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `userdata` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
