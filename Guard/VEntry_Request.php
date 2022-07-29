<?php
ob_start();
// session_start();

include_once 'Guard_Dashboard.php';
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
    $err = false;

    if (isset($_REQUEST['btnSendreq']) && isset($_FILES['image'])) {
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['contact'];
        $desc = $_REQUEST['desc'];
        $wing = $_REQUEST['wing'];
        $flat = $_REQUEST['flat'];
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../Image/user/" . $filename;
        $mid = $_SESSION['mid'];
        $sid = $_SESSION['socid'];

        echo $name;
        if (images($filename)) {
            $err = true;
            echo "<script type='text/javascript'>
                toastr.error('Only JPEG or PNG or JPG file supported.');
            </script>";
            // goto start;
        }

        if ($err == false) {
            $path    = '../Image/user';
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $fname) {
                if (strcmp($fname, $filename) == 0) {
                    $value = explode(".", $filename);
                    $rndno = rand(100, 999);
                    $filename = $value[0] . $rndno . '.' . $value[1];
                    $folder = "../Image/user/" . $filename;
                    // echo '<script>alert("' . $filename . '");</script>';
                    break;
                }
            }

            move_uploaded_file($tempname, $folder);

            $query = "insert into tbl_visitor_entry (vname,description,sid,wing,flat,phone,image,status) values ('$name','$desc','$sid','$wing','$flat','$phone','$filename','Pending')";
            $insert = mysqli_query($conn, $query);

            if ($insert) {
                echo "<script type='text/javascript'>
                toastr.success('Request sent Successfully.');
                </script>";
                header("location:VEntry_Request.php");
            }
        }
    }

    ?>

    <?php
    $w = $_SESSION['wing'];
    $s = $_SESSION['socid'];

    $result = mysqli_query($conn, "SELECT * From tbl_visitor_entry where sid=$s");  ?>
    <div class="row grid-responsive" id="tbl">
        <div class="column ">
            <div class="card">
                <div class="card-title">
                    <button type="button" id="btnAdd_Guard_out" data-toggle="modal" data-target="#exampleModal" style="float: right; margin-bottom:0px;">New Request</button>
                    <h3>Visitor Entry Requests</h3>
                </div>
                <div class="card-block">
                    <table id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col" style="padding-left: 5px;">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Wing</th>
                                <th>Flat</th>
                                <th>Datetime</th>
                                <th>Status</th>
                                <th>Image</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
                                    <td><?php echo $data['vname']; ?></td>
                                    <td><?php echo $data['description']; ?></td>
                                    <td><?php echo $data['wing']; ?></td>
                                    <td><?php echo $data['flat']; ?></td>
                                    <td><?php echo $data['datetime']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td style="width: 150px; height: 200;"><img src="../Image/user/<?php echo $data['image']; ?>"></td>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:#35cebe;">New Visitor Entry Request</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="lgForm" id="lgForm" onsubmit="return validateForm()" novalidate enctype="multipart/form-data">

                        <div class="tab">Visitor Name:
                            <p><input type="text" placeholder="Enter Visitor name..." name="name" id="name" required="true"></p>
                        </div>
                        <div class="tab">Visitor Mobile No::
                            <p><input type="tel" placeholder="Enter Visitor mobile number..." name="contact" id="contact" maxlength="10" required="true"></p>
                        </div>
                        <div class="tab" style="margin-bottom: 15px;">Wing:<br>
                            <select name="wing" id="wing_dropdown">
                                <option>--  SELECT WING  --</option>
                                <?php
                                $records = mysqli_query($conn, "SELECT DISTINCT(wing) From tbl_member where sid=" . $_SESSION["socid"]);  // Use select query here

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['wing'] . "'>" . $data['wing'] . "</option>";  // displaying data in option menu
                                }
                                ?>
                            </select>
                        </div>

                        <div class="tab" style="margin-bottom: 15px;">Select Flat:<br>
                            <select name="flat" id="flat_dropdown" onselect="myFunction()">
                                <option>--  SELECT FLAT  --</option>
                            </select>
                        </div>
                        <div class="tab">Description:
                            <p><textarea name="desc" id="desc" rows="5" cols="94" placeholder="Enter Description...." required="true"></textarea></p>
                        </div>
                        <div class="tab">Image:
                            <p><input type="file" placeholder="select image...." name="image" id="image" /></p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" style="font-size: 15px;">Close</button>
                    <button type="submit" value="Send" id="btnSendreq" name="btnSendreq" style="text-align: center; font-size: 15px;">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </table>





    <script>
        $(document).ready(function() {
            $('#UserTable').DataTable();

            // Getting Cities
            $('#wing_dropdown').on('change', function() {
                // alert( this.value );
                // $("#flat_dropdown").html("<option value=''>SELECT CITY</option>");
                $.ajax({
                    url: "Get_Flat.php",
                    type: 'post',
                    data: {
                        "wing": $("#wing_dropdown").val()
                    },
                    success: function(result) {
                        // alert(result);
                        var str = "<option value=''>SELECT FLAT</option>";
                        $.each(result, function(key, value) {
                            str = str + "<option value='" + value.flat + "'>" + value.flat + "</option>";
                        });
                        $("#flat_dropdown").html(str);
                    },
                    error: function(err) {
                        alert(err.responseText);
                    }
                });
            });
        });

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Add New Guard')
            modal.find('.modal-body input').val(recipient)
        })

        // setInterval(function() {
        //     $('#fmGuard').load(location.href);
        // }, 5000);

        function validateForm() {

            var err = false;
            var name = $('#name').val();
            var contact = $('#contact').val();
            var desc = $('#desc').val();
            var flat = $('#flat_dropdown').val();
            var img = $('#image').val();
            var selectElement = document.querySelector('#flat_dropdown');
            var output = selectElement.value;

            if (output == "") {
                toastr.error("Please select flat.");
                err = true;
            }

            if (name == "" || name == " " || !/^[a-zA-Z ']{0,31}$/.test(name)) {
                toastr.error('Name Is not Valid.');
                err = true;
            }

            if (contact == "" || contact == " " || !/^[9876][0-9]{9}$/.test(contact)) {
                toastr.error('Contact Is not Valid.');
                err = true;
            }

            if (desc == "" || desc == " ") {
                toastr.error('Description Is not Valid.');
                err = true;
            }

            if (img == "") {
                toastr.error('Please select image.');
                err = true;
            }

            // if (wing == "" || wing <= 0) {
            //     toastr.error('Select Wing.');
            //     err = true;
            // }

            // if (flat == "" || flat <= 0) {
            //     toastr.error('Select Flat.');
            //     err = true;
            // }

            if (err == true) {
                return false;
            }

        }
    </script>
</body>

</html>
<?php ob_flush(); ?>