<?php

    /* Hola FPDF */

    require_once('fpdf185/fpdf.php');

    $nombre = 'Juan Carlos i';
    $apellidos = 'Moreno Jiménez';


    $pdf=new FPDF('P', 'mm', 'A4');

    $pdf->SetFillColor(240);
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Cell(60,10,iconv('UTF-8','ISO-8859-1','Nombre: '), 1, 0, 'R', true);
    $pdf->Cell(0, 10,iconv('UTF-8','ISO-8859-1',$nombre), 1, 1);
    $pdf->Cell(60,10,iconv('UTF-8','ISO-8859-1','Apellidos: '), 1, 0, 'R', true);
    $pdf->Cell(0,10,iconv('UTF-8','ISO-8859-1',$apellidos), 1);

    $pdf->Output("I", "doc.pdf", true);

?>