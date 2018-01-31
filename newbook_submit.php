<?php
include_once 'dbconnect.php';
$book_name = $_POST['bname'];
if(!isset($_POST['path'])){
	$path = "null";
}else{
	$path = $_POST['path'];
}

$book_author = $_POST['bauthor'];
$book_oldprice = $_POST['boldprice'];
$book_newprice = $_POST['bnewprice'];
$book_about = $_POST['babout'];
$latitude = $_POST['lat'];
$longitude = $_POST['lon'];

$address = getAddress($latitude,$longitude);

while($address==false){
	$address = getAddress($latitude,$longitude);
}

$sql = "INSERT INTO alo_booklist(usr_id, book_name, book_oldprice, book_newprice, book_author, book_about, latitude, longitude, place, path) VALUES ('2', '$book_name',  '$book_oldprice', '$book_newprice', '$book_author', '$book_about', '$latitude', '$longitude', '$address', '$path')";
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


function getAddress($latitude,$longitude){
    if(!empty($latitude) && !empty($longitude)){
        //Send request and receive json data by address
        $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false');
        $output = json_decode($geocodeFromLatLong);
        $status = $output->status;
        //Get address from json data
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        //Return address of the given latitude and longitude
        if(!empty($address)){
            return $address;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

?>
