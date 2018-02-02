<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['do_resetmobile'])){
    $mobile=$_POST['mobile'];
    $result = mysqli_num_rows(mysqli_query($con,"SELECT * FROM alo_user WHERE id1 = '".$_SESSION['usr_id']."'"));
    if($result == 1){
        $sql = "UPDATE alo_user SET mobile = '".$mobile."' WHERE id1 = '".$_SESSION['usr_id']."'";
        mysqli_query($con,$sql);
        echo "success"; // wrong details

    }else{
        echo "fail";
    }
    exit();
}
?>
