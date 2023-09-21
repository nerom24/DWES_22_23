<?php


    class pdfMovimientos extends FPDF{

        public function Header(){
            
            $this->SetFont('Times', 'B', 12);
            $this->Cell(0, 16, 'Movimientos - ' . date('d/m/Y'), 'B', 1, 'R');
            $this->ln(5);
        }


        public function Footer()
        {
            $this->setY(-10);
            $this->SetFont('Times', 'B', 10);
            $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');
        }

        public function Titulo(){

            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Lista Movimientos'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'ID'), 1, 1);
            $this->Ln(5);
        }

        public function CabListadoArticulos(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'ID '), 'B', 0, 'L');
            $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Concepto '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Tipo '), 'B', 0, 'L');
            $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Cantidad'), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Saldo '), 'B', 1, 'L');

        }

    }



?>