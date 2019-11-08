<?php 
  include_once "../includes/database.php";
  include_once "../includes/Pasien-class.php";

  $class_pasien   = new Pasien($pdo);
  $pasienID       = $_GET['id'];
  $edit       = $class_pasien->editPasien($pasienID);
  // $pasien         = $class_pasien->showpasien();
  
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><?php if($page == 'pasien-baru') echo 'Pasien Baru'; else echo 'Edit Pasien'; ?></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><?php if($page == 'pasien-baru') echo 'Tambah pasien Baru'; else echo 'Edit pasien'; ?></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate id="<?php if($page == 'pasien-baru') echo 'form-pasien-baru'; else echo 'form-pasien-edit'; ?>">
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_rm">No RM <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="no_rm" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="no_rm" placeholder="D/123" required="required" type="text" value="<?php echo $edit->pasien_id ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_pasien">Nama Pasien <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="nama_pasien" id="nama_pasien" name="nama_pasien" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $edit->pasien_nama ?>">
                </div>
              </div>
              <!-- <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lahir">Tanggal Lahir <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="row calendar-exibit">
                    
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="col-md-6 xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" name="tgl-lahir" id="single_cal1" placeholder="Select Date" aria-describedby="inputSuccess2Status" >
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    
                  </div>
                </div>
              </div> -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lahir">Tanggal Lahir <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="text" class="form-control" name="tgl-lahir" data-inputmask="'mask': '99/99/9999'">
                  <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="umur_pasien">Umur Pasien <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="umur_pasien" name="umur_pasien" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $edit->pasien_umur ?>">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea  id="alamat" name="alamat"  required="required" class="form-control col-md-7 col-xs-12"><?php echo $edit->pasien_alamat ?></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Jenis Kelamin <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <p>
                  Laki-laki:
                  <input type="radio" class="flat" name="gender" id="genderL" value="L" checked="" required /> Perempuan:
                  <input type="radio" class="flat" name="gender" id="genderP" value="P" />
                </p>
                </div>
              </div>
              
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">No Telpon <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="telp" name="telp" required="required" placeholder="" class="form-control col-md-7 col-xs-12" value="<?php echo $edit->pasien_telp ?>">
                </div>
              </div>
              
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_ortu">Nama Orang Tua <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="nama_ortu" type="text" name="nama_ortu"  class="optional form-control col-md-7 col-xs-12" value="<?php echo $edit->pasien_ortu ?>">
                </div>
              </div>
              <!-- /form datepicker -->
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button id="button-pasien" type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var pasienadd;    
  $("#form-pasien-baru").submit(function(event){
      if (pasienadd) {
           pasienadd.abort();
      }
      var $form = $(this);
      var $inputs = $form.find("input, button");
      var serializedData = $form.serialize();
      pasienadd = $.ajax({
          url: "pasien-add.php",
          type: "post",
          beforeSend: function(){ $("#button-pasien").html('<i class="fa fa-spinner fa-pulse"></i> Saving...'); $("#button-pasien").attr('disabled','disabled');},
          data: serializedData
      });
      pasienadd.done(function (msg){
        console.log(msg);
        console.log(serializedData);
          if(msg == 'error') {
              $("#button-pasien").removeAttr('disabled');
              $("#button-pasien").html('Save');
              $.gritter.add({
                  title:"Failed!",
                  text:" Can't add pasien. Please try again.",
                  image:"../images/logo-smp.jpeg",
                  sticky:false,
                  time:""
              });
          }
          else if(msg == 'success') {
              $.gritter.add({
                      title:"Success!",
                      text:"pasien has been added.",
                      image:"../images/logo-smp.jpeg",
                      sticky:false,
                      time:""
              });
              setTimeout(function() {
                  window.location="data-pasien";
              }, 2000);
          }
          else {
              $("#button-pasien").removeAttr('disabled');
              $("#button-pasien").html('Save');
              $.gritter.add({
                  title:"Error! Can't added pasien",
                  text:"Can't added pasien. There is something error when updating. Please try again.",
                  image:"../images/logo-smp.jpeg",
                  sticky:false,
                  time:""
              });
          }
      });
      pasienadd.always(function () {
          $inputs.prop("disabled", false);
      });
      event.preventDefault();
  });
  // Edit pasien 
  var pasienedit;    
  $("#form-pasien-edit").submit(function(event){
      if (pasienedit) {
           pasienedit.abort();
      }
      var $form = $(this);
      var $inputs = $form.find("input, button");
      var serializedData = $form.serialize();
      pasienedit = $.ajax({
          url: "pasien-update.php",
          type: "post",
          beforeSend: function(){ $("#button-pasien").html('<i class="fa fa-spinner fa-pulse"></i> Saving...'); $("#button-pasien").attr('disabled','disabled');},
          data: serializedData
      });
      pasienedit.done(function (msg){
        console.log(msg);
        console.log(serializedData);
          if(msg == 'error') {
              $("#button-pasien").removeAttr('disabled');
              $("#button-pasien").html('Save');
              $.gritter.add({
                  title:"Failed!",
                  text:" Can't update pasien. Please try again.",
                  image:"../images/logo-smp.jpeg",
                  sticky:false,
                  time:""
              });
          }
          else if(msg == 'success') {
              $.gritter.add({
                      title:"Success!",
                      text:"pasien has been updated.",
                      image:"../images/logo-smp.jpeg",
                      sticky:false,
                      time:""
              });
              setTimeout(function() {
                  window.location="data-pasien";
              }, 2000);
          }
          else {
              $("#button-pasien").removeAttr('disabled');
              $("#button-pasien").html('Save');
              $.gritter.add({
                  title:"Error! Can't updated pasien",
                  text:"Can't updated pasien. There is something error when updating. Please try again.",
                  image:"../images/logo-smp.jpeg",
                  sticky:false,
                  time:""
              });
          }
      });
      pasienedit.always(function () {
          $inputs.prop("disabled", false);
      });
      event.preventDefault();
  });
});
</script>
<!-- /page content -->