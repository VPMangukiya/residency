<?php include_once 'Member_Dashboard.php';
include_once '../Connection.php';

if ($_SESSION['mid'] == "") {
  header("location:../Home.php");
}

$q2 = "select *,count(*) from tbl_maintenance_status MS INNER JOIN tbl_maintenance MN ON MS.mnid = MN.mnid WHERE MS.mid = " . $_SESSION['mid'] . " and MN.year = '" . date('Y')."'";
$sel2 = mysqli_query($conn, $q2);
$data2 = mysqli_fetch_array($sel2);

if (!empty($data2)) {
  if ($data2['count(*)'] == 1) {
    header("Location:Gold_Plan.php");
  }

  if ($data2['count(*)'] == 2) {
    header("Location:Select_Silver.php");
  }
  
  if ($data2['count(*)'] == 3) {
    header("Location:Bronze_Plan.php");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      font-family: Raleway;
    }

    .content {
      margin-left: 400px;
      margin-top: 150px;
      width: 1200px;
    }

    .columns {
      float: left;
      width: 25.3%;
      padding: 8px;
    }

    .price {
      list-style-type: none;
      border: 1px solid #eee;
      margin: 0;
      padding: 0;
      -webkit-transition: 0.3s;
      transition: 0.3s;
    }

    .price:hover {
      box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .price .header {
      background-color: #111;
      color: white;
      font-size: 25px;
    }

    .price li {
      border-bottom: 1px solid #eee;
      padding: 20px;
      text-align: center;
    }

    .price .grey {
      background-color: #eee;
      font-size: 20px;
    }

    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 25px;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
    }

    .alert {
      padding: 20px;
      background-color: #ff9800;
      color: white;
      width: 900px;
      height: fit-content;
    }

    .alert2 {
      padding: 20px;
      background-color: #17a2b8;
      color: white;
      width: 900px;
      height: fit-content;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }

    @media only screen and (max-width: 600px) {
      .columns {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <?php
  $query = "select * from tbl_maintenance where sid = " . $_SESSION['socid'] . " and wing = '" . $_SESSION['wing'] . "' and year = " . date('Y');
  $sel = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($sel);
  
  if(!empty($data))
  {
  ?>

  <div class="content">
    <h2 style="margin-left:310px;"><b>Select your installment</b></h2>
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      <strong>Warning:!</strong> Once you select any plan , it will not be change.
    </div>
    <div class="columns">
      <ul class="price">
        <li class="header" style="background-color:#D2AC47">GOLD</li>
        <li class="grey"> <?php echo $data['dis_12']; ?> &#8377; / year</li>
        <li>12 Months</li>
        <li>1 Installment</li>
        <li class="grey"><a href="Gold_Plan.php" class="button" style="height:50px;">Select</a></li>
      </ul>
    </div>

    <div class="columns">
      <ul class="price">
        <li class="header" style="background-color:#757575">SILVER</li>
        <li class="grey"> <?php echo $data['dis_6']; ?> &#8377; / year</li>
        <li>6 Months</li>
        <li>2 Installments</li>
        <li class="grey"><a href="Select_Silver.php" class="button" style="height:50px;">Select</a></li>
      </ul>
    </div>

    <div class="columns">
      <ul class="price">
        <li class="header" style="background-color:#CD7F32">BRONZE</li>
        <li class="grey"> <?php echo $data['dis_4']; ?> &#8377; / year</li>
        <li>4 Months</li>
        <li>3 Installments</li>
        <li class="grey"><a href="Select_Bronze.php" class="button" style="height:50px;">Select</a></li>

      </ul>

    </div>
  </div>
<?php } 
else{
  echo "<div class='alert2 content'>
    <strong>Notice :</strong> Please wait , to update maintenance amount by your president.
</div>";
}
?>

</body>

</html>