<?php

// Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

class pdfMovimiento  extends FPDF
{

    public function Header()
    {
        $this->Image("imagenes/logo/logo.jpg", 10, 5, 20);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 16, 'MOVIMIENTOS ', 'B', 1, 'R');

        $this->ln(5);
    }


    public function Footer()
    {
        $this->setY(-10);
        $this->SetFont('Times', 'B', 10);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }
    public function Titulo()
    {
        $this->SetFont('Times', 'B', 10);
        $this->SetFillColor(200);
        $this->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Movimientos'), 1, 1);
        $this->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Por id'), 1, 1);
        $this->Ln(5);
    }
    public function CabListadoMovimiento()
    {
        $this->SetFont('Times', 'B', 10);
        $this->SetFillColor(200);
        $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id: '), 'B', 0, 'L');
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Nº Cuenta: '), 'B', 0, 'L');
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Fecha hora: '), 'B', 0, 'L');
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Concepto: '), 'B', 0, 'L');
        $this->Cell(15, 7, iconv('UTF-8', 'ISO-8859-1', 'Tipo: '), 'B', 0, 'L');
        $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Cantidad: '), 'B', 0, 'L');
        $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Saldo: '), 'B', 1, 'R');
    }
}
