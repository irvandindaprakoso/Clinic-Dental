<?php
require "../includes/database.php";//database
require "../includes/Invoice-class.php";//all data
require "../includes/Generate-invoice-number.php";//all data
	
	$class_invoice = new Invoice($pdo);
	$invoice_number = $_POST['invoice_number'];
	$subtotal    = $_POST['subtotal'];
	$discount  	 = $_POST['disc'];
	$total       = $_POST['tot'];
	$grandtotal  = $_POST['grandtotal'];
	$pasien_id   = $_POST['pasienID'];
	$itemID  	 = $_POST['item'];
	$kembali  	 = $_POST['change'];
	$bayar  	 = $_POST['paid'];

	$create_invoice = $class_invoice->addInvoice($subtotal, $discount, $total, $grandtotal, $kembali, $bayar, $invoice_number, $pasien_id);
	if($create_invoice == true) {
        if(isset($_POST['listmenu'])){
            foreach($_POST['listmenu'] as $key => $value ){
                $type           = $_POST['tipe'][$key];
                $listmenuName   = $_POST['listmenuName'][$key];
                $listmenuID     = $value;
                $qty            = $_POST['qty'][$key];
                $price          = $_POST['price'][$key];
                $total          = $_POST['total'][$key];
                if($type == 'tindakan') {
                    $add_transaksi = $class_invoice->addTransaksiPasien($pasien_id, $listmenuID, $invoice_number, $discount);
                }
                $add_invoice_detail = $class_invoice->addInvoiceDetail($listmenuID, $qty, $price, $invoice_number);
            }
            // unset($_SESSION['diagnosa_dokter']);
            // unset($_SESSION['tindakan_dokter']);
            // unset($_SESSION['jumlah_tindakan_dokter']);
            // unset($_SESSION['biaya_lab']);
            // unset($_SESSION['obat']);
            // unset($_SESSION['rekammedis']);
            // echo 'true,'.$invoice_number;
        }
        else {
            echo 'false';
        }
        echo "success";
    }
    else {
        echo 'false';
    }
?>