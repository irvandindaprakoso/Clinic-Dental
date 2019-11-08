<?php 
  include_once "../includes/Pelanggar-class.php";
  $class_pelanggar = new Pelanggar($pdo);
  $pelanggar       = $class_pelanggar->showPelanggar();
?>
<div class="right_col" role="main">  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="no-print">List Pelanggaran Parkir</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List Pelanggaran Parkir</h2>
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
            <div class="col-sm-2" id="section-status" style="margin-bottom: 10px;">
              <select id="select-status" name="select-status" class="form-control" >
                <option value=""> Status </option>
                <option value="1"> Sudah Ditangani </option>
                <option value="0"> Belum Ditangani </option>
              </select>
            </div>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="17%">Pelanggar</th>
                  <th width="12%">Plat Nomor</th>
                  <th>Alamat</th>
                  <th>Tanggal</th>
                  <th width="12%">Status</th>
                  <th width="12%">Pelapor</th>
                  <th width="16%" class="no-print">Action</th>
                </tr>
              </thead>
              <tbody >
              <?php 
                $no = 0;
                if ($pelanggar == 0 || empty($pelanggar)): ?>
                  <tr><td colspan="8" align="center"> Tidak ada data pelanggaran</td></tr> <?php
                endif;
                if ($pelanggar != 0 || !empty($pelanggar)):
                  foreach ($pelanggar as $data):
                    $no++; ?>
                    <tr style="<?php if($data->pelanggar_read==0) echo "background-color:#9fff74;";?>">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->stnk_pemilik ?></td>
                      <td><?php echo $data->stnk_platnomor ?></td>
                      <td><?php echo $data->stnk_alamat ?></td>
                      <td><?php echo $data->pelanggar_tgl_waktu ?></td>
                      <td>
                        <?php if ($data->pelanggar_status!=1) echo "Belum ditangani"; else echo "Sudah ditangani" ?>
                      </td>
                      <td><?php echo $data->user_nama?></td>
                      <td class="no-print">
                        <button id="detail_pelanggar<?=$data->pelanggar_id;?>" type="button" class="btn btn-dark btn-icon btn-circle" title="Details" ><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-success btn-icon btn-circle" onclick="location.href='print-laporan&<?=$data->pelanggar_id ?>'" title="Print" ><i class="fa fa-print"></i></button>
                        <button type="button" class="btn btn-primary btn-icon btn-circle" data-target="#edit-laporan" data-id="<?=$data->pelanggar_id;?>" data-toggle="modal" title="Edit" ><i class="fa fa-pencil"></i></button>
                      </td>
                    </tr> 
                    <script type="text/javascript">
                    $('#detail_pelanggar<?=$data->pelanggar_id?>').on('click', function() {
                        var id   = "<?php echo $data->pelanggar_id;?>";
                        var read = 1;
                        $.ajax({
                            type:"post",
                            url:"read-pelanggar.php",
                            data: {id:id, read:read},
                            cache:false
                        });
                        setTimeout(function() {
                            window.location="detail-pelanggar&<?=$data->pelanggar_id;?>";
                        }, 200);
                    });
                    $('#select-status').on('change',function(){
                      var status = this.value;
                      $.ajax({
                        url: "laporan-table2.php",
                        type: "post",
                        data: {status:status},
                        success: function(msg){
                          // console.log(msg);
                          // console.log(kelas);
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
                            $('#datatable').html(msg);
                          }
                        }
                      })
                    })
                  </script><?php 
                  endforeach;
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row no-print">
    <div class="col-xs-12">
      <button class="btn btn-success pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
      <!-- <button class="btn btn-primary pull-right" href="dompdf.php" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
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
                header('location:laporan') ;
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
                          <input type="radio" class="flat"  name="status" value="1" <?php if($data->pelanggar_status == 1) echo 'checked';?>> Sudah ditangani <br><br>
                          <input type="radio" class="flat" name="status" value="0" <?php if($data->pelanggar_status == 0) echo 'checked';?>> Belum ditangani
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
  $('#edit-laporan').on('show.bs.modal', function(e) {
    $(this).find('#idpel').attr('value', $(e.relatedTarget).data('id'));
  });
});
</script>