<?php

    // Genero una clase pdf por cada tabla que vaya a imprimir en mi proyecto

    class pdfClientes extends FPDF{

        public function Header() {
            
            $this->Image("logo/clientes/logo.png", 10,5, 20);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 16, 'ALVARO MORENO GIL', 'B', 1, 'R');
            $this->ln(5);
        }


        public function Footer() {

            $this->setY(-10);
            $this->SetFont('Times', 'B', 10);
            $this->Cell(0,10, 'Page' .$this->PageNo() .'/{nb}','T' ,0 ,'C');
        }

        public function Titulo() {

            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(255,128,0);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Listado: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Productos'),1 , 1);
            $this->Cell(60,10,iconv('UTF-8', 'ISO-8859-1', 'Criterio: '), 1, 0, "R", true);
            $this->Cell(0,10,iconv('UTF-8', 'ISO-8859-1', 'Orden de Creación'), 1, 1);
            $this->Ln(5);
        }

        public function Encabezado() {

        }

        public function Cuerpo() {
            
            $this->SetFont('Times', 'B', 10);
            $this->SetFillColor(255,255,255);
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id  '), 'B', 0, 'R');
            $this->Cell(60, 7, iconv('UTF-8', 'ISO-8859-1', 'Nombre'), 'B', 0, 'L');
            $this->Cell(25, 7, iconv('UTF-8', 'ISO-8859-1', 'Email'), 'B', 0, 'L');
            $this->Cell(55, 7, iconv('UTF-8', 'ISO-8859-1', 'Poblacion'), 'B', 0, 'L');
            $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'DNI'), 'B', 0, 'L');
            $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Curso'), 'B', 1, 'R');

        }

    }


?>