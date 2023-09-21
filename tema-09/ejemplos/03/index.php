<?php

    /* Hola FPDF */

    require_once('fpdf185/fpdf.php');
    require_once('class/pdfArticulos.php');
    require_once('datos/articulos.php');

    $pdf=new pdfArticulo('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();

    # Muestro el título del documento
    $pdf->Titulo();

    # Cabecera del listado de artículos
    $pdf->CabListadoArticulos();

    $pdf->SetFont('Times','',10);

    foreach($articulos as $articulo) {

        $pdf->Cell(10, 7, iconv('UTF-8','ISO-8859-1',$articulo['id']), 'B', 0, 'R');
        $pdf->Cell(50, 7, iconv('UTF-8','ISO-8859-1',$articulo['Descripción']), 'B', 0, 'L');
        $pdf->Cell(30, 7, iconv('UTF-8','ISO-8859-1',$articulo['Fabricante']), 'B', 0, 'L');
        $pdf->Cell(30, 7, iconv('UTF-8','ISO-8859-1',$articulo['Categoría']), 'B', 0, 'L');
        $pdf->Cell(40, 7, iconv('UTF-8','ISO-8859-1',implode(", ", $articulo['Etiquetas'])), 'B', 0, 'L');
        $pdf->Cell(30, 7, iconv('UTF-8','ISO-8859-1',$articulo['Precio']), 'B', 1, 'R');

    }


    $pdf->Output("I", "doc.pdf", true);

?>