<?php 
  include_once "../includes/Pelanggar-class.php";
  $class_pelanggar = new Pelanggar($pdo);
  $pelanggar       = $class_pelanggar->showPelanggar($date);
  $dateforNow = new DateTime();  
  $NowDate = $dateforNow->format('m/d/Y'); // same format as NOW()
  include_once "map.php"; 
?>
<div class="right_col" role="main">
  <center><div id="map"></div></center>
  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Pelanggaran Parkir</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List <small>Pelanggaran Parkir</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>              
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Dibawah ini merupakan data pelanggaran parkir 
            </p>
            <div class="row calendar-exibit">
              <div class="col-md-3">
                <fieldset>
                  <div class="control-group">
                    <div class="controls">
                      <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name="select-date" id="single_cal1" placeholder="Select Date" aria-describedby="inputSuccess2Status" >
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
            <div id="laporan-table"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="modal animated rotateInDownLeft" id="edit-laporan">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-green">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title text-white">Update Laporan</h4>
          </div>
          <div class="modal-body">
          <?php
              if (isset($_POST['update'])) {
                  
                $pelanggar_id     = $_POST['idpel'];
                $status           = $_POST['status'];
                $updateStatus     = $class_pelanggar->updateLaporan($status,$pelanggar_id);
                header('location:monitoring') ;
              } 
          ?>
            <form action=""  method="post">
              <div class="row">
                <div class="col-md-12">
                  <legend>Tindakan</legend>                          
                  <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="hidden" id="idpel" name="idpel" value="">
                      <div class="radio">
                        <label>
                          <input type="radio" class="flat"  name="status" value="1"> Sudah ditangani <br><br>
                          <input type="radio" class="flat" name="status" value="0" checked> Belum ditangani
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                  <button name="update" type="submit" class="btn btn-success">Update</button>
                </div>
          </form>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#single_cal1").on("change", function () {
    // $('#end').data("DateTimePicker").minDate(e.date);
    var date = this.value;
    $.ajax({
        url: "laporan-table.php",
        type: "post",
        data: {date:date},
        success: function(msg){
          // alert(msg);
          // alert(date);
          if(msg == 'false') {
            $.gritter.add({
                title:"Failed!",
                text:"Can't found data. Please try again.",
                image:"../assets/images/logo-app.png",
                sticky:false,
                time:""
            });
          }
          else {
            $('#laporan-table').html(msg);
          }
      }
    })
  })
  $('#edit-laporan').on('show.bs.modal', function(e) {
    $(this).find('#idpel').attr('value', $(e.relatedTarget).data('id'));
  });
});
</script>