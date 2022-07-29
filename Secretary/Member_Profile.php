<?php

include_once '../Connection.php';
include_once 'Secretary_Dashboard.php';
include_once '../validation.php';

if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <style>
        body {
            background-color: #f7f2dfe7;
        }
    </style>

    <!-- <script>location.reload();</script>     -->
</head>

<body>
    <?php
    $err = false;
    $filename = "";
    $tempname = "";
    $folder = "";


    if (isset($_REQUEST['btnUpPro'])) {
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['contact'];
        // $image = $_REQUEST['name']; 
        $email = $_REQUEST['email'];

        if (isset($_FILES["image"])) {
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "../Image/user/" . $filename;


            if (images($filename)) {
                $err = true;
                echo "<script type='text/javascript'>
                    toastr.error('Only JPEG or PNG or JPG file supported.');
                </script>";
                // goto start;
            } else {
                $path    = '../Image/user';
                $files = array_diff(scandir($path), array('.', '..'));

                foreach ($files as $fname) {
                    if (strcmp($fname, $filename) == 0) {
                        $value = explode(".", $filename);
                        $rndno = rand(100, 999);
                        $filename = $value[0] . $rndno . '.' . $value[1];
                        $folder = "../Image/user/" . $filename;
                        echo '<script>alert("' . $filename . '");</script>';
                        break;
                    }
                }
            }
        }


        if (sel_UpPro_email($email,$_SESSION['mid'])) {
            $err = true;
            echo "<script type='text/javascript'>
                toastr.error('Email is Already Exists.');
            </script>";
        }

        if ($err == false) {

            if($filename != "")
            {
                
                $query = "update tbl_member set mname='$name',phone='$phone',image='$filename',email='$email' where mid=".$_SESSION['mid'];
                $insert = mysqli_query($conn, $query);
                
                move_uploaded_file($tempname, $folder);
                
                if ($insert) {
                    $_SESSION['mname'] = $name;
                    $_SESSION['uimg'] = $filename;
                    header("location:Member_Profile.php");
                }
            }    
            else
            {
                $query = "update tbl_member set mname='$name',phone='$phone',email='$email' where mid = ".$_SESSION['mid'];
                $_SESSION['mname'] = $name;
                $insert = mysqli_query($conn, $query);
                header("location:Member_Profile.php");
            }
        //    ;
        //     // $insert = mysqli_query($conn,$query);
        //     echo "<script type='text/javascript'>
        //     toastr.success('Profile Edited Successfully.');
        //     </script>";
            // header("location:Member_Dashboard.php");
        // }
    }
}
    start:
    ?>
    <?php
    $sel_data = "select mname,email,phone from tbl_member where mid = " . $_SESSION['mid'];
    $result = mysqli_query($conn, $sel_data);
    $data = mysqli_fetch_array($result);
    ?>
    <form action="" id="regForm" method="POST" onsubmit="return validateForm()" style="margin-left: 500px; margin-top: 155px;   border-radius: 10px;" enctype="multipart/form-data" novalidate>


        <h1><b style="color:#f0a73a;">Edit Profile</b></h1><br><br>
        <div class="row">
            <div class="column">
                <div class="tab">Full Name:
                    <p><input type="text" placeholder="Enter Full Name..." name="name" id="name" value="<?php echo $data['mname']; ?>" pattern="[A-Za-z][2,255]" title=""></p>
                </div>
                <div class="tab">Mobile Number:
                    <p><input type="tel" placeholder="Enter mobile number.." name="contact" id="contact" maxlength="10" value="<?= $data['phone']; ?>" pattern="[6789][0-9][9]"></p>
                </div>
                <div class="tab">Email:
                    <p><input type="email" placeholder="Enter email..." name="email" id="email" value="<?= $data['email']; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></p>
                </div>
                <div class="tab">Image:
                    <p><input type="file" placeholder="select image...." name="image" id="image"></p>
                </div>
            </div>
        </div>


        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="submit" id="btnUpPro" name="btnUpPro" style="width:100px; font-size: 13px; align-items: center; justify-content: center; width:120px;">Update</button>
            </div>
        </div>
        </div>
    </form>
</body>

<script>
    function validateForm() {

        var err = false;
        var name = $('#name').val();
        var contact = $('#contact').val();
        var email = $('#email').val();


        if (name == "" || name == " " || !/^[a-zA-Z ']{0,31}$/.test(name)) {
            toastr.error('Name Is not Valid.');
            err = true;
        }

        if (contact == "" || contact == " " || !/^[9876][0-9]{9}$/.test(contact)) {
            toastr.error('Contact Is not Valid.');
            err = true;
        }

        if (email == "" || email == " " || !/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
            toastr.error('Email Is not Valid.');
            err = true;
        }

        if (err == true) {
            return false;
        }

    }
</script>

</html>