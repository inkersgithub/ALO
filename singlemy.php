<!DOCTYPE html>
<html>
<?php
include_once 'dbconnect.php';
$bookid = $_GET['bookid'];
?>
<head lang="en">
    <meta charset="UTF-8">
    <!-- Bootstrap stuff -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEelMW2Wnlzbq1KFNvOF3fCaLp_FTclFA&sensor=false&libraries=places" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="dist/locationpicker.jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Alo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .pac-container {
        z-index: 99999;
    }

    .search-button {
        background: #337ab7;
        color: #fff;
        border: none;
        position: fixed;
        padding: 0.6em;
        cursor: pointer;
        padding-left: 10px;
        padding-right: 10px;
        transition: 800ms ease all;
        outline: none;
        margin-left: 0%;
        bottom: 0;
    }

    button:focus {
        outline: 0;
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top:0px;padding-right: 0px;padding-left: 0px;">
        <?php
        $sql = "SELECT * FROM alo_booklist WHERE id2 = '$bookid'";
        $value = mysqli_fetch_object(mysqli_query($con,$sql));
        ?>
        <div class="row" style="margin-right: 0px;margin-left: 0px; ">
            <div style="text-align:center;">
                <img width="280" style="width: 100%;height: auto;" src="<?php echo $value->path; ?>">
            </div>
            <button class="search-button" style="width:100%" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Details</button>
        </div>
    </div>
</body>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px;margin-top: 50px;">
        <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        </div>
        <div class="w3-section">
            <div style="text-align:center">
                <p><b><?php echo ($value->book_name) ;?></b></p>
                <p>Author : <b><?php echo ($value->book_author) ;?></b></p>
            </div>
            <div style="margin-top:12px">
                <?php
                $sql2 = "SELECT name,mobile FROM alo_user WHERE id1 = '$value->usr_id'";
                $value2 = mysqli_fetch_object(mysqli_query($con,$sql2));
                if(($value->status)==0){
                    $text_line = explode(",",$value->place);
                    echo '<p style="float:left;margin-left:25px;font-size: 13px;">Old Price - '.$value->book_oldprice.'</p>
                    <p style="float:right;margin-right:25px;font-size: 13px;">Reselling Price - '.$value->book_newprice.'</p><br/><br/>
                    <p style="text-align:center;margin-top: -13px;font-size: 14px;">'.$text_line[0].','.$text_line[1].'</p><br />
                    <p style="text-align:center;margin-top: -20px;font-size: 13px;">'.$value->book_about.'</p><br />
                    <p style="text-align:center;margin-top: -15px;font-size: 14px;">Posted By '.$value2->name.'</p>';
                }else {
                    echo '<p style="text-align:center;font-size: 13px;margin-top: 0px;">Price - '.$value->book_newprice.'</p><br />
                    <p style="text-align:center;margin-top:-20px;font-size: 13px;">'.$value->book_about.'</p>';
                }
                ?>
                ?>
            </div>
            <div>
            </div>
            <input type="hidden" value="<?php echo ($value->id2); ?>" id="bookid"/>
            <div id="result">
                <button class="w3-button w3-block w3-red w3-section w3-padding"  onclick="submitForm()">Remove</button>
            </div>
        </div>
    </div>
</div>
<script>
	function submitForm() {
	var bookid = $("#bookid").val();
    $.post("submit.php", { bookid: bookid },
    function(data) {
	 $("#result").html(data);
    });
}
</script>
</html>
