<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once 'dbconnect.php';
?>
<?php
if(isset($_POST['addbook'])){
    $longitude = $_POST['longfetch'];
    $latitude = $_POST['latfetch'];
    header("Location:newbook.php?lon=$longitude&lat=$latitude#menu2");
}
if(isset($_POST['searchbutton'])){
    $longitude = $_POST['longfetch'];
    $latitude = $_POST['latfetch'];
    $search = $_POST['search'];
    header("Location:search.php?lon=$longitude&lat=$latitude&keyword=$search#menu2");
}
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
    <script src="dist/snbutton.js"></script>

    <script>

    function buildMap(lat, lng){
        $('#us3').locationpicker({
            location: {
                latitude: +lat,
                longitude: +lng
            },
            radius: 300,
            inputBinding: {
                latitudeInput: $('#us3-lat'),
                longitudeInput: $('#us3-lon'),
                radiusInput: $('#us3-radius'),
                locationNameInput: $('#us3-address')
            },
            enableAutocomplete: true,
            markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png'
        });

        $('#us6-dialog').on('shown.bs.modal', function() {
            $('#us3').locationpicker('autosize');
        });
    }
    $( document ).ready(function() {
        navigator.geolocation.getCurrentPosition(showPosition);
        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $('.map-lat').val(lat);
            $('.map-lon').val(lng);
            buildMap(lat, lng);
            var element = document.getElementById("spinning");
            element.classList.remove("fa-circle-o-notch");
            element.classList.remove("fa");
            element.classList.remove("fa-spin");

        }
    });
    </script>
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
        padding: 0.2em;
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

    .cardsets {
        min-height: 68px;
        margin-top: 8px;
        box-shadow: 0px 1px 3px #337ab7;
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

    .fullscreen {
        margin-top: 8%;
        background: white;
        /* Just to visualize the extent */
        text-align: center;
    }

    .myicons {
        font-size: 50px;
        color: #337ab7;
    }
    </style>
</head>

<body>
    <div class="row" style="margin-right: 0px;margin-left: 0px; ">
        <div class="col-xs-12" style="margin-top: 25px;text-align: center">
            <button class="search-button" style="margin-left: 0%;height: 35px;" data-target="#us6-dialog" data-toggle="modal">Location <i id="spinning" class="fa fa-circle-o-notch fa-spin"></i></button>
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline">
                <input type="text" onkeyup="Enable()" autocomplete="off" name="search" style="margin-left: 0%;height: 35px;" id="searchinput" placeholder="search" />
                <button type="submit" id="myBtn" name="searchbutton" style="margin-right: 0%;height: 35px;" class="fa fa-search search-button"></button>
            </div>
        </div>
        <div class="container" style="margin-top:10px;padding-right: 3px;padding-left: 3px;">
            <ul class="nav nav-tabs" style="text-align:center" id="myTab">
                <li style="width:33.3%" class="active"><a data-toggle="tab" href="#home">USED</a></li>
                <li style="width:33.2%"><a data-toggle="tab" href="#menu1">NEW</a></li>
                <li style="width:33.5%"><a data-toggle="tab" href="#menu2">PROFILE</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div style="height: 15px;">
                    </div>
                    <div style="padding-left: 10px;padding-right: 10px;">
                        <div id="results2" style="margin-top:-25px"></div>
                        <div id="remove" style="text-align:center;margin-top:150px;">
                            <i class="fa fa-circle-o-notch fa-spin" style="color: #337ab7;font-size: 24px;"></i>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <div style="height: 15px;">
                    </div>
                    <div style="padding-left: 10px;padding-right: 10px;">
                        <div id="results" style="margin-top:-25px"></div>
                        <?php
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
                            <p style="word-wrap: break-word;font-size:13px">
                            ₹ '.$row['book_newprice'].'
                            </p>
                            </div>
                            </a>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div style="padding-left: 10px;padding-right: 10px;">
                        <div style="height: 15px;">
                        </div>
                        <div style="text-align:center;margin-top: 13px;color:#337ab7;">
                            Welcome <b>ANOOP P</b>
                        </div>
                        <div class="fullscreen">
                            <div class="row" style="margin-left:0px;margin-right:0px">
                                <div class="col-xs-6">
                                    <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                        <button type="submit" name="addbook" style="background: white;border: 0px;">
                                            <li class="fa fa-book myicons"></li>
                                        </button>
                                        <p style="margin-top:10px;margin-bottom: -2px;color:#337ab7">
                                            Post Book
                                        </p>
                                        <div class="col-sm-3">
                                            <input type="hidden" name="latfetch" class="form-control" value="" style="width: 110px" id="us3-lat" />
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="hidden" name="longfetch" class="form-control" value="" style="width: 110px" id="us3-lon" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <a href="mybooks.php" style="text-decoration:none;">
                                    <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                        <button style="background: white;border: 0px;">
                                            <li class="fa fa-history myicons"></li>
                                        </button>
                                        <p style="margin-top:10px;margin-bottom: -2px;">
                                            My Books
                                        </p>
                                    </div>
                                    <a/>
                                </div>
                            </div>
                            <div class="row" style="margin-left:0px;margin-right:0px;margin-top:24px;">
                                <div class="col-xs-6">
                                    <a href="settings.php" style="text-decoration:none;">
                                        <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                            <button style="background: white;border: 0px;">
                                                <li class="fa fa-cog myicons"></li>
                                            </button>
                                            <p style="margin-top:10px;margin-bottom: -2px;">
                                                Settings
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="logout.php" style="text-decoration:none;">
                                        <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                            <button style="background: white;border: 0px;">
                                                <li class="fa fa-sign-out myicons"></li>
                                            </button>
                                            <p style="margin-top:10px;margin-bottom: -2px;">
                                                Logout
                                            </p>
                                        </div>
                                        <a/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="us6-dialog" class="modal fade">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Location</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-horizontal" style="width:100%x">
                                        <div class="form-group">
                                            <!-- <label class="col-sm-2 control-label">Location:</label>-->
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="us3-address" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                        <div id="us3" style="width: 100%; height: 180px;"></div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="m-t-small">
                                            <div class="col-sm-3">
                                                <input type="hidden" name="latfetch" class="form-control" value="" style="width: 110px" id="us3-lat" />
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="longfetch" class="form-control" value="" style="width: 110px" id="us3-lon" />
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </body>



                <script>
                //$( document ).ready(function() {
                navigator.geolocation.getCurrentPosition(showPosition);
                function showPosition(position) {
                    var latt = position.coords.latitude;
                    var lngg = position.coords.longitude;
                    $.post("oldbook_fetch.php", { latt: latt, lngg: lngg },
                    function(data) {
                        $('#results2').html(data);
                        $("#remove").remove();
                    });
                }
                //});

                $( document ).ready(function() {
                    var x = document.getElementById("searchinput").value.length;
                    if(x>0){
                        document.getElementById("myBtn").disabled = false;
                    }else{
                        document.getElementById("myBtn").disabled = true;
                    }
                });

                function Enable(){
                    var x = document.getElementById("searchinput").value.length;
                    if(x>0){
                        document.getElementById("myBtn").disabled = false;
                    }else{
                        document.getElementById("myBtn").disabled = true;
                    }
                }
                </script>


                <script>
                $('#myTab a').click(function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                });

                // store the currently selected tab in the hash value
                $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
                    var id = $(e.target).attr("href").substr(1);
                    window.location.hash = id;
                });

                // on load of the page: switch to the currently selected tab
                var hash = window.location.hash;
                $('#myTab a[href="' + hash + '"]').tab('show');
                </script>

                </html>
