<?php

class Invoice{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function addInvoice($subtotal, $discount, $total, $grandtotal, $change, $payment, $number, $pasien_id) {
        $result = $this->pdo->prepare("INSERT INTO invoice (
            invoice_subtotal,
            invoice_discount,
            invoice_total,
            invoice_grandtotal,
            invoice_change,
            invoice_payment,
            invoice_number,
            pasien_id)
            VALUES(
            :invoice_subtotal,
            :invoice_discount,
            :invoice_total,
            :invoice_grandtotal,
            :invoice_change,
            :invoice_payment,
            :invoice_number,
            :pasien_id)");        
        $result->bindParam(':invoice_subtotal',$subtotal);
        $result->bindParam(':invoice_discount',$discount);
        $result->bindParam(':invoice_total',$total);
        $result->bindParam(':invoice_grandtotal',$grandtotal);
        $result->bindParam(':invoice_change',$change);
        $result->bindParam(':invoice_payment',$payment);
        $result->bindParam(':invoice_number',$number);
        $result->bindParam(':pasien_id',$pasien_id);
        if($result->execute()){
            return true;
        } else {return false;}
    }
    public function addInvoiceDetail($itemID, $qty, $price, $invoice_number){
        $detInvoice = $this->pdo->prepare("INSERT INTO invoicedetail(
            invoicedetail_itemID,
            invoicedetail_quantity,
            invoicedetail_price,
            invoice_number)
            VALUES(
            :invoicedetail_itemID,
            :invoicedetail_quantity,
            :invoicedetail_price,
            :invoice_number)");
        $detInvoice->bindParam(':invoicedetail_itemID', $itemID);
        $detInvoice->bindParam(':invoicedetail_quantity', $qty);
        $detInvoice->bindParam(':invoicedetail_price', $price);
        $detInvoice->bindParam(':invoice_number', $invoice_number);
        $detInvoice->execute();
    }
    public function addTransaksiPasien($pasien_id, $item_id, $invoice_number, $discount){
        $transaksi = $this->pdo->prepare("INSERT INTO transaksipasien(
            pasien_id,
            tindakan_id,
            invoice_number,
            transaksipasien_diskon)
            VALUES(
            :pasien_id,
            :tindakan_id,
            :invoice_number,
            :transaksipasien_diskon)");
        $transaksi->bindParam(':pasien_id', $pasien_id);
        $transaksi->bindParam(':tindakan_id', $item_id);
        $transaksi->bindParam(':invoice_number', $invoice_number);
        $transaksi->bindParam(':transaksipasien_diskon', $discount);
        $transaksi->execute();
    }
    public function viewInvoice ($invoice_number){
        $result = $this->pdo->query("SELECT * FROM invoice i, pasien p WHERE i.pasien_id=p.pasien_id && invoice_number='$invoice_number'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function viewInvoiceDetail($invoice_number) {
        $result    = $this->pdo->query("SELECT * FROM invoicedetail WHERE invoice_number = '$invoice_number' ORDER BY invoicedetail_id asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function showinvoice (){
        $result  = $this->pdo->query("SELECT * FROM invoice");
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
    }
    
    public function deleteinvoice($invoiceID, $nama_foto) {
        $cek_foto_query = $this->pdo->query("SELECT * FROM invoice p, foto f WHERE p.invoice_id='$invoiceID' AND p.invoice_id = f.invoice_id");
        if ($cek_foto_query->rowCount() > 0 ) {
            $cek_foto = $cek_foto_query->fetch(PDO::FETCH_OBJ);
            $nama_foto = $cek_foto->foto_nama;
            $array_foto = array($nama_foto);
            for ($i=0; $i<=$cek_foto_query->rowCount(); $i++ ) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/invoice/'.$array_foto[$i]);
                unlink($_SERVER['DOCUMENT_ROOT'].'/vozz/assets/images/_thumbs/'.$array_foto[$i]);
                $i += 1;
                // echo $data;
            }
            // $delFoto = $this->pdo->prepare("DELETE FROM foto WHERE invoice_id='$invoiceID'");
            // $delFoto->execute();
        }

        // $result = $this->pdo->prepare("DELETE FROM invoice WHERE invoice_id = ?");
        // $result->bindParam(1, $invoiceID);
        // $result->execute();
    }
    public function updateInvoice($no, $nama, $tgllahir, $umur, $alamat, $jk, $telp, $ortu) {
        $result = $this->pdo->prepare("UPDATE invoice SET  
            invoice_id        =:invoice_id, 
            invoice_nama      =:invoice_nama,
            invoice_tglLahir  =:invoice_tglLahir,
            invoice_umur      =:invoice_umur,
            invoice_alamat    =:invoice_alamat,
            invoice_jk      =:invoice_jk,
            invoice_telp      =:invoice_telp,
            invoice_ortu      =:invoice_ortu
            WHERE invoice_id  =:invoice_id"); 
        $result->bindParam(':invoice_id', $no);
        $result->bindParam(':invoice_nama', $nama);
        $result->bindParam(':invoice_tglLahir', $tgllahir);
        $result->bindParam(':invoice_umur', $umur);
        $result->bindParam(':invoice_alamat', $alamat);
        $result->bindParam(':invoice_jk', $jk);
        $result->bindParam(':invoice_telp', $telp);
        $result->bindParam(':invoice_ortu', $ortu);
        
        if($result->execute()){
            return true;
        } else {return false;}
    }
    public function checkName($nama) {
        $result = $this->pdo->query("SELECT * FROM invoice WHERE invoice_nama = '$nama'");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            $alert = 1;
            return $alert;
        }
    }
    
}