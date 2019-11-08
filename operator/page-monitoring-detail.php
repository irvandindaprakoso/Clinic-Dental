<?php
  include_once "../includes/Foto-class.php";
  $class_foto = new Foto($pdo);
  $class_users = new Users($pdo);
  $class_pelanggar = new Pelanggar($pdo);
  $pelanggar_id = $_GET['id'];
  $foto  = $class_foto->viewFoto($pelanggar_id);
  $users = $class_users->editUsers($pelanggar_id);
  $pelanggar = $class_pelanggar->detailPelanggar($pelanggar_id); 
?>

<!DOCTYPE html>
<head>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry&callback=initMap"></script>
<style type="text/css">
  #map { width: 1079px; height: 400px; }
</style>
<script type="text/javascript">
var customIcons = {
      pelanggar: {
        icon: '../assets/images/marker/marker-logo2.png'
      }
    };
 
    function initialize() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-8.676488,115.211177),
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
    
    var infoWindow = new google.maps.InfoWindow;


      // Bagian ini digunakan untuk mendapatkan data format XML yang dibentuk dalam dataLokasi.php
    // berbasis Ajax
      $.ajax({
      url: "selected-location.php?id=<?=$pelanggar_id?>",
      type: "GET",
      dataType: "xml",
      success:function(data)
      {
        //alert (data);
        var xml = data;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var plate = markers[i].getAttribute("plate");
          var foto = markers[i].getAttribute("foto");
          var type = markers[i].getAttribute("category");
          var point = new google.maps.LatLng(
            parseFloat(markers[i].getAttribute("lat")),
            parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b><br/>"+"<img src='../assets/images/uploads/"+foto+"' style='width:50%'"+"<br/><br/>" + plate;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
          map: map,
          position: point,
          icon: icon.icon
     
          });
          bindInfoWindow(marker, map, infoWindow, html);
         }
      }
    });
  }
  
    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      map.setCenter(marker.position);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
 
<!-- page content -->
<div class="right_col" role="main">
<center><div id="map"></div></center>
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Detail Pelanggaran</h3>
      </div>
    </div>
    
    <div class="clearfix"></div>

    <div class="col-md-6 col-sm-6" style=" margin-left: -10px!important">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sender Profile</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="chef-thumb">
            <img src="<?php if (empty($users->user_foto) || $users->user_foto=='') echo '../assets/images/no-pic.png'; else echo '..assets/images/users/'.$users->user_foto ?>" alt="profile-user" class="img-responsive">
            </div>
            <div class="form-group">
              <h3 align="center"> <strong><?php echo $users->user_nama ?></strong></h3>
              <ul class="list-unstyled text-center">
                <li><i class="fa fa-envelope"></i> <?php echo $users->user_email;?> </li>
                <li><i class="fa fa-building"></i> <?php echo $users->user_alamat;?> </li>
                <li><i class="fa fa-phone"></i> <?php echo $users->user_telpon;?> </li>
              </ul>
              <div class="ln_solid"></div>
              <!-- <button id="button-edit" type="button" class="btn btn-success pull-right">Edit</button> -->
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel" style="min-height: 436px!important">
          <div class="x_title">
            <h2>Data Pelanggar <small>Data STNK pelanggar</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table class="table table-striped">
              <thead>
              </thead>
              <tbody>
                <tr>
                  <td>Nama</td>
                  <td><?=$pelanggar->stnk_pemilik ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?=$pelanggar->stnk_alamat?></td>
                </tr>
                <td>Plat Nomor</td>
                  <td><?=$pelanggar->stnk_platnomor ?></td>
                </tr>
                <tr>
                  <td>Merk Kendaraan</td>
                  <td><?=$pelanggar->stnk_merk?></td>
                </tr>
                <tr>
                  <td>Tipe Kendaraan</td>
                  <td><?=$pelanggar->stnk_tipe?></td>
                </tr>
                <td>Warna Kendaraan</td>
                  <td><?=$pelanggar->stnk_warna ?></td>
                </tr>
                <tr>
                  <td>Jenis</td>
                  <td><?=$pelanggar->stnk_jenis?></td>
                </tr>
                <?php 
                  $lat = $pelanggar->pelanggar_lat;
                  $lng = $pelanggar->pelanggar_lng;
                  $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry";
                  // $data = @file_get_contents($url);
                  $address_json = json_decode(file_get_contents($url));
                  // $address_data = $address_json->results[0]->address_components;
                  $address_data = $address_json->results[0]->formatted_address;
                ?>
                <tr>
                  <td width="30%">Lokasi Pelanggar</td>
                  <!-- <td><a href="<?php echo $url?>"><?php echo $url?></a></td> -->
                  <td><?php echo $address_data; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-title">
      <div class="title_left">
        <h3>Foto Bukti Pelanggaran</h3>
      </div>
    </div>
    <div class="superbox text-center" > <?php
	        //$images = glob($targetFolder."*.{jpg,jpeg,gif,png}", GLOB_BRACE);
    if (!empty($foto)|| $foto!=0) {
      foreach($foto as $data):
            // $image_name = str_replace($targetFolder,"",$image);
          $image_path = $data->foto_nama;
          list($image_width, $image_height) = getimagesize($image_path); ?>
			<div class="superbox-list nailthumb-container square-thumb">
				<img src="<?=$data->foto_nama ?>" data-img="<?=$data->foto_nama ?>" data-width="<?php echo $image_width ?>" data-height="<?php echo $image_height ?>" alt="<?php echo $data->foto_nama ?>" title="<?php echo $data->foto_nama ?>" data-mediaid="<?php echo $data->foto_id ?>" data-title="<?php echo $data->stnk_platnomor?>" data-desc="<?php echo "No Description";?>" data-mediadate="<?php echo $data->pelanggar_tgl_waktu?>" data-imagepath="<?=$data->foto_nama ?>" data-mediaauthor="<?php echo ucwords($data->user_nama) ?>" class="superbox-img" />
			</div> <?php
        endforeach; 
    }?>	
	</div>
  </div>
</div>
<!-- /page content -->

<!-- end superbox -->
<?php
    if (!empty($foto)|| $foto!=0) {
        foreach($foto as $data) {
?>
        <div class="modal animated rotateInDownLeft" id="media-delete-dialog<?php echo $data->mediaID ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-white">Alert</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <?php echo $data->foto_nama ?>?</p>
                        <?php
                        ?>
                        <form id="form-delete-media<?php echo $data->mediaID ?>" action="" method="post">
                            <input type="hidden" name="media_id" value="<?php echo $data->mediaID ?>">
                            <input type="hidden" name="media_name" value="<?php echo $data->foto_nama ?>">
                            <input type="hidden" name="admin_login_id" value="<?php echo $adminID_session ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button id="button-delete-media<?php echo $data->mediaID ?>" type="submit" class="btn btn-danger" name="hapus">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
?>
<link href="../assets/css/dropzone.css" rel="stylesheet" />
<link href="../assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="../assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
$(function() {
// Call SuperBox
  $('.superbox').SuperBox();
});
    (function($) {
        $.fn.SuperBox = function(options) {
            var superbox      = $('<div class="superbox-show"></div>'),
                superboximg   = $('<img src="" class="superbox-current-img"><div id="imgInfoBox" class="superbox-imageinfo inline-block"> <h4 class="text-white">Image Title</h4><p><em id="galdate"></em></p><span><dl><dt>Dimension</dt><dd id="galdimension"></dd><dt>Description</dt><dd id="galdescription"></dd><dt>File Name</dt><dd id="galtitle"></dd></dl><p><button id="delgal-button" class="btn btn-danger m-l-10" data-target="" data-toggle="modal" data-hapus="" data-dn=""><i class="fa fa-times"></i> Delete</button></p></span> </div>'),
                superboxclose = $('<div class="superbox-close text-white"><i class="fa fa-times fa-lg"></i></div>');
            superbox.append(superboximg).append(superboxclose);
            var imgInfoBox = $('.superbox-imageinfo');
            return this.each(function() {
                $('.superbox-list').click(function() {
                    $this = $(this);
                    var currentimg = $this.find('.superbox-img'),
                        imgData = currentimg.data('img'),
                        imgLink = imgData,
                        imgName = currentimg.attr('title'),
                        imgTitle = currentimg.data('title')  || "No Title",
                        imgDesc = currentimg.data('desc') || "No Description",
                        img = currentimg.data('desc') || "No Description",
                        imgWidth = currentimg.data('width'),
                        imgHeight = currentimg.data('height'),
                        imgID = currentimg.data('mediaid'),
                        imgDate = currentimg.data('mediadate'),
                        imgAuthor = currentimg.data('mediaauthor');
                        imgPath = currentimg.data('imagepath');
                    superboximg.attr('src', imgData);
                    $('.superbox-list').removeClass('active');
                    $this.addClass('active');
                    superboximg.find('#galdate').html('Uploaded '+imgDate+' by <strong style="color:rgba(52, 241, 4, 0.89)">'+imgAuthor+'</strong>');
                    superboximg.find('#delgal-button').attr('data-target', '#media-delete-dialog'+imgID);
                    $('#media-delete-dialog'+imgID+'').appendTo('body');
                    superboximg.find('>:first-child').text(imgTitle);
                    superboximg.find('#galdimension').html(imgWidth+'px x '+imgHeight+'px');
                    superboximg.find('#galdescription').html(imgDesc);
                    superboximg.find('#galtitle').html(imgName);
                    if(imgTitle == 'No Title') {
                        superboximg.find('#egal-button').attr('data-mediatitle','');
                    }
                    else {
                        superboximg.find('#egal-button').attr('data-mediatitle',imgTitle);
                    }
                    if(imgDesc == 'No Description') {
                        superboximg.find('#egal-button').attr('data-mediadesc','');
                    }
                    else {
                        superboximg.find('#egal-button').attr('data-mediadesc',imgDesc);
                    }
                    if($('.superbox-current-img').css('opacity') == 0) {
                        $('.superbox-current-img').animate({opacity: 1});
                    }
                    if ($(this).next().hasClass('superbox-show')) {
                        $('.superbox-list').removeClass('active');
                        superbox.toggle();
                    } else {
                        superbox.insertAfter(this).css('display', 'block');
                        $this.addClass('active');
                    }
                    $('html, body').animate({
                        scrollTop:superbox.position().top - currentimg.width()
                    }, 'medium');
                    $('#media-delete-dialog').on('show.bs.modal', function(e) {
                        $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
                        $(this).find('#foto_nama').attr('value', $(e.relatedTarget).data('dn'));
                        $(this).find('#dn').html($(e.relatedTarget).data('dn'));
                    });
                });
                $('.superbox').on('click', '.superbox-close', function() {
                    $('.superbox-list').removeClass('active');
                    $('.superbox-current-img').animate({opacity: 0}, 200, function() {
                        $('.superbox-show').slideUp();
                    });
                });
            });
        };
    })(jQuery);
</script>

<script type="text/javascript">
	$(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();
  	});
</script>