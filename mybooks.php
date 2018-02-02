<!DOCTYPE html>
<html>
<?php
ob_start();
session_start();
include_once 'dbconnect.php';
?>
<?php
$limit = 15;
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
    <div class="container" style="margin-top:10px;padding-right: 3px;padding-left: 3px;">
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div style="height: 15px;">
                </div>
                <div style="padding-left: 10px;padding-right: 10px;">
                    <div id="results" style="margin-top:0px"></div>
                    <?php
                    $sqlold = "SELECT * FROM alo_booklist WHERE usr_id = '".$_SESSION['usr_id']."' LIMIT $start_from , $limit";
                    $resultold = mysqli_query($con,$sqlold);
                    while ($row = mysqli_fetch_array($resultold)) {
                        echo '<div class="cardsets">
                        <a href="singlemy.php?bookid='.$row['id2'].'" style="text-decoration:blink">
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
                $sqlnum = "SELECT count(id2) FROM alo_booklist WHERE usr_id = '".$_SESSION['usr_id']."'";
                $rs_result = mysqli_query($con, $sqlnum);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];
                $total_pages = ceil($total_records / $limit);
                if($total_records>15){
                    $pagLink = "<div><nav style='text-align:center'><ul style='display: inline-table;text-aling:center' class='pagination'>";
                    for ($i=1; $i<=$total_pages; $i++) {
                        $pagLink .= '<li><a href="mybooks.php?page='.$i.'">'.$i.'</a></li>';
                    };
                    echo $pagLink . "</ul></nav></div>";
                }
                ?>
            </div>
        </body>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.pagination').pagination({
                items: <?php echo $total_records;?>,
                itemsOnPage: <?php echo $limit;?>,
                cssStyle: 'light-theme',
                currentPage : <?php echo $page;?>,
                hrefTextPrefix : 'mybooks.php?page='
            });
        });
        </script>
    </html>
