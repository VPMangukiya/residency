<?php 
    // session_start();
    include_once '../Connection.php';
    include_once 'Secretary_Dashboard.php';
    include_once '../validation.php';
    if($_SESSION['mid'] == "")
    {
        header("location:../home.php");
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="../css/logincss.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">

  <style>
    body {
      background-color: #f7f2dfe7;
    }
  </style>
</head>
<body>


  <?php 
        $error = "";
        $operror = "";
        $nperror = "";
        $errRes = false;

        if(isset($_REQUEST['nPassword']))
        {
            $op = $_REQUEST['opass'];
            $np = $_REQUEST['npass'];

            // $np = $_REQUEST['npass'];

            if(empty($_REQUEST['npass']) || empty($_REQUEST['opass']))
            {
                $error = "All Field Must Be Entered!!!";
                $errRes = true;
            }
            else
            {
                if(md5($op) != $_SESSION['mpass'])
                {
                  $operror = "Password Not Match!!!";
                  $errRes = true;
                }

                if(pass($np))
                {
                  $nperror = "New password must be consist of Uppercase letter,number and special character!!!";
                  $errRes = true;
                }

                if($errRes == true)
                {
                  goto start;
                }

                  $q = "update tbl_member set password = md5('$np') where mid=".$_SESSION['mid'];
                  mysqli_query($conn, $q);  
                  echo '<script>alert("Password Updated Successfully!!!");</script>';
            }
        }

  start:      
  ?>

<form id="regForm" action="" method="POST" style="margin-top: 150px; margin-left: 500px;">
    <h1><b style="color:#f0a73a;">CHANGE PASSWORD</b></h1>
    <div class="tab">OLD PASSWORD:
      <p><input type="password" placeholder="Enter Old Password..." name="opass" ></p>
    </div>
    <span style="color: red;"><?php echo $operror; ?></span>    
    <div class="tab">NEW PASSWORD:
      <p><input type="password" placeholder="Enter New Password..." name="npass" ></p>
    </div>
    <span style="color: red;"><?php echo $nperror; ?><?php echo $error; ?></span>
    <div style="overflow:auto;">
      <div style="float:right;">
        <input type="submit" value="Submit" name="nPassword">
      </div>
    </div>
  </form>


</body>
</html>
