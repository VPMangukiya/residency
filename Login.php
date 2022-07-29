<?php session_start();
include_once 'Connection.php';
include_once 'Header.php';
include_once 'Footer.php';

if (!empty($_SESSION['mid'])) {
  $mt = $_SESSION["mbType"];
  // echo $mt;
  // header("location:Member_Dashboard.php");
  // echo '<script>alert("Success");</script>';

  if ($mt == "Member") {
    header("location:Member/Member_Dashboard.php");
  } elseif ($mt == "Secretary") {
    header("location:Secretary/Secretary_Dashboard.php");
  } elseif ($mt == "President") {
    header("location:President/President_Dashboard.php");
  } elseif ($mt == "Spresident") {
    header("location:SubPresident/SPresident_Dashboard.php");
  } elseif ($mt == "Guard") {
    header("location:Guard/Guard_Dashboard.php");
  } else {
    header("location:Home.php");
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="css/logincss.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
  <?php
  $err = "";
  if (isset($_REQUEST['btnLogin'])) {

    if (!empty($_SESSION['mid'])) {
      $err = "Already one user is logged in.";
    } else {

      $usr = $_POST["email"];
      $pas = $_POST["pwd"];
      $sql = "select count(*) from tbl_member where email ='$usr' and password=md5('$pas') and is_approved='Approved' ";
      $result = mysqli_query($conn, $sql);
      $rows = mysqli_fetch_array($result);

      if ($rows["count(*)"] > 0) {

        $sql = "select * from tbl_member where email ='$usr' and password=md5('$pas')";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_array($result);

        $_SESSION["mid"] = $rows["mid"];
        $_SESSION["mbType"] = $rows["member_type"];
        $_SESSION["mpass"] = $rows['password'];
        $_SESSION['mname'] = $rows['mname'];
        $_SESSION['uimg'] = $rows['image'];
        $_SESSION['wing'] = $rows['wing'];
        $_SESSION['socid'] = $rows['sid'];
        $_SESSION['flat'] = $rows['flat'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['phone'] = $rows['phone'];


        // header("location:Check_Multilogin.php");
        $mt = $rows["member_type"];
        // echo $mt;
        // header("location:Member_Dashboard.php");
        // echo '<script>alert("Success");</script>';

        if ($mt == "Member") {
          header("location:Member/Member_Dashboard.php");
        } elseif ($mt == "Secretary") {
          header("location:Secretary/Secretary_Dashboard.php");
        } elseif ($mt == "President") {
          header("location:President/President_Dashboard.php");
        } elseif ($mt == "Spresident") {
          header("location:SubPresident/SPresident_Dashboard.php");
        } elseif ($mt == "Guard") {
          header("location:Guard/Guard_Dashboard.php");
        } else {
          header("location:Home.php");
        }
      } else {
        $err = "Invalid username or password!";
      }
    }
  }
  ?>
  <form id="lgForm" action="" method="POST">
    <h1><b style="color:#35cebe;">LOGIN</b></h1>
    <div class="tab">USER ID:
      <p><input type="email" placeholder="Enter email..." oninput="this.className = ''" name="email" id="user"></p>
    </div>
    <div class="tab">PASSWORD:
      <p><input type="password" placeholder="Enter Password...." oninput="this.className = ''" name="pwd" id="pass"></p>
    </div>
    <span style="color: red;"><?php echo $err; ?></span>
    <div style="overflow:auto;">
      <div style="float:right;">
        <input type="submit" value="Login" onclick="next()" name="btnLogin" style="background-color:#35cebe; color:#ffffff;">
      </div>
    </div>
    <a href="Forgot_Password.php">Forgot Password?</a>
  </form>

  <script>
    function next() {
      var inp = document.getElementsByTagName("input");
      // var y = document.getElementById("user");

      var i;
      for (i = 0; i < inp.length; i++) {
        if (inp[i].value == "") {
          inp[i].classList.add("invalid");
        }
      }
    }
  </script>

</body>

</html>
<?php ob_flush(); ?>