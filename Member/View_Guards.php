<?php
// session_start();
include_once '../Connection.php';
include_once 'Member_Dashboard.php';

if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
}


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

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/milligram.min.css">
    <link rel="stylesheet" href="../css/styles.css">


    <style>
        #tbl {
            margin-left: 300px;
            margin-top: 100px;
            width: 1200px;
        }
    </style>

</head>

<body>
<?php
    $s = $_SESSION['socid'];

    $result = mysqli_query($conn, "SELECT * From tbl_member where sid='$s' and is_approved='Approved' and member_type ='Guard' ");  ?>
    <!-- <form action="" method="POST" id="fmGuard"> -->
        <div class="row grid-responsive" id="tbl">
            <div class="column ">
                <div class="card">
                    <div class="card-title">
                        <h3>Guards</h3>
                    </div>
                    <div class="card-block">
                        <table id="UserTable">
                            <thead>
                                <tr>
                                    <th scope="col" style="padding-left: 5px;">#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
                                        <td><?php echo $data['mname']; ?></td>
                                        <td><?php echo $data['phone']; ?></td>
                                        
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


    




    <script>
        $(document).ready(function() {
            $('#UserTable').DataTable();
        });
    </script>

</body>

</html>