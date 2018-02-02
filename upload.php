<?php
//upload.php
include_once 'dbconnect.php';

$sql = "SELECT COUNT(id2) as TOTAL FROM alo_booklist";
$value = mysqli_fetch_assoc(mysqli_query($con,$sql));
$num = $value['TOTAL'];
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = rand(1000, 9999) . '.' . $ext;
 $location = 'images/' .$num . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 echo '<img src="'.$location.'" height="100" width="125" class="img-thumbnail" />
 		<input type="hidden" value="'.$location.'" id="path"/>';
}
?>
