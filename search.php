<!DOCTYPE html>
<html>
<?php
ob_start();
include_once 'dbconnect.php';

?>
<?php
if(isset($_POST['addbook'])){
    $longitude = $_POST['longfetch'];
    $latitude = $_POST['latfetch'];
    echo $longitude;
    header("Location:newbook.php?lon=$longitude&lat=$latitude#menu2");
}
if(isset($_POST['searchbutton'])){
    $longitude = $_POST['longfetch'];
    $latitude = $_POST['latfetch'];
    $search = $_POST['search'];
    header("Location:search.php?lon=$longitude&lat=$latitude&keyword=$search#menu2");
}
$limit = 20;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;

$sql = "SELECT * FROM employee ORDER BY id ASC LIMIT $start_from, $limit";
$rs_result = mysqli_query($con, $sql);

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
    <link rel="stylesheet" href="dist/simplePagination.css" />
    <script src="dist/jquery.simplePagination.js"></script>
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
        margin-top: 14%;
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
            <button class="search-button" style="margin-left: 0%;height: 35px;" data-target="#us6-dialog" data-toggle="modal">Location</button>
            <form style="display:inline;" action="search.php" method="POST">
                <input type="text" name="search" style="margin-left: 0%;height: 35px;" placeholder="search" required />
                <button type="submit" name="searchbutton" onkeyup="Enable()" autocomplete="off" style="margin-right: 0%;height: 35px;" class="fa fa-search search-button" id="searchinput"></button>
                <div class="m-t-small">
                    <div class="col-sm-3">
                        <input type="hidden" name="latfetch" class="form-control" value="" style="width: 110px" id="us3-lat" />
                    </div>
                    <div class="col-sm-3">
                        <input type="hidden" name="longfetch" class="form-control" value="" style="width: 110px" id="us3-lon" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container" style="margin-top:10px;padding-right: 3px;padding-left: 3px;">
        <ul class="nav nav-tabs" style="text-align:center" id="myTab">
            <li style="width:50%" class="active"><a data-toggle="tab" href="#home">USED</a></li>
            <li style="width:50%"><a data-toggle="tab" href="#menu1">NEW</a></li>

        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div style="height: 15px;">
                </div>
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div id="results" style="margin-top:0px"></div>
                    <?php
                    $keyword = "%".$_GET['keyword']."%";
                    $radius = 300;
                    $sqlold = sprintf("SELECT *, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM alo_booklist WHERE book_name LIKE '%s' AND status = '0' HAVING distance < '%s' ORDER BY distance LIMIT $start_from , $limit",
                    mysqli_real_escape_string($con,$_GET['lat']),
                    mysqli_real_escape_string($con,$_GET['lon']),
                    mysqli_real_escape_string($con,$_GET['lat']),
                    mysqli_real_escape_string($con,$keyword),
                    mysqli_real_escape_string($con,$radius));
                    $resultold = mysqli_query($con,$sqlold);
                    $numfind = mysqli_num_rows($resultold);
                    if($numfind <= 0){
                        echo '<p style="text-align: center;margin-top: 125px;color: red;">No BOOKS Found</p>';
                    }
                    while ($row = mysqli_fetch_array($resultold)) {
                        echo '<div class="cardsets">
                        <a href="single.php?bookid='.$row['id2'].'" style="text-decoration:blink">
                        <div class="" style="text-align:center;">
                        <p style="word-wrap: break-word;padding-top: 8px;">
                        <b>	'.$row['book_name'].' by '.$row['book_author'].'  </b>
                        </p>
                        </div>
                        <div class="" style="text-align:center;">
                        <p style="word-wrap: break-word;font-size:13px">
                        Original ₹ '.$row['book_oldprice'].'--->Reselling ₹ '.$row['book_newprice'].'
                        </p>
                        </div>
                        </a>
                        </div>';
                    }
                    ?>
                </div>
                <?php
                $sqlnum = sprintf("SELECT COUNT(id2), ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM alo_booklist WHERE book_name LIKE '%s' AND status = '0' HAVING distance < '%s' ORDER BY distance LIMIT 0 , 150",
                mysqli_real_escape_string($con,$_GET['lat']),
                mysqli_real_escape_string($con,$_GET['lon']),
                mysqli_real_escape_string($con,$_GET['lat']),
                mysqli_real_escape_string($con,$keyword),
                mysqli_real_escape_string($con,$radius));
                $rs_result = mysqli_query($con, $sqlnum);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];
                if($total_records>20){
                    $total_pages = ceil($total_records / $limit);
                    $pagLink = "<div><nav style='text-align:center'><ul style='display: inline-table;text-aling:center' class='pagination'>";
                    for ($i=1; $i<=$total_pages; $i++) {
                        $pagLink .= '<li><a href="search.php?lon='.$_GET['lon'].'&lat='.$_GET['lat'].'&keyword= '.$_GET['keyword'].'&page='.$i.'">'.$i.'</a></li>';
                    };
                    echo $pagLink . "</ul></nav></div>";
                }
                ?>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div style="height: 15px;">
                </div>
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div id="results2" style="margin-top:0px">
                        <?php
                        $keyword2 = "%".$_GET['keyword']."%";
                        $radius = 300;
                        $sqlold2 = sprintf("SELECT *, ( 6371 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM alo_booklist WHERE book_name LIKE '%s' AND status = '1' HAVING distance < '%s' ORDER BY distance LIMIT 0, 25",
                        mysqli_real_escape_string($con,$_GET['lat']),
                        mysqli_real_escape_string($con,$_GET['lon']),
                        mysqli_real_escape_string($con,$_GET['lat']),
                        mysqli_real_escape_string($con,$keyword),
                        mysqli_real_escape_string($con,$radius));
                        $resultold2 = mysqli_query($con,$sqlold2);
                        $numfind2 = mysqli_num_rows($resultold2);
                        if($numfind2 <= 0){
                            echo '<p style="text-align: center;margin-top: 125px;color: red;">No BOOKS Found</p>';
                        }
                        while ($row2 = mysqli_fetch_array($resultold2)) {
                            echo '<div class="cardsets">
                            <a href="single.php?bookid='.$row2['id2'].'" style="text-decoration:blink">
                            <div class="" style="text-align:center;">
                            <p style="word-wrap: break-word;padding-top: 8px;">
                            <b>	'.$row2['book_name'].' by '.$row2['book_author'].'  </b>
                            </p>
                            </div>
                            <div class="" style="text-align:center;">
                            <p style="word-wrap: break-word;font-size:13px">
                            ₹ '.$row2['book_newprice'].'
                            </p>
                            </div>
                            </a>
                            </div>';
                        }
                        ?>
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

        $('#us3').locationpicker({
            location: {
                latitude: <?php echo $_GET['lat']; ?>,
                longitude: <?php echo $_GET['lon']; ?>
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

        <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination').pagination({
                items: <?php echo $total_records;?>,
                itemsOnPage: <?php echo $limit;?>,
                cssStyle: 'light-theme',
                currentPage : <?php echo $page;?>,
                hrefTextPrefix : 'search.php?lon=<?php echo $_GET['lon']; ?>&lat=<?php echo $_GET['lat']; ?>&keyword=<?php echo $_GET['keyword']; ?>&page='
            });
        });

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

        </html>
