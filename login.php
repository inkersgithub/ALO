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
            <div style="text-align:center;margin-top: 52%;">
                <form style="display:inline;" method="post" action="do_login.php" onsubmit="return do_login();">
                    <input class="formclass"  type="email" onkeyup="myFunction()" name="emailid" id="emailid" placeholder="Email" required />
                    <input class="formclass"  type="password" onkeyup="myFunction()" name="password" id="password" placeholder="Password"  required />
                    <input style="margin-top:20px;padding: 6px 25px;" type="submit" class="search-button" name="login" id="login_button" value="Login" />
                </form>
                <a href="register.php"><button style="margin-top:20px;padding: 6px 25px;" class="search-button" name="registernow" >Register</button></a>
            </div>
            <div>
                <p id="results"></p>
            </div>
        </div>
    </div>
    <div id="demo"></div>
</body>


<script type="text/javascript" src="jquery.js"></script>
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

function do_login()
{
    var email=$("#emailid").val();
    var pass=$("#password").val();
    var lat = $('#lat').val();
    var lon = $('#lon').val();
    if(email!="" && pass!="")
    {
        $("#loading_spinner").css({"display":"block"});
        $.ajax
        ({
            type:'post',
            url:'do_login.php',
            data:{
                do_login:"do_login",
                email:email,
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
                    document.getElementById("results").innerHTML = '<p id="results" style="text-align: center;margin-top: 14px;color: red;">Invalid username or password</p>'
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

function myFunction() {
    document.getElementById("results").innerHTML = '<p id="results"></p>'
}
</script>

</html>
