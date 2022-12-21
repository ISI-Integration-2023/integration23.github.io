<?php
//ini_set('error_reporting', E_ALL);
include_once('./config.php');
require_once( $ROOT_PATH.'/Model/mathdata_model_offline.php');
//require_once($ROOT_PATH.'/Model/mathdata_model2.php');
require_once( $ROOT_PATH.'/DAL/mathdata_dal_offline.php');
require_once( $ROOT_PATH.'/pdf.php');
//require_once($ROOT_PATH.'/Utility/pdf.php');
session_start();

//require_once('connect.php');
function generate_admit_offline($student)//,$name, $roll_no, $school_addr, $time, $rep_time, $venue, $ver)
{	
	$name=$student->name;
	$class = ($student->student_class=='9')?'IX':'XI';
	$school_addr = $student->institution;
	if($class === 'IX'){
            $time = "2:00 pm - 4:30 pm";
            $rep_time = "1:00 pm";
        }
        else{
            $time = "10:00 am - 12:30 pm";
            $rep_time = "9:00 am";
        }
	$ver = $student->medium;
	$venue = $student->exam_zone;
    $venue_name = '';
    if($venue == 'Kolkata-S'){
        $venue_name = 'Ramakrishna Mission Residential College, Narendrapur KMA Main Road, Narendrapur, Kolkata-700103';$zone="S";
    }
    elseif($venue == 'Kolkata-N'){
        $venue_name = 'Ramkrishna Mission Shilpapitha, Ramkrishna Mission Road, Jatindas Nagar, Belghoria, Kolkata - 700056';$zone="N";
    }
    elseif($venue == 'Durgapur'){
        $venue_name = 'DAV MODEL School, JM Sengupta Road, Durgapur - 713205';$zone="D";
    }
    elseif($venue == 'Choose...'){
        $venue_name = 'ERROR';$zone="S";
    }
    else{
        $venue_name = 'ERROR';$zone="F";
    }
	$id_str = sprintf("%'.04d\n", 1000+$student->studentid);
	$roll_no = '20'.$zone.'/'.$class.'/'.$id_str;

    $pdf = new PDF('P','mm','A4');
    $pdf->SetTitle("Admit-Card-SUM-IT-2020");//echo 12;AAAA;
    $pdf->AddPage();
    $pdf->SetFont('Times','B',20);
    $pdf->Cell(80);
    $pdf->Cell(30,10,'INTEGRATION 2020',0,1,'C');
    $pdf->LN(1);
    $pdf->Image('./AppData/Images/Integration_logo.png',95,null,20,20);
    $pdf->LN(1);
    $pdf->Image('./AppData/Images/oxford_logo.jpg',85,null,40,20);
    if($ver === 'Bengali'){
        $pdf->Image('./AppData/Images/B.png',180,40,20,20);
    }
    else{
        $pdf->Image('./AppData/Images/E.png',180,40,20,20);
    }
    //echo "Success";//////////////////////////////
    $pdf->LN(5);
    $pdf->Image('./AppData/Images/sum-it-logo.png',80,null,48,20);
    $pdf->LN(1);
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(80);
    $pdf->Cell(30,10,'S U M - I T  2 0 2 0',0,1,'C');//////////////////////////////////
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
    $pdf->Cell(40,10,"Category ",0,0,'L');
    $pdf->Cell(2,10,": ",0,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(50,10,'Class '.$class,0,0,'L');
    $pdf->LN(10);

    $pdf->Cell(20);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,6,"School ",0,0,'L');
    $pdf->Cell(2,6,": ",0,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,6,$school_addr,0,'L',0);
    $pdf->LN(4);

    $pdf->Cell(20);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,10,"Roll Number ",0,0,'L');
    $pdf->Cell(2,10,": ",0,0,'C');
    $pdf->Cell(50,10,$roll_no,0,0,'L');
    $pdf->LN(8);

    $pdf->Cell(20);
    $pdf->Cell(40,10,"Date of Exam ",0,0,'L');
    $pdf->Cell(2,10,": ",0,0,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(50,10,"19th January, 2020",0,0,'L');
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
    $pdf->MultiCellBlt($column_width,6,chr(149),"All students must carry one <b>Photo Identity Proof</b>.");
    $pdf->LN(8);

    $pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"All students should reach the venue as per the mentioned reporting time so that they can go through the entire registration validation process without any difficulty.");
    $pdf->LN(8);


    $pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"All students should carry with them this <b>ADMIT CARD</b>.");// as well as the <b>Ticket</b> sent to their email.");
    $pdf->LN(8);

    $pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"Each student will be given a seat no. and volunteers will guide them to the corresponding rooms for the examination.");
    $pdf->LN(8);

    $pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"It is <b>NOT</b> necessary for the students to come in School Uniform.");
    $pdf->LN(8);

    /*$pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"For students opted for Kolkata center, parking facilities cannot be availed inside the ISI campus.");
    $pdf->LN(8);*/

    $pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"Any student found to indulge in unfair means or illicit behaviour during the examination will be immediately disqualified.");
    $pdf->LN(8);

    /*$pdf->Cell(15);
    $pdf->MultiCellBlt($column_width,6,chr(149),"Exact venue of the examination wil be mailed to the candidate by 10-th Janunary, 2019.");
    $pdf->LN(8);*/

    $pdf->Output('I','SUM-IT_ADMIT.pdf');
}
/*
if(isset($_POST['roll_no'])){
    $roll_no = $_POST['roll_no'];
}
else if(isset($_SESSION['roll_no'])){
    $roll_no = $_SESSION['roll_no'];
}
if(empty($roll_no))
{
   header('location:error.php?code=4');
}

list($mtrp, $venue, $class, $id) = explode('/', $roll_no);
$table_name = $venue . "_" . $class;
$query = 'SELECT * from '. $table_name . ' where ROLL_NO = ' . (int)($id);
//echo $query;
$result = $con->query($query);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()) 
    {
        $id_str = sprintf("%'.04d\n", $row["ROLL_NO"]);
        $roll_no = 'MTRP19/'. $venue .'/'.$class.'/'.$id_str;
        $name = $row["name"];
        //$email = $row["EMAIL"];
	$school_addr = $row["SCHOOL_ADDR"];
        echo $email;
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
else{

    echo "Input Roll Number is Invalid! Please check and retry again!";
}
$con->close();
//session_unset();
//session_destroy();*/
/*$obj=new mathdata_model_admit();
$obj->studentid =  1;
            $obj->firstname =  'a';
            $obj->lastname =  'b';
            $obj->date_of_birth = 'c';
            $obj->institution = $row['institution'];
            //$obj->phone1 =  $row['phone1'];
            //$obj->phone2 =  $row['phone2'];
            //$obj->email =  $row['email'];
            $obj->student_class = '9';
            $obj->medium = 'Bengali';
            $obj->exam_zone = 'Kolkata-S';
            //$obj->book = $row['book'];
            //$obj->guard_name = $row['guard_name'];
            //$obj->address = $row['address'];
		//$obj->pay = $row['pay'];
	//echo $obj->pay;
	generate_admit($obj);echo "1";*/
$id='0';
if(isset($_SESSION['ide'])){
    $id = $_SESSION['ide'];
}
/*echo 1;
echo $email;
echo $date_of_birth;*/
//echo $pay;
$mathdata=new mathdata_model_offline();
if($id!='0')
{
	$dalobj = new mathdata_dal_offline();

                $sql = "studentid = '".$id."'";
                $mathdata = $dalobj->getDatasForAdmit($sql);
		//echo 23;
                if (count($mathdata) < 1) {
                        $res = 0;header('Location:https://www.isical.ac.in/~integration/math.php');
                }
                else {
                        $mathdata = reset($mathdata);
			$allow = $mathdata->allow;
			if($allow=='0'){//echo 234;
			//session_start();$_SESSION['email']=$mathdata->email;$_SESSION['date_of_birth']=$mathdata->date_of_birth;$_SESSION['mode']='admit';
				//var_dump($mathdata);//$mathdata->institution;
				generate_admit_offline($mathdata);session_destroy();//$res=1;
			}else{
				header('Location:https://www.isical.ac.in/~integration/math.php');
				}
		}
}
else{
	//session_destroy();
	header('Location:https://www.isical.ac.in/~integration/math.php');
}
?>
