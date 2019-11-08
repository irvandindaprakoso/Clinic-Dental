<?php 
    require_once "../assets/plugins/dompdf/autoload.inc.php";

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $html = file_get_contents('page-monitoring-print.php');

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'Potrait');

    $dompdf->render();

    $dompdf->stream();
?>
