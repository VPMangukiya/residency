<?php 
	session_start();
	include_once '../links.php';

	if($_SESSION['mid'] == "")
	{
		header("location:../Home.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Member Dashboard</title>
	
	<!-- Google Fonts -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet"> -->
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">
	
	<style>
		.column-30{
			padding: 0px;
		}

		.column-15{
			padding: 0px;
		}

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
		
			<div class="column column-15 col-site-title"><a href="#" class="site-title float-left">Dashboard</a></div>
			<!-- <div class="column column-30 col-site-title"><a href="#" class="site-title float-right	">Dashboard</a></div> -->
			<!-- <div class="column column-15 " id="btn" style="margin-right: 100px; float: left;">
				<button class="fa fa-bell" type="button" id="btnSh_Notice" data-toggle="modal" data-target="#exampleModal" style="margin-left: 0px;"></button>
			</div>	 -->



			<div class="column column-30" id="user">
				<div class="user-section" style="margin-top: -50px; "><a href="#">
					<img src="../Image/user/<?php echo $_SESSION['uimg']; ?>" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
					<div class="username">
						<h4><?php echo $_SESSION['mname']; ?></h4>
						<p>Member</p>
					</div>
				</div>
			</div>
	


		</div>
		
	</div>
	<div class="row">
		<div id="sidebar" class="column">
			<h5>Navigation</h5>
			<ul>
				<li><a href="Member_Dashboard.php"><em class="fa fa-home"></em> Home</a></li>
				<li><a href="Member_Profile.php"><em class="fa fa-user"></em> Profile</a></li>
				<li><a href="Generate_Gatepass.php"><em class="fa fa-ticket"></em>Generate Gatepass</a></li>
				<li><a href="View_Notice.php"><em class="fa fa fa-bell"></em>View Notice</a></li>
				<li><a href="Address_Book.php"><em class="fa fa-address-card"></em> Address Book</a></li>
				<li><a href="View_Guards.php"><em class="fa fa-shield"></em> View Guard</a></li>
				<li><a href="Visitor_Entry.php"><em class="fa fa-ban"></em> Manage Visitor Entry</a></li>
				<li><a href="View_Visitor.php"><em class="fa fa-eye"></em> View Visitor</a></li>
				<li><a href="Pay_Maintenance.php"><em class="fa fa-wrench"></em> Pay Maintenance</a></li>
				<li><a href="<?php echo $LogOut; ?>"><em class="fa fa-sign-out"></em> Logout </a></li>

			</ul>
		</div>
	</div>

	
<script>
if(document.referrer.includes("Member_Profile"))
{
	// toastr.success('Profile Edited Successfully.');
}

// if(document.referrer.includes("Generate_Gatepass"))
// {
// 	toastr.success('Gatepass Genertaed Successfully.');
// }
</script>
					
</body>
</html> 