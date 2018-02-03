<!DOCTYPE html>
<html>
<?php
session_start();
include_once 'dbconnect.php';
$usrid = $_SESSION['usr_id'];
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
        position: relative;
        padding: 0.5em;
        cursor: pointer;
        padding-left: 16px;
        padding-right: 16px;
        transition: 800ms ease all;
        outline: none;
        margin-left: 0%;
        bottom: 0;
        margin-top: 15px
    }
    .formclass {
        margin-top: 11px;
        width: 89%;
        height: 44px;
        border: 0px;
        border-color: white;
        box-shadow: 0 1px 1px #337ab7;
        text-align: center;
        font-size: 14px;
    }

    .fullscreen {
        margin-top: 14%;
        background: white;
        /* Just to visualize the extent */
        text-align: center;
    }
    button:focus {
        outline: 0;
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top:0px;padding-right: 0px;padding-left: 0px;">
        <div class="row" style="margin-right: 0px;margin-left: 0px; ">
            <div style="text-align:center;">
                <div style="text-align:center;margin-top: 25%">
                    <form style="display:inline;" method="post" id="myForm" action="do_reset.php" onsubmit="return do_reset();">
                        <input class="formclass" onClick="myFunction()" type="text" name="currentpassword" id="currentpassword" placeholder="Current Password" required />
                        <input class="formclass" onClick="myFunction()" type="text" name="newpassword" pattern=".{8,}" title="Min 8 Chracters" id="password" placeholder="New Password" required />
                        <input class="formclass" onClick="myFunction()" type="text" name="repassword" id="confirm_password" placeholder="Re-Enter Password" required />
                        <button type="submit" class="search-button">Change Password</button>
                    </form>
                </div>
                <div style="text-align:center;margin-top:10px">
                    <p id="results"></p>
                </div>
                <div style="text-align:center;margin-top: 5%">
                    <form style="display:inline;" method="post" id="myForm2" action="do_resetmobile.php" onsubmit="return do_resetmobile();">
                        <input class="formclass" onClick="myFunction()" type="text" name="mobile" title="Invalid Mobile Number" pattern="[789][0-9]{9}" id="mobile" placeholder="New Number" required />
                        <button type="submit" class="search-button">Change Number</button>
                    </form>
                </div>
                <div style="text-align:center;margin-top:10px">
                    <p id="results2"></p>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
function myFunction() {
    document.getElementById("results").innerHTML = '<p id="results"></p>'
    document.getElementById("results2").innerHTML = '<p id="results"></p>'
}

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

function do_reset()
{
    var currentpassword=$("#currentpassword").val();
    var newpassword=$("#password").val();
    if(currentpassword!="" && newpassword!="")
    {
        $("#loading_spinner").css({"display":"block"});
        $.ajax
        ({
            type:'post',
            url:'do_reset.php',
            data:{
                do_reset:"do_reset",
                currentpassword:currentpassword,
                newpassword:newpassword
            },
            success:function(response) {
                if(response=="success")
                {
                    document.getElementById("results").innerHTML = '<p id="results" style="color:green;">Password Changed</p>'
                    $('#myForm')[0].reset();
                }
                else
                {
                    document.getElementById("results").innerHTML = '<p id="results" style="color:red;">Error</p>'
                    $('#myForm')[0].reset();
                }
            }
        });
    }

    else
    {
        document.getElementById("results").innerHTML = '<p id="results" style="color:red;">Fill All Fields</p>'
    }

    return false;
}


function do_resetmobile()
{
    var mobile=$("#mobile").val();
    if(mobile!="")
    {
        $("#loading_spinner").css({"display":"block"});
        $.ajax
        ({
            type:'post',
            url:'do_resetmobile.php',
            data:{
                do_resetmobile:"do_resetmobile",
                mobile:mobile
            },
            success:function(response) {
                if(response=="success")
                {
                    document.getElementById("results2").innerHTML = '<p id="results2" style="color:green;">Mobile No Changed</p>'
                }
                else
                {
                    document.getElementById("results2").innerHTML = '<p id="results2" style="color:red;">Error</p>'
                }
            }
        });
    }

    else
    {
        document.getElementById("results2").innerHTML = '<p id="results2" style="color:red;">Fill All Fields</p>'
    }

    return false;
}

</script>

</html>
