<?php 
ob_start();
include_once 'Member_Dashboard.php';
include_once '../Connection.php';

if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
}

// $_SESSION['inst'] == $_POST['inst'];
$apiKey = "rzp_test_fDhgTi2arCRG5o";

$q1 = "select * from tbl_maintenance where sid = " . $_SESSION['socid'] . " and year = '" . date('Y') . "' and wing = '" . $_SESSION['wing'] . "'";
$sel1 = mysqli_query($conn, $q1);
$data1 = mysqli_fetch_array($sel1);

$q2 = "select * from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid WHERE MS.mid = " . $_SESSION['mid'] . " and MN.year = " . date('Y');
$sel2 = mysqli_query($conn, $q2);
$data2 = mysqli_fetch_array($sel2);

$q3 = "select * from tbl_maintenance where sid = ".$_SESSION['socid'] . " and year = ".date('Y');
$sel3 = mysqli_query($conn,$q3);
$data3 = mysqli_fetch_array($sel3);

$q4 = "select * from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid where mid = ".$_SESSION['mid'] . " and MN.year = ".date('Y')." and MS.status = 'Paid' and installment = ".$_POST['inst'];
$sel4 = mysqli_query($conn,$q4);
$data4 = mysqli_fetch_array($sel4);

$_SESSION['inst'] = $_POST['inst'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Maintenance</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<style>
    .razorpay-payment-button { display: none; }
</style>
</head>
<body>
<?php
if(empty($data4))
{

    if (empty($data2)) {
        $q3 = "insert into tbl_maintenance_status (mnid,mid,installment) values (" . $data1['mnid'] . "," . $_SESSION['mid'] . ",1);"."insert into tbl_maintenance_status (mnid,mid,installment) values (" . $data1['mnid'] . "," . $_SESSION['mid'] . ",2);";

        $ins = mysqli_multi_query($conn, $q3); ?>

        <!-- header("location:pay_gold.php"); -->
        <!-- <body> -->

        <form action="Pay_Silver.php" method="POST">
        <input type="hidden" value="<?php echo $_POST['inst']; ?>" name="inst"> 
        <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $apiKey; ?>"  //Enter the Test API Key ID generated from Dashboard → Settings → API Keys
        data-amount="<?php echo $data3['dis_6'] * 100;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
        data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
        data-id="<?php echo 'OID'.rand(10,100).'END';?>"//Replace with the order_id generated by you in the backend.
        data-buttontext="Pay with Razorpay"
        data-name="My Society"
        data-description="Maintenance Collection"
        data-image="../Image/logo.png"
        data-prefill.name="<?php echo $_SESSION['mname'];?>"
        data-prefill.email="<?php echo $_SESSION['email'];?>"
        data-prefill.contact="<?php echo $_SESSION['phone'];?>"
        data-theme.color="#F37254"
        ></script>
        </form>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.razorpay-payment-button').click();
            });
        </script>
        <!-- </body> -->
    <?php } 
    else{ ?>
        <!-- header("location:pay_gold.php"); -->
        <!-- <body> -->

        <form action="Pay_Silver.php" method="POST">
        <input type="hidden" value="<?php echo $_POST['inst']; ?>" name="inst"> 
        <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $apiKey; ?>"  //Enter the Test API Key ID generated from Dashboard → Settings → API Keys
        data-amount="<?php echo $data3['dis_6'] * 100;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
        data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
        data-id="<?php echo 'OID'.rand(10,100).'END';?>"//Replace with the order_id generated by you in the backend.
        data-buttontext="Pay with Razorpay"
        data-name="My Society"
        data-description="Maintenance Collection"
        data-image="../Image/logo.png"
        data-prefill.name="<?php echo $_SESSION['mname'];?>"
        data-prefill.email="<?php echo $_SESSION['email'];?>"
        data-prefill.contact="<?php echo $_SESSION['phone'];?>"
        data-theme.color="#F37254"
        ></script>
        </form>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.razorpay-payment-button').click();
            });
        </script>
    <!-- </body> -->
<?php }}
else
{ ?>
    <input type="hidden" value="1" name="inst">
    <!-- $_SESSION[] -->
    <script>location.reload();</script>
    <?php header("location:Pay_Silver.php");
}
 ?>



</body>
<?php ob_flush();?>