<?php
// session_start();

include_once 'Secretary_Dashboard.php';
include_once '../Connection.php';
include_once '../validation.php';
include_once '../links.php';
$wing = $_SESSION['wing'];
$sid = $_SESSION['socid'];

if ($_SESSION['mid'] == "") {
  header("location:../Home.php");
}
?>

<?php
$q1 = "select count(*) from tbl_maintenance_status MS inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'paid' and M.sid = " .$sid." and M.wing = '".$wing."'";

$q2 = "select count(*) from tbl_maintenance_status MS inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'pending' and M.sid = " .$sid." and M.wing = '".$wing."'";

// SELECT * FROM tbl_maintenance_status MS innerjoin tbl_maintenance M on MS.mnid = M.mnid WHERE M.sid = '" . $_SESSION['socid'] . "' and M.wing = ' " . $_SESSION['wing'] . " '

$fire1 = mysqli_query($conn, $q1);
$fire2 = mysqli_query($conn, $q2);

$res1 = mysqli_fetch_assoc($fire1);
$res2 = mysqli_fetch_assoc($fire2);

$c1 = $res1['count(*)'];
$c2 = $res2['count(*)'];

?>

<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  

  <style>
    body {
      background-color: #f7f2dfe7;
    }

    .MChart {
      margin-left: 350px;
      margin-top: 150px;
    }
  </style>
</head>

<body>
  <div id="piechart_3d" class="MChart" style="width: 900px; height: 500px;"></div>
  <?php echo "['Paid','".$res1['count(*)']."'.]";
        echo $c1; ?>

  <script type="text/javascript">
    google.charts.load("current", {
      packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        // ['Work',     11],
        // ['Eat',      2],
        // ['Commute',  2],
        // ['Watch TV', 2],
        // ['Sleep',    7]
        <?php
            echo "['Paid','".$c1."'],";
            echo "['Unpaid','".$c2."'],";
        ?>
      ]);

      var options = {
        title: 'My Daily Activities',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);


    }
  </script>  
</body>

</html>