<!DOCTYPE html>
<html>
<?php
    ob_start();
?>
<?php
    if(isset($_POST['addbook'])){
            $longitude = $_POST['longfetch'];
            $latitude = $_POST['latfetch'];
            echo $longitude;
            header("Location:newbook.php?lon=$longitude&lat=$latitude#menu2");
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
    button:focus {outline:0;}
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
    .formclass{
        margin-top: 11px;
        width: 89%;
        height: 44px;
        border: 0px;
        border-color: white;
        box-shadow: 0 1px 1px #337ab7;
        text-align: center;
    }
    .fullscreen {
        margin-top: 14%;
        background: white; /* Just to visualize the extent */
        text-align: center;

    }
    .myicons{
        font-size: 50px;
        color: #337ab7;
    }
    </style>
</head>

<body>
    <div class="row" style="margin-right: 0px;margin-left: 0px; ">
        <div class="col-xs-12" style="margin-top: 5px;text-align: center">
            <button class="search-button" style="margin-left: 0%;height: 35px;" data-target="#us6-dialog" data-toggle="modal">Location</button>
            <input type="text" name="search" style="margin-left: 0%;height: 35px;" placeholder="search" />
            <button style="margin-right: 0%;height: 35px; " class="fa fa-search search-button"></button>
        </div>
    </div>
    <div class="container" style="margin-top:10px;padding-right: 3px;padding-left: 3px;">

        <ul class="nav nav-tabs" style="text-align:center" id="myTab">
            <li style="width:33.3%" class="active"><a data-toggle="tab" href="#home">NEW</a></li>
            <li style="width:33.2%"><a data-toggle="tab" href="#menu1">OLD</a></li>
            <li style="width:33.5%"><a data-toggle="tab" href="#menu2">PROFILE</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active" >
                <div style="height: 15px;">
                </div>
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div style="height: 15px;">
                </div>
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                    <div class="cardsets">

                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div style="height: 15px;">
                    </div>
                    <div style="text-align:center;">
                        Welcome ANOOP P
                    </div>
                    <div class="fullscreen">
                        <div class="row" style="margin-left:0px;margin-right:0px">
                            <div class="col-xs-6">
                                <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <button type="submit" name="addbook" style="background: white;border: 0px;"><li class="fa fa-book myicons"></li></button>
                                        <p style="margin-top:10px;margin-bottom: -2px;">
                                            Add Book
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
                                <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                    <button style="background: white;border: 0px;"><li class="fa fa-history myicons"></li></button>
                                    <p style="margin-top:10px;margin-bottom: -2px;">
                                        History
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left:0px;margin-right:0px;margin-top:24px;">
                            <div class="col-xs-6">
                                <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                    <button style="background: white;border: 0px;"><li class="fa fa-key myicons"></li></button>
                                    <p style="margin-top:10px;margin-bottom: -2px;">
                                        Change
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div style="padding: 25%;box-shadow: 0 1px 1px #337ab7;">
                                    <button style="background: white;border: 0px;"><li class="fa fa-users myicons"></li></button>
                                    <p style="margin-top:10px;margin-bottom: -2px;">
                                        About us
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div style="text-align:center;">
                    <input class="formclass" type="text" name="bookname" placeholder="Book Name" />
                    <input class="formclass" type="text" name="authorname" placeholder="Author Name" />
                    <input class="formclass" type="text" style="width: 44%;" name="orignalprice" placeholder="Original Price" />
                    <input class="formclass" type="text" style="width: 44%;" name="newprice" placeholder="Selling Price" />
                    <input class="formclass" type="text" name="about" placeholder="Descripition   " />
                    <button style="    margin-top: 6%;padding-right: 20px;padding-left: 20px;padding-top: 5px;padding-bottom: 5px;" class="search-button">ADD</button>
                </div> -->
            </div>
        </div>
        <div id="demo"></div>
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
                                <label class="p-r-small col-sm-1 control-label">Lat.:</label>

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
    window.onload = function(){
        var x = document.getElementById("demo");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            x.innerHTML = "<br><input type='text' name='fetchlat' value='" + position.coords.latitude + "'/>" + "<br><input type='text' name='fetchlon' value='" + position.coords.longitude + "'/>";
        }
    };

    $('#us3').locationpicker({
        location: {
            latitude: 46.15242437752303,
            longitude: 2.7470703125
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
