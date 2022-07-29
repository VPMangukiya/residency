<?php 
    include_once 'Connection.php';
    $id= $_GET['id']; 
    // $email= $_GET['email']; 
    $action = $_GET['action'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $get_email = "select email from tbl_member where mid = $id";
    $result = mysqli_query($conn,$get_email);
    $data = mysqli_fetch_array($result);
    $email = $data['email'];    
    
    if(strcmp($action,"approve") == 0)
    {
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
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
            $mail->Subject = 'MySociety - Registration Status';
            $message_body = "Your registration is approved by your society president , now you can login into MySociety system." ;
            $mail->Body = $message_body;
            $mail->send();
    
        $q = "update tbl_member set is_approved = 'Approved' where mid = $id";
        mysqli_query($conn,$q);
    }

    if(strcmp($action,"reject") == 0)
    {
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
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
            $mail->Subject = 'MySociety - Registration Status';
            $message_body = "Your registration is rejected by your society president , please contact your society president if you found this is mistake." ;
            $mail->Body = $message_body;
            $mail->send();
    
            $q = "update tbl_member set is_approved = 'Rejected' where mid = $id";
            mysqli_query($conn,$q);
            
    }

    if(strcmp($action,"delete_g") == 0)
    {
        $q = "update tbl_member set is_approved = 'Rejected' where mid = $id";
        mysqli_query($conn,$q);   
    }

    if(strcmp($action,"delete_sp") == 0)
    {
        $q = "delete from tbl_service_provider where spid = $id";
        mysqli_query($conn,$q);   
    }
    
    if(strcmp($action,"approve_ve") == 0)
    {
        $q = "update tbl_visitor_entry set status = 'Approved' where veid = $id";
        mysqli_query($conn,$q);   
    }

    if(strcmp($action,"reject_ve") == 0)
    {
        $q = "update tbl_visitor_entry set status = 'Rejected' where veid = $id";
        mysqli_query($conn,$q);   
    }
?>