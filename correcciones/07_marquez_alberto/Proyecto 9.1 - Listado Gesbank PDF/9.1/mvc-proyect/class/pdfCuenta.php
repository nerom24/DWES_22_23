<?php
    class pdfCuenta extends FPDF{

        public function Header(){
            
            $this->SetFont('Arial', '', 12);
             $this->Cell(30, 10, 'GESBANK 1.0', 0, 0, 'L');
             $this->Cell(130, 10, 'Alberto Marquez', 0, 0, 'C');
                 $this->Cell(30, 10, '2DAW 22/23', 0, 0, 'R');
                 $this->Cell(0, 10, '', 'B', 1);
         }
 
 
         public function Footer()
         {
             $this->setY(-10);
             $this->SetFont('Times', 'B', 10);
             $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');
         }
 
         public function Titulo(){
 
            // Título en negrita tamaño 12
         $this->SetFont('Arial', 'B', 12);
         $this->Cell(0, 10, 'Informe: Listado de Cuentas', 0, 1, 'C');
         $this->SetFont('Arial', '', 10);
         // Muestra la fecha actual
         $this->Cell(0, 5, 'Fecha: '.date('d/m/Y H:i:s'), 0, 1, 'C');
         $this->Ln(10);
         }

        public function Encabezado(){
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(255, 165, 0);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'ID '), 'B', 0, 'R');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'Nº CUENTA: '), 'B', 0, 'L');
            $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'ID CLIENTE: '), 'B', 0, 'L');
            $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'FECHA DE ALTA: '), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Nº MOVIMIENTOS: '), 'B', 0, 'L');
            $this->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', 'SALDO: '), 'B', 1, 'L');

        }
    }
?>