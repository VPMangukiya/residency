<?php
session_start();

include_once '../Connection.php';
include_once '../links.php';


if ($_SESSION['mid'] == "") {
	header("location:../Home.php");
}

$q = "select * from tbl_maintenance where sid = " . $_SESSION['socid'] . " and year = " . date("Y");
$sel = mysqli_query($conn, $q);
$data = mysqli_fetch_array($sel);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Secretary Dashboard</title>

	<link rel="stylesheet" href="../css/logincss.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<style>
		* {
			font-family: Raleway;
		}
	</style>

</head>

<body>
	<div class="navbar">
		<div class="row">
			<div class="column column-30 col-site-title"><a href="#" class="site-title float-left">Dashboard</a></div>

			<div class="column column-15" id="user">
				<div class="user-section"><a href="#">
						<img src="../Image/user/<?php echo $_SESSION['uimg']; ?>" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						<div class="username">
							<h4><?php echo $_SESSION['mname']; ?></h4>
							<p>Secretary</p>
						</div>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div id="sidebar" class="column">
			<a href="#" id="d1">
				<h5>Secretary Features &nbsp;&nbsp;&nbsp; ></h5>
			</a>
			<ul>
				<li class="PF"><a href="Secretary_Dashboard.php"><em class="fa fa-home"></em> Home</a></li>
				<?php if (empty($data['mnid'])) { ?>
				<li class="PF"><a href="Manage_Maintenance.php"><em class="fa fa-wrench"></em>Manage Maintenance</a></li><?php } ?>
				<li class="PF"><a href="Manage_Expense.php"><em class="fa fa-money"></em>Manage Expenses</a></li>
				<li class="PF"><a href="Service_Provider.php"><em class="fa fa-user-plus"></em> Add Service Provider</a></li>
				<li class="PF"><a href="Maintenance_Report.php"><em class="fa fa-file"></em> Maintenance Report</a></li>
			</ul>
			<a href="#" id="d2">
				<h5>Member Features &nbsp;&nbsp;&nbsp;&nbsp; ></h5>
			</a>
			<ul>
				<li class="MF"><a href="Member_Profile.php"><em class="fa fa-user"></em> Profile</a></li>
				<li class="MF"><a href="Generate_Gatepass.php"><em class="fa fa-ticket"></em>Generate Gatepass</a></li>
				<li class="MF"><a href="Address_Book.php"><em class="fa fa-address-card"></em> Address Book</a></li>
				<li class="MF"><a href="View_Guards.php"><em class="fa fa-shield"></em> View Guard</a></li>
				<li class="MF"><a href="Visitor_Entry.php"><em class="fa fa-ban"></em> Manage Visitor Entry</a></li>
				<li class="MF"><a href="View_Visitor.php"><em class="fa fa-eye"></em> View Visitor</a></li>
				<li class="MF"><a href="Pay_Maintenance.php"><em class="fa fa-wrench"></em> Pay Maintenance</a></li>
				<li class="MF"><a href="New_Password.php"><em class="fa fa-lock"></em> Change Password</a></li>
				<li><a href="<?php echo $LogOut; ?>"><em class="fa fa-sign-out"></em> Logout </a></li>
			</ul>
		</div>
	</div>


	<script>
		$(document).ready(function() {
			$( ".MF" ).toggle('slow');

			$( "#d1" ).click(function() {
				$( ".PF" ).toggle('slow');
				$( ".MF" ).hide('slow');
			});

			$( "#d2" ).click(function() {
				$( ".MF" ).toggle('slow');
				$( ".PF" ).hide('slow');
			});
		});
	</script>


</body>

</html>