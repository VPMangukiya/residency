<?php
// session_start();

include_once 'SPresident_Dashboard.php';
include_once '../Connection.php';
include_once '../validation.php';
include_once '../links.php';
$wing = $_SESSION['wing'];
$sid = $_SESSION['socid'];

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/milligram.min.css">
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="modal" tabindex="-1" role="dialog" id=myModal>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notice from your President</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $q = "select * from tbl_notice where mid = (select mid from tbl_member where sid = $sid and wing = '$wing' and member_type IN ('President','Spresident'))";
              
              $select = mysqli_query($conn,$q);
              $i = 1;
              while($data = mysqli_fetch_array($select)){  ?>
                <b><p style="text-decoration: underline;"><?php echo $data['notice_date'] ?> : </p></b>
                 <p><?php echo $data['message'] ?></p>   

                 <hr>
        <?php $i++; } ?>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
     $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
</body>
</html>