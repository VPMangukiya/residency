<?php
session_start();
include_once '../Connection.php';
require('../fpdf182/fpdf.php');


if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
}

$sid = $_SESSION['socid'];

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../Image/logo.png', 15, 4, 60);
        $this->SetFont('Arial', 'B', 13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80, 10, 'Maintenance Report', 1, 0, 'C');
        
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// $db = new dbObj();
// $connString =  $db->getConnstring();
$display_heading = array('mname' => 'NAME', 'phone' => 'PHONE', 'wing' => 'WING', 'flat' => 'FLAT',);

$result = mysqli_query($conn, "select P.mname,P.phone,P.wing,P.flat from tbl_member P inner join tbl_maintenance_status MS on MS.mid = P.mid inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'paid' and M.sid = " . $sid) or die("database error:" . mysqli_error($conn));

$result1 = mysqli_query($conn, "select P.mname,P.phone,P.wing,P.flat from tbl_member P inner join tbl_maintenance_status MS on MS.mid = P.mid inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'pending' and M.sid = " . $sid) or die("database error:" . mysqli_error($conn));

$header = array("Number","Name","Phone","Wing","Flat");


// select p.name_mname,p.name_phone,p.name_wing,p.name_flat from tbl_member P inner join tbl_maintenance_status MS on MS.mid = p.mid;
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln(20);
$pdf->Cell(80, 10, 'Paid Users', 1, 0, 'C');
$pdf->Ln(20);

foreach ($header as $heading) {
    $pdf->Cell(38, 12, $heading, 1);
}

$i=1;
foreach ($result as $row) {
    $pdf->Ln();
    $pdf->Cell(38, 12, $i, 1);

    foreach ($row as $column)
    {    $pdf->Cell(38, 12, $column, 1); }
    $i++;
}

$pdf->Ln(40);
$pdf->Cell(80, 10, 'Unpaid Users', 1, 0, 'C');
$pdf->Ln(20);

foreach ($header as $heading) {
    $pdf->Cell(38, 12, $heading, 1);
}

$i=1;
foreach ($result1 as $row) {
    $pdf->Ln();
    $pdf->Cell(38, 12, $i, 1);

    foreach ($row as $column)
    {    $pdf->Cell(38, 12, $column, 1); }
    $i++;
}

$pdf->Output();
?>