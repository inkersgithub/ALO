<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['do_reset'])){
    $cpassword=$_POST['currentpassword'];
    $npassword=$_POST['newpassword'];
    $result = mysqli_num_rows(mysqli_query($con,"SELECT * FROM alo_user WHERE id1 = '".$_SESSION['usr_id']."' AND password = '".$cpassword."'"));
    if($result == 1){
        $sql = "UPDATE alo_user SET password = '".$npassword."' WHERE id1 = '".$_SESSION['usr_id']."' AND password = '".$cpassword."'";
        mysqli_query($con,$sql);
        echo "success"; // wrong details

    }else{
        echo "fail";
    }
    exit();
}
?>
