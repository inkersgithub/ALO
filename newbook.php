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

    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    </style>
</head>

<body>
    <div class="container" style="margin-top:60px;padding-right: 3px;padding-left: 3px;">
        <div class="row" style="margin-right: 0px;margin-left: 0px; ">
            <div style="text-align:center;">
                <input class="formclass" onClick="myFunction()" type="text" name="bookname" id="bname" placeholder="Book Name"  />
                <input class="formclass" onClick="myFunction()" type="text" name="authorname" id="bauthor" placeholder="Author Name" />
                <input class="formclass" onClick="myFunction()" type="text" style="width: 44%;" id="boldprice" name="orignalprice" placeholder="Original Price" />
                <input class="formclass" onClick="myFunction()" type="text" style="width: 44%;" id="bnewprice" name="newprice" placeholder="Selling Price" />
                <button class="search-button" style="margin-left: 3%;height: 35px;padding-left: 70px;padding-right: 70px;margin-top: 11px;" data-target="#us6-dialog" data-toggle="modal" onclick="myFunction()">Location</button>
                <div class="fileUpload btn btn-primary" style="margin-top: 8px;border: 0px transparent; border-radius: 0px;padding: 8px 15px;    font-size: 14px;padding-bottom: 7px;">
                    <span>Photo</span>
                    <input type="file" class="upload" id="file" name="file" />
                </div>
                <div id="uploaded_image"></div>
                <textarea onClick="myFunction()" style="resize: none;margin-top: 11px;width: 89%;border: 0px;border-color: white;box-shadow: 0 1px 1px #337ab7;text-align: center;color: #757579;" name="about" id="babout" value="Descripition" rows="5" cols="50" placeholder="Descripition"></textarea>
                <button style="margin-top: 6%;padding-right: 20px;padding-left: 20px;padding-top: 5px;padding-bottom: 5px;" class="search-button" onclick="SubmitFormData()">ADD</button>
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
<script>
function SubmitFormData() {
    var bname = $("#bname").val();
    var bauthor = $("#bauthor").val();
    var boldprice = $("#boldprice").val();
    var bnewprice = $("#bnewprice").val();
    var path = $("#path").val();
    var babout = $("#babout").val();
    var lon = $("#us3-lon").val();
    var lat = $("#us3-lat").val();
    if(bname&&bauthor&&boldprice&&bnewprice){
        $.post("newbook_submit.php", {
            bname: bname,
            bauthor: bauthor,
            boldprice: boldprice,
            bnewprice: bnewprice,
            babout: babout,
            lon: lon,
            path: path,
            lat: lat
        },
        function(data) {
            $('#results').html(data);
            $('#myForm')[0].reset();
        });
    }else{
        document.getElementById("results").innerHTML = '<p id="results" style="text-align: center;margin-top: 14px;color: red;">Fill all Fields</p>'
    }
}

function myFunction() {
    document.getElementById("results").innerHTML = '<p id="results"></p>'
}
</script>
<script>
$(document).ready(function(){
    $(document).on('change', '#file', function(){
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
        {
            alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);
        var f = document.getElementById("file").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 6000000)
        {
            alert("Image File Size is very big");
        }
        else
        {
            form_data.append("file", document.getElementById('file').files[0]);
            $.ajax({
                url:"upload.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },
                success:function(data)
                {
                    $('#uploaded_image').html(data);
                }
            });
        }
    });
});
</script>
</html>
