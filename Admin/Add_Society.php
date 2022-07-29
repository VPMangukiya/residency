<?php 
    // session_start();

   include_once './Admin_Dashboard.php'; 
   include_once '../Connection.php';
   include_once '../validation.php';
  //  include_once '../links.php';

  if($_SESSION['mid'] == "")
  {
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
  <link href="../css/logincss.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <style>
    html{
      font-family: Raleway;
      background-color: #f7f2dfe7;
    }

    body{
      background-color: #f7f2dfe7;
    }

    .almark{
        font-family: Raleway;
    }

    button 
    {
      background-color: #35cebe;
      border: 0.1rem solid #35cebe;
      border-radius: 499rem;
      font-size: 1.75rem;
      color : #ffffff; 
      font-weight: bold;
    }
    
    .navbar{
      position: fixed;
    }
  </style>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

    
  <?php

    $snameErr = "";
    $addrErr = "";
    $pinErr = "";
    $landmarkErr = "";
    $result = false;

    if(isset($_REQUEST['btnAddlm']))
    {   
      if($_COOKIE['stid'] == "" || $_COOKIE['stid'] == null || $_COOKIE['cid'] == "" || $_COOKIE['cid'] == null)
      {
        // echo "<script>alert(".$_COOKIE['stid'].");</script>";
        // echo "<script>document.getElementById('error').innerHTML = Select state and city both!!</script>";
        echo "<script>alert('Select state and city both!!');</script>"; 
        // echo "<script>alert(".$_COOKIE['stid']."<br>".$_COOKIE['cid'].");</script>";  

      }

      $landmark = $_REQUEST['lmark'];

      if(empty($landmark) || !preg_match("/^[A-Za-z0-9 ]*$/",$landmark))
      {
        echo "<script>alert('Landmark name not valid!!');</script>";
      }
      else{
          $q = "insert into tbl_landmark (cid,landmark) values (".$_COOKIE['cid'].",'$landmark')";
          mysqli_query($conn,$q);
      }
    }

    if(isset($_REQUEST['btnAddSoc']))
    {
        // echo "<br><br><br><br><br><br><br><br><br><br><br><h1>aaaaaaaaaaaaaaaaaaaaaaaaaaaaa".$_REQUEST['addr']."</h1>";
        // echo "<script>alert(".$_REQUEST['sname'].");</script>";
        // echo "<script>console.log(".$_REQUEST['sname'].");</script>";

        global $snameErr,$addrErr,$pinErr,$landmarkErr;

        $sname = $_POST['sname'];
        $addr = $_REQUEST['addr'];
        $pincode = $_REQUEST['pin'];
        $stateid = $_REQUEST['state'];
        $cityid = $_REQUEST['city'];
        $landmarkid = $_REQUEST['landmark'];
        // $txtLandmark = $_REQUEST['lmark'];

        if(empty($sname) || !preg_match("/^[A-Za-z0-9- ]+$/",$sname))
        {
          $snameErr = "Society Name is not Valid";
          $result = true;
        }

        if(empty($addr) || !preg_match("/^[A-Za-z0-9-,. ]+$/",$sname))
        {
          $addrErr = "Address is not Valid";
          $result = true;
        }

        if(pincode($pincode))
        {
          $pinErr = "Pincode is not Valid";
          $result = true;
        }

        if(empty($landmarkid) || $landmarkid == 0)
        {
          $landmarkErr = "Please Select Landmark.";
          $result = true;
        }

        if($result == true)
        {
          goto start;
        }

        $query = "insert into tbl_society (sname,address,pincode,lid,cid,stid) values ('$sname','$addr',$pincode,$landmarkid,$cityid,$stateid)";
        $insert = mysqli_query($conn,$query);

    }
  
  start:
  ?>
<form id="lgForm" action="" method="POST">
        <h3><b style="color:#35cebe;">ADD SOCIETY</b></h3>
        <div class="tab">Society Name:
          <p><input type="text" placeholder="Enter society name..." oninput="this.className = ''" name="sname" id="sname"></p>
        </div>
        <span style="color: red; font-size: 15px;"><?php echo $snameErr; ?></span>
        <div class="tab">Address:
          <p><textarea name="addr" id="addr" placeholder="Enter Address...."></textarea></p>
        </div>
        <span style="color: red; font-size: 15px;"><?php echo $addrErr; ?></span>
        <div class="tab">Pincode:
          <p><input type="text" placeholder="Enter pincode..." oninput="this.className = ''" name="pin" id="pin" maxlength="6"></p>
        </div>
        <span style="color: red; font-size: 15px;"><?php echo $pinErr; ?></span>
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
            
            &nbsp;&nbsp; <b>or</b><br><span style="color: red; font-size: 15px;" id="landmarkErr"><?php echo $landmarkErr; ?></span> <br><br><button type="button" id="btnAdd_lmark" data-toggle="modal" data-target="#exampleModal">Add Landmark</button>
        </div>
            <!-- <h2><center>OR</center></h2> -->
            
        <div style="overflow:auto;">
          <div style="float:right;">
            <input type="submit" value="ADD" name="btnAddSoc" onclick="sub()" style="background-color:#35cebe; font-size:15px; color:#ffffff;">
          </div>
        </div>

        <div class="almark">
              <!-- <p><input type="text" placeholder="Enter landmark..." oninput="this.className = ''" name="lmark" id="lmark"></p> -->
                  <!-- Modal Class start -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                          <br><b>State : </b><span id='sh_stid' style="margin-right: 30px;"></span>
                          <b>City : </b><span id='sh_cid'></span>
                        </div>
                        <div class="modal-body">
                          <form action="" method="POST" name="alform" id="alform">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Landmark Name:</label>
                              <input type="text" class="form-control" id="lmark" name="lmark" placeholder="Enter Landmark Name....">
                            </div>
                            <span id="error"></span>
                          <!-- </form> -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" data-dismiss="modal" style="font-size: 15px;">Close</button> 
                          <input type="submit" onclick="" value="Add" id="btnAddlm" name="btnAddlm" style="width:100px; font-size: 15px;">
                          </form>  
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal class end -->
        </div>
    </form>

    <script>
    
      $(document).ready(function ()
      {
            // Getting Cities
            $('#state_dropdown').on('change', function() {
                  // alert( this.value );
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
                      // disableTxt();
            });

            // Disable landmark   
            // $('#landmark_dropdown').on('click', function() { 
            //   document.getElementById("lmark").disabled = true;
            // });

            // $('#lmark').on('click', function() { 
            //   document.getElementById("landmark_dropdown").disabled = true;
            // });

            $('#btnAdd_lmark').on('click',function(){
                // var stid =  $("#state_droppdown option:selected").text();
                var stid = document.getElementById("state_dropdown").options[document.getElementById('state_dropdown').selectedIndex].text;
                var cid = document.getElementById("city_dropdown").options[document.getElementById('city_dropdown').selectedIndex].text;
                document.getElementById("sh_stid").innerHTML = stid; 
                document.getElementById("sh_cid").innerHTML = cid; 
                
                var d = new Date();
                d.setTime(d.getTime () + (15*1000));
                var expires = "expires="+ d.toUTCString();
                
                document.cookie="stid= " + document.getElementById("state_dropdown").value + ";" + expires + ";path=/";
                document.cookie="cid= " + document.getElementById("city_dropdown").value + ";" + expires + ";path=/";
            });

            // $('#alform').on('submit',function(event){
            //   event.preventDefault();
            // });
      });

      function sub()
      {
        selectElement = document.querySelector('#landmark_dropdown'); 
        output = selectElement.value; 

        if(output == "")
        {
          document.getElementById("landmarkErr").innerHTML = "Please select society.";
        }
      }

      function btnAdd_lmark_check()
      {
        
      }

      $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var modal = $(this)
        modal.find('.modal-title').text('Add Landmark')
      })
  </script>    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>