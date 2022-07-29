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

$q1 = "select P.mname,P.flat,P.phone,P.wing from tbl_member P inner join tbl_maintenance_status MS on MS.mid = P.mid inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'paid' and M.sid = " .$sid;
// $q1 = "select count(*) from tbl_maintenance_status MS inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'paid' and M.sid = " .$sid." and M.wing = '".$wing."'";

$q2 = "select P.mname,P.flat,P.phone,P.wing from tbl_member P inner join tbl_maintenance_status MS on MS.mid = P.mid inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'pending' and M.sid = " .$sid;
// $q2 = "select count(*) from tbl_maintenance_status MS inner join tbl_maintenance M on MS.mnid = M.mnid where MS.status = 'pending' and M.sid = " .$sid;

$fire1 = mysqli_query($conn, $q1);
$fire2 = mysqli_query($conn, $q2);

// $res1 = mysqli_fetch_assoc($fire1);
// $res2 = mysqli_fetch_assoc($fire2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <!-- datatable cdn -->
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <style>
        #tbl {
            margin-left: 300px;
            margin-top: 5px;
            width:  600px;
        }

        #tbl2 {
            margin-left: 900px;
            margin-top: -405px;
            width:  600px;
        }

        #sidebar {
            margin-top: 0px;
        }

        body {
             background-color: #f7f2dfe7;
        }

        #user{
            margin-top: -40px;
        }
    </style>

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/milligram.min.css">
    <!-- <link rel="stylesheet" href="../css/styles.css"> -->
    
</head>

<body>
        <div class="row grid-responsive" id="tbl">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h3 id="title">Paid Users</h3>
                    </div>
                    <div class="card-block">
                        <table id="UserTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding-left: 5px;">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Wing</th>
                                    <th>Flat</th>
                                </tr>
                            </thead>
                            
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while ($res1 = mysqli_fetch_array($fire1)) {
                                    ?>
                                    <tr>
                                        <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
                                        <td><?php echo $res1['mname']; ?></td>
                                        <td><?php echo $res1['phone']; ?></td>
                                        <td><?php echo $res1['wing']; ?></td>
                                        <td><?php echo $res1['flat']; ?></td>
                                    <?php $i++;
                                } ?>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </tbody>

        <div class="row grid-responsive" id="tbl2">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h3 id="title">Unpaid Users</h3>
                    </div>
                    <div class="card-block">
                        <table id="UserTable2">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding-left: 5px;">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Wing</th>
                                    <th>Flat</th>
                                </tr>
                            </thead>
                            
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while ($res2 = mysqli_fetch_array($fire2)) {
                                    ?>
                                    <tr>
                                        <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
                                        <td><?php echo $res2['mname']; ?></td>
                                        <td><?php echo $res2['phone']; ?></td>
                                        <td><?php echo $res2['wing']; ?></td>
                                        <td><?php echo $res2['flat']; ?></td>
                                    <?php $i++;
                                } ?>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </tbody>

        <form action="MN_Report_PDF.php">
            <input type="submit" value="Get PDF" style="width:fit-content; margin-left:900px; margin-top:150px;">
        </form>
          

        <script>
        $(document).ready(function() {
            $('#UserTable').DataTable();
            $('#UserTable2').DataTable();
        });
    </script>
    </body>
</html>