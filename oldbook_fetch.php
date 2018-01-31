<?php
include_once 'dbconnect.php';

$center_lat = $_POST['latt'];
$center_lng = $_POST['lngg'];
$radius = 600;

// Search the rows in the markers table
$query = sprintf("SELECT *, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM alo_booklist WHERE status = '1' HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
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

    echo '<div class="cardsets">
    <a href="single.php?bookid='.$row['id2'].'" style="text-decoration:blink">
    <div class="" style="text-align:center;">
    <p style="word-wrap: break-word;padding-top: 8px;">
    <b>	'.$row['book_name'].' by '.$row['book_author'].'  </b>
    </p>
    </div>
    <div class="" style="text-align:center;">
    <p style="word-wrap: break-word;">
    ₹ '.$row['book_newprice'].'
    </p>
    </div>
    </a>
    </div>';
}

?>
