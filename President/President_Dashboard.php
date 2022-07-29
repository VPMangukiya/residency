<?php
session_start();
include_once '../links.php';

if ($_SESSION['mid'] == "") {
	header("location:../Home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>President Dashboard</title>

	<!-- Google Fonts -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet"> -->

	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<style>
		*{
			font-family:Raleway;
		}
	</style>

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
	<div class="navbar">
		<div class="row">
			<div class="column column-30 col-site-title"><a href="#" class="site-title float-left">Dashboard</a></div>
			<!-- <div class="column column-30 col-site-title"><a href="#" class="site-title float-right	">Dashboard</a></div> -->


			<div class="column column-15" id="user">
				<div class="user-section"><a href="#">
						<img src="../Image/user/<?php echo $_SESSION['uimg']; ?>" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						<div class="username">
							<h4><?php echo $_SESSION['mname']; ?></h4>
							<p>President</p>
						</div>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div id="sidebar" class="column">

			<a href="#" id="d1">
				<h5>President Features &nbsp;&nbsp;&nbsp;&nbsp; ></h5>
			</a>
			<ul>
				<li class="PF"><a href="<?php echo $PreDash; ?>"><em class="fa fa-home"></em> Home</a></li>
				<li class="PF"><a href="AM.php"><em class="fa fa-user-plus"></em>Add Member</a></li>
				<li class="PF"><a href="Add_Committee.php"><em class="fa fa-users"></em>Add Committee</a></li>
				<li class="PF"><a href="Send_Notice.php"><em class="fa fa-bell"></em> Send Notice</a></li>
				<li class="PF"><a href="Manage_Guard.php"><em class="fa fa-shield"></em> Manage Guard</a></li>
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