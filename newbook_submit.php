<?php
include_once 'dbconnect.php';
$book_name = $_POST['bname'];
$book_author = $_POST['bauthor'];
$book_oldprice = $_POST['boldprice'];
$book_newprice = $_POST['bnewprice'];
$book_about = $_POST['babout'];
$latitude = $_POST['lat'];
$longitude = $_POST['lon'];

$sql = "INSERT INTO alo_booklist(usr_id, book_name, book_oldprice, book_newprice, book_author, book_about, latitude, longitude) VALUES ('1', '$book_name', '$book_author', '$book_oldprice', '$book_newprice', '$book_about', '$latitude', '$longitude')";
mysqli_query($con,$sql);





  echo "==============================<br />";
  echo "All Data Submitted Successfully!";
?>
