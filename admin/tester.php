<!-- JS file -->
<script src="../assets/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script> 

<!-- CSS file -->
<link rel="stylesheet" href="../assets/plugins/easy-autocomplete/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="../assets/plugins/easy-autocomplete/easy-autocomplete.themes.min.css"> 
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<div class="right_col" role="main">  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="no-print">Kasir</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Pembayaran</small></h2>
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
          <br />
          <form id="form-add-pembayaran" class="form-horizontal form-label-left" data-parsley-validate method="post" action="" role="form">
            <div class="form-group">
              <div class="col-md-3 pull-right">
                <div class='input-group date' >
                  <input type='text' class="form-control"  name="tanggaldatang" value="<?php echo $NowDate; ?>" readonly />
                </div>
              </div>
              
            </div> 
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Pasien</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" id="pasien_id">
                  <option></option>
                  <?php foreach ($pasien as $data) { ?>
                    <option value="<?php echo $data->pasien_id ?>"><?php echo $data->pasien_nama ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="hf-item">Nama Tindakan</label>
               <div class="col-md-4 col-sm-4 col-xs-12">
                <input id="hf-item" type="text" placeholder="Nama Tindakan" name="item" class="form-control" autofocus>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table" id="tableSales">
                <thead>
                  <tr>
                      <th>Nama Tindakan / Obat</th>
                      <th width="230" class="text-center">Jumlah</th>
                      <th width="150" class="text-center">Harga</th>
                      <th width="150" class="text-right">Total</th>
                      <th class="text-center" width="100">Action</th>
                  </tr>
                </thead>
                <tbody id="append-data">
                  
                  <tr id="baris-kosong"><td colspan="5" class="text-center"><em>Data masih kosong.</em></td></tr>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var options = {
    data: ["blue", "green", "pink", "red", "yellow"]
    };

  $("#hf-item").easyAutocomplete(options);