<?php
    function generateInvoiceNumber($param=''){
		$link = mysqli_connect("localhost", "root", "", "vozz"); 
		$result=mysqli_query($link,"SELECT SUBSTR(MAX(invoice_number),-4) AS ID FROM invoice");
		$dataMax=mysqli_fetch_array($result);
        if($dataMax['ID']==''){
            $ID = $param."0001";
        }
        else{
            $maxID = $dataMax['ID'];
            $maxID++;
            if($maxID<10) $ID = $param.'000'.$maxID;
            else if($maxID<100) $ID = $param.'00'.$maxID;
            else if($maxID<1000) $ID = $param.'0'.$maxID;
            else $ID = $maxID;
        }
        return $ID;
    }
?>