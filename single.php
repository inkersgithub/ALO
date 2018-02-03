<!DOCTYPE html>
<html>
<?php
include_once 'dbconnect.php';
$bookid = $_GET['bookid'];
?>
<head lang=en>
<meta charset=UTF-8>
<link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js></script>
<link rel=stylesheet href=https://www.w3schools.com/w3css/4/w3.css>
<title>Alo</title>
<meta name=viewport content="width=device-width, initial-scale=1.0">
<style>.pac-container{z-index:99999}.search-button{background:#337ab7;color:#fff;border:0;position:fixed;padding:.6em;cursor:pointer;padding-left:10px;padding-right:10px;transition:800ms ease all;outline:0;margin-left:0;bottom:0}button:focus{outline:0}</style>
</head>
<body>
<div class=container style=margin-top:0;padding-right:0;padding-left:0>
<?php
        $sql = "SELECT * FROM alo_booklist WHERE id2 = '$bookid'";
        $value = mysqli_fetch_object(mysqli_query($con,$sql));
        ?>
<div class=row style=margin-right:0;margin-left:0>
<div style=text-align:center id="results">
</div>
<button class=search-button style=width:100% onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Details</button>
</div>
</div>
</body>
<div id=id01 class=w3-modal>
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style=max-width:600px;margin-top:50px>
<div class=w3-center><br>
<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
</div>
<div class=w3-section>
<div style=text-align:center>
<p><b><?php echo ($value->book_name) ;?></b></p>
<p>Author : <b><?php echo ($value->book_author) ;?></b></p>
</div>
<div style=margin-top:12px>
<?php
                $sql2 = "SELECT name,mobile FROM alo_user WHERE id1 = '$value->usr_id'";
                $value2 = mysqli_fetch_object(mysqli_query($con,$sql2));
                if(($value->status)==0){
                    $text_line = explode(",",$value->place);
                    echo '<p style="float:left;margin-left:25px;font-size: 13px;">Old Price - <b>'.$value->book_oldprice.'</b></p>
                    <p style="float:right;margin-right:25px;font-size: 13px;">Reselling Price - <b>'.$value->book_newprice.'</b></p><br/><br/>
                    <p style="text-align:center;margin-top: -13px;font-size: 14px;"><b>'.$text_line[0].','.$text_line[1].'</b></p><br />
                    <p style="text-align:center;margin-top: -20px;font-size: 13px;">'.$value->book_about.'</p><br />
                    <p style="text-align:center;margin-top: -15px;font-size: 14px;">Posted By '.$value2->name.'</p>';
                }else {
                    echo '<p style="text-align:center;font-size: 13px;margin-top: 0px;">Price - <b>'.$value->book_newprice.'</b></p><br />
                    <p style="text-align:center;margin-top:-20px;font-size: 13px;">'.$value->book_about.'</p>';
                }
                ?>
</div>
<div>
</div>
<input type=hidden value=<?php echo ($value->id2); ?> id="bookid"/>
<div id=result>
    <a href = "tel:<?php echo ($value2->mobile); ?>"><button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Call</button></a>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    setTimeout(function(){
        document.getElementById("results").innerHTML = '<img width=280 style=width:100%;height:auto src=<?php if(($value->path)=="null"){echo "images/not_uploaded.jpg";}else{ echo $value->path; } ?> >';
    },400);
});
</script>
</html>
