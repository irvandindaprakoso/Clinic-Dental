<?php 
  include_once "../includes/Invoice-class.php";
  include_once "../includes/Tindakan-class.php";
  $class_invoice = new Invoice($pdo);
  $class_tindakan = new Tindakan($pdo);
  $invoice_number = $_GET['id'];
  $invoice = $class_invoice->viewInvoice($invoice_number);
  $det_invoice = $class_invoice->viewInvoiceDetail($invoice_number);
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_right">
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row" >
      <div class="col-md-12 col-xs-12">
        <div class="x_panel" id="ttt">
          <div class="x_title">
            <h2>Detail Pembayaran</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <section class="content invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12 invoice-header">
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <strong>Data Pemeriksaan</strong>
                  <address>
                                  Nama <span>:</span> <?=$invoice->pasien_nama ?><br>
                                  Telpon <span>:</span> <?=$invoice->pasien_telp ?>
                                  <br>Dokter :
                              </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <strong>Detail Pembayaran</strong>
                  <address>
                                  Pembayaran : Tunai
                              </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                <strong>Nota</strong> <br>
                  No: #<?php echo $invoice_number ?>
                  <br>
                  Tanggal : <?=$invoice->invoice_date;?>
                  <br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Nama Tindakan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($det_invoice as $data):
                            $data_item=$class_tindakan->editTindakan($data->invoicedetail_itemID); 
                            $data_qty=$data->invoicedetail_quantity;
                            $data_price = $data->invoicedetail_price;?>
                      <tr>
                        <td><?=$data_item->tindakan_nama; ?></td>
                        <td><?=$data_qty ?></td>
                        <td>Rp.<?=number_format($data_price) ?></td>
                        <td>Rp.<?=number_format($data_price*$data_qty) ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-8 col-xs-7">
                  
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-xs-5">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>Rp.<?=number_format($invoice->invoice_subtotal)?></td>
                        </tr>
                        <tr>
                          <th>Diskon</th>
                          <td>Rp.<?=number_format($invoice->invoice_discount)?></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>Rp.<?=number_format($invoice->invoice_total)?></td>
                        </tr>
                        <tr>
                          <th>Bayar:</th>
                          <td>Rp.<?=number_format($invoice->invoice_payment)?></td>
                        </tr>
                        <tr>
                          <th>Kembali:</th>
                          <td>Rp.<?=number_format($invoice->invoice_change)?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12">
                  <button class="btn btn-primary pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>
            </section>
            <div class="invoice-footer text-muted" id="invoice-footer" style="display: none;">
                <p class="invoice-thanks  m-b-5">
                    <h2 align="center">TERIMA KASIH TELAH BERKUNJUNG DAN LEKAS SEMBUH</h2>
                </p>
                <p class="text-center">
                    <span class="m-r-10"><i class="fa fa-globe"></i> Vozz Dental</span>
                    
                    <span class="m-r-10"><i class="fa fa-phone"></i> 085xxxxxxxxx</span>
                    <span class=""><i class="fa fa-home"></i> Celuk</span>
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->