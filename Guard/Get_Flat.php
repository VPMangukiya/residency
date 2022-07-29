<?php
    session_start();
    include_once '../Connection.php';

    $wing = $_POST['wing'];
    $result = mysqli_query($conn, "select distinct(flat) from tbl_member where wing ='". $wing ."' and sid = ".$_SESSION['socid'] );

    $object = array();

    while ($row = mysqli_fetch_array($result)){
            $object[] = array(
                "flat" => $row["flat"]
            );
    }

    header("content-type: application/json");
    echo json_encode($object); 
?>
 
