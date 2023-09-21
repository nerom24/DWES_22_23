<?php

    class pdfCuenta extends FPDF{

        public function Header(){
            
            $this->SetFont('helvetica', 'B', 18);            
            $this->Cell(50, 10, 'GESBANK 1.0', 0, 0, 'L');
            $this->Cell(90, 10, 'Antonio Juan', 0, 0, 'C');
            $this->Cell(50, 10, '2DAW 22/23', 0, 0, 'C');
            $this->ln(8);
            $this->setY(20);
        }


        public function Footer()
        {
            $this->setY(-20);
            $this->SetFont('courier', 'B', 12);
            $this->Cell(0,10, 'Pagina' .$this->PageNo() .'/{nb}','T' ,0 ,'C');
        }

        public function Titulo(){

            $this->SetFont('courier', 'B', 12);
            $this->SetFillColor(98, 101, 103);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Tabla: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Cuenta'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Fecha: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1',date('Y-m-d H:i:s')), 1, 1);
            $this->Ln(5);
        }

        public function Encabezado(){
            
            $this->SetFont('courier', 'B', 12);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id '), 'B', 0, 'R');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Num_cuenta '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Id_cliente '), 'B', 0, 'R');
            $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Fecha_alta '), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Num_movtos '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Saldo '), 'B', 1, 'L');

        }

    }
