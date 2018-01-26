<!DOCTYPE html>
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
        
      
    </style>
</head>

<body>
    <div class="container" style="margin-top:20px;padding-right: 3px;padding-left: 3px;">
        <div class="row" style="margin-right: 0px;margin-left: 0px; ">
            <div style="text-align:center;">
            	<img width="280" style="width: 90%;height: auto;" src="images/10788.jpeg">
				<button>Buttton</button>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <input type="hidden" name="latfetch" class="form-control" value="" style="width: 110px" id="us3-lat" />
    </div>
    <div class="col-sm-3">
        <input type="hidden" name="longfetch" class="form-control" value="" style="width: 110px" id="us3-lon" />
    </div>
    <div id="results">

    </div>
</body>

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


</html>