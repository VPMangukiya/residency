<?php 
  // session_start();

  include_once 'President_Dashboard.php';
  include_once '../Connection.php';
  include_once '../validation.php';
  include_once '../links.php';

  if($_SESSION['mid'] == "")
  {
      header("location:../Home.php");
  }
?>
<?php 

    $nameErr = "";
    $ContactnoErr = "";
    $imgerror="";
    $emailErr = "" ;
    $passwordErr = "";
    $wingErr = "";
    $flatErr = "";

    if(isset($_REQUEST["regBtn"]) && isset($_FILES["image"]))
    {
        $sid = $_SESSION['socid'];
        $name = $_REQUEST['name'];
        $mob = $_REQUEST['mob'];    
        $wing = $_REQUEST['wing'];
        $flat = $_REQUEST['flat'];
        $pas = $_REQUEST['pwd'];
        $email = $_REQUEST['email'];
        $role = $_REQUEST['role'];
        $filename = $_FILES["image"]["name"]; 
        $tempname = $_FILES["image"]["tmp_name"]; 
        $folder = "../Image/user/".$filename; 

    //   if($_REQUEST['soc'] <= 0 || $_REQUEST['soc'] == "")
    //   {
    //       $SocError = "Required.. || Please select society.";
    //       $errorresult=true;
    //   }
    //   else
    //   {
    //     $sid = $_REQUEST['soc'];
    //   }

      if($flat <= 0)
      {
          $SocError = "Required.. || Please enter valid flat no.";
          $errorresult=true;
      }
      
      if(name($name))
      {
          $nameErr = "Required.. || Please enter valid first name.";
          $errorresult=true;
      }

      if(contact($mob))
      {
          $ContactnoErr = "Required.. || Please enter valid contact number.";
          $errorresult=true;
      }

      if(pass($pas))
      {
          $passwordErr = "Required.. || Password Must be consist of uppercase letter,special symbol and number.";
          $errorresult=true;
      }

      if(sel_email($email))
      {
          $emailErr = "Required.. || Please enter valid Email. || Email already Exist.";
          $errorresult=true;
      }

      if(images($filename))
      {
          $imgerror = "Only JPEG or PNG or JPG file supported.";
          $errorresult=true;
      }

      if($role == "")
      {
          $SocError = "Select any role.";
          $errorresult=true;
      }

      if($errorresult==true)
      {
          goto start;
      }

        $path    = '../Image/user';
        $files = array_diff(scandir($path), array('.', '..'));

        foreach($files as $fname)
        { 
            if(strcmp($fname,$filename) == 0)
            {
              $value = explode(".",$filename);    
              $rndno = rand(100,999);
              $filename = $value[0].$rndno.'.'.$value[1];
              $folder = "../Image/user/".$filename;
              echo '<script>alert("'.$filename.'");</script>'; 
              break;
            }
        }   

        $query = "insert into tbl_member (sid,mname,phone,wing,flat,image,email,password,member_type,is_approved) values ($sid,'$name','$mob','$wing','$flat','$filename','$email',md5('$pas'),'$role','Approved')";
        $insert = mysqli_query($conn,$query);

        if (move_uploaded_file($tempname, $folder))  { 
          // $msg = "Image uploaded successfully"; 
          echo '<script>alert("success");</script>';
        }else{ 
          echo '<script>alert("fail");</script>';
        } 
        
        if($insert)
        {
          header("location:President_Dashboard.php");
        }
}
      

start:
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="css/logincss.css" rel="stylesheet">
  <style>
    
    form 
    {
        width: 50%;
        margin-left: 450px;
        margin-top: 100px;
        font-family: Raleway;
        background-color: #ffffff;
        padding: 20px;
    }

    body{
      background-color: #f7f2dfe7;
    }
  </style>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<a href="<?php //echo $header; ?>"></a> 
<a href="<?php //echo $footer; ?>"></a> 

<form id="regForm" action="#" method="POST" enctype="multipart/form-data">
    <h1><b style="color:#35cebe;"><center>Add Committee Member</center></b></h1>
    <div class="row">
        <div class="column" >
        <span style="color: red; " id="nameErr"><?php echo $nameErr; ?></span>
        <div class="tab">Full Name:
        <p><input type="text" placeholder="Enter Full Name..." oninput="this.className = ''" name="name" id="user" title="Name" required></p>
        </div>
        <span style="color: red;" id="phoneErr"><?php echo $ContactnoErr; ?></span>
        <div class="tab">Mobile Number:
        <p><input type="tel" placeholder="Enter mobile number...." oninput="this.className = ''" name="mob" title="Eight or more characters" maxlength="10" minlength="10" required></p>
        </div>
        <span style="color: red; "><?php echo $imgerror; ?></span>
        <div class="tab">Image:
            <p><input type="file" placeholder="select image...." oninput="this.className = ''" name="image" id="image" /></p>
        </div>
        
        <span style="color: red;" id="socErr"></span>
        <div class="tab" style="margin-bottom: 15px;">Role:
              <select name="role" id="role">
                  <!-- <option>--Select Role--</option> -->
                  <option value="Spresident">Sub President</option> 
                  <option value="Secretary">Secretary</option> 
              </select>
        </div> 

        <span style="color: red; " id="wingErr"><?php echo $wingErr; ?></span>
        <div class="tab">Wing:
            <p><input type="text" placeholder="Enter wing...." oninput="this.className = ''" name="wing" id="wing" required></p>
        </div>

        <span style="color: red;" id="flatErr"><?php echo $flatErr; ?></span>
        <div class="tab">Flat No.:
            <p><input type="number" placeholder="Enter Flat no....." oninput="this.className = ''" name="flat" id="flat" required></p>
        </div>

        <span style="color: red;" id="emailErr"><?php echo $emailErr; ?></span>
        <div class="tab">Email:
            <p><input type="email" placeholder="Enter email...." oninput="this.className = ''" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></p>
        </div>
        
        <span style="color: red;" id="passErr"><?php echo $passwordErr; ?></span>
        <div class="tab">Password:
            <p><input type="password" placeholder="Enter Password...." oninput="this.className = ''" name="pwd" id="pass" required></p>
        </div>
        </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <input type="submit" name="regBtn" onclick="next()" value="Submit" style="background-color: #35cebe; color:#ffffff;">
      </div>
    </div>
</div>
</form>

  <script>

    function next()
    {
      var inp = document.getElementsByTagName("input");
      // var y = document.getElementById("user");

      var i,blank=0;
      for(i=0;i<inp.length;i++)
      {
        if(inp[i].value == "")
        {
          inp[i].classList.add("invalid");
          blank=1;
        }
      }

      if(!/^[a-zA-Z ']{0,31}$/.test(inp[0].value) || inp[0].value == " " || inp[0].value == "")
      {
        document.getElementById("nameErr").innerHTML = "Name is not valid.";
      }

      if(!/^[9876][0-9]{9}$/.test(inp[1].value))
      {
        document.getElementById("phoneErr").innerHTML = "Phone Number is not valid.";
      }

      if(!/^[a-zA-z]$/.test(inp[3].value))
      {
        document.getElementById("wingErr").innerHTML = "Wing is not valid.";
      }

      if(!/^[0-9]{0,4}$/.test(inp[4].value))
      {
        document.getElementById("flatErr").innerHTML = "Flat no. is not valid.";
      }

      if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(inp[5].value))
      {
        document.getElementById("emailErr").innerHTML = "Email is not valid.";
      }

      if(inp[6].value.length >=! 8)
      {
        document.getElementById("passErr").innerHTML = "Password must be 8 character long.";
      }
      
      selectElement = document.querySelector('#society_dropdown'); 
      output = selectElement.value; 

      if(output == "" || output == 0)
      {
        document.getElementById("socErr").innerHTML = "Please select society.";
      }       


    }


  </script>
  

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>