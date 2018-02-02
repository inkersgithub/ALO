<?php
session_start();
include_once 'dbconnect.php';
$userid = $_SESSION['usr_id'];
$bookid = $_POST['bookid'];

if(mysqli_query($con, "DELETE FROM alo_booklist WHERE id2 = '".$bookid."' AND usr_id = '".$userid."'")){
 echo '<button class="w3-button w3-block w3-red w3-section w3-padding" id="myBtn" style="background-color: #f44336!important;color: #000!important; ">Removed From List</button>';
}else{
echo '<button class="w3-button w3-block w3-red w3-section w3-padding" id="myBtn" style="background-color: #f44336!important;color: #000!important; ">Error</button>';
}
?>
