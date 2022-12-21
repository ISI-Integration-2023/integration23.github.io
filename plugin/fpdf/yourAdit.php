<<html><<head><<title>Admit Generator</title></head>
<<body>
    <?php
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes
    require('pdf.php');
    //require_once('connect.php');
    $servername = "localhost";
    $username = "root";
    //$password = "password";
    
    // Create connection
    $con = new mysqli($servername, $username);
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } 
    echo "Connected successfully";
    $con->query('USE csv_db');
    function generate_admit($name, $roll_no, $school_addr, $time, $rep_time, $venue, $ver)
    {
        $venue_name = '';
        if($venue == 'CC'){
            $venue_name = 'Kolkata';
        }
        elseif($venue == 'CO'){
            $venue_name = 'CoochBehar';
        }
        elseif($venue == 'DP'){
            $venue_name = 'Durgapur';
        }
        elseif($venue == 'BG'){
            $venue_name = 'Bangalore';
        }
        else{
            $venue_name = 'Warangal';
        }
    
        $pdf = new PDF('P','mm','A4');
        $pdf->SetTitle("Admit-Card-MTRP19");
        $pdf->AddPage();
        $pdf->SetFont('Times','B',20);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'INTEGRATION 2019',0,1,'C');
        $pdf->LN(1);
        $pdf->Image('./img/Integration_logo.png',95,null,20,20);
        $pdf->LN(1);
        $pdf->Image('./images/oxford_logo.jpg',85,null,40,20);
        if($ver === 'bn'){
            $pdf->Image('./images/B.png',180,40,20,20);
        }
        else{
            $pdf->Image('./images/E.png',180,40,20,20);
        }
        
        $pdf->LN(5);
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Mathematics Talent Reward Programme, 2019',0,1,'C');
        $pdf->LN(1);
    
        $pdf->Line(10,85,200,85);
        $pdf->SetFont('Arial','BU',14);
        $pdf->Cell(80);
        $pdf->Cell(30,4,'ADMIT CARD',0,1,'C');
        $pdf->LN(2);
    
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20);
        $pdf->Cell(40,10,"Name ",0,0,'L');
        $pdf->Cell(2,10,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(100,10,$name,0,0,'L');
        $pdf->LN(8);
    
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,6,"School ",0,0,'L');
        $pdf->Cell(2,6,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(0,6,$school_addr,0,'L',0);
        $pdf->LN(4);
    
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,"Roll No ",0,0,'L');
        $pdf->Cell(2,10,": ",0,0,'C');
        $pdf->Cell(50,10,$roll_no,0,0,'L');
        $pdf->LN(8);
    
        $pdf->Cell(20);
        $pdf->Cell(40,10,"Date of Exam ",0,0,'L');
        $pdf->Cell(2,10,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,"20th January, 2019",0,0,'L');
        $pdf->LN(8);
    
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,"Time of Exam ",0,0,'L');
        $pdf->Cell(2,10,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,$time,0,0,'L');
        $pdf->LN(8);
    
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,"Reporting Time ",0,0,'L');
        $pdf->Cell(2,10,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50,10,$rep_time,0,0,'L');
        $pdf->LN(10);
    
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,6,"Venue ",0,0,'L');
        $pdf->Cell(2,6,": ",0,0,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->MultiCell(0,6,$venue_name,0,'L',0);
        $pdf->LN(8);
    
        //$pdf->Line(10,180,200,180);
    
        $pdf->Cell(10);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,6,"Rules and other Necessary Instructions: ",0,0,'L');
        $pdf->LN(8);
        $pdf->SetFont('Arial','',11);
        $column_width = 175;
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"All students must carry <b>AADHAAR CARD</b> for ID proof.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"All students should reach the venue as per the mentioned reporting time so that they can go through the entire registration validation process without any difficulty.");
        $pdf->LN(8);
    
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"All students should carry with them this <b>ADMIT CARD</b> as well as the <b>Ticket</b> sent to their email.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"Each student will be given a seat no. and volunteers will guide them to the corresponding rooms for the examination.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"It is <b>NOT</b> necessary for the students to come in School Uniform.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"For students opted for Kolkata center, parking facilities cannot be availed inside the ISI campus.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"Any student found to indulge in unfair means or illicit behaviour during the examination will be immediately disqualified.");
        $pdf->LN(8);
    
        $pdf->Cell(15);
        $pdf->MultiCellBlt($column_width,6,chr(149),"Exact venue of the examination wil be mailed to the candidate by 10-th Janunary, 2019.");
        $pdf->LN(8);
        list($mtrp, $venue, $class, $id) = explode('/', $roll_no);
        $pdf_path='./allAdmit/'.$mtrp.'_'.$venue.'_'.$class.'_'.$id.'.pdf';
        $pdf->Output($pdf_path,'F');
    }

if(isset($_POST['roll_no'])){
    $roll_no = $_POST['roll_no'];
}


    if(($h=fopen("List2WithSchool.csv", "r"))!=FALSE)
    {
        while($data=fgetcsv($h,1000,","))
        {
            $roll_no=$data[9];
            echo $roll_no.'<br>';
            list($mtrp, $venue, $class, $id) = explode('/', $roll_no);
            $table_name = $venue . "_" . $class;
            $query = 'SELECT * from '. $table_name . ' where ROLL_NO = ' . (int)($id);
            $result = $con->query($query);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) 
                {
                    $id_str = sprintf("%'.04d\n", $row["ROLL_NO"]);
                    //$roll_no = 'MTRP19/'. $venue .'/'.$class.'/'.$id_str;
                    $name = $row["name"];
                    //$email = $row["EMAIL"];
                $school_addr = $row["SCHOOL_ADDR"];
                    //echo $email;
                    $version = $row["LANG_MED"];
                    if($class === 'IX'){
                        $time = "2:00 pm - 4:30 pm";
                        $rep_time = "1:00 pm";
                    }
                    else{
                        $time = "10:00 am - 12:30 pm";
                        $rep_time = "9:00 am";
                    }
                    generate_admit($name,$roll_no,$school_addr, $time, $rep_time, $venue,$version);
                }
            }
        }
    }
    $con->close();
    ?>
    <br>Admits have been generated<<br>
</body>
</html>