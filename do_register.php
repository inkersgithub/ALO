<?php
session_start();
include_once 'dbconnect.php';
if(isset($_POST['do_register'])){
    $email=$_POST['email'];
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $pass=$_POST['password'];
    $sql = "INSERT INTO alo_user(name,email,mobile,password)VALUES('$name','$email','$mobile','$pass')";
    if(mysqli_query($con,$sql)){
        $result = mysqli_query($con, "SELECT * FROM alo_user WHERE email = '" . $email. "' and password = '" . $pass . "'");
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['usr_id'] = $row['id1'];
            $_SESSION['usr_name'] = $row['name'];
            $_SESSION['usr_email'] = $row['email'];
            $_SESSION['usr_mobile'] = $row['mobile'];

            echo "success";
        }
        else {
            echo "fail"; // wrong details
        }
    }else{
        echo "fail";
    }
    exit();
}
?>
