
<?php
ob_start();
// session_start();

include_once 'Secretary_Dashboard.php';
include_once '../Connection.php';
include_once '../validation.php';
include_once '../links.php';

if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="refresh" content="5" /> -->
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

        #user {
            margin-top: -40px;
        }

        body {
            background-color: #f7f2dfe7;
        }

        .toast-error {
            font-size: 15px;
        }

        body {
            font-family: Raleway;
        }

        input[type='submit'] {
            border: 0px none;
            outline: none;
        }
    </style>

</head>

<body>
    <?php
    if (isset($_REQUEST['btnAdd'])) {
        $date = $_REQUEST['date'];
        $desc = $_REQUEST['desc'];
        $mid = $_SESSION['mid'];
        $amo = $_REQUEST['amo'];

            $query = "insert into tbl_expense (mid,date,description,amount) values ($mid,'$date','$desc','$amo')";
            $insert = mysqli_query($conn, $query);
            
            header("location:Manage_Expense.php");
            echo "<script type='text/javascript'>
            toastr.success('Expense Added Successfully.');
            </script>";
        // }
    }

    start:
    ?>

    <?php
    $w = $_SESSION['wing'];
    $m = $_SESSION['mid'];

    $result = mysqli_query($conn, "SELECT * From tbl_expense where mid='$m'"); ?>
    <div class="row grid-responsive" id="tbl">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <button type="button" id="btnAdd_out" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-bottom:0px;">Add Expense</button>
                    <h3>All Expenses</h3>
                </div>
                <div class="card-block">
                    <table id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col" style="padding-left: 5px;">#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <!-- <th>Image</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
                                    <?php //$mid = $data['mid']; 
                                    ?>
                                    <td><?php echo $data['date']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo $data['amount']; ?></td>
                                    <!-- <td><?php //echo '<img src="Image/user/' . $data['image'] . ' )."/>'; 
                                                ?></td> -->
                                    <!-- <td style="width: 150px; height: 200;"><img src="../Image/user/<?php //echo $data['image']; 
                                                                                                        ?>"></td> -->
                                    <!-- <td><a href='javascript:void(0)' onclick='del_sp(<?php echo $data['spid'] ?>)'><img src="../Image/reject.png" style="width:42px;height:42px;"></a></td> -->
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



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="agform" id="agform" onsubmit="return validateForm()" novalidate>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Date:</label></label>
                            <input type="date" min="<?php echo date('Y'); ?>" placeholder="Select Date..." name="date" id="date">
                            <label for="" class="col-form-label">Description:</label>
                            <textarea rows="5" name="desc" id="desc" placeholder="Enter Description here..."></textarea>
                            <label for="recipient-name" class="col-form-label">Amount:</label>
                            <input type="number" class="form-control" id="amo" name="amo" placeholder="Enter Amount....">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" style="font-size: 15px;">Close</button>
                    <button type="submit" value="Add" id="btnAdd" name="btnAdd" style="width:100px; font-size: 15px;">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </table>





    <script>
        // $(document).ready(function(){
        //     $("#btnAdd_Guard_in").click(function(){
        //         $('.toast').toast('show');
        //     });
        // });

        $(document).ready(function() {
            $('#UserTable').DataTable();
        });


        // function del_sp(mid) {
        //     var id = mid;
        //     $.ajax({
        //         type: "GET",
        //         url: "../app_rej.php",
        //         data: {
        //             id: id,
        //             action: 'delete_sp'
        //         },
        //         success: function(data) {
        //             alert('Deleted');
        //             location.reload();

        //         }
        //     });
        // }

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Add Expense')
            modal.find('.modal-body input').val(recipient)
        })

        // setInterval(function() {
        //     $('#fmGuard').load(location.href);
        // }, 5000);

        function validateForm() {
            var err = false;
            var desc = $('#desc').val();
            var date = $('#date').val();
            var amo = $('#amo').val();

            if(date == "" )
            {
                toastr.error('Please Select date');
                err = true;
            }

            if(desc == "" || desc == " ")
            {
                toastr.error('Please Enter description');
                err = true;
            }

            if(amo == "" || amo <= 0)
            {
                toastr.error('Please Enter Valid Amount.');
                err = true;
            }

            if (err == true) {
                return false;
            }


        }
    </script>
</body>

</html>
<?php ob_flush(); ?> 