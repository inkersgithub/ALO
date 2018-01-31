<?php
include_once 'dbconnect.php';

$center_lat = "10.778055";
$center_lng = "76.344915";
$radius = 300;

// Search the rows in the markers table
$query = sprintf("SELECT *, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM alo_booklist HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysqli_real_escape_string($con,$center_lat),
  mysqli_real_escape_string($con,$center_lng),
  mysqli_real_escape_string($con,$center_lat),
  mysqli_real_escape_string($con,$radius));
$result = mysqli_query($con,$query);

$result = mysqli_query($con,$query);
if (!$result) {
  die("Invalid query: " . mysqli_error());
}
echo "<br />";

// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
    echo $row['id2'];
    echo $row['distance'];
    echo $row['place'];
    echo "<br />";
}




?>
