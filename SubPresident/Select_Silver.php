<?php 
    include_once 'SPresident_Dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>

<body>

    <div style="margin-top:200px; margin-left:350px;">
    <center><h1>Select Installment :</h1>
    <form action="Silver_Plan.php" method="POST" style="margin-top:100px;">
        <select name="inst" id="inst">
            <option value="1">First</option>
            <option value="2">Second</option>
        </select>

        <input type="submit" value="Pay">
    </form>
    </center>
    </div>
</body>

</html>