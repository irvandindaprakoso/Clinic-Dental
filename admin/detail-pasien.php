<?php 
  include_once "../includes/database.php";
  include_once "../includes/Pasien-class.php";
  $class_pasien = new Pasien($pdo);
  if (isset($_POST['pasien'])) {
    $pasienID = $_POST['pasien'];
    $pasien   = $class_pasien->editPasien($pasienID);
  
?>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
  </div>
</div>
  <table class="table table-hover">
    <tbody>
      <tr>
        <td>No RM</td>
        <td><?=$pasien->pasien_id;?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td><?=$pasien->pasien_nama;?></td>
      </tr>
      <tr>
        <td>Tanggal Lahir</td>
        <td><?=$pasien->pasien_tglLahir;?></td>
      </tr>
      <tr>
        <td>Umur</td>
        <td><?=$pasien->pasien_umur;?></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><?=$pasien->pasien_alamat;?></td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td><?=$pasien->pasien_jk;?></td>
      </tr>
      <tr>
        <td>No Telp</td>
        <td><?=$pasien->pasien_telp;?></td>
      </tr>
      <tr>
        <td>Nama Orang Tua</td>
        <td><?=$pasien->pasien_ortu;?></td>
      </tr>
    </tbody>
  </table>
