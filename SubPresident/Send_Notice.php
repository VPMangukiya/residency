<?php
  include_once 'SPresident_Dashboard.php';
  include_once '../Connection.php';
  include_once '../validation.php';
  include_once '../links.php';

  if($_SESSION['mid'] == "")
  {
      header("location:../Home.php");
  }

?>
<?php
    $notErr = "";
    $err = false;

    
    if(isset($_REQUEST['sendnotice']))
    {
      // echo "<script>alert('start');</script>";
    
      $mid= $_SESSION['mid'];
      $notice = $_REQUEST['notice_text'];
      echo $notice;

        if(empty($notice))
        {
             $notErr = "Enter Notice Properly!!";  
             $err = true ;
        }

        if($err == true)
        {
          goto start;
        }

        
        // $n = $_REQUEST['notice_text'];

        // echo "<script>alert(".$mid.");</script>";
        // echo "<script>alert(".$notice.");</script>";
        // echo "<script>alert('start123');</script>";

        $query = "insert into tbl_notice (mid,message) values ($mid,'".$notice."')";
        
        // echo "<script>alert('start');</script>";
        if(!mysqli_query($conn,$query))
        {
            echo "<script>alert(".mysqli_error($conn).");</script>";
        }
        else
        {
            echo "<script>alert('abcdefno');</script>";
        }
    }

start:    
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
  
  <style>
      textarea {
        width: calc(100% - 6px);
      }
      .btn-block {
        margin-top: 20px;
        text-align: center;
      }
      button:hover {
      background-color: #0666a3;
      }
    body{
      background-color: #f7f2dfe7;
    }
  </style>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<body>


<form id="regForm" action="" method="POST" style="margin-top: 150px; margin-left: 500px;">
    <h1><b style="color:#f0a73a;">Send Notice</b></h1><br><br>
    <div class="row">
        <div class="column" >
        <div class="tab">Notice :
            <textarea rows="5" name="notice_text" placeholder="Enter notice here..."></textarea>
            <span id="noticeErr" style="color: red;"><?php echo $notErr;  ?></span>
        <div class="btn-block">
        <input type="submit" name="sendnotice" value="Send" style="width: 150px; font-size:15px;">
        <input type="reset" value="Reset" style="width: 150px; font-size:15px;">
    </div>
</form>

<!-- <script>
    function valid()
    {
        // alert('dsd');
        var inp = document.getElementsByTagName("input");
        // alert(inp[0].value);

        // if(document.getElementsByName('sendnotice').value)

        if(document.getElementsByName("notice").value == "")
        // if(inp[0] == "" || inp[0] == " " || !/^[A-Za-z0-9-,. ]+$/.test(inp[0]))
        {
            document.getElementById("noticeErr").innerHTML = "Notice is not valid.";
        }
    }
</script> -->
</body>
</html>
