<?php
  include_once "../includes/Foto-class.php";
  include_once "../includes/Pasien-class.php";
  $class_foto = new Foto($pdo);
  $class_pasien = new Pasien($pdo);
  $pasien_id = $_GET['id'];
  $foto  = $class_foto->viewFoto($pasien_id);
  $pasien = $class_pasien->detailPasien($pasien_id); 
?>
 
<!-- page content -->
<div class="right_col" role="main">
<center><div id="map"></div></center>
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Detail Pasien</h3>
      </div>
    </div>
    
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height: 436px!important">
          <div class="x_title">
            <h2>Data Pasien <small>Data Pasien Klinik Vozz</small></h2>
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
                  <td><?=$pasien->pasien_nama ?></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td><?=$pasien->pasien_tglLahir?></td>
                </tr>
                <tr>
                  <td>Umur</td>
                  <td><?=$pasien->pasien_umur?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?=$pasien->pasien_alamat?></td>
                </tr>
                <td>Jenis Kelamin</td>
                  <td><?=$pasien->pasien_jk ?></td>
                </tr>
                <tr>
                  <td>No Telp</td>
                  <td><?=$pasien->pasien_telp?></td>
                </tr>
                <tr>
                  <td>Nama Orang Tua</td>
                  <td><?=$pasien->pasien_ortu?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-title">
      <div class="title_left">
        <h3>Foto Gigi Pasien</h3>
      </div>
    </div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#media-add-dialog"><i class="fa fa-plus"></i> Add Photo</button>
    <div class="superbox text-center" > <?php
	        //$images = glob($targetFolder."*.{jpg,jpeg,gif,png}", GLOB_BRACE);
    if (!empty($foto)|| $foto!=0) {
      foreach($foto as $data):
            // $image_name = str_replace($targetFolder,"",$image);
          $image_path = "../assets/images/_thumbs/".$data->foto_nama;
          list($image_width, $image_height) = getimagesize($image_path); ?>
			<div class="superbox-list nailthumb-container square-thumb">
				<img src="<?=$image_path?>" data-img="<?=$image_path?>" data-width="<?php echo $image_width ?>" data-height="<?php echo $image_height ?>" alt="<?=$image_path?>" title="<?=$image_path?>" data-fotoid="<?php echo $data->foto_id ?>" data-title="<?=$image_path?>" data-desc="<?php if($data->foto_desc=='') echo "No Description"; else echo $data->foto_desc;?>" data-mediadate="<?php echo $data->pasien_waktu?>" data-imagepath="<?=$image_path?>" data-mediaauthor="<?php echo ucwords($data->foto_nama) ?>" class="superbox-img" />
			</div> <?php
        endforeach; 
    }?>	
	</div>
  </div>
</div>
<!-- /page content -->

<!-- end superbox -->
<div class="modal fade" id="media-add-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Add Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <form action="media-upload.php" method="POST" class="dropzone" id="myAwesomeDropzone">
                  <input type="hidden" name="pasien_id" value="<?php echo $pasien_id;?>">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-5x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if (!empty($foto)|| $foto!=0) {
        foreach($foto as $data) {
?>
        <div class="modal animated rotateInDownLeft" id="foto-edit-dialog<?php echo $data->foto_id ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-green">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-white">Edit Foto</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img class="img-responsive" style="width: 100%" src="<?php echo "../assets/images/pasien/".$data->foto_nama ?>">
                            </div>
                            <div class="col-md-4">
                                <form id="form-edit-foto<?php echo $data->foto_id ?>" data-parsley-validate action="" method="post">
                                    <input type="hidden" name="foto_id" value="<?php echo $data->foto_id ?>">
                                    <legend>Media Information</legend>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Description</label>
                                        <textarea class="form-control"  name="foto_desc" rows="5" data-parsley-maxlength="255"><?php echo $data->foto_desc ?></textarea>
                                    </div>  
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button id="button-edit-foto<?php echo $data->foto_id ?>" type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal animated rotateInDownLeft" id="foto-delete-dialog<?php echo $data->foto_id ?>">
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
                        <form id="form-delete-foto<?php echo $data->foto_id ?>" action="" method="post">
                            <input type="hidden" name="foto_id" value="<?php echo $data->foto_id ?>">
                            <!-- <input type="hidden" name="foto_nama" value="<?php echo $data->foto_nama ?>"> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</foton>
                        <button id="button-delete-foto<?php echo $data->foto_id ?>" type="submit" class="btn btn-danger" name="hapus">Delete</button>
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
                superboximg   = $('<img src="" class="superbox-current-img"><div id="imgInfoBox" class="superbox-imageinfo inline-block"> <h4 class="text-white">Image Title</h4><p><em id="galdate"></em></p><span><dl><dt>Dimension</dt><dd id="galdimension"></dd><dt>Description</dt><dd id="galdescription"></dd><dt>File Name</dt><dd id="galtitle"></dd></dl><p><button id="egal-button" class="btn btn-success" data-target="#foto-edit-dialog" data-toggle="modal" data-fotoid="" data-mediatitle="" data-fotodesc="" data-mediaimage=""><i class="fa fa-pencil"></i> Edit </button> <button id="delgal-button" class="btn btn-danger m-l-10" data-target="" data-toggle="modal" data-hapus="" data-dn=""><i class="fa fa-times"></i> Delete</button></p></span> </div>'),
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
                        imgID = currentimg.data('fotoid'),
                        imgDate = currentimg.data('mediadate'),
                        imgAuthor = currentimg.data('mediaauthor');
                        imgPath = currentimg.data('imagepath');
                    superboximg.attr('src', imgData);
                    $('.superbox-list').removeClass('active');
                    $this.addClass('active');
                    superboximg.find('#galdate').html('Uploaded '+imgDate+' by <strong>'+imgAuthor+'</strong>');
                    superboximg.find('#delgal-button').attr('data-target', '#foto-delete-dialog'+imgID);
                    superboximg.find('#egal-button').attr('data-target', '#foto-edit-dialog'+imgID);
                    $('#foto-edit-dialog'+imgID+'').appendTo('body');
                    $('#foto-delete-dialog'+imgID+'').appendTo('body');
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
                        superboximg.find('#egal-button').attr('data-fotodesc','');
                    }
                    else {
                        superboximg.find('#egal-button').attr('data-fotodesc',imgDesc);
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

                    $('#foto-edit-dialog').on('show.bs.modal', function(e) {
                        $(this).find('#media-edit-id').attr('value', $(e.relatedTarget).data('fotoid'));
                        $(this).find('#media-edit-title').attr('value', $(e.relatedTarget).data('mediatitle'));
                        $(this).find('#media-edit-desc').text($(e.relatedTarget).data('fotodesc'));
                        $(this).find('#media-edit-image').attr('src', $(e.relatedTarget).data('mediaimage'));
                    });
                    $('#foto-delete-dialog').on('show.bs.modal', function(e) {
                        $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
                        $(this).find('#medianame').attr('value', $(e.relatedTarget).data('dn'));
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
    // var pasien_id.attr('value', $(relatedTarget).data('fotoid'));
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();
        Dropzone.options.myAwesomeDropzone = {
            maxFilesize: 5, // MB
            maxFiles: 20,
            acceptedFiles: "image/*",
            queuecomplete: function(file){
                    $('#error-handling').html('<div class="alert alert-info fade in"><p><strong>Success!</strong> This page will now refresh.</p></div> ');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
            },
            error: function(file){
                    $('#error-handling').html('<div class="alert alert-danger fade in"><p><strong>Error!</strong> There is an error with files upload system. Please try again.</p></div> ');
                }
            };
    <?php
        if($foto != '0') {
            foreach($foto as $data) {
    ?>
                var updatefoto<?php echo $data->foto_id ?>;    
                $("#form-edit-foto<?php echo $data->foto_id ?>").submit(function(event){
                    if (updatefoto<?php echo $data->foto_id ?>) {
                         updatefoto<?php echo $data->foto_id ?>.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    updatefoto<?php echo $data->foto_id ?> = $.ajax({
                        url: "foto-update.php",
                        type: "post",
                        beforeSend: function(){ $("#button-edit-foto<?php echo $data->foto_id ?>").html('<i class="fa fa-spinner fa-pulse"></i> Saving...'); $("#button-edit-foto<?php echo $data->foto_id ?>").attr('disabled','disabled');},
                        data: serializedData
                    });
                    updatefoto<?php echo $data->foto_id ?>.done(function (msg){
                      console.log(msg);
                        if(msg == 'failed') {
                            $("#button-edit-foto<?php echo $data->foto_id ?>").removeAttr('disabled');
                            $("#button-edit-foto<?php echo $data->foto_id ?>").html('Save');
                            $.gritter.add({
                                title:"Failed! Can't update media",
                                text:"Can't update foto. Please try again.",
                                image:"assets/img/kdc.png",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'desc-long') {
                            $("#button-edit-foto<?php echo $data->foto_id ?>").removeAttr('disabled');
                            $("#button-edit-foto<?php echo $data->foto_id ?>").html('Save');
                            $.gritter.add({
                                title:"Failed! Can't update media",
                                text:"Media description is too long. It should have 750 characters or less Please try again.",
                                image:"assets/img/kdc.png",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'success') {
                            $.gritter.add({
                                    title:"Success!",
                                    text:"Media has been updated.",
                                    image:"assets/img/kdc.png",
                                    sticky:false,
                                    time:""
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                        else {
                            $("#button-edit-foto<?php echo $data->foto_id ?>").removeAttr('disabled');
                            $("#button-edit-foto<?php echo $data->foto_id ?>").html('Save');
                            $.gritter.add({
                                title:"Error! Can't update media",
                                text:"Can't update media. There is something error when updating. Please try again.",
                                image:"assets/img/kdc.png",
                                sticky:false,
                                time:""
                            });
                        }
                    });
                    updatefoto<?php echo $data->foto_id ?>.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                });
                var deletefoto<?php echo $data->foto_id ?>;    
                $("#form-delete-foto<?php echo $data->foto_id ?>").submit(function(event){
                    if (deletefoto<?php echo $data->foto_id ?>) {
                         deletefoto<?php echo $data->foto_id ?>.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    deletefoto<?php echo $data->foto_id ?> = $.ajax({
                        url: "foto-delete.php",
                        type: "post",
                        beforeSend: function(){ $("#button-delete-foto<?php echo $data->foto_id ?>").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...'); $("#button-delete-foto<?php echo $data->foto_id ?>").attr('disabled','disabled');},
                        data: serializedData
                    });
                    deletefoto<?php echo $data->foto_id ?>.done(function (msg){
                      console.log(msg);
                        if(msg == 'failed') {
                            $("#button-delete-foto<?php echo $data->foto_id ?>").removeAttr('disabled');
                            $("#button-delete-foto<?php echo $data->foto_id ?>").html('Delete');
                            $.gritter.add({
                                    title:"Failed! Can't delete media",
                                    text:"Can't delete media. Please try again.",
                                    image:"assets/img/kdc.png",
                                    sticky:false,
                                    time:""
                            });
                        }
                        else if(msg == 'success') {
                            $.gritter.add({
                                    title:"Success!",
                                    text:"Media has been deleted.",
                                    image:"assets/img/kdc.png",
                                    sticky:false,
                                    time:""
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                        else {
                            $("#button-delete-foto<?php echo $data->foto_id ?>").removeAttr('disabled');
                            $("#button-delete-foto<?php echo $data->foto_id ?>").html('Delete');
                            $.gritter.add({
                                title:"Error! Can't delete media",
                                text:"Can't delete media. There is something error when deleting. Please try again.",
                                image:"assets/img/kdc.png",
                                sticky:false,
                                time:""
                            });
                        }
                    });
                    deletefoto<?php echo $data->foto_id ?>.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                });
    <?php
            }
        }
    ?>
  });
</script>