<?php
//SQL to get 10 records

require "connection.php";
require "fpdf/fpdf.php";

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images/Copy of s2.jpg',10,10,-550);
    // Arial bold 15
    $this->Ln(13);
   
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$Counter_Part_Pdf = $_POST['Counter_Part_Pdf'];
$Date1 = $_POST['From_Date'];
$Date2 = $_POST['To_Date'];

$count="SELECT Speedway_No,date_format(Date,'%d-%m-%Y') AS Date, Country, Destination, To_Name, Service, Weight, Service_Fee, Tracking_Website FROM speedway WHERE Counter_Part = '$Counter_Part_Pdf' AND Date BETWEEN '$Date1' AND '$Date2' ";
$pdf = new PDF(); 
$pdf->AliasNbPages();
$pdf->AddPage('l');

$width_cell=array(15,20,28,30,70,35,20,25,35);
$pdf->SetFont('Arial','',13);
$pdf->Cell(0,12,'Counter Part : '.$_POST['Counter_Part_Pdf'],0,0,'L');
$pdf->Cell(-28,12,'Date : '.$_POST['From_Date'],0,0,'R');
$pdf->Cell(0,12,'- '.$_POST['To_Date'],0,1,'R');

$pdf->SetFont('Arial','B',11);

//Background color of header//
$pdf->SetFillColor(230,230,230);
//193,229,252
// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0],10,'No',1,0,'C',true);
//Second header column//
$pdf->Cell($width_cell[1],10,'Date',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[2],10,'Country',1,0,'C',true); 
//Fourth header column//
$pdf->Cell($width_cell[3],10,'Destination',1,0,'C',true);
//Third header column//
$pdf->Cell($width_cell[4],10,'To Name',1,0,'C',true);
$pdf->Cell($width_cell[5],10,'Service',1,0,'C',true);
$pdf->Cell($width_cell[6],10,'Weight',1,0,'C',true);
$pdf->Cell($width_cell[7],10,'Service Fee',1,0,'C',true);
$pdf->Cell($width_cell[8],10,'Airway Bill No.',1,1,'C',true);

//// header ends ///////

$pdf->SetFont('Arial','',9);
//Background color of header//
$pdf->SetFillColor(235,236,236); 
//to give alternate background fill color to rows// 
$fill=false;

/// each record is one row  ///
foreach ($link->query($count) as $row) {
$pdf->Cell($width_cell[0],10,$row['Speedway_No'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,$row['Date'],1,0,'C',$fill);
$pdf->Cell($width_cell[2],10,$row['Country'],1,0,'C',$fill);
$pdf->Cell($width_cell[3],10,$row['Destination'],1,0,'C',$fill);
$pdf->Cell($width_cell[4],10,$row['To_Name'],1,0,'C',$fill);
$pdf->Cell($width_cell[5],10,$row['Service'],1,0,'C',$fill);
$pdf->Cell($width_cell[6],10,$row['Weight'],1,0,'C',$fill);
$pdf->Cell($width_cell[7],10, number_format($row['Service_Fee'],2),1,0,'C',$fill);
$pdf->Cell($width_cell[8],10,$row['Tracking_Website'],1,1,'C',$fill);

//to give alternate background fill  color to rows//
$fill = !$fill;
}
/// end of records /// 

$pdf->Output();
?>