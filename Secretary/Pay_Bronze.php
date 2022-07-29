<?php
session_start();
include_once '../Connection.php';
// include_once 'Member_Dashboard.php';
require('../fpdf182/fpdf.php');

// if ($_SESSION['mid'] == '') {
//     header("location:../Home.php");
// }

$q1 = "select count(*) from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid where MS.mid = " . $_SESSION['mid'] . " and MN.year = '" . date('Y') . "' and MS.status = 'Paid' and MS.installment = ".$_SESSION['inst'];
$sel1 = mysqli_query($conn, $q1);
$data1 = mysqli_fetch_array($sel1);


if ($data1['count(*)'] == '0') {
    // echo  $_SESSION['mid'];
    $q = "update tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid set MS.payment_id = '" . $_POST['razorpay_payment_id'] . "' , MS.status = 'Paid' , datetime = CURRENT_TIMESTAMP where MS.mid = " . $_SESSION['mid'] ." and  MN.year = '".date('Y')."' and installment = ".$_SESSION['inst'];
    mysqli_query($conn, $q);

    echo "<script>location.reload();</script>";
    $q1 = "select MS.installment,MS.payment_id,MS.datetime,M.mname,MN.dis_4,S.sname from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid INNER JOIN tbl_Member M ON MS.mid = M.mid INNER JOIN tbl_society S ON MN.sid = S.sid WHERE MS.mid = " . $_SESSION['mid']." and  MN.year = '".date('Y')."' and installment = ".$_SESSION['inst'];
    $sel = mysqli_query($conn, $q1);
    $data_member = mysqli_fetch_array($sel);

    // echo $data_member['installment'];


    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 25);

    $pdf->Cell(190, 30, 'Maintenance Receipt 1', 1, 1, 'C');
    $pdf->Cell(90, 20, 'Name                  : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["mname"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Payment Id         : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["payment_id"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Date                    : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["datetime"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Installment No.    : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["installment"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Amount                : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["dis_4"], 0, 1, 'C');

    $pdf->Ln(50);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Regards,', 0, 1, 'C');

    $pdf->Ln(5);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Secretary', 0, 1, 'C');

    $pdf->Ln(5);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, ''.$data_member['sname'], 0, 1, 'C');

    $pdf->Ln(30);
    $pdf->Cell(190, 30, 'MY SOCIETY', 0, 1, 'C');

    // $fname = $_SESSION['mid']."2".date('Y    ')
    $pdf->Output();
} else {
    $q1 = "select MS.installment,MS.payment_id,MS.datetime,M.mname,MN.dis_4,S.sname from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid INNER JOIN tbl_Member M ON MS.mid = M.mid INNER JOIN tbl_society S ON MN.sid = S.sid WHERE MS.mid = " . $_SESSION['mid']." and  MN.year = '".date('Y')."' and installment = ".$_SESSION['inst'];
    $sel = mysqli_query($conn, $q1);
    $data_member = mysqli_fetch_array($sel);


    // echo $data_member['installment'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 25);

    $pdf->Cell(190, 30, 'Maintenance Receipt', 1, 1, 'C');
    $pdf->Cell(90, 20, 'Name                  : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["mname"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Payment Id         : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["payment_id"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Date                    : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["datetime"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Installment No.    : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["installment"], 0, 1, 'C');

    $pdf->Cell(90, 20, 'Amount                : ', 0, 0, 'C');
    $pdf->Cell(90, 20, ''.$data_member["dis_4"], 0, 1, 'C');

    $pdf->Ln(50);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Regards,', 0, 1, 'C');

    $pdf->Ln(5);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, 'Secretary', 0, 1, 'C');

    $pdf->Ln(5);
    $pdf->Cell(140, 5, '', 0, 0);
    $pdf->Cell(50, 5, ''.$data_member['sname'], 0, 1, 'C');

    $pdf->Ln(30);
    $pdf->Cell(190, 30, 'MY SOCIETY', 0, 1, 'C');

    $pdf->Output();
}
