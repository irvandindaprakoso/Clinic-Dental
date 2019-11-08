<?php 
  include_once "../includes/database.php";
  include_once "../includes/Pelanggar-class.php";
  $class_pelanggar = new Pelanggar($pdo);
  $status          = $_POST['status'];
  $pelanggar       = $class_pelanggar->showPelanggarStatus($status);
?>
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
            <button type="button" class="btn btn-primary btn-icon btn-circle" data-target="#edit-laporan" data-toggle="modal" data-id="<?=$data->pelanggar_id;?>" title="Edit" ><i class="fa fa-pencil"></i></button>
            <!-- <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-nm="<?=$data->stnk_pemilik; ?>" data-hapus="<?=$data->pelanggar_id; ?>"  title="Delete" data-toggle="modal"><i class="fa fa-times"></i></button> -->
          </td>
        </tr> 
        <script type="text/javascript">
        // $(document).ready(function() {
          $('#detail_pelanggar<?=$data->pelanggar_id?>').on('click', function() {
              var id   = "<?=$data->pelanggar_id;?>";
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
      </script><?php 
      endforeach;
    endif; ?>
  </tbody>
</table>         