<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST['do_login'])){

    $email=$_POST['email'];
    $pass=$_POST['password'];
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
    exit();
}
?>
