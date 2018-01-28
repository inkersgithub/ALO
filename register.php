<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION['usr_id'] )){
    if($_SESSION['usr_id'] != ""){
        header("Location:index.php");
    }
}
?>
<html>

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
        position: relative;
        padding: 0.5em;
        cursor: pointer;
        padding-left: 10px;
        padding-right: 10px;
        transition: 800ms ease all;
        outline: none;
        margin-left: 0%;
    }

    button:focus {
        outline: 0;
    }
    </style>
    <style>
    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 3px solid #337ab7;
        border-top-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .formclass {
        margin-top: 11px;
        width: 89%;
        height: 44px;
        border: 0px;
        border-color: white;
        box-shadow: 0 1px 1px #337ab7;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top:10px;padding-right: 3px;padding-left: 3px;">

        <div class="row" style="margin-right: 0px;margin-left: 0px; ">
            <div style="text-align:center;margin-top: 23%;">
                <form style="display:inline;text-align:center;" method="post" action="do_login.php" onsubmit="return do_register();">
                    <input class="formclass"  type="text" name="name" id="name" placeholder="Name" required />
                    <input class="formclass"  type="textr" name="mobile" id="mobile" placeholder="Mobile" required />
                    <input class="formclass"  type="email" name="email" id="email" placeholder="Email"  required />
                    <input class="formclass"  type="password" name="password" id="password" placeholder="Password"  required />
                    <input class="formclass"  type="password" name="password2" id="confirm_password" placeholder="Re Enter Password"  required />
                    <a href="index.php"><input style="margin-top:20px;padding: 6px 25px;" type="submit" class="search-button" name="registernow" value="Register" /></a>
                </form>
            </div>
        </div>
    </div>
    <div>
        <p id="results"></p>
    </div>
    <div id="demo"></div>
</body>

<script type="text/javascript">
window.onload = function() {
    var x = document.getElementById("demo");

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

    function showPosition(position) {
        x.innerHTML = "<br><input type='hidden' name='fetchlat' id='lat' value='" + position.coords.latitude + "'/>" + "<br><input type='hidden' name='fetchlon' id='lon' value='" + position.coords.longitude + "'/>";
    }
};

function do_register()
{
    var name=$("#name").val();
    var mobile=$("#mobile").val();
    var email=$("#email").val();
    var pass=$("#password").val();
    var lat = $('#lat').val();
    var lon = $('#lon').val();
    if(email!="" && pass!="")
    {
        $("#loading_spinner").css({"display":"block"});
        $.ajax
        ({
            type:'post',
            url:'do_register.php',
            data:{
                do_register:"do_register",
                name:name,
                email:email,
                mobile:mobile,
                password:pass
            },
            success:function(response) {
                if(response=="success")
                {
                    window.location.href="index.php?lat="+lat+"&lon="+lon;
                }
                else
                {
                    $("#loading_spinner").css({"display":"none"});
                    document.getElementById("results").innerHTML = '<p id="results" style="text-align: center;margin-top: 14px;color: red;">Mobile No or Email Already Used.</p>'
                }
            }
        });
    }

    else
    {
        alert("Please Fill All The Details");
    }

    return false;
}
</script>
<script>
var password = document.getElementById("password")
, confirm_password = document.getElementById("confirm_password");
function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>

</html>
