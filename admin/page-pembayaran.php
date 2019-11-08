<?php 
  include_once "../includes/Pasien-class.php";
  include_once "../includes/Tindakan-class.php";
  require_once "../includes/Generate-invoice-number.php";//all data

  $class_pasien = new Pasien($pdo);
  $class_tindakan = new Tindakan($pdo);
  $pasien       = $class_pasien->showPasien();
  $tindakan     = $class_tindakan->showTindakan();
  $invoice_number = generateInvoiceNumber($param='');
  // $edit_tindakan = $class_tindakan->editTindakan($tindakan_id);
?>
<!-- <script type="text/javascript">
    $(document).ready(function(){
      $('#paid, #subtotal, #disc, #tot, #grandtotal, #change, #sisa').number(true);
    })  
</script> -->
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
              <input type='hidden' class="form-control"  name="invoice_number" value="<?php echo $invoice_number; ?>" readonly />
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Pilih Pasien</label>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <select class="selectpicker" data-live-search="true" tabindex="-1" id="pasien_id" name="pasienID" title="- Pasien -">
                  <?php foreach ($pasien as $data) { ?>
                    <option value="<?php echo $data->pasien_id ?>"><?php echo $data->pasien_nama ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="hf-item">Nama Tindakan</label>
               <div class="col-md-5 col-sm-5 col-xs-12">
                <input id="hf-item" type="text" placeholder="Nama Tindakan" name="item" class="form-control" autofocus>
              </div>
            </div>
            <div class="ln_solid"></div>

            <div class="table-responsive">
              <table class="table" id="tableSales">
                <thead>
                  <tr>
                      <th>Nama Tindakan / Obat</th>
                      <th width="230" >Jumlah</th>
                      <th width="150" >Harga</th>
                      <th width="150">Total</th>
                      <th width="100">Action</th>
                  </tr>
                </thead>
                <tbody id="append-data">
                 <?php 
                    if ($tindakan != '') { 
                  ?>
                      <tr id="baris-kosong"><td colspan="5" class="text-center"><em>Data masih kosong.</em></td></tr>
                  <?php
                    }
                  ?>
                  
                  
                  <tr id="item-tindakan-<?php echo $edit_tindakan->cr_tindakanID ?>">
                    <!-- <td>
                      <input id="listmenuName_<?php echo $main_increment ?>" value="<?php echo $edit_tindakan->cr_tindakanNama ?>" data-type="listmenuName" class="form-control listMenu input-no-readonly-bg" placeholder="" type="text" name="listmenuName[]" readonly>
                      <input type="hidden" value="<?php echo $edit_tindakan->cr_tindakanID ?>" id="listmenu_<?php echo $main_increment ?>" class="form-control listMenu" name="listmenu[]" readonly>
                      <input type="hidden" value="tindakan" id="type_<?php echo $main_increment ?>" class="form-control listMenu" name="tipe[]" readonly>
                      <input id="lab_<?php echo $main_increment ?>" value="<?php echo $explode_tindakan_lab[$tdnya2] ?>" data-type="lab" class="form-control lab listMenu" type="hidden" name="lab[]" readonly>
                    </td>
                    <td class="text-center">
                      <input id="qty_<?php echo $td ?>" value="<?php echo $explode_tindakan_jumlah2[$tdnya2] ?>" data-type="qty" class="form-control qty listMenu" type="hidden" name="qty[]"><?php echo $explode_tindakan_jumlah2[$tdnya2] ?></td>
                    <td>
                      <input min="0" id="price_<?php echo $main_increment ?>" value="<?php echo $harga_tindakan ?>" data-type="price" class="form-control listMenu input-no-readonly-bg" placeholder="0" type="text" name="price[]">
                    </td>
                    <td>
                      <input min="0" id="total_<?php echo $main_increment ?>" value="<?php echo $harga_tindakan2 ?>" data-type="total" class="form-control total listMenu input-no-readonly-bg" placeholder="0" type="text" name="total[]" readonly>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-item" data-delete="item-tindakan-<?php echo $edit_tindakan->cr_tindakanID ?>" data-name="<?php echo $edit_tindakan->cr_tindakanNama ?>"><i class="fa fa-times"></i> Hapus</button>
                    </td> -->
                </tr>
          
        <table class="table">
          <tr>
            <th class="text-right" style="width: 60%;">Subtotal</th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon2">Rp</span>
                <input name="subtotal" id="subtotal" type="text" class="form-control" placeholder="0" value="<?php echo $initial_subtotal ?>" aria-describedby="basic-addon2" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <th class="text-right" style="width: 60%;">Diskon </th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon5">Rp</span>
                <input id="disc" value="0" class="form-control" type="text" name="disc" placeholder="0" aria-describedby="basic-addon5">
              </div>
            </td>
          </tr>
          <tr>
            <th class="text-right" style="width: 60%;">Total </th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon11">Rp</span>
                <input id="tot" readonly value="" class="form-control" type="text" name="tot" placeholder="0" aria-describedby="basic-addon11">
              </div>
            </td>
          </tr>
          <tr>
            <th class="text-right" style="width: 60%;"></th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon4">Rp</span>
                <input value="" id="grandtotal" class="form-control" type="text" name="grandtotal" aria-describedby="basic-addon4" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <th class="text-right" style="width: 60%;">BAYAR</th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addonpaid">Rp</span>
                <input id="paid" class="form-control" placeholder="Bayar" type="text" name="paid" data-parsley-errors-container="#paid-error" aria-describedby="basic-addonpaid" required>
              </div>
              <div id="paid-error"></div>
            </td>
          </tr>
          <tr id="kembalian">
            <th class="text-right" style="width: 60%;">KEMBALI</th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addonchange">Rp</span>
                <input id="change" value="" class="form-control" placeholder="Kembali" type="text" name="change" data-parsley-errors-container="#change-error" aria-describedby="basic-addonchange" readonly>
              </div>
              <div id="change-error"></div>
            </td>
          </tr>
          <tr id="sisabayar">
            <th class="text-right" style="width: 60%;">SISA</th>
            <td>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addonsisa">Rp</span>
                <input id="sisa" value="" class="form-control" placeholder="Sisa" type="text" name="sisa" data-parsley-errors-container="#sisa-error" aria-describedby="basic-addonsisa" readonly>
              </div>
              <div id="sisa-error"></div>
            </td>
          </tr>
        </table>
      </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-0">
                <button id="button-add-pembayaran" type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Proses Pembayaran</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-delete-item">
    <div class="modal-dialog modal-danger">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Apakah anda akan menghapus <span id="item-name"></span> dari daftar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="button-delete-item" type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
<script src="../assets/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js"></script>
<script src="../assets/plugins/parsley/dist/parsley.js"></script>
<script type="text/javascript">
function calculateSum(){
  var sum = 0,
    sumTot,
    gTot;
  
  $(".total").each(function() {
    if(!isNaN(this.value) && this.value.length!=0) {
      sum += parseFloat(this.value);
    }
  });
  
  $("#subtotal").val(sum.toFixed(0));
  $("#tot").val(sum.toFixed(0));
  $('#grandtotal').val(sum.toFixed(0));
  $("#paid").attr('data-parsley-min',sum.toFixed(0));

  calculateDiscount();

}

function calculateDiscount(){
  var discount = $("#disc").val(),
  // var max_disc = $("#subtotal").val(),
    subtot = $("#subtotal").val(),
    sumTot,
    gTot;
  
  if(discount.length != 0){
    //Kalau presentase
    // sumTot = parseFloat(( discount / 100 )) * parseFloat(subtot);
    //Kalau nominal
    sumTot = discount;
    gTot = parseFloat(subtot) - sumTot;
    $("#tot").val(gTot.toFixed(0));
    $("#grandtotal").val(gTot.toFixed(0));
    $("#paid").attr('data-parsley-min',gTot.toFixed(0));


  }else{
    sumTot = 0 + parseFloat(subtot) ;
    $("#tot").val(sumTot);
    $("#paid").attr('data-parsley-min',0);

  }

}

function calculatePayment(){
  var grandTot = $("#grandtotal").val(),
    paid = $("#paid").val(),
    change;
  
  if(paid.lenght != 0){
    change = paid - parseFloat(grandTot);
    $("#change").val(change.toFixed(0));
  }

}

function calculateRestPayment(){
  var grandTot = $("#grandtotal").val(),
    paid = $("#paid").val(),
    change;
  
  if(paid.lenght != 0){
    restpayment = parseFloat(grandTot) - paid;
    $("#sisa").val(restpayment.toFixed(0));
  }

}

function updatePrice(){
  var subtotalVal = $("#subtotal").val(),
    stot, gTot ;
  
  stot = parseFloat(subtotalVal);
  gTot = parseFloat(subtotalVal) + stot;
  
  $("#grandtotal").val(gTot);
  calculateDiscount();

}
  $(document).ready(function(){
    var options = {
      data: [           
        <?php  
          if($tindakan != false) {
            foreach($tindakan as $tindakan_list) {
              echo '{name: "'.$tindakan_list->tindakan_nama.'", id: "'.$tindakan_list->tindakan_id.'", type: "tindakan", hargajual: "'.$tindakan_list->tindakan_tarif.'", minorder: "1"},';
            }
          }
        ?>
        // {name: "Biaya Dokter", id: "999991", type: "other", hargajual: "50000", minorder: "1", stok: "1"},
        // {name: "Biaya Ronsen", id: "999992", type: "other", hargajual: "50000", minorder: "1", stok: "1"},
      ],
      getValue: "name",
      template: {
        type: "description",
          fields: {
            description: "type"
          }
      },
      list: {   
        match: {
            enabled: true
        },
        onClickEvent: function() {
          var count   = $('#tableSales tr').length;
          var item_id    = $("#hf-item").getSelectedItemData().id;
          var item_type  = $("#hf-item").getSelectedItemData().type;
          var item_harga = $("#hf-item").getSelectedItemData().hargajual;
          var item_stok  = $("#hf-item").getSelectedItemData().stok;
          var item_min   = $("#hf-item").getSelectedItemData().minorder;
          var item_name  = $("#hf-item").getSelectedItemData().name;
          var item_satuan= $("#hf-item").getSelectedItemData().satuan;

          if(item_satuan == 'none') {
            var input_qty = '<input min="1" id="qty_'+ count +'" value="1" data-type="qty" class="form-control qty listMenu" placeholder="0" type="number" name="qty[]" data-parsley-max="'+item_stok+'">';
          }
          else {
            var input_qty = '<div class="input-group"><input min="1" id="qty_'+ count +'" value="1" data-type="qty" class="form-control qty listMenu" placeholder="0" type="number" name="qty[]" data-parsley-max="'+item_stok+'" data-parsley-errors-container="#qty-error-'+ count +'"><span class="input-group-addon">'+item_satuan+'</span></div><div id="qty-error-'+ count +'"></div>';
          }
          
          $("#baris-kosong").remove();

          if(item_type == 'tindakan') var ronly_price = 'readonly';
          if(item_type == 'other' || item_type == 'tindakan') {
            $('#append-data').append('<tr id="item-pilih'+item_type+'-'+item_id+'"><td><input id="listmenuName_'+ count +'" value="'+ item_name +'" data-type="listmenuName" class="form-control listMenu input-no-readonly-bg" placeholder="" type="text" name="listmenuName[]" readonly><input type="hidden" value="'+ item_id +'" id="listmenu_'+count+'" class="form-control listMenu" name="listmenu[]" readonly><input type="hidden" value="'+ item_type +'" id="type_'+count+'" class="form-control listMenu" name="tipe[]" readonly></td>'+
              '<td><input id="qty_'+ count +'" value="1" data-type="qty" class="form-control qty listMenu" type="hidden" name="qty[]">-</td>'+
              '<td><input min="0" id="price_'+ count +'" value="'+ item_harga +'" data-type="price" class="form-control listMenu input-no-readonly-bg" placeholder="0" type="text" name="price[]" '+ronly_price+'></td>'+
              '<td><input min="0" id="total_'+ count +'" value="'+ item_harga +'" data-type="total" class="form-control total listMenu input-no-readonly-bg" placeholder="0" type="text" name="total[]" readonly></td><td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-item" data-delete="item-pilih'+item_type+'-'+item_id+'" data-name="'+item_name+'"><i class="fa fa-times"></i> Hapus</button></td></tr>' 
            )
            var price_fm = '#price_'+count;
            var total_fm = '#total_'+count;
            count++;
            calculateSum();
          }
          $('#paid, #subtotal, #disc, #tot, #grandtotal, #change, #sisa').number(true);
          $("#hf-item").val('');
          $("#hf-item").focus();
        }
       }
      };

      $("#hf-item").easyAutocomplete(options);
      $("#hf-item").focus();

      $("#sisabayar").hide();

      $(".total").on('change', function() {
        calculateSum();
        return false;
      });
  
      $("#disc").keyup(function() {
        var max_disc_str = $('#subtotal').val();
        var max_disc_int = parseInt(max_disc_str);
        // var max_disc = '300';
        if ($(this).val() > max_disc_int){
          alert("Diskon maksimal = Rp."+ max_disc_int);
          $(this).val(max_disc_int);
          calculateSum();
        }
        else{
          calculateSum();
          return false;
        }
      });
      // $('#disc').keypress(function(event) {
      //   if (event.keyCode == 13) {
      //     event.preventDefault();
      //   }
      // });
      $("#paid").on('change', function() {
        calculatePayment();
        return false;
      });
      $("#paid").keyup(function() {
        calculatePayment();
        return false;
      });
      $('#paid').keypress(function(event) {
        if (event.keyCode == 13) {
          event.preventDefault();
          calculatePayment();
          $("#change").focus();
        }
      });
      $("#tax").on('change', function() {
        calculateTax();
        return false;
      });
    });

$(document).on('focus','.listMenu', function(){
  var id_arr = $(this).attr('id'),
    id     = id_arr.split("_"),
    elementId = id[id.length-1],
    tot;

  //$("qty_"+elementId)
  $(this).on('keyup change click', function(){
    var qty     = $('#qty_'+elementId).val(),
      stock     = $('#stock_'+elementId).val(),
      price       = $('#price_'+elementId).val(),
      stock_min   = $('#min_qty').val(),
      grosirqty   = $('#grosir_qty').val(),
      ids     = $('#listmenu_'+elementId).val(),
      tot ;

    if(!isNaN(this.value) && this.value.length!=0) {
      tot = qty * parseFloat(price);
    }

    $('#total_'+elementId).val(tot.toFixed(0));
    console.log($('#total_'+elementId).val());
    calculateSum();

  })

  $('#price_'+elementId).keyup(function(){
    var qty     = $('#qty_'+elementId).val(),
      price       = $('#price_'+elementId).val(),
      tot ;
    
    if(!isNaN(this.value) && this.value.length!=0) {
      tot = qty * parseFloat(price);
    }
    
    $('#total_'+elementId).val(tot.toFixed(0));
    calculateSum();
  })
  
  $('#qty_'+elementId).keypress(function(event) {
    if (event.keyCode == 13) {
      event.preventDefault();
    }
  });
  
  $('#price_'+elementId).keypress(function(event) {
    if (event.keyCode == 13) {
      event.preventDefault();
    }
  });
  
  $('#total_'+elementId).keyup(function(){
    calculateSum(); 
  })
  
  $('#total_'+elementId).keydown(function(){
    calculateSum(); 
  })
  
  $('#total_'+elementId).keypress(function(){
    calculateSum(); 
  })
})
$(document).ready(function() {
  $('#datetimepicker3').datetimepicker({
           format: 'DD-MM-YYYY'
     });
  
  $('#modal-delete-item').on('show.bs.modal', function(e) {
      $(this).find('#button-delete-item').attr('data-id', $(e.relatedTarget).data('delete'));
      $(this).find('#item-name').html($(e.relatedTarget).data('name'));

      $(this).find('#button-delete-item').on('click',function() {
      var id = "#"+$(e.relatedTarget).data('delete');
      console.log(id);
      $(this).html('<i class="fa fa-spinner fa-pulse"></i> Menghapus...');
      var price    = $(id).find(".price").val();
      var jumlah   = $(id).find(".qty").val();
      var subtotal = $("#subtotal").val();
      var tot;
      tot = parseFloat(subtotal) - parseFloat(price*jumlah);
      $("#subtotal").val(tot);
      updatePrice();
        setTimeout(function() {
        $(id).remove();
        $("#modal-delete-item").modal('hide');
        }, 1000);
        setTimeout(function() {
          $("#button-delete-item").html('Hapus');
          if($('#append-data').children().length < 1) {
          $('#append-data').append('<tr id="baris-kosong"><td colspan="5" class="text-center"><em>Data masih kosong.</em></td></tr>');
        }
        }, 1200);
    })
  });

  $('#modal-delete-item').on('hidden.bs.modal', function(e) {
      $(this).find('#button-delete-item').attr('data-id', '');
  })

  var add_payment;    
  $("#form-add-pembayaran").submit(function(event){
      if (add_payment) {
           add_payment.abort();
      }
      var $form = $(this);
      var $inputs = $form.find("input, button");
      var serializedData = $form.serialize();
      add_payment = $.ajax({
          url: "pembayaran-add.php",
          type: "post",
          beforeSend: function(){ $("#button-add-pembayaran").html('<i class="fa fa-spinner fa-pulse"></i> Saving...'); $("#button-add-pembayaran").attr('disabled','disabled');},
          data: serializedData
      });
      add_payment.done(function (msg){
        console.log(msg);
        // console.log(serializedData);
          if(msg == 'error') {
              $("#button-add-pembayaran").removeAttr('disabled');
              $("#button-add-pembayaran").html('Save');
              $.gritter.add({
                  title:"Failed!",
                  text:"Can't add payment. Please try again.",
                  image:"",
                  sticky:false,
                  time:""
              });
          }
          else if(msg == 'success') {
              $.gritter.add({
                      title:"Success!",
                      text:"payment has been added.",
                      image:"",
                      sticky:false,
                      time:""
              });
              setTimeout(function() {
                  window.location="detail-pembayaran&<?php echo $invoice_number?>";
              }, 2000);
          }
          else {
              $("#button-add-pembayaran").removeAttr('disabled');
              $("#button-add-pembayaran").html('Save');
              $.gritter.add({
                  title:"Error! Can't added payment",
                  text:"Can't added payment. There is something error when updating. Please try again.",
                  image:"",
                  sticky:false,
                  time:""
              });
          }
      });
      add_payment.always(function () {
          $inputs.prop("disabled", false);
      });
      event.preventDefault();
  });
});
</script>