<?php
include_once 'dbconnect.php';

$center_lat = $_POST['latt'];
$center_lng = $_POST['lngg'];
$radius = 600;

// Search the rows in the markers table
$query = "SELECT  * FROM alo_booklist WHERE status='1' LIMIT 0,20";
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
    ₹ 220
    </p>
    </div>
    </a>
    </div>';
}

?>
