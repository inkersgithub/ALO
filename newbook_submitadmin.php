<?php
session_start();
include_once 'dbconnect.php';
$book_name = $_POST['bname'];
$book_author = $_POST['bauthor'];
$book_oldprice = $_POST['boldprice'];
$book_newprice = $_POST['bnewprice'];
$book_about = $_POST['babout'];
if(!isset($_POST['path'])){
	$path = "null";
}else{
	$path = $_POST['path'];
}
$userid = "2";
$sql = "INSERT INTO alo_booklist(usr_id, book_name, book_oldprice, book_newprice, book_author, book_about, path, status) VALUES ('$userid', '$book_name', '$book_oldprice', '$book_newprice', '$book_author', '$book_about', '$path', '1')";
if(mysqli_query($con,$sql)){
	echo '<div id="results" style="text-align: center;color: green;margin-top: 11px;
	margin-bottom: 12px;">
	<span>Added Successfully!</span>
	</div>';
}else{
	echo '<div id="results" style="text-align: center;color: red;margin-top: 11px;margin-bottom: 12px;">
	<span>Error!</span>
	</div>';
}
?>
