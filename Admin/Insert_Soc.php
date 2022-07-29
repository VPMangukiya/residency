<?php 
    include_once "../Connection.php";
    session_start();

    $q = "select lid from tbl_landmark where landmark = ".$_SESSION['add_soc_lmark']." and cid = ".$_SESSION['add_soc_cid']."";
    $data = mysqli_query($conn,$q);

    if(mysqli_num_rows($data) > 0)
    {
        $query2 = "insert into tbl_society (sname,address,pincode,lid,cid,stid) values (".$_SESSION['add_soc_sname'].",".$_SESSION['add_soc_sname'].",".$_SESSION['add_soc_sname'].",".$data['lid'].",".$_SESSION['add_soc_cid'].",".$_SESSION['add_soc_stid'].")";     
        
        if(!$in = mysqli_query($conn,$query2))
        {
            echo mysqli_error($conn);
        }
        else
        {
            echo "success";
        }
    }
    else{
        echo mysqli_error($conn);
    }

    
    
    // if(!$insert2 = mysqli_query($conn,$query2))

?>