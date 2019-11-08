<?php 
    require_once "../includes/Pelanggar-class.php";
    require_once "../includes/Foto-class.php";

    $class_pelanggar = new Pelanggar($pdo);
    $class_foto   = new Foto($pdo);
    $pelanggar_id = $_GET['id'];
    $pelanggar    = $class_pelanggar->detailPelanggar($pelanggar_id); 
    $foto         = $class_foto->viewFoto($pelanggar_id);
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="kop-surat" style="display: none;">
      <div class="row">
        <div class="col-md-3">
          <img src="../assets/images/logo_dinas.png" width="90" height="105">
        </div>
        <div class="col-md-6" align="center" style="width:77%;">
          <h3>PEMERINTAHAN KABUPATEN DENPASAR <br>DINAS PERHUBUNGAN</h3>
          <h5>Alamat : Padang Sambian kaja Denpasar barat, jl. Gn Galunggung, Ubung kaja <br>Kode Pos : 80116</h5>
        </div>
        <div class="col-md-3" style="float: right;">
          <img src="../assets/images/logo_dinas.png" width="90" height="105">
        </div>
      </div>
    </div>
    <div class="page-title">
        <h3 style="float: left;">Tilang Online </h3>
        <h2 class="pull-right">TILANG NO. <?=$pelanggar->pelanggar_id?></h2>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 >KESATUAN : </h2>
            <div style="border-bottom: 2px solid #E6E9ED; padding: 1px 5px 6px; margin-top:20px;margin-bottom: 10px"></div>
            <div class="clearfix"></div>

            <h4 align="center" style="float:unset!important"><small>PRO JUSTITIA</small> <b><u>"BUKTI PELANGGARAN LALU LINTAS JALAN TERTENTU"</u></b></h4>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-7" id="form-tilang-left">
              <p align="justify">Penyidik / penyidik pembantu yang bertanda tangan di bawah ini mengingat sumpah jabatan saat ini, Menyatakan dengan sebenarnya bahwa seorang:</p>
                <table class="table table-bordered" name="table">
                  <tbody>
                    <tr>
                      <td rowspan="2" colspan="2">Nama : <b style="color: #f34949;"><?=$pelanggar->stnk_pemilik?></b></td>
                      <td>LK</td>
                    </tr>
                    <tr>
                      <td>PR</td>
                    </tr>
                    <tr>
                      <td colspan="3">Alamat : <b style="color: #f34949;"><?=$pelanggar->stnk_alamat?></b> </td>
                    </tr>
                    <tr>
                      <td colspan="2">Pekerjaan : </td>
                      <td>Pendidikan</td>
                    </tr>
                    <tr>
                      <td>Umur</td>
                      <td>Tempat/ tgl lahir</td>
                      <td>No KTP</td>
                    </tr>
                    <tr>
                      <td rowspan="2">Kendaraan NO. Pol <br> <b style="color: #f34949;"><?=$pelanggar->stnk_platnomor?></b></td>
                      <td>Jenis <br><b style="color: #f34949;"><?=$pelanggar->stnk_jenis?></b></td>
                      <td>NOKA</td>
                    </tr>
                    <tr>
                      <td>Merek <br><b style="color: #f34949;"><?=$pelanggar->stnk_merk?></b></td>
                      <td>Mesin <br><b style="color: #f34949;"><?=$pelanggar->stnk_nmrmesin?></b></td>
                    </tr>
                    <tr>
                    <?php 
                      $lat = $pelanggar->pelanggar_lat;
                      $lng = $pelanggar->pelanggar_lng;
                      $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=AIzaSyAAgY3Vew0LpTLCBR_Sg98TKXrW_8Yk_4o&libraries=geometry";
                      // $data = @file_get_contents($url);
                      $address_json = json_decode(file_get_contents($url));
                      $address_data = $address_json->results[0]->address_components;
                      // $address_data = $address_json->results[0]->formatted_address;
                      $street = str_replace('Dr', 'Drive', $address_data[1]->long_name);
                      $town = $address_data[2]->long_name;
                      $county = $address_data[3]->long_name;
                    ?>
                      <td colspan="4" >
                          Pada tanggal <b style="color: #f34949;"><?=$pelanggar->pelanggar_tgl_waktu?></b> <br>
                          Di dekat <b style="color: #f34949;"><?=$street?></b><br>
                          Dalam wilayah hukum, <b style="color: #f34949;">Denpasar</b> <br>
                          telah melakukan pelanggaran lalu lintas jalan sebagaimana dimaksud pasal 121 
                          UUD NO. 22 Tahun 2009 Tentang lalu lintas dan Angkutan jalan.
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="col-md-5" id="form-tilang-right" style="border: 2px solid #E6E9ED; padding: 1px 5px 6px;">
                <h4 align="center" style="padding-bottom: 5px"><b>RUANG BAGI TERDAKWA</b></h4>
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="col-md-12 col-sm-12 col-xs-12">Melanggar Pasal 121 UUD NO.22 Tahun 2009 </label> <br>
                    <label class="col-md-12 col-sm-12 col-xs-12">Denda Maksimal Rp.500.000,00</label>
                    <label class="col-md-12 col-sm-12 col-xs-12" >Angka Penalti Pelanggaran</label>
                  </div>
                  <div style="border-bottom: 2px solid #E6E9ED; padding: 1px 5px 6px;"></div>
                  <h4 align="center" style="padding-bottom: 5px"><b>PERNYATAAN TERDAKWA</b></h4>
                  <p align="center">Dengan ini saya menyatakan akan hadir sendiri / menunjuk wakil disidang pengadilan</p>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" >Nama 
                    </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                      <input type="text"  class="form-control col-md-12 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" >Umur 
                    </label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text"  class="form-control col-md-12 col-xs-12">
                    </div>
                  </div>
                  <p align="justify">Selanjutnya saya bersedia menyetorkan UANG TITIPAN DENDA sebesar DENDA MAKSIMAL YANG DIANCAMKAN UU LLAJ melalui Bank tersebut diatas, paling lama dalam waktu 3 (tiga) hari sebelum tanggal sidang terhitung mulai tanggal diterima tilang ini.</p>
                  <p align="center">Hari.................. TGL.........BULAN...................TAHUN...... <br>
                  TANDA TANGAN PELANGGAR <br><br>
                  ..................................</p>
                </form>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-7" id="form-tilang-left">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td rowspan="2" width="170">Barang bukti yang disita</td>
                      <td>SIM</td>
                      <td>STCK</td>
                    </tr>
                    <tr>
                      <td>KTP</td>
                      <td>STNK</td>
                    </tr>
                    <tr>
                      <td colspan="3">
                          Selanjutnya Penyidik Atas Kuasa Penuntut Umum Demi Hukum, Mewajibkan Terdakwa
                          Untuk : <br>
                          <input type="checkbox"> Menghadiri sidang dalam negeri..............................................<br> pada hari .............................. Tanggal/Bulan/Tahun.............................................. <br>
                           <input type="checkbox"> Menyetorkan Unag Titipan Denda Melalui Bank yang Ditentukan Jika Sidang Diwakilkan.
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12">
                    <div class="x_panel">
                      <div class="col-md-9 col-xs-9" >
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2" >Penyidik 
                          </label>
                          <div class="col-md-10 col-sm-10 ">
                            <input type="text"  class="form-control">
                          </div>
                          <label class="control-label col-md-2 col-sm-2 " >Pangkat 
                          </label>
                          <div class="col-md-10 col-sm-10 ">
                            <input type="text"  class="form-control col-md-12 ">
                          </div>
                          <label class="control-label col-md-2 col-sm-2 " >Kesatuan 
                          </label>
                          <div class="col-md-10 col-sm-10 ">
                            <input type="text"  class="form-control col-md-12 ">
                          </div>
                          <label class="control-label col-md-2 col-sm-2 " >Telp/HP 
                          </label>
                          <div class="col-md-10 col-sm-10 ">
                            <input type="text"  class="form-control col-md-12 ">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-xs-3" align="center" >
                        <label class="control-label" >Cap Kesatuan </label> <br><br><br><br>
                        <label class="control-label">Tanda Tangan Penyidik </label>
                      </div>                  
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5" id="form-tilang-right" >
                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="x_panel">
              
                      <h4 align="center" style="padding-bottom: 5px"><b>RUANG BANK</b></h4>
                      <p>Telah Diterima Setoran Uang Titipan Denda Dari Pelanggar Tersebut Diatas sebesar Rp. <br>
                      Apabila putusan Pengadilan lebih kecil dari titipan denda, sisa uang titipan dapat diambil di Bank . . . . . . . . <br> 
                      dengan membawa bukti Eksekusi Kejaksaan</p>
                    </div>
                    <div class="x_panel" align="center">
                      <div class="form-group">
                        <label class="control-label" >Teller / Penerima Uang titipan denda 
                        </label>
                      </div> <br>
                      <div class="col-md-4 col-xs-4">
                        <div class="form-group">
                          <label class="control-label" >Nama
                          </label> <br><br>
                          <label class="control-label" >.......................
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-4">
                        <div class="form-group">
                          <label class="control-label" >Cap Bank
                          </label>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-4">
                        <div class="form-group">
                          <label class="control-label" >Tanda Tangan
                          </label><br><br>
                          <label class="control-label" >.......................
                          </label>
                        </div>
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
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <center>
            <h4>Bukti Pelanggaran</h4>
                <?php 
                    if (!empty($foto)|| $foto!=0) {
                        foreach($foto as $data): ?>
                            <img src="<?=$data->foto_nama;?>" width="20%" >
                        <?php endforeach; 
                    }
                ?>
            </center>
        </div>
    </div>
  </div>
</div>
<!-- /page content-->
<!-- <script type="text/javascript" src="../includes/jspdf.js"></script> -->
<!-- <script type="text/javascript" src="../includes/pdfFromHTML.js"></script> -->
