
----- select cities based on state
<input type="submit" name="selState" value='select'>

            <!-- <button type="button" name="selState" id="selState" style="margin-top: 10px;">Select</button> -->
            <?php 
                if(isset($_REQUEST['selState']))
                {
                    $_SESSION['stid'] = $_REQUEST['state'];
                }
            ?>


            LOGIN


            $error_email = " ";
      $Pass_error = " ";
      $err = " ";

      
      if(isset($_REQUEST['btnLogin']))
      {
          $email = $_REQUEST['email'];
          $pass = $_REQUEST['pwd'];

          if (!filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                  // echo "<br><my class='Red'>Invalid Email ID!</my>";
                    $error_email =  "Invalid Email ID!";
              } else if (strlen($pass) < 8)
              {
                  $Pass_error = "Password must be 8 character long!";
              }
              else
              {
                  $q = "select mid,member_type from tbl_member where email='$email' and password=md5('$pass')";
                  $check = mysqli_query($conn,$q);

                  if (!$row = mysqli_fetch_assoc($check))
                  {
                      echo $q;
                      echo $row['mid'];
                      echo "<br><my class='Red'>Invalid Email ID/Password!</my>";
                  } else
                  {
                      $_SESSION["mid"] = $email;
                      $_SESSION["mbType"] = $row['member_type'];
                      $mt = $row['member_type']; 
                      
                            if($mt == "Member")
                            {
                              header("location:Member_Dashboard.php");
                            }
                            elseif($mt == "Secretary")
                            {
                              header("location:Secretary_Dashboard.php");  
                            }
                            elseif($mt == "President")
                            {
                              header("location:President_Dashboard.php");
                            }
                            else
                            {
                              header("location:SPresident_Dashboard.php");
                            }
                  }
              }
          }
        // $email = $_REQUEST['email'];
        // $query = "select count(*) as count from tbl_member where email='$email'";
        // $result = mysqli_query($conn, $query);
        // $row = mysqli_fetch_assoc($result);
        // $total = $row["count"];    

        // if (empty($_REQUEST["email"])) {
        //     $error_email = "Email is required";
        // } else {
        //     $emails = test_input($email);
        //     if (!filter_var($emails, FILTER_VALIDATE_EMAIL) || $total <= 0) {
        //         $error_email = "Invalid email format or Email is not exist!!";
        //     }
        // }
        
        // $pass = $_REQUEST["pwd"];
        // $query = "select password,member_type,mid from tbl_member where email='$email'";
        // $result = mysqli_query($conn, $query);
        // $row = mysqli_fetch_assoc($result);
        // $dbpass = $row["password"];
        // $mt = $row["member_type"];
        // $_SESSION['mType'] = $mt;
        // $mbid = $row["mid"];
        // $_SESSION['mbID'] = $mbid;
        
        // if(empty($_REQUEST["pwd"]))
        // {
        //     $Pass_error = "Password is required";
        // }
        // else
        // {
        //     if($pass == $dbpass)
        //     {
        //       if($mt == "Member")
        //       {
        //         header("location:Member_Dashboard.php");
        //       }
        //       elseif($mt == "Secretary")
        //       {
        //         header("location:Secretary_Dashboard.php");  
        //       }
        //       elseif($mt == "President")
        //       {
        //         header("location:President_Dashboard.php");
        //       }
        //       else
        //       {
        //         header("location:SPresident_Dashboard.php");
        //       }
        //     }   

       

      // }

                        // $uname = $_REQUEST["email"];
                        // $password = $_REQUEST["pwd"];
                        // if (!filter_var($uname, FILTER_VALIDATE_EMAIL))
                        // {
                        //     // echo "<br><my class='Red'>Invalid Email ID!</my>";
                        //      $error_email =  "Invalid Email ID!";
                        // } else if (strlen($password) < 8)
                        // {
                        //     $Pass_error = "Password must be 8 character long!";
                        // } else
                        // {
                        //     $query = "select count(*) as count,mid,member_type from tbl_member where email='$uname' and pwd='$password')";
                        //     $rs = mysqli_query($conn, $query);
                        //     $mt = "";
                        //     if($row = mysqli_fetch_row($rs))
                        //     {
                        //         $_SESSION['mbType'] = $row['member_type'];
                        //         $_SESSION['mid'] = $row['mid'];
                        //         $mt = $row['member_type'];
                        //         if($row["count"] <= 0)
                        //         {
                        //           $err = "Invalid Email ID/Password!";
                        //         }
                        //     } else
                        //     {
                        //       if($mt == "Member")
                        //         {
                        //           header("location:Member_Dashboard.php");
                        //         }
                        //         elseif($mt == "Secretary")
                        //         {
                        //           header("location:Secretary_Dashboard.php");  
                        //         }
                        //         elseif($mt == "President")
                        //         {
                        //           header("location:President_Dashboard.php");
                        //         }
                        //         else
                        //         {
                        //           header("location:SPresident_Dashboard.php");
                        //         }
                        //       }
                        //     }
                        // }

      // function test_input($data) {
      //   $data = trim($data);
      //   $data = stripslashes($data);
      //   $data = htmlspecialchars($data);
      //   return $data;
      // }

    // }


    ==================================================================================================
    President_dashboard.php


    <?php 
    include_once '../Connection.php';
    // include_once 'President_Dashboard.php';

    if($_SESSION['mid'] == "")
    {
        header("location:../Home.php");
    }
    // include_once ' Connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
      <div class="container" id="output"></div>

      <script>
        $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'AM.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 6000);  // it will refresh your data every 1 sec

    });
      </script>

</body>
</html>


========================================================================================================
AM.php


<?php 
    
    include_once '../Connection.php';
    // include_once 'President_Dashboard.php';

    // if($_SESSION['mid'] == "")
    // {
    //     header("location:../Home.php");
    // }
    // include_once ' Connection.php';
      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <link rel="stylesheet" href="../css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/normalize.css">
  	<link rel="stylesheet" href="../css/milligram.min.css">
	  <link rel="stylesheet" href="../css/styles.css">

    <style>
      #tbl{
        margin-left: 100px;
      }
    </style>

</head>
<body>
    <?php $result = mysqli_query($conn, "SELECT mid,mname,phone,wing,flat,image From tbl_member where is_approved='Pending'");  ?>
    <form action="" method="POST">
    <table style="margin-left: 50px; margin-top: 100px;" id="" class="table table-bordered table-hover" >
        <thead>
          <tr>
            <th scope="col" style="padding-left: 5px;">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone No.</th>
            <th scope="col">Wing</th>
            <th scope="col">Flat No.</th>
            <th scope="col">Image</th>
            <th scope="col">Approve</th>
            <th scope="col">Reject  </th>
          </tr>
        </thead>
          <?php  
            $i = 1;
            while($data = mysqli_fetch_array($result))
            {
          ?>
        <tbody>
          <tr>
            <th scope="row" style="padding-left: 10px;"><?php echo $i; ?></th>
            <?php $mid=$data['mid']; ?>
            <td><?php echo $data['mname']; ?></td>
            <td><?php echo $data['phone']; ?></td>
            <td><?php echo $data['wing']; ?></td>
            <td><?php echo $data['flat']; ?></td>
            <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $data['image'] ).'"/>'; ?></td>
            <td><a href='javascript:void(0)' onclick='approve(<?php echo $data['mid']; ?>)'>Approve</a></td>
            <td><a href='javascript:void(0)' onclick='reject(<?php echo $data['mid']; ?>)'>Reject</a></td>     
      <?php $i++; } ?>
              
          </tr>
        </tbody>
        </form>
        
      </table>

      <!-- <h5 class="mt-2">Tables</h5><a class="anchor" name="tables"></a>
			<div class="row grid-responsive" id="tbl">
				<div class="column ">
					<div class="card">
						<div class="card-title">
							<h3>Current Members</h3>
						</div>
						<div class="card-block" >
							<table  >
								<thead>
									<tr>
										<th>Name</th>
										<th>Phone</th>
										<th>Wing</th>
										<th>Flat No.</th>
                    <th>Image</th>
                    <th>Approve</th>
                    <th>Reject</th>
                  </tr>
								</thead>
								<tbody>
									<tr>
										<td>Jane Donovan</td>
										<td>UI Developer</td>
										<td>23</td>
										<td>Philadelphia, PA</td>
									</tr>
									<tr>
										<td>Jonathan Smith</td>
										<td>Designer</td>
										<td>30</td>
										<td>London, UK</td>
									</tr>
									<tr>
										<td>Kelly Johnson</td>
										<td>UX Developer</td>
										<td>25</td>
										<td>Los Angeles, CA</td>
									</tr>
									<tr>
										<td>Sam Davidson</td>
										<td>Programmer</td>
										<td>28</td>
										<td>Philadelphia, PA</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> -->

      

      <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });

        function approve(mid)
        {
            var id = mid;
            $.ajax({
              type:"GET",
              url:"app_rej.php",
              // data: "id="+id,
              data: { id: id, action: 'approve' },
              success:function(data)
              {
                // $(#userTable).html(data);
                  alert('deleted');
              }
            });
        }

        function reject(mid)
        {
            var id = mid;
            $.ajax({
              type:"GET",
              url:"app_rej.php",
              // data: "id="+id,
              data: { id: id, action: 'reject' },
              success:function(data)
              {
                // $(#userTable).html(data);
                  alert('deleted');
              }
            });
        }

         
      </script>

</body>
</html>

===================================================================================================
Registration.php


<?php 
  include_once 'Connection.php';
  include_once '../Project/other/validation.php';
  session_start();
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
        $sid = $_REQUEST['soc'];
        $name = $_REQUEST['name'];
        $mob = $_REQUEST['mob'];    
        $wing = $_REQUEST['wing'];
        $flat = $_REQUEST['flat'];
        $pas = $_REQUEST['pwd'];
        $email = $_REQUEST['email'];
        $filename = $_FILES["image"]["name"]; 
        $tempname = $_FILES["image"]["tmp_name"]; 
        $folder = "Image/user/".$filename; 
        // $msg = "";

        $path    = 'Image/user';
        $files = $files = array_diff(scandir($path), array('.', '..'));

        foreach($files as $id => $fname)
        {
            if($fname == $filename)
            {
              $value = explode(".",$filename);    
              $rndno = rand(100,999);
              $filename = $value[0].$rndno.'.'.$value[1];
              $folder = "Image/user/".$filename;
              echo '<script>alert("'.$filename.'");</script>'; 
              break;
            }
        }   

        $query = "insert into tbl_member (sid,mname,phone,wing,flat,image,email,password,member_type) values ($sid,'$name','$mob','$wing','$flat','$filename','$email',md5('$pas'),'Member')";
        $insert = mysqli_query($conn,$query);

        if (move_uploaded_file($tempname, $folder))  { 
          // $msg = "Image uploaded successfully"; 
          echo '<script>alert("success");</script>';
        }else{ 
          echo '<script>alert("fail");</script>';
        } 

      
}
      


?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="css/logincss.css" rel="stylesheet">
</head>
<body>


<form id="regForm" action="Registration.php" method="POST" enctype="multipart/form-data">
    <h1><b style="color:#f0a73a;">Registration</b></h1><br><br>
    <div class="row">
        <div class="column" >
        <div class="tab">Full Name:
        <p><input type="text" placeholder="Enter Full Name..." oninput="this.className = ''" name="name" id="user" title="Name" required></p>
        </div>
        <span style="color: red;"><?php echo $nameErr; ?></span>
        <div class="tab">Mobile Number:
        <p><input type="tel" placeholder="Enter mobile number...." oninput="this.className = ''" name="mob" title="Eight or more characters" maxlength="10" minlength="10" required></p>
        </div>
        <span style="color: red;"><?php echo $ContactnoErr; ?></span>
        <div class="tab">Image:
            <p><input type="file" placeholder="select image...." oninput="this.className = ''" name="image" id="image" /></p>
        </div>
        
        
        <div class="tab" style="margin-bottom: 15px;">State:
            <select name="state" id="state_dropdown">
                <option>--Select your State--</option>
                <?php
                  $records = mysqli_query($conn, "SELECT * From tbl_state where stid=12");  // Use select query here 

                  while($data = mysqli_fetch_array($records))
                  {
                      echo "<option value='". $data['stid'] ."'>" .$data['sname'] ."</option>";  // displaying data in option menu
                  }	
                ?>
            </select>
          </div>

        <div class="tab" style="margin-bottom: 15px;">City:
           <select name="city" id="city-dropdown">
              <option>--Select your City--</option>
              <?php
                  $records = mysqli_query($conn, "SELECT cname From tbl_city where stid=12");  // Use select query here 

                  while($data = mysqli_fetch_array($records))
                  {
                      echo "<option value='". $data['cid'] ."'>" .$data['cname'] ."</option>";  // displaying data in option menu
                  }	
                ?>
          </select>
        </div>

        <div class="tab" style="margin-bottom: 15px;">Landmark:
            <select name="landmark" id="landmark-dropdown" onselect="myFunction()">
              <option>--Select your Landmark--</option>
              <?php
                  $records = mysqli_query($conn, "select DISTINCT(landmark) FROM tbl_my_society where cid =54");  // Use select query here 

                  while($data = mysqli_fetch_array($records))
                  {
                      echo "<option value='". $data['landmark'] ."'>" .$data['landmark'] ."</option>";  // displaying data in option menu
                  }	
                ?>
              </select>
        </div>
        </div>

        <div class="column">
        <div class="tab" style="margin-bottom: 15px;">Society:
              <select name="soc" id="soc">
                  <option>--Select your Society--</option> 
                  <?php
                  $records = mysqli_query($conn, "SELECT sid,sname From tbl_my_society");  // Use select query here 

                  while($data = mysqli_fetch_array($records))
                  {
                      echo "<option value='". $data['sid'] ."'>" .$data['sname'] ."</option>";  // displaying data in option menu
                  }	
                ?>
              </select>
        </div> 

        <div class="tab">Wing:
            <p><input type="text" placeholder="Enter wing...." oninput="this.className = ''" name="wing" id="wing" required></p>
        </div>
        <span style="color: red;"><?php echo $wingErr; ?></span>
        <div class="tab">Flat No.:
            <p><input type="text" placeholder="Enter Flat no....." oninput="this.className = ''" name="flat" id="flat" required></p>
        </div>
        <span style="color: red;"><?php echo $flatErr; ?></span>
        <div class="tab">Email:
            <p><input type="email" placeholder="Enter email...." oninput="this.className = ''" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></p>
        </div>
        <span style="color: red;"><?php echo $emailErr; ?></span>
        <div class="tab">Password:
            <p><input type="password" placeholder="Enter Password...." oninput="this.className = ''" name="pwd" id="pass" required></p>
        </div>
        <span style="color: red;"><?php echo $passwordErr; ?></span>
        </div>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <input type="submit" name="regBtn" onclick="next()" value="Submit" style="background-color: #f0a73a; color:#ffffff;">
      </div>
    </div>
</div>
</form>

  <script>
    
    function next()
    {
      var inp = document.getElementsByTagName("input");
      // var y = document.getElementById("user");

      var i;
      for(i=0;i<inp.length;i++)
      {
        if(inp[i].value == "")
        {
          inp[i].classList.add("invalid");
        }
      }

  }
    

    

  </script>
  
  <!-- Ajax Script -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

  <!-- Bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>


=================================================================================================================
logincss.css

* {
  box-sizing: border-box;
}

body {
  background-color: #f7f2dfe7;
  /* overflow-y: hidden; */
} 

#regForm {
  /* margin-top: 15px; */
  background-color: #ffffff;
  margin: 70px auto;
  font-family: Raleway;
  padding: 10px;
  width: 60%;
  /* min-width: 300px; */
}

#reg {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 20%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

select {
  padding: 10px;
  margin-top: 15px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

input.invalid {
  background-color: #ffdddd;
}

input[type=submit] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

/* .tab {
  display: none;
} */

button {
  background-color: #35cebe;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

.column {
  float: left;
  width: 50%;
  padding: 100px;
  /* height: 300px; Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


==================================================================================================
Admin_Dashboard(OLD)


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>
  <div style="background-color:#696969; width:100%; height:75px;">
    <a style="font-size:40px; color:#f0a73a; padding-left:10px; padding-top:15px;">DASHBOARD</a>
    <button style="background-color:blueviolet; float:right; padding:5px; border-radius:20px; margin-top:15px; margin-left:10px;">LOGOUT</button>
    <a style="font-size:25px; color:#f0a73a; padding-left:10px; float:right; padding-top:15px;">Hello,Admin</a>
  </div>

  <div class="d-flex" id="wrapper">
    <!-- <a style="text-align:left; text-size:15px; ">Dashboard</a> -->
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <!-- <div class="sidebar-heading">Dashboard</div> -->
      <div class="list-group list-group-flush">
        <a href="Add_Society.php" class="list-group-item list-group-item-action bg-light">Register Society</a>
        <a href="Add_President.php" class="list-group-item list-group-item-action bg-light">Register President</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">View Societies</a>
        <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->


      </div>
    </div>
    

</body>

</html>


========================================================================================
Add_Society.php


<?php 
    // include_once 'Admin_Dashboard.php';
    include_once '../Connection.php';
    session_start();
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Society</title>
    <link href="../css/logincss.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/milligram.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <style>

        form {
            margin:200px auto auto 500px ;
            font-family: Raleway;
        }

        input select{
            margin-top: 0px;
        }

        textarea {
            font-family: Raleway;
        }

    </style>
</head>
<body>
  <?php 
     if(isset($_REQUEST['btnAddSoc']))
     {
         $sname = $_POST['sname'];
         $addr = $_REQUEST['addr'];
         $pincode = $_REQUEST['pin'];
        //  $stateid = $_REQUEST['state'];
        //  $cityid = $_REQUEST['city'];
        //  $landmarkid = $_REQUEST['landmark'];
         $txtLandmark = $_REQUEST['lmark'];
 
        //  echo "<script>alert(".$pincode.");</script>";
        //  echo "<script>alert('asasasas');</script>";

     }
  ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
    <?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
    <form id="lgForm" action="" method="POST">
        <h3><b style="color:#35cebe;">ADD SOCIETY</b></h3>
        <div class="tab">Society Name:
          <p><input type="text" placeholder="Enter society name..." oninput="this.className = ''" name="sname" id="sname"></p>
        </div>
        <div class="tab">Address:
          <p><textarea name="addr" id="addr" placeholder="Enter Address...."></textarea></p>
        </div>
        <div class="tab">Pincode:
          <p><input type="text" placeholder="Enter pincode..." oninput="this.className = ''" name="pin" id="pin"></p>
        </div>
        <div class="tab" style="margin-bottom: 15px;">State:<br>
                <select name="state" id="state_dropdown">
                    <option>SELECT STATE</option>
                    <?php
                      $records = mysqli_query($conn, "SELECT * From tbl_state");  // Use select query here 

                      while($data = mysqli_fetch_array($records))
                      {
                          echo "<option value='". $data['stid'] ."'>" .$data['sname'] ."</option>";  // displaying data in option menu
                      }	
                    ?>
                </select>
            </div>

            <div class="tab" style="margin-bottom: 15px;">City:<br>
                <select name="city" id="city_dropdown">
                  <!-- <option>--Select your City--</option> -->
                </select>
            </div>

            <div class="tab" style="margin-bottom: 15px;">Select landmark (if exist):<br>
                <select name="landmark" id="landmark_dropdown" onselect="myFunction()">
                  <!-- <option>--Select your Landmark--</option> -->
                </select>
            </div>
            <h2><center>OR</center></h2>
            <div class="tab">Landmark:
              <p><input type="text" placeholder="Enter landmark..." oninput="this.className = ''" name="lmark" id="lmark"></p>
            </div>
        <div style="overflow:auto;">
          <div style="float:right;">
            <input type="submit" name="btnAddSoc" onclick="sub()" style="background-color:#35cebe; font-size:15px; color:#ffffff;">
          </div>
        </div>
    </form>

  <script>
    $('#state_dropdown').on('change', function() {
              // alert(this.value);
              $("#city_dropdown").html("<option value=''>SELECT CITY</option>");
              $.ajax({
                  url: "../Registration/Get_City.php",
                  type: 'post',
                  data: { "id": $("#state_dropdown").val()},
                  success: function(result){
                    // alert(result);
                    var str = "<option value=''>SELECT CITY</option>";
                    $.each(result,function(key,value) {
                        str = str + "<option value='" + value.id + "'>" + value.name + "</option>";
                    });
                    $("#city_dropdown").html(str);
                },
                error: function(err) {
                    alert(err.responseText);
                }
            });
       });


        // Getting Landmarks
        $('#city_dropdown').on('change', function() {
                    // alert( this.value );
                    $("#landmark_dropdown").html("<option value=''>SELECT LANDMARK</option>");
                    $.ajax({
                        url: "../Registration/Get_Landmark.php",
                        type: 'post',
                        data: { "id": $("#city_dropdown").val()},
                        success: function(result){
                          // alert(result);
                          var str = "<option value=''>SELECT LANDMARK</option>";
                          $.each(result,function(key,value) {
                              str = str + "<option value='" + value.id + "'>" + value.name + "</option>";
                          });
                          $("#landmark_dropdown").html(str);
                      },
                      error: function(err) {
                          alert("error");
                      }
                  });
        });


        // Getting Societies
        $('#landmark_dropdown').on('change', function() {
              // alert( this.value );
              $("#society_dropdown").html("<option value=''>SELECT SOCIETY</option>");
              $.ajax({
                  url: "../Registration/Get_Society.php",
                  type: 'post',
                  data: { "id": $("#landmark_dropdown").val()},
                  success: function(result){
                    // alert(result);
                    var str = "<option value=''>SELECT SOCIETY</option>";
                    $.each(result,function(key,value) {
                        str = str + "<option value='" + value.id + "'>" + value.name + "</option>";
                    });
                    $("#society_dropdown").html(str);
                },
                error: function(err) {
                    alert("error");
                }
            });
        });

        function sub()
        {
            var a = document.getElementsByName("state").value;
            console.log(a);
        }
  </script>
</body>
</html>



-------------------------------------------------------------------------------------------------------------------
visitor entry request form


<form action="" method="POST" name="lgForm" id="lgForm" onsubmit="return validateForm()" novalidate>

        <h3><b style="color:#35cebe;">VISITOR ENTRY REQUEST</b></h3>
        <div class="tab">Visitor Name:
            <p><input type="text" placeholder="Enter Visitor name..." name="name" id="name" required="true"></p>
        </div>
        <div class="tab">Visitor Mobile No::
            <p><input type="phone" placeholder="Enter Visitor mobile number..." name="contact" id="contact" maxlength="10" required="true"></p>
        </div>
        <div class="tab" style="margin-bottom: 15px;">Wing:<br>
            <select name="wing" id="wing_dropdown">
                <option>--  SELECT WING  --</option>
                <?php
                //                      $records = mysqli_query($conn, "SELECT wing From tbl_member where sid=$_SESSION["socid"]");  // Use select query here
                //
                //                      while($data = mysqli_fetch_array($records))
                //                      {
                //                          echo "<option value='". $data['stid'] ."'>" .$data['sname'] ."</option>";  // displaying data in option menu
                //                      }
                ?>
            </select>
        </div>

        <div class="tab" style="margin-bottom: 15px;">Select Flate:<br>
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
        <div style="overflow:auto;">
            <div style="float:right;">
                <!-- <input type="submit" value="Send" name="btnSendreq" style=" background-color:#35cebe; font-size:15px; color:#ffffff;"> -->
                <button type="submit" value="Send" id="btnSendreq" name="btnSendreq" style="text-align: center; font-size: 15px;">SEND</button>

            </div>
        </div>
    </form>


    function validateForm() {
        var err = false;
        var name = $('#name').val();
        var contact = $('#contact').val();
        var desc = $('#desc').val();
        var flat = $('#flat_dropdown').val();
        var wing = $('#wing_dropdown').val();

        if (name == "" || name == " " || !/^[a-zA-Z ']{0,31}$/.test(name)) {
            toastr.error('Name Is not Valid.');
            err = true;
        }

        if (contact == "" || contact == " " || !/^[9876][0-9]{9}$/.test(contact)) {
            toastr.error('Contact Is not Valid.');
            err = true;
        }

        if (desc == "" || desc == " " ){
            toastr.error('Description Is not Valid.');
            err = true;
        }

        if (wing == "" || wing <= 0) {
            toastr.error('Select Wing.');
            err = true;
        }

        if (flat == "" || flat <= 0) {
            toastr.error('Select Flat.');
            err = true;
        }

        if (err == true) {
            return false;
        }

    }


-------------------------------------------------------------------------------------------------------------------------------------------------------------
Pay_gold.php (OLD) (razorpay integration code)

<?php 
include_once 'Member_Dashboard.php';
include_once '../Connection.php';

if ($_SESSION['mid'] == "") {
    header("location:../Home.php");
}

$apiKey = "rzp_test_fDhgTi2arCRG5o";

$q = "select * from tbl_maintenance where sid = ".$_SESSION['socid'] . " and year = ".date('Y');
$sel = mysqli_query($conn,$q);
$data = mysqli_fetch_array($sel);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Maintenance</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<style>
    .razorpay-payment-button { display: none; }
</style>
</head>
<body>

<form action="" method="POST">
<script
   src="https://checkout.razorpay.com/v1/checkout.js"
   data-key="<?php echo $apiKey; ?>"  //Enter the Test API Key ID generated from Dashboard → Settings → API Keys
   data-amount="<?php echo $data['dis_12'] * 100;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
   data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
   data-id="<?php echo 'OID'.rand(10,100).'END';?>"//Replace with the order_id generated by you in the backend.
   data-buttontext="Pay with Razorpay"
   data-name="My Society"
   data-description="Maintenance Collection"
   data-image="../Image/logo.png"
   data-prefill.name="<?php echo $_SESSION['mname'];?>"
   data-prefill.email="<?php echo $_SESSION['email'];?>"
   data-prefill.contact="<?php echo $_SESSION['phone'];?>"
   data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('.razorpay-payment-button').click();
    });
</script>
</body>
</html>