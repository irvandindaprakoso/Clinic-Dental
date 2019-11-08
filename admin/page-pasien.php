<?php 
  include_once "../includes/Pasien-class.php";
  $class_pasien = new Pasien($pdo);
  $pasien       = $class_pasien->showPasien();
?>
<div class="right_col" role="main">  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="no-print">List Pasien</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>List Pasien</h2>
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
              Dibawah ini merupakan data Pasien 
            </p>
            <button class="btn btn-info" type="button" onclick="location.href='pasien-baru'"><i class="fa fa-plus-square-o"></i> Tambah</button>
            <button class="btn btn-info" type="button" data-target="#import-dialog" data-toggle="modal" > <i class="fa fa-arrow-circle-up"></i> Import</button>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pasien</th>
                  <th width="16%" class="no-print">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                if ($pasien == 0 || empty($pasien)): ?>
                  <tr><td colspan="8" align="center"> Tidak ada data pasien</td></tr> <?php
                endif;
                if ($pasien != 0 || !empty($pasien)):
                  foreach ($pasien as $data):?>
                    <tr>
                      <td><?php echo $data->pasien_id; ?></td>
                      <td><?php echo $data->pasien_nama ?></td>
                      <td class="no-print">
                        <button onclick="location.href='detail-pasien&<?=$data->pasien_id;?>'" type="button" class="btn btn-dark btn-icon btn-circle" title="Details" ><i class="fa fa-eye"></i></button>
                        <button onclick="location.href='pasien-edit&<?=$data->pasien_id;?>'" type="button" class="btn btn-primary btn-icon btn-circle"  title="Edit" ><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-nm="<?=$data->pasien_nama; ?>" data-hapus="<?=$data->pasien_id; ?>"  title="Delete pasien" data-toggle="modal"><i class="fa fa-times"></i></button>
                      </td>
                    </tr> 
                    <?php 
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
<div class="modal animated rotateInDownLeft" id="import-dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header bg-green">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title text-white">Import Data Pasien</h4>
        </div>
        <div class="modal-body">
          <form id="form-import"  action="import-pasien.php"  method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih File :</label>
                <input type="File" name="file" id="file" accept=".xls,.xlsx" multiple>
              </div>
              <span>NB : File yang diimport akan berekstensi excel (.xls)</span>
            </div>
            <div class="modal-footer">
              <button id="button-import" type="submit" name="import" class="btn btn-success">Import</button>
              <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="modal animated rotateInUpLeft" id="delete-dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title text-white">Peringatan!</h4>
          </div>
          <div class="modal-body">
              <p>Yakin Akan Menghapus Data "<b><span id="nm"></span></b>" ? </p>
              <?php
                  if (isset ($_POST['hapus'])) {
                      //Delete Handler
                      $deleteit    = sha1("deleteit");
                      $pasienID     = $_POST['pasienID'];
                      $delPasien    = $class_pasien->deletePasien($pasienID);
                        header('location:data-pasien') ;
                  } 
              ?>
              <form action="" method="post">
                  <input type="hidden" name="pasienID" value="" id="delete">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
              </form>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#delete-dialog').on('show.bs.modal', function(e) {
    $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
    $(this).find('#nm').html($(e.relatedTarget).data('nm'));
  });
});
</script>