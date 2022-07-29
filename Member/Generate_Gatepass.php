<?php ob_start(); ?>
<?php

include_once '../Connection.php';
include_once 'Member_Dashboard.php';
include_once '../validation.php';
// date_default_timezone_set('Asia/Kolkata');   

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

    <!-- for toast -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script> 

    <!-- for date-time -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="jquery-timepicker/jquery.timepicker.min.css">
    <script src="jquery-timepicker/jquery.timepicker.min.js"></script>    

    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <style>
        body{
            background-color: #f7f2dfe7;
        }
    </style>

</head>

<body>
<?php
    $err = false;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_REQUEST['btnGGP']) && isset($_FILES["image"])) {
        $name = $_REQUEST['name'];
        $phone = $_REQUEST['contact'];
        $desc = $_REQUEST['desc']; 
        $date = $_REQUEST['date'];
        $time = $_REQUEST['time'];
        $email = $_REQUEST['email'];
        $filename = $_FILES["image"]["name"]; 
        $tempname = $_FILES["image"]["tmp_name"]; 
        $folder = "../Image/user/".$filename;        
        $mid= $_SESSION['mid'];

        if(images($filename))
        {
            $err = true;
            echo "<script type='text/javascript'>
                toastr.error('Only JPEG or PNG or JPG file supported.');
            </script>";
            // goto start;
        } 

        if($err == false)
        {
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

            $query = "insert into tbl_visitor (mid,vname,phone,date,time,description,email,image) values ($mid,'$name','$phone','$date','$time','$desc','$email','$filename')";
            $insert = mysqli_query($conn,$query);

            require '../PHPMailer/src/Exception.php';
            require '../PHPMailer/src/PHPMailer.php';
            require '../PHPMailer/src/SMTP.php';
            $_SESSION["otp"] = $rndno;
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'contact.mysociety@gmail.com';
            $mail->Password = 'bmiit4270';
            $mail->SMTPSecure = 'tls';
            $mail->setFrom('contact.mysociety@gmail.com');
            $mail->addAddress($email);
            $sub = "MySociety - Gatepass issued to ".$name;
            $mail->Subject = $sub;
            $message_body = "Name : ".$name."\nDate : ".$date."\nTime : ".$time."\nDescription : ".$desc;
            $mail->Body = $message_body;
            $mail->send();

            if($insert)
            {
                echo "<script type='text/javascript'>
                toastr.success('Gatepass Generation Successfully.');
                </script>";
                header("location:Member_Dashboard.php");

            }
        }
        
    }
    else
    {   
        // echo "<script type='text/javascript'>
        // toastr.error('Please select image.');
        // </script>";   
    }

    // start:
    ?>

    <form action="" id="regForm"  method="POST" onsubmit="return validateForm()" style="margin-left: 500px; margin-top: 110px; border-radius: 15px;" enctype="multipart/form-data" novalidate>


        <h1><b style="color:#f0a73a;">Generate Gatepass</b></h1><br><br>
        <div class="row">
            <div class="column">
                <div class="tab">Full Name:
                    <p><input type="text" placeholder="Enter Full Name..." name="name" id="name" pattern="[A-Za-z][2,255]" title=""></p>
                </div>
                <div class="tab">Mobile Number:
                    <p><input type="tel" placeholder="Enter mobile number...." name="contact" id="contact" maxlength="10" pattern="[6789][0-9][9]" ></p>
                </div>
                <div class="tab">Description:
                    <p><textarea rows="5" name="desc" id="desc" placeholder="Enter Description here..."></textarea></p>
                </div>
                <div class="tab">Select Date:
                    <p><input type="date" min="<?php echo date("Y-m-d"); ?>" placeholder="Select Date..." name="date" id="date" min="21-03-2021"></p>
                </div>
                <div class="tab">Select Time:
                    <p><input type="time" placeholder="Select Time..." name="time" id="time"></p>
                </div>
                <div class="tab">Email:
                    <p><input type="email" placeholder="Enter email..." name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></p>
                </div>
                <div class="tab">Image:
                    <p><input type="file" placeholder="select image...." name="image" id="image"></p>
                </div>
            </div>
        </div>


        <div style="overflow:auto;">
            <div style="float:right;">
            <button type="submit" id="btnUpPro" name="btnGGP" style="width:100px; font-size: 13px; align-items: center; justify-content: center; width:140px;">Generate</button>
            </div>
        </div>
        </div>
    </form>
</body>

<script>
    // jQuery('#date').datepicker();
    // jQuery('#time').timepicker();
    
    function validateForm() {

                var err = false;
                var name = $('#name').val();
                var contact = $('#contact').val();
                var desc = $('#desc').val();
                var date = $('#date').val();
                var time = $('#time').val();
                var email = $('#email').val();



                if(name == "" || name == " " || !/^[a-zA-Z ']{0,31}$/.test(name))
                {
                    toastr.error('Name Is not Valid.');
                    err = true;
                }

                if(contact == "" || contact == " " || !/^[9876][0-9]{9}$/.test(contact))
                {
                    toastr.error('Contact Is not Valid.');
                    err = true;
                }

                if (email == "" || email == " " || !/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
                    toastr.error('Email Is not Valid.');
                    err = true;
                }
                
                if(time == "" )
                {
                    toastr.error('Please Select time');
                    err = true;
                }

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
                
                if(err == true)
                {
                    return false;
                }
                
        }

        if($('#regForm').onsubmit == true)
        {
            toastr.error('Please Enter descssssssssssssssssssssssription');
            err = true;
        }

</script>

</html>
<?php ob_flush();?>