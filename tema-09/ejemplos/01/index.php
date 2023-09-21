<?php

    /* Hola FPDF */

    require('fpdf185/fpdf.php');

    $pdf = new FPDF();

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    // $pdf->Cell(40,10, iconv('UTF-8','ISO-8859-1','¡Hola mundo FPDF!'));

    $pdf->Cell(40,10, mb_convert_encoding('¡Hola mundo FPDF!', 'ISO-8859-1','UTF-8' ));

    $pdf->Output();

?>