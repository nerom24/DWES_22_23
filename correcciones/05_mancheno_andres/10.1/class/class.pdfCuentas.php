<?php

    // Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

    class pdfCuenta extends FPDF{

        public function Header(){
            
            $this->Image("logo/santander.png", 10,18, 20);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 21, date('d/m/Y'), 'B', 1, 'R');
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
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Cuentas'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Por ID'), 1, 1);
            $this->Ln(5);
        }

        public function CabListadoCuentas(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(200);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id: '), 'B', 0, 'R');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Nombre: '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'IBAN: '), 'B', 0, 'L');
            $this->Cell(45, 7, iconv('UTF-8', 'ISO-8859-1', 'Fecha de alta: '), 'B', 0, 'L');
            $this->Cell(53, 7, iconv('UTF-8', 'ISO-8859-1', 'Nº Movimientos: '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Saldo: '), 'B', 1, 'L');

        }

    }



?>